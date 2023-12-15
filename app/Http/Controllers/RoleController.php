<?php

// Ini [Controller] "Role" untuk mengganti role yang diinginkan oleh user
// [Controller] ini tidak menggunakan [Model] apapun karena hanya menyimpan
// role ke dalam [Session]

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('role.index');
    }

    // Action untuk set role(mengganti role) yang diinginkan
    public function set_role($role){
        // menyimpan role kedalam session dengan key role
        session(['role' => $role]);

        // redirect ke route lalu menampilkan standar flash message
        return redirect()->route("home")->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Berhasil login',
            ]
        ]);
    }
}
