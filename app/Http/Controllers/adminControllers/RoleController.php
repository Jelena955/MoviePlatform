<?php


namespace App\Http\Controllers\adminControllers;

use App\Http\Controllers\Controller;
use App\Http\Request\RoleRequest;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index ()
    {
        $this->data['roles'] = Role::all ();
        return view ('pages.admin.tables-role', $this->data);
    }

    public function create ()
    {
        return view ('pages.admin.insert-role', $this->data);
    }

    public function edit ($id)
    {
        $this->data['role'] = Role::find ($id);
        return view ('pages.admin.edit-role', $this->data);
    }

    public function update (Request $request, $id)
    {
        try {
            \DB::beginTransaction ();
            $role = Role::find ($id);
            $role->role = $request->role;
            $role->save ();
            \DB::commit ();
            return redirect ('/adminRole')->with ('status', 'Successfully edited role');
        } catch (\Exception $e) {
            \DB::rollback ();
            return redirect ('/adminRole')->with ('error', 'Something went wrong, try role');

        }
    }

    public function store (RoleRequest $request)
    {

        $this->data['role'] = $request->role;
        try {
            \DB::beginTransaction ();
            Role::create (["role" => $request->role]);
            \DB::commit ();
            return redirect ('/insertRoleForm')->with ('status', 'Successfully added role');
        } catch (\Exception $e) {
            \DB::rollBack ();
            return redirect ('/insertRoleForm')->with ('error', 'Something went wrong, try again');

        }
    }

    public function destroy (Role $role)
    {
        try {
            \DB::beginTransaction ();
            $role->delete ();
            \DB::commit ();
            return redirect ('/adminRole')->with ('status', 'Successfully deleted role');
        } catch (Exception $e) {
            return redirect ('/adminRole')->with ('error', 'Something went wrong, try again');
            \DB::rollBack ();

        }
    }
}


