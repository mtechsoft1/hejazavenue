<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Destination;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $destinations = Destination::orderBy('created_at', 'desc')->paginate(12);
 
        return view('admin.destination.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.destination.create');
        
    }
      
       /**
        * Store a newly created resource in storage.
        *
        * @param \Illuminate\Http\Request $request
        *
        * @return \Illuminate\Http\Response
        */

        
    public function store(Request $request)
    {
        $destination = new Destination;
        if($request->has('destination_name') && $request->destination_name !="")
        {
        $destination->destination_name = $request->destination_name;
        }
        if($request->has('is_public') && $request->is_public !="")
        {
        $destination->is_public = $request-> is_public;
        }
        if($request->has('destination_image') && $request->destination_image !="")
            {
                if( $request->destination_image->getClientOriginalExtension() == 'PNG' ||
                    $request->destination_image->getClientOriginalExtension() == 'png' ||
                    $request->destination_image->getClientOriginalExtension() == 'JPG' ||
                    $request->destination_image->getClientOriginalExtension() == 'jpg' ||
                    $request->destination_image->getClientOriginalExtension() == 'jpeg' ||
                    $request->destination_image->getClientOriginalExtension() == 'JPEG')
                {
                    $newfilename = md5(mt_rand()) .'.'. $request->destination_image->getClientOriginalExtension();
                    $request->file('destination_image')->move(public_path("/tour_images"), $newfilename);
                    $new_path1 = 'tour_images/'.$newfilename;
                    $destination->destination_image = $new_path1;
                }
                else{
                    return back()->with('error','Choose a Valid Image !');
                }
            }
            $destination->save();
            return back()->with('message','Destination Added Successfully !');
        //
        // $data=array();
        // $data['destination_name'] = $request->destination_name;
        // $data['is_public'] = $request->is_public;


        // $image = $request->file('destination_image');
        // // dd($data);
        // if ($image){
        //     $image_name = date('dmy_H_s_i');
        //     $ext = strtolower($image->getClientOriginalExtension());
        //     $image_fullname = $image_name. '.' .$ext;
        //     $upload_path= 'public/tour_images/';
        //     $image_url = $upload_path. $image_fullname;
        //     $success = $image->move($upload_path,$image_fullname);
        //     $data['destination_image'] =$image_url;
        //     $tour = DB::table('destinations')->insert($data);
        //     return back()->with('success', 'Destination Insert Successfuly');
        // }
    
        // $data=array();
        // $data['destination_name'] = $request->destination_name;
        // $data['is_public'] = $request->is_public;
        // $file_name = $request->destination_image->getClientOriginalName();
        //     $generated_new_name = time() . '.' . $request->file->getClientOriginalExtension();
        //     $image = 'public/tour_image' . $generated_new_name;
        //     $request->destination_image->store($image);

        // $messages = [
        //     'required' => 'This field is required.',
        //    ];
         
        //    Destination::make($request->all(), [
        //     'destination_name'       => 'required',
        //     'is_public'        => 'required',
        //     'phone'       => 'required',
        //     'phone'      => 'unique:consumers',
        //    ], $messages)->validate();
          
         
        //   $destinations = Destination::create($request->all());
          
        // //    Alert::alert('Saved', 'Your Record is saved!', 'success');
        //   return redirect('admin.destination.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $picking = PickingTourPoint::where('tour_id',$id)->get();
        $destinations = Destination::findOrFail($id);
        return view ('admin.destination.show', compact('destinations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $destination = DB::select('select * from destinations where id = ?' ,[$id]);
        return view ('admin.destination.edit' , ['destinations'=>$destination]);
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
        
        $destination = Destination::find($id);
        if($request->has('destination_name') && $request->destination_name !="")
        {
        $destination->destination_name = $request->destination_name;
        }
        if($request->has('is_public') && $request->is_public !="")
        {
        $destination->is_public = $request-> is_public;
        }
        if($request->has('destination_image') && $request->destination_image !="")
            {
                if( $request->destination_image->getClientOriginalExtension() == 'PNG' ||
                    $request->destination_image->getClientOriginalExtension() == 'png' ||
                    $request->destination_image->getClientOriginalExtension() == 'JPG' ||
                    $request->destination_image->getClientOriginalExtension() == 'jpg' ||
                    $request->destination_image->getClientOriginalExtension() == 'jpeg' ||
                    $request->destination_image->getClientOriginalExtension() == 'JPEG')
                {
                    $newfilename = md5(mt_rand()) .'.'. $request->destination_image->getClientOriginalExtension();
                    $request->file('destination_image')->move(public_path("/tour_images"), $newfilename);
                    $new_path1 = 'tour_images/'.$newfilename;
                    $destination->destination_image = $new_path1;
                }
                else{
                    return back()->with('error','Choose a Valid Image !');
                }
            }
            $destination->save();
            return back()->with('message','Destination Updated Successfully !');
        //
        // $ddestination_name = $request->input('destination_name');
        // $is_public= $request->input('is_public');


        // $image = $request->file('destination_image');
        // // dd($data);
        // if ($image){
        //     $image_name = date('dmy_H_s_i');
        //     $ext = strtolower($image->getClientOriginalExtension());
        //     $image_fullname = $image_name. '.' .$ext;
        //     $upload_path= 'public/tour_images/';
        //     $image_url = $upload_path. $image_fullname;
        //     $success = $image->move($upload_path,$image_fullname);
        //     $destination_image = $image_url;
            
        // }
        // DB::table('destinations')->where('id',$id)
        // ->update(['destination_name' => $ddestination_name, 'destination_image' => $destination_image, 'is_public' => $is_public]); 
        
        // return back()->with('success' , 'Data Updated');
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
            $destination = Destination::find($id);

            if(empty($destination))
            {
                return back()->with('error', 'Destination does not Exists!');
            }     
            $destination->applicants()->detach();

            $destination->delete();

            return back()->with('message', 'Destination Deleted');

        }catch(\Exception $e)
        {
            return back()->with('error', 'There is some trouble to proceed your action!');
        }
    }
    }
    

