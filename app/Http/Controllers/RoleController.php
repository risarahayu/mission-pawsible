<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        return view('role.index');
    }

    public function set_role($role){
        session(['role' => $role]);
        return redirect()->route("home")->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Berhasil login',
            ]
        ]);
    }
}