<?php

namespace App\Http\Controllers;

use App\Models\RescueRequest;
use App\Models\Area;
use App\Models\UserInfo;
use App\Http\Requests\StoreRescueRequestRequest;
use App\Http\Requests\UpdateRescueRequestRequest;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RescueRequestController extends Controller
{

    public function __construct()
    {
        // Redirect back ke halaman login ketika belum login
        $this->middleware('auth');

        // Redirect back ke [route('role.index')] ketika belum menerapkan role
        $this->middleware('role');
    }

    // Display a listing of the resource.
    public function index(Request $request)
    {
        $area = Area::all();
        $stray_dogs = RescueRequest::all();
        $area_name = null;

        if ($request->input('area')) {
            $area_name = $request->input('area');
            $areaRequest = $area->where('name', $area_name)->first();
            $stray_dogs = $stray_dogs->where('area_id', optional($areaRequest)->id);
        }

        return view('requests.index', compact('stray_dogs', 'area', 'area_name'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $controller_name = 'request';
        $action_name = 'create';
        $dog = new RescueRequest;
        $user = auth()->user();
        $stray_dogs = RescueRequest::all();
        $areas = Area::all();
        return view('requests.create', compact('user', 'stray_dogs', 'areas', 'action_name', 'dog', 'controller_name'));
    }

    // Store a newly created resource in storage.
    public function store(StoreRescueRequestRequest $request)
    {
        $strayDog = null;

        DB::transaction(function () use ($request, &$strayDog) {
            // Create area
            $area_name = $request->input('area');
            $area = Area::where('name', $area_name)->first();
            if (optional($area)->exists()) {
                $area = $area;
            } else {
                $area = new Area();
                $area->name = $request->input('area');
                $area->save();
            }

            // Create straydogs
            $stray_dog_request = array_merge($request->except(['_token', 'area']), ['area_id' => $area->id]);
            $strayDog = RescueRequest::create($stray_dog_request);

            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $filename = $image->getClientOriginalName();
                    $path = $image->storeAs('public/stray_dog_images', $filename);
                    $publicPath = Storage::url($path);

                    $imageModel = new Image();
                    $imageModel->filename = $publicPath;
                    $imageModel->category = 'requester';
                    $strayDog->images()->save($imageModel);
                }
            }
        });

        return redirect()->route("requests.view_contact", ['request' => $strayDog->id])->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Stray dog has been add successfully',
            ]
        ])->with('flash.once', true);
    }

    // Display the specified resource.
    public function show(RescueRequest $request)
    {
        //kita bawa id requestnya makanya disiini Rescue Request, biasanya kalo mengarahkan biasa ga usah diisi,
        //passing dari 2 controller yang berbeda
        //dibawa melalui route, makanya di route selalu isi {request}
        $controller_name = 'request';
        $stray_dog = $request;
        $rescuer = $stray_dog;
        $user = Auth::user();
        $own = $stray_dog->user;
        // $rescuer_name = RescueRequest::with('rescuer')->get();
        $users = User::all()->where('role', 'rescuer');
        return view('requests.show', compact('stray_dog', 'user', 'rescuer', 'own', 'controller_name', 'users'));
    }

    // Show the form for editing the specified resource.
    public function edit(RescueRequest $request)
    {
        $controller_name = 'request';
        $action_name = 'edit';
        $dog = $request;
        $user = $dog->user;
        $images = $dog->images;
        return view('requests.edit', compact('dog', 'request', 'user', 'action_name', 'images', 'controller_name'));
    }

    // Update the specified resource in storage.
    public function update(UpdateRescueRequestRequest $rescueRequest, RescueRequest $request)
    {
        $dog = $request;
        $request = $rescueRequest;
        DB::transaction(function () use ($request, &$dog) {
            // Update area (if necessary)
            $area_name = $request->input('area');
            $area = Area::where('name', $area_name)->first();
            if (optional($area)->exists()) {
                // If the area already exists, update the area_id of the StrayDog instance
                $dog->area_id = $area->id;
            } else {
                // If the area doesn't exist, create a new area and update the area_id of the StrayDog instance
                $newArea = new Area();
                $newArea->name = $area_name;
                $newArea->save();
                $dog->area_id = $newArea->id;
            }

            // Update other attributes of the StrayDog model
            $dog->dog_type = $request->input('dog_type');
            $dog->color = $request->input('color');
            $dog->temperament = $request->input('temperament');
            $dog->gender = $request->input('gender');
            $dog->size = $request->input('size');
            $dog->description = $request->input('description');
            $dog->save();

            if ($request->input('delete_image')) {
                $dog->images->where('category', 'requester')->each->delete();
            }

            if ($request->hasFile('images')) {
                // $strayDog->images()->delete();

                foreach ($request->file('images') as $image) {
                    $filename = $image->getClientOriginalName();
                    $path = $image->storeAs('public/stray_dog_images', $filename);
                    $publicPath = Storage::url($path);

                    $imageModel = new Image();
                    $imageModel->filename = $publicPath;
                    $imageModel->category = 'requester';
                    $dog->images()->save($imageModel);
                }
            }
        });

        return redirect()->route("requests.show", ['request' => $dog->id])->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Stray dog has been updated successfully',
            ]
        ])->with('flash.once', true);
    }

    // Remove the specified resource from storage.
    public function destroy(RescueRequest $request)
    {
        $request->delete();
        return redirect()->route('requests.index')->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Stray dog has been remove',
            ]
        ])->with('flash.once', true);
    }

    public function rescue(Request $rescueRequest, RescueRequest $request)
    {
        $validatedRequest = $rescueRequest->validate([
            'rescuer_id' => 'required|integer',
            'images.*' => 'required|image|mimes:jpeg,png,jpg',
        ]);
        // dd($validatedRequest['rescuer_id']);

        $user = User::find($validatedRequest['rescuer_id']);
        // $user = User::find($rescueRequest->input('rescuer_id'));
        $request->update([
            'rescuer_id' => $user->id,
            'rescued' => true,
        ]);

        if ($rescueRequest->hasFile('images')) {
            foreach ($rescueRequest->file('images') as $image) {
                $filename = $image->getClientOriginalName();
                $path = $image->storeAs('public/stray_dog_images', $filename);
                $publicPath = Storage::url($path);

                $imageModel = new Image();
                $imageModel->filename = $publicPath;
                $imageModel->category = 'rescuer';
                $request->images()->save($imageModel);
            }
        }

        return redirect()->route("requests.show", ['request' => $request->id])->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Stray dog has been updated successfully',
            ]
        ])->with('flash.once', true);
    }

    public function view_contact(RescueRequest $request)
    {
        $data = $request;
        $user = Auth::user();
        return view('requests.view_contact', compact('user', 'data'));
    }

    public function update_contact(Request $request_params, User $user, RescueRequest $request)
    {
        $area_name = $request_params->input('area');
        $area = Area::where('name', $area_name)->first();
        if (empty($area)) {
            $area = Area::create(['name' => $area_name]);
        };

        $user->update($request_params->only(['first_name', 'last_name']));
        $userInfo_params = array_merge($request_params->except(['_token', '_method', 'first_name', 'last_name', 'area']), ['user_id' => $user->id, 'area_id' => $area->id]);
        if ($user->userInfo()->exists()) {
            $user->userInfo()->update($userInfo_params);
        } else {
            UserInfo::create($userInfo_params);
        }

        return redirect()->route('requests.additional_contact', ['request' => $request->id]);
    }

    public function additional_contact(RescueRequest $request)
    {
       
        
        $dog_finder = $request->user;
        $stray_dog = $request;
        // $find = RescueRequest::find($request->id);
        // $images =  $find->images()->where('category', 'rescuer')->get();
        $users = User::where('role', 'rescuer')
        ->whereHas('userInfo', function ($query) {
            $query->whereHas('area');
        })
        ->with(['userInfo' => function ($query) {
            $query->join('areas', 'user_infos.area_id', '=', 'areas.id')
                  ->orderBy('areas.name');
        }])
        ->get();
    

        return view('requests.additional_contact', compact('dog_finder', 'stray_dog', 'users'));
    }

    public function dog_list()
    {

        $user = Auth::user();
        $stray_dogs = RescueRequest::where('user_id', $user->id)->get();
        $count = $stray_dogs->count();

        return view('dogs.my_dog_list', compact('stray_dogs', 'count'));
    }
}
