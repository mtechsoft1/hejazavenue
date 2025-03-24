<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use App\TourPickupPoint;
use Carbon\Carbon;

class AllUsersController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
     public function index()
            {
            $users = User::where('type', '1')
            ->orderBy('created_at', 'desc')->paginate(12);
            return view('admin.users.index', compact('users'));
            }
            /**
            * Display a listing of the resource.
            *
            * @return \Illuminate\Http\Response
            */
     public function indexprovider()
            {
            $users = User::where('type', '2')
            ->orderBy('created_at', 'desc')->paginate(12);
            return view('admin.users.indexprovider', compact('users'));
            }
            /**
            * Show the form for creating a new resource.
            *
            * @return \Illuminate\Http\Response
            */
     public function create()
            {
            
            return view('admin.users.create');
            }
            /**
            * Store a newly created resource in storage.
            *
            * @param  \Illuminate\Http\Request  $request
            * @return \Illuminate\Http\Response
            */
     public function store(Request $request)
            {
            //
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
            $user = User::findOrFail($id);
            return view('admin.users.show', compact('user'));
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
            //
            }
            /**
            * Remove the specified resource from storage.
            *
            * @param  int  $id
            * @return \Illuminate\Http\Response
            */
            //  function for geting pickup point id
     public function pickuppoint($id)
            {
            $picking_point =TourPickupPoint::where('tour_id',$id)->get();
            return view('admin.tours.pick_up_point', compact('picking_point'));
            }
            // function for showing list of pickup point 
     public function pickupshow($id)
            {
            $picking_point = TourPickupPoint::findOrFail($id);
            return view ('admin.tours.pickup_point_show', compact('picking_point'));
            }
     public function pickupdelete($id)
            {
            try{
            $pickuppoint = TourPickupPoint::find($id);
            if(empty($pickuppoint))
            {
            return back()->with('error', 'Location does not Exists!');
            }            
            $pickuppoint->delete();
            return back()->with('success', 'Location Deleted');
            }catch(\Exception $e)
            {
            return back()->with('error', 'There is some trouble to proceed your action!');
            }
            }
     public function destroy($id)
        {
        try{
        $user = User::find($id);
        if(empty($user))
            {
            return back()->with('error', 'Location does not Exists!');
            }            
        $user->delete();
        return back()->with('success', 'Location Deleted');
            }catch(\Exception $e)
            {
            return back()->with('error', 'There is some trouble to proceed your action!');
            }
            }

            
            public function approve_provider($id)
            {
                $user = User::find($id);
                $user->email_verified_at = Carbon::now();
                $user->is_approved_by_admin = 'true';
                $user->save();
                if($user)
                {
                    return back()->with('message', 'Verified Successfully !');
                }
                else
                {
                    return back()->with('error', 'There is some trouble to proceed your action!');
                }
            }
}  