<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

use App\Models\Clinic;
use App\Models\Admin\ClinicProfile;

class ClinicController extends Controller
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

    const CLINIC_CREATE = 'Clinic has been created successfully';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $clinics = Clinic::with('clinic_profile')->latest()->get();
        return view('_admin.clinic_listing', compact('clinics'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('_admin.clinic_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'clinic_reference_id' => 'required',
            'clinic_name' => 'required',
            'clinic_address' => 'required',
            'phone_number' => 'required',
            'secondary_email' => 'required|email',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'ac_number' => 'required',
            'ac_holder_name' => 'required',
            'bank_name' => 'required',
            'bank_code' => 'required',
            'bank_address' => 'required',
            'commission_percentage' => 'required',
        ]);

        $clinic_admin = Clinic::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Trigger Mail Here

        if($clinic_admin){
            $clinic_profile = new ClinicProfile();
            $clinic_profile->createdByAdminId = Auth::guard('admin')->user()->id;
            $clinic_profile->clinicAdminId = $clinic_admin->id;
            $clinic_profile->clinicReferenceId = $request->clinic_reference_id;
            $clinic_profile->clinicName = $request->clinic_name;
            $clinic_profile->clinicAddress = $request->clinic_address;
            $clinic_profile->phoneNumber = $request->phone_number;
            $clinic_profile->secondaryEmail = $request->secondary_email;
            $clinic_profile->bankAcNumber = $request->ac_number;
            $clinic_profile->bankAcHolderName = $request->ac_holder_name;
            $clinic_profile->bankName = $request->bank_name;
            $clinic_profile->bankCode = $request->bank_code;
            $clinic_profile->bankAddress = $request->bank_address;
            $clinic_profile->commissionPercentage = $request->commission_percentage;
            $clinic_profile->save();
        }

        return redirect()->route('admin_clinic_list')->with('success', static::CLINIC_CREATE);
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
    public function destroy($id)
    {
        //
    }
}
