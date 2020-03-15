<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:clinic');
    }

    // Define Constants
    const MY_PROFILE_UPDATE = 'Your Profile has been updated successfully';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('_clinic.dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
        $clinic = Auth::guard('clinic')->user();
        return view('_clinic.my_profile', compact('clinic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $clinic = Auth::guard('clinic')->user();
        $clinic->name = $request->name;
        if(! empty($request->password) ){
           $clinic->password = bcrypt($request->password);
        }
        $clinic->save();

        return back()->with('success', static::MY_PROFILE_UPDATE);
    }

}