<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

use App\Models\Clinic;
use App\Models\Admin\ClinicProfile;
use App\Events\ClinicWasActivatedEvent;
use StringHelper;

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

    // Define Constants
    const CLINIC_CREATE = 'Clinic has been created successfully';
    const CLINIC_UPDATE = 'Clinic has been updated successfully';
    const CLINIC_DELETE = 'Clinic has been deleted successfully';
    const CLINIC_DELETE_FAIL = 'Something went wrong. Clinic deletion failure.';
    const CLINIC_STATUS = 'Clinic Status has been changed successfully';

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
            'clinic_reference_num' => 'required',
            'clinic_name' => 'required',
            'clinic_address' => 'required',
            'phone_number' => 'required',
            'secondary_email' => 'required|email',
            'name' => 'required',
            'email' => 'required|email|unique:clinic_admins',
            'ac_number' => 'required',
            'ac_holder_name' => 'required',
            'bank_name' => 'required',
            'bank_code' => 'required',
            'bank_address' => 'required',
            // 'commission_percentage' => 'required',
        ]);

        $clinic = Clinic::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('temporary_random_password'), // will change after clinic status is enabled
            'status' => 'suspend', // default
            'hasFirstTimeActivated' => 0 // default
        ]);

        if($clinic){
            $clinic_profile = new ClinicProfile();
            $clinic_profile->createdByAdminId = Auth::guard('admin')->user()->id;
            $clinic_profile->clinicRefNum = $request->clinic_reference_num;
            $clinic_profile->clinicName = $request->clinic_name;
            $clinic_profile->clinicAddress = $request->clinic_address;
            $clinic_profile->phoneNumber = $request->phone_number;
            $clinic_profile->secondaryEmail = $request->secondary_email;
            $clinic_profile->bankAcNumber = $request->ac_number;
            $clinic_profile->bankAcHolderName = $request->ac_holder_name;
            $clinic_profile->bankName = $request->bank_name;
            $clinic_profile->bankCode = $request->bank_code;
            $clinic_profile->bankAddress = $request->bank_address;
            if($request->has('commission_percentage')){
                $clinic_profile->commissionPercentage = $request->commission_percentage;
            }
            $clinic->clinic_profile()->save($clinic_profile);
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
    public function edit($uuid)
    {
        $clinic = Clinic::fetchModelByUnqId($uuid);
        return view('_admin.clinic_edit', compact('clinic'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        $this->validate($request, [
            'clinic_name' => 'required',
            'clinic_address' => 'required',
            'phone_number' => 'required',
            'secondary_email' => 'required|email',
            'name' => 'required',
            'ac_number' => 'required',
            'ac_holder_name' => 'required',
            'bank_name' => 'required',
            'bank_code' => 'required',
            'bank_address' => 'required',
            // 'commission_percentage' => 'required',
        ]);

        $clinic = Clinic::fetchModelByUnqId($uuid);

        if($clinic->update(['name'=> $request->name])){
            $clinic->clinic_profile->clinicName = $request->clinic_name;
            $clinic->clinic_profile->clinicAddress = $request->clinic_address;
            $clinic->clinic_profile->phoneNumber = $request->phone_number;
            $clinic->clinic_profile->secondaryEmail = $request->secondary_email;
            $clinic->clinic_profile->bankAcNumber = $request->ac_number;
            $clinic->clinic_profile->bankAcHolderName = $request->ac_holder_name;
            $clinic->clinic_profile->bankName = $request->bank_name;
            $clinic->clinic_profile->bankCode = $request->bank_code;
            $clinic->clinic_profile->bankAddress = $request->bank_address;
            if($request->has('commission_percentage')){
                $clinic->clinic_profile->commissionPercentage = $request->commission_percentage;
            }
            $clinic->clinic_profile->save();
        }

        return redirect()->route('admin_clinic_list')->with('success', static::CLINIC_UPDATE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        try{
            $clinic = Clinic::fetchModelByUnqId($uuid);
            $clinic->clinic_profile->delete();
            $clinic->delete();

        } catch (\Exception $e) {
            // return $e->getMessage();
            return back()->withErrors(['error' => static::CLINIC_DELETE_FAIL]);
        }

        return back()->with('success', static::CLINIC_DELETE);
    }

    // Activate or Suspend Clinics
    public function toggleClinicStatus(Request $request)
    {
        if($request->ajax()){
            $newStatus = $request->status;
            $clinic = Clinic::fetchModelByUnqId($request->clinic_unqid);
            $clinic->status = $newStatus;

            if($newStatus == 'active' && $clinic->hasFirstTimeActivated == 0){ // means first time activation, Trigger Mail
                $password = StringHelper::randString(8);
                event( new ClinicWasActivatedEvent($clinic, $password) );
                $clinic->password = bcrypt($password);
                $clinic->hasFirstTimeActivated = 1;
            }
            $clinic->save();

            return response()->json(['status' => TRUE, 'message' => static::CLINIC_STATUS]);
        }
    }
}