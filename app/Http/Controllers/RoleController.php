<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $role = Role::all();
        $permission = Permission::all();
        return view('role')->with('roles',$role)
                           ->with('permissions',$permission);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (empty($request->role)) {
          Session::flash('message', 'Please fill role name');
        }else{
          $role = Role::where('name',$request->role)->get();
          if($role->isEmpty()){
               if(Role::create(['name' => $request->role])){
                  Session::flash('message', 'Role Created Successfully !!!');
                }else{
                  return "something went wrong try again later";
                }
          }else{
              Session::flash('message', 'Role already exists.. try another role name');
          }
        }

        return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('role.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $role_count = Role::where('name',$request->role)->get();
          if ($role_count->isEmpty()) {
            $role = Role::find($id);
            $role->name = $request->role;
            $role->save();
            Session::flash('message', 'Role Updated Successfully');
          }else{
            Session::flash('message', 'Role name already taken');
          }
        return redirect()->route('role.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id)->delete();
        Session::flash('message', 'Role Deleted');
        return redirect()->route('role.index');
    }

    public function assignPermission(Request $request, $id){

        if (empty($request->permission)) {
          Session::flash('message', 'Please Select Permission');
          return redirect()->route('role.index');
        }
        $role = Role::find($id);
        if($role->syncPermissions($request->permission)){
          Session::flash('message', 'Permission Assigned Successfully ...');
          return redirect()->route('role.index');
        }

    }

    public function roleHasPermission(Request $request){
      return 12345;
    }
}
