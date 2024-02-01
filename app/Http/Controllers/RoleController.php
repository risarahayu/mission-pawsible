<?php

// Ini [Controller] "Role" untuk mengganti role yang diinginkan oleh user
// [Controller] ini tidak menggunakan [Model] apapun karena hanya menyimpan
// role ke dalam [Session]

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{

    // Fungsi untuk melakukan sesuatu sebelum menjalankan action
    public function __construct()
    {
        // ini langsung dari laravelnya, Fungsi untuk
        // Redirect back ke halaman login ketika belum login
        $this->middleware('auth');
    }

    // Action index role, page untuk memilih role setelah login
    public function index(){
        //kalo masih ada session yang masih nyangkut, session nyimpennya di browser
        // dd(session());
        Session::forget('role');
        $user = Auth::user();
        
        if ($user->role == 'admin') {
            session(['role' => 'admin']);
            return redirect()->route('admins.index')->with([
                'flash' => [
                    'type' => 'success',
                    'message' => __('flash.role_selected', ['name' => "$user->first_name $user->last_name", 'role' => session('role')]),
                ]
            ])->with('flash.once', true);
        } elseif ($user->role == 'rescuer') {
            session(['role' => 'rescuer']);
            return redirect()->route('requests.create')->with([
                'flash' => [
                    'type' => 'success',
                    'message' => __('flash.role_selected', ['name' => "$user->first_name $user->last_name", 'role' => session('role')]),
                ]
            ])->with('flash.once', true);
        } else {
            return view('role.index');
        }
    }

    // Action untuk set role(mengganti role) yang diinginkan
    public function set_role(Request $request, $role){
        // menyimpan role kedalam session dengan key role
        $user = Auth::user();
        session(['role' => $role]);

        $redirect_url = session('role') == 'rescuer' ? 'requests.create' : 'dogs.index';
        if ($request->input('create')) { $redirect_url = 'dogs.create'; }

        // redirect ke route lalu menampilkan standar flash message
        return redirect()->route($redirect_url)->with([
            'flash' => [
                'type' => 'success',
                'message' => __('flash.role_selected', ['name' => "$user->first_name $user->last_name", 'role' => $role]),
            ]
        ])->with('flash.once', true);
    }
}
