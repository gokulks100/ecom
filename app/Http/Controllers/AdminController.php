<?php

namespace App\Http\Controllers;

use App\Models\RolePrivilegeMapping;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.pages.dashboard');
    }

    public function getRoles()
    {
        config()->set('database.connections.mysql.strict', false);
        DB::reconnect();

        $data =  RolePrivilegeMapping::select(
            [
                'privilage_master.*',
                DB::raw('COUNT(role_privilege_mapping.id) AS menu_count')

            ]
        )->leftJoin('privilage_master', 'role_privilege_mapping.fk_privilege_id', 'privilage_master.id')
            ->where('privilage_master.is_active', 1)->where('role_privilege_mapping.fk_role_id', Auth::user()->role_id)
            ->groupBy('privilage_master.title')->orderBy('privilage_master.id','ASC')->get();

        config()->set('database.connections.mysql.strict', true);
        DB::reconnect();

        return $data;
    }

    public  function  getRolePrivileges($title)
    {
        $privileges = DB::select("SELECT p.* FROM privilage_master p, role_privilege_mapping m WHERE p.title=? AND m.fk_role_id=? AND m.fk_privilege_id=p.id", [$title, Auth::user()->role_id]);
        return json_encode($privileges);
    }

}
