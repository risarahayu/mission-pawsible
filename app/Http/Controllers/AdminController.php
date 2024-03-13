<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Area;
use App\Models\RescueRequest;
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
        $users = User::where('role', 'rescuer')->get();
        $count =  $users->count();

        return view('admins.index', compact('users','count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $area=Area::all();
        return view('admins.create', compact('area'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $validatedUser = $request->validate([
            'role' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'whatsapp' => ['required', 'numeric', 'regex:/^[0-9]+$/'],
        ]);

        // dd($validatedUser['role']);
        $user = new User;
        $user->role = $validatedUser['role'];
        $user->first_name = $validatedUser['first_name'];
        $user->last_name = $validatedUser['last_name'];
        $user->email = $validatedUser['email'];
        $user->password = bcrypt('123456');
        $user->save();

        $userInfo = new UserInfo([
            'whatsapp' => $validatedUser['whatsapp'],
            'area_id'  => $request['area_id'],
            'province'  => $request['province']
        ]);
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
    public function edit(User $user, $request)
    {
        // dd($request);
        $users = User::where('role', 'rescuer')->find($request);
        // $rescuer=User::find($id);
        $area=Area::all();
        return view('admins.rescuer_edit', compact('users','area'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'area_id' => 'required',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'whatsapp' => ['required', 'numeric', 'regex:/^[0-9]+$/'],
        ]);

        // Mengupdate informasi user
        $user->update([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'password' => bcrypt('123456'),
            'email' => $validatedData['email'],
        ]);
        // Mengupdate informasi userInfo
        $userInfo = $user->userInfo;
        if ($userInfo) {
            $userInfo->update([
                'whatsapp' => $validatedData['whatsapp'],
                'area_id' => $validatedData['area_id'],
            ]);
        }
    
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
    public function rescuer_detail($rescuer_id){
        $rescuer = User::find($rescuer_id);
        $rescued_dogs = $rescuer->rescuedDogs;

        return view ('admins.rescuer_detail', compact('rescued_dogs','rescuer'));
    }
}
