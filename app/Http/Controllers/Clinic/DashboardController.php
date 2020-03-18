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
            'clinic_name' => 'required',
            'clinic_address' => 'required',
            'phone_number' => 'required',
            'secondary_email' => 'required|email',
            'name' => 'required',
            'password' => 'nullable|min:6',
            'ac_number' => 'required',
            'ac_holder_name' => 'required',
            'bank_name' => 'required',
            'bank_code' => 'required',
            'bank_address' => 'required',
        ]);

        $clinic = Auth::guard('clinic')->user();
        $clinic->name = $request->name;
        if(! empty($request->password) ){
           $clinic->password = bcrypt($request->password);
        }
        $clinic->save();

        $clinic->clinic_profile->clinicName = $request->clinic_name;
        $clinic->clinic_profile->clinicAddress = $request->clinic_address;
        $clinic->clinic_profile->phoneNumber = $request->phone_number;
        $clinic->clinic_profile->secondaryEmail = $request->secondary_email;
        $clinic->clinic_profile->bankAcNumber = $request->ac_number;
        $clinic->clinic_profile->bankAcHolderName = $request->ac_holder_name;
        $clinic->clinic_profile->bankName = $request->bank_name;
        $clinic->clinic_profile->bankCode = $request->bank_code;
        $clinic->clinic_profile->bankAddress = $request->bank_address;
        $clinic->clinic_profile->save();

        return back()->with('success', static::MY_PROFILE_UPDATE);
    }

}