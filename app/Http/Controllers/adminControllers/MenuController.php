<?php

namespace App\Http\Controllers\adminControllers;

use App\Http\Controllers\Controller;
use App\Http\Request\MenuRequest;
use App\Models\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index ()
    {
        return view ('pages.admin.tables-menu', $this->data);
    }

    public function create ()
    {
//    dd ($this->data['year']+1);
        return view ('pages.admin.insert-menu', $this->data);
    }

    public function edit ($id)
    {
        $this->data['link'] = Menu::find ($id);
        return view ('pages.admin.edit-menu', $this->data);
    }

    public function update (Request $request, $id)
    {
        try {
            \DB::beginTransaction ();
            $menu = Menu::find ($id);
            $menu->link = $request->link;
            $menu->menu_title = $request->menu_title;
            $menu->save ();
            \DB::commit ();
            return redirect ('/adminMenu')->with ('status', 'Successfully edited link');
        } catch (\Exception $e) {
            \DB::rollback ();
            return redirect ('/adminMenu')->with ('error', 'Something went wrong, try again');

        }
    }

    public function store (MenuRequest $request)
    {

        $this->data['menu_title'] = $request->menu_title;
        $this->data['link'] = $request->link;
        try {
            \DB::beginTransaction ();
            Menu::create ($this->data);
            \DB::commit ();
            return redirect ('/insertMenuForm')->with ('status', 'Successfully added link');
        } catch (\Exception $e) {
            \DB::rollBack ();
            return redirect ('/insertMenuForm')->with ('error', 'Something went wrong, try again');

        }
    }

    public function destroy (Menu $menu)
    {
        try {
            \DB::beginTransaction ();
            $menu->delete ();
            \DB::commit ();
            return redirect ('/adminMenu')->with ('status', 'Successfully deleted link');
        } catch (Exception $e) {
            return redirect ('/adminMenu')->with ('error', 'Something went wrong, try again');
            \DB::rollBack ();

        }
    }
}
