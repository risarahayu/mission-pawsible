<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use App\Models\User;
use App\Models\Area;
use App\Models\Adoption;
use App\Http\Requests\StoreDogRequest;
use App\Http\Requests\UpdateDogRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class DogController extends Controller
{

    public function __construct()
    {
        // Redirect back ke halaman login ketika belum login
        $this->middleware('auth');

        // Redirect back ke [route('role.index')] ketika belum menerapkan role
        $this->middleware('role');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $area = Area::all();
        $stray_dogs = Dog::all();

        if ($request->input('area')) {
            $areaRequest = Area::all()->where('name', $request->input('area'))->first();
            $stray_dogs = $stray_dogs->where('area_id', optional($areaRequest)->id);
        }

        return view('dogs.index', compact('stray_dogs','area'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $controller_name = 'dog';
        $action_name = 'create';
        $dog = new Dog;
        $user = auth()->user();
        $stray_dogs = Dog::all();
        $areas = Area::all();
        return view('dogs.create', compact('user', 'stray_dogs', 'areas', 'action_name', 'dog', 'controller_name'));

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

            if  ($request->hasFile('vaccination_certificate')) {
                foreach ($request->file('vaccination_certificate') as $image) {
                    $filename = $image->getClientOriginalName();
                    $path = $image->storeAs('public/stray_dog_images', $filename);
                    $publicPath = Storage::url($path);

                    $imageModel = new Image();
                    $imageModel->filename = $publicPath;
                    $imageModel->category = 'vaccination';
                    $strayDog->images()->save($imageModel);
                }
            }

            if  ($request->hasFile('sterilization_certificate')) {
                foreach ($request->file('sterilization_certificate') as $image) {
                    $filename = $image->getClientOriginalName();
                    $path = $image->storeAs('public/stray_dog_images', $filename);
                    $publicPath = Storage::url($path);

                    $imageModel = new Image();
                    $imageModel->filename = $publicPath;
                    $imageModel->category = 'sterilization';
                    $strayDog->images()->save($imageModel);
                }
            }
        });



        return redirect()->route("dogs.show", ['dog' => $strayDog->id])->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Stray dog has been added successfully',
            ]
        ])->with('flash.once', true);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dog $dog, Adoption $adoption)
    {
        //request adoption
        $user = Auth::user();

        //cek anjingyang dimiliki dari user yg sedang login
        $userDogs = $user->dogs;

        //cek data dari anjingnya
        $stray_dog = $dog;

        //Data adopsi dari user yang lagi login dengan anjing yang lgi dilihat di page ini
        $userAdoption = $user->adoptions()->where('dog_id', $dog->id)->first();

        //Cek pemilik anjing
        $own = $stray_dog->user;

        //cek request adopsi untuk owener
        $adoptions = $dog->adoptions;



        return view('dogs.show', compact('user', 'stray_dog', 'userAdoption', 'own', 'adoptions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dog $dog)
    {
        $controller_name = 'dog';
        $action_name = 'edit';
        $user = $dog->user;
        $images = $dog->images;
        return view('dogs.edit', compact('dog', 'user', 'action_name', 'images', 'controller_name'));
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

            // Handle images update (if necessary)
            if ($request->input('delete_image')) {
                $dog->images->where('category', null)->each->delete();
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
        ])->with('flash.once', true);
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
        ])->with('flash.once', true);
    }
}
