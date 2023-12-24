<?php

namespace App\Http\Controllers;

use App\Models\RescueRequest;
use App\Models\Area;
use App\Http\Requests\StoreRescueRequestRequest;
use App\Http\Requests\UpdateRescueRequestRequest;
use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

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

        if ($request->input('area')) {
            $areaRequest = Area::all()->where('name', $request->input('area'))->first();
            $stray_dogs = $stray_dogs->where('area_id', $areaRequest->id);
        }

        return view('requests.index', compact('stray_dogs','area'));
    }

    // Show the form for creating a new resource.
    public function create()
    {
        $action_name = 'create';
        $dog = new RescueRequest;
        $user = auth()->user();
        $stray_dogs = RescueRequest::all();
        $areas = Area::all();
        return view('requests.create', compact('user', 'stray_dogs', 'areas', 'action_name', 'dog'));
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
                    $imageModel->request_status = 'requested';
                    $strayDog->images()->save($imageModel);
                }
            }
        });

        return redirect()->route("requests.show", ['request' => $strayDog->id])->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Stray dog has been add successfully',
            ]
        ]);
    }

    // Display the specified resource.
    public function show(RescueRequest $request)
    {
            $stray_dog = $request;
            $finder = $stray_dog->user;
            $rescuer = $stray_dog;
            return view('requests.show', compact('stray_dog', 'finder', 'rescuer'));
    }

    // Show the form for editing the specified resource.
    public function edit(RescueRequest $request)
    {
        $action_name = 'edit';
        $dog = $request;
        $user = $dog->user;
        $images = $dog->images;
        return view('requests.edit', compact('dog', 'request', 'user', 'action_name', 'images'));
    }

    // Update the specified resource in storage.
    public function update(UpdateRescueRequestRequest $recueRequest, RescueRequest $request)
    {
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
            // dd($request);
            // Handle images update (if necessary)

            if ($request->input('delete_image')) {
                $dog->images()->delete();
            }

            if ($request->hasFile('images')) {
                // $strayDog->images()->delete();

                foreach ($request->file('images') as $image) {
                    $filename = $image->getClientOriginalName();
                    $path = $image->storeAs('public/stray_dog_images', $filename);
                    $publicPath = Storage::url($path);

                    $imageModel = new Image();
                    $imageModel->filename = $publicPath;
                    $dog->images()->save($imageModel);
                }
            }
        });

        return redirect()->route("dogs.show", ['dog' => $dog->id])->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Stray dog has been updated successfully',
            ]
        ]);
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
        ]);
    }

    public function rescue(Request $rescueRequest, RescueRequest $request){
        $user = auth()->user();
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
                $imageModel->request_status = 'rescuer';
                $request->images()->save($imageModel);
            }
        }

        return redirect()->route("requests.show", ['request' => $request->id])->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Stray dog has been updated successfully',
            ]
        ]);
    }
}
