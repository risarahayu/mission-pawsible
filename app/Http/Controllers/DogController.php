<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use App\Models\Area;
use App\Http\Requests\StoreDogRequest;
use App\Http\Requests\UpdateDogRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Image;


class DogController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $area = Area::all();
        $stray_dogs=Dog::all();
        return view('dogs.index', compact('stray_dogs','area'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $action_name = 'create';
        $dog = new Dog;
        $user = auth()->user();
        $stray_dogs = Dog::all();
        $areas = Area::all();
        return view('dogs.create', compact('user', 'stray_dogs', 'areas', 'action_name', 'dog'));
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDogRequest $request)
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
            $strayDog = Dog::create($stray_dog_request);
            
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $filename = $image->getClientOriginalName();
                    $path = $image->storeAs('public/stray_dog_images', $filename);
                    $publicPath = Storage::url($path);
            
                    $imageModel = new Image();
                    $imageModel->filename = $publicPath;
                    $strayDog->images()->save($imageModel);
                }
            }
        });
        
        return redirect()->route("dogs.show", ['dog' => $strayDog->id])->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Stray dog has been add successfully',
            ]
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dog $dog)
    {
        $stray_dog = $dog;
        $own = $stray_dog->user;
        return view('dogs.show', compact('stray_dog', 'own'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dog $dog)
    {
        $action_name = 'edit';
        $user = $dog->user;
        $images = $dog->images;
        return view('dogs.edit', compact('dog', 'user', 'action_name', 'images'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDogRequest $request, Dog $dog)
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dog $dog)
    {
        $dog->delete();
        return redirect()->route('dogs.index')->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Stray dog has been remove',
            ]
        ]);
    }
}
