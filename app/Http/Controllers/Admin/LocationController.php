<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Location;
use App\DeviceToken;
use App\Notification;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::where('camera_type', 'fixed')
            ->orderBy('created_at', 'desc')->paginate(12);

        return view('admin.locations.index', compact('locations'));
    }
    
      public function movable_cameras()
    {
        $locations = Location::where('camera_type', 'movable')
            ->orderBy('created_at', 'desc')->paginate(12);

        return view('admin.locations.movable_cameras', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $location = new Location;
            $location->camera_type = $request->camera_type;
            $location->latitude = $request->latitude;
            $location->longitude = $request->longitude;
            $location->speed_limit = $request->speed_limit;
            $location->speed_limit_unit = $request->speed_limit_unit;
            
            if($location->save())
            {
                if($request->camera_type == 'movable')
                {
                    $saved_location = Location::where('camera_type', 'movable')
                    ->orderBy('created_at', 'desc')
                    ->first();

                    $notification = new Notification;
                    $notification->location_id = $saved_location->id;
                    $notification->notification = 'A New Movable Location Added!';
                    if($notification->save())
                    {
                        $tokens = DeviceToken::all();
                    
                        if(!empty($tokens))
                        {
                            foreach($tokens as $token)
                            {
                                //Start FCM Android Code 
                                
                                $json_data = array('priority'=>'HIGH','to'=>$token->token,'data'=>array('title'=>'Radar Auto Ried', 'message' => 'New Movable Camera Added!', 'latitude' => $request->latitude, 'longitude' => $request->longitude));
                                
                                $data = json_encode($json_data);
                                //FCM API end-point
                                $url = 'https://fcm.googleapis.com/fcm/send';
                                //api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
                                $server_key = 'AAAAorplNfc:APA91bH2ZUf_pjkTvs5ZB0ldwtD0LoPO0y0BHAmO_rbYl-ckYqaO_poDLaO8e3Vua5QmFDQqMsPhFzdoigrsCugf1WiB1sv1oioYxSVbJItCI1xYJ1JwAN4LsptLqWcO-TTgFzuxuPWI';
                                //header with content_type api key
                                $headers = array(
                                    'Content-Type:application/json',
                                    'Authorization:key='.$server_key
                                );
                                //CURL request to route notification to FCM connection server (provided by Google)
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, $url);
                                curl_setopt($ch, CURLOPT_POST, true);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                                $result = curl_exec($ch);
                                if ($result === FALSE) {
                                    die('Oops! FCM Send Error: ' . curl_error($ch));
                                }
                                curl_close($ch);
                                
                                //End FCM Android Code
                                
                                //Start FCM iOS Code 
                                
                                // $token = $user->token;
                                
                                $json_data = array('to'=>$token->token, 'mutable-content' => 1, 'notification'=>array("title"=>"Radar Auto Ried", "body" => "Movable Camera Added", "sound" => "default", "priority" => "high"), 'data'=>array("latitude"=>$request->latitude, "longitude" =>$request->longitude));
                                $data = json_encode($json_data);
                                
                                //FCM API end-point
                                $url = 'https://fcm.googleapis.com/fcm/send';
                                //api_key in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
                                $server_key = 'AAAAorplNfc:APA91bH2ZUf_pjkTvs5ZB0ldwtD0LoPO0y0BHAmO_rbYl-ckYqaO_poDLaO8e3Vua5QmFDQqMsPhFzdoigrsCugf1WiB1sv1oioYxSVbJItCI1xYJ1JwAN4LsptLqWcO-TTgFzuxuPWI';
                                //header with content_type api key
                                $headers = array(
                                    'Content-Type:application/json',
                                    'Authorization:key='.$server_key
                                );
                                //CURL request to route notification to FCM connection server (provided by Google)
                                $ch = curl_init();
                                curl_setopt($ch, CURLOPT_URL, $url);
                                curl_setopt($ch, CURLOPT_POST, true);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                                $result = curl_exec($ch);
                                if ($result === FALSE) {
                                    die('Oops! FCM Send Error: ' . curl_error($ch));
                                }
                                curl_close($ch);
                                
                                //End FCM iOS Code       
                            }
                        }
                    }                    
                }
            }         
            
            return back()->with('message', 'Location Added Successfully!');
        }catch(\Exception $e)
        {
            return back()->with('error', 'There is some trouble to proceed your action!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $location = Location::find($id);
          return view('admin.locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            
             $location = Location::find($id);

            if(empty($location))
            {
                return back()->with('error', 'Location Does Not Exists!');
            }
            
            
            if($request->has('camera_type'))
            {
             $location->camera_type = $request->camera_type;   
            }
            if($request->has('latitude'))
            {
             $location->latitude = $request->latitude;   
            }
            if($request->has('longitude'))
            {
             $location->longitude = $request->longitude;
            }
             if($request->has('speed_limit'))
            {
              $location->speed_limit = $request->speed_limit;    
            }
            
            if($request->has('speed_limit_unit'))
            {
                $location->speed_limit_unit = $request->speed_limit_unit;
            }
           
            $location->save();

            return back()->with('message', 'Location Updated Successfully!');
        }catch(\Exception $e)
        {
            return back()->with('error', 'There is some trouble to proceed your action!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $location = Location::find($id);

            if(empty($location))
            {
                return back()->with('error', 'Location does not Exists!');
            }            

            $location->delete();

            return back()->with('success', 'Location Deleted');

        }catch(\Exception $e)
        {
            return back()->with('error', 'There is some trouble to proceed your action!');
        }
    }
}
