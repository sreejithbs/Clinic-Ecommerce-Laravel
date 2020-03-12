<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Clinic;
use App\Models\Admin;
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
        $this->middleware('auth:admin');
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
        $clinics_count = Clinic::count();
        return view('_admin.dashboard', compact('clinics_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editProfile()
    {
        $admin = Auth::guard('admin')->user();
        return view('_admin.my_profile', compact('admin'));
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

        $admin = Auth::guard('admin')->user();
        $admin->name = $request->name;
        if(request->has('password')){
           $admin->password = bcrypt($request->password);
        }
        $admin->save();

        return back()->with('success', static::MY_PROFILE_UPDATE);
    }

}
