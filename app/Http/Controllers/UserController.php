<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Adoption;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $user->update($request->only(['first_name', 'last_name']));

        if ($user->userInfo()->exists()) {
            $user->userInfo()->update($request->except(['_token', '_method', 'first_name', 'last_name']));
        } else {
            UserInfo::create(array_merge($request->except(['_token', '_method', 'first_name', 'last_name']), ['user_id' => $user->id]));
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function view_contact(Adoption $adoption){
        $user = Auth::user();
        return view('auth.update_profile', compact('user', 'adoption'));
    }
}
