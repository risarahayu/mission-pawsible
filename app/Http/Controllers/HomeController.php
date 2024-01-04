<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // Fungsi untuk melakukan sesuatu sebelum menjalankan action
    public function __construct()
    {
        // ini langsung dari laravelnya, Fungsi untuk
        // Redirect back ke halaman login ketika belum login
        $this->middleware('auth');

        // Ini adalah custom middleware
        // untuk mengecek [session('role')] sudah di terapkan
        // sebelum melakukan [action], Redirect back ke [route('role.index')] ketika belum menerapkan role
        $this->middleware('role');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $redirect_route = session('role') == 'adopter' ? 'dogs.index' : 'requests.index';
        return redirect()->route($redirect_route)->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Stray dog has been add successfully',
            ]
        ])->with('flash.once', true);
        // return view('dashboards.index');
    }
}
