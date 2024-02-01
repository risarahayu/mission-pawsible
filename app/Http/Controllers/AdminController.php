<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = User::where('role','rescuer')->get();
        $count =  $users->count();
        return view('admins.index', compact('users','count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedUser = $request->validate([
            'role' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'whatsapp' => 'required|string|min:12',
            'password' => 'required|min:8|confirmed',
        ]);

        // dd($validatedUser['role']);
        $user = new User;
        $user->role = $validatedUser['role'];
        $user->first_name = $validatedUser['first_name'];
        $user->last_name = $validatedUser['last_name'];
        $user->email = $validatedUser['email'];
        $user->password = bcrypt($validatedUser['password']);
        $user->save();

        $userInfo = new UserInfo(['whatsapp' => $validatedUser['whatsapp']]);
        $user->userInfo()->save($userInfo);

        return redirect()->route("admins.index")->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Stray dog has been updated successfully',
            ]
        ])->with('flash.once', true);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
