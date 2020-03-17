<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin;
use App\Events\AdminWasCreatedEvent;

class AdminController extends Controller
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
    const ADMIN_CREATE = 'Admin User has been created successfully';
    const ADMIN_UPDATE = 'Admin User has been updated successfully';
    const ADMIN_DELETE = 'Admin User has been deleted successfully';
    const ADMIN_DELETE_FAIL = 'Something went wrong. Admin User deletion failure.';

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $this->authorize('isSuper');
        $admins = Admin::where('isSuper', 0)->latest()->get();
        return view('_admin.admin_listing', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('_admin.admin_create');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Trigger Mail
        event( new AdminWasCreatedEvent($admin, $request) );

        return redirect()->route('admin_user_list')->with('success', static::ADMIN_CREATE);
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
        $admin = Admin::fetchModelByUnqId($uuid);
        return view('_admin.admin_edit', compact('admin'));
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
            'name' => 'required|string|max:255',
        ]);

        Admin::fetchModelByUnqId($uuid)->update(['name'=> $request->name]);

        return redirect()->route('admin_user_list')->with('success', static::ADMIN_UPDATE);
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
            $admin = Admin::fetchModelByUnqId($uuid);
            $admin->delete();

        } catch (\Exception $e) {
            // return $e->getMessage();
            return back()->withErrors(['error' => static::ADMIN_DELETE_FAIL]);
        }

        return back()->with('success', static::ADMIN_DELETE);
    }
}