<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    
    public function __construct()
    {
     $this->middleware('permission:create roles', ['only' => ['store']]);
     $this->middleware('permission:update roles', ['only' => ['edit','update']]);
     $this->middleware('permission:read roles', ['only' => ['index']]);
     $this->middleware('permission:delete roles', ['only' => ['destroy']]);

    }
    //
    public function index()
    {
        return view(
            'Roles.index',
            [
                
                'roles' => Role::orderBy('name')->get(),
                'permissions'=>Permission::all()


            ]
        );
    }

    public function edit(Role $role){

        return view(
            'Roles.edit',[
                'role'=> $role,
                'permissions'=>Permission::all()

            ]
        );
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('roles', 'name')]
        ]);

        $selectedPermissions = $request->input('assigned_permissions', []);

        $role=Role::create($formFields);

        foreach($selectedPermissions as $Permissions){
            $role->givePermissionTo(Permission::find($Permissions));
        }
        return redirect("/role")->with('message', 'role created successfully');
    }


    public function update(Role $role,Request $request){
        $formFields = $request->validate([
            'name' => ['required']
        ]);

        $assigned_permissions = $request->input('assigned_permissions', []);
        $not_assigned_permissions = $request->input('not_assigned_permissions', []);

        if($assigned_permissions){
            foreach($assigned_permissions as $Permissions){
                $role->revokePermissionTo(Permission::find($Permissions));
            }
        }

        if($not_assigned_permissions){
            foreach($not_assigned_permissions as $Permissions){
                $role->givePermissionTo(Permission::find($Permissions));
            }
        }

        $role->update($formFields);

        return redirect("/role")->with('message', 'role updated successfully');

    }
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect('/role')->with("message", "role deleted successfully!!!");

    }
}
