<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use App\Models\Dog;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAdoptionRequest;
use App\Http\Requests\UpdateAdoptionRequest;

class AdoptionController extends Controller
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
    public function create(Request $request)
    {
        $user = auth()->user();
        $is_indonesian = $request->input('is_indonesian');
        // dd($nationality_checked = !$request->input('is_indonesian') == null);
        $nationality_checked = !$request->input('is_indonesian') == null;
        return view('adoptions.create', compact('nationality_checked','user'));
    }

    public function createForm()
    {
        $action_name = 'create';
        $adoption = new Adoption;
        $user = auth()->user();
        $stray_dogs = Dog::all();
        return view('adoptions.create', compact('user', 'stray_dogs', 'action_name', 'adoption'));
    }

    public function nationalityCheck(Request $request){
        // dd($request);
        $action_name = 'create';
        $adoption = new Adoption;
        $user = auth()->user();
        $stray_dogs = Dog::all();

        $isIndonesian = $request->input('is_indonesian');
        if ($isIndonesian == 1) {
            return view('adoptions.create',compact('user', 'stray_dogs', 'action_name', 'adoption'));
        } else {
            return view('not-indonesian');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdoptionRequest $request)
    {
        dd($request);
        $adoption = Adoption::create($request);
        // $dogId = $adoption->dog->id;


        return redirect()->route('dogs.show', ['dog' => $adoption->dog_id])->with([
            'flash' => [
                'type' => 'success',
                'message' => 'Adoption record has been created successfully.',
            ]
        ]);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Adoption $adoption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Adoption $adoption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdoptionRequest $request, Adoption $adoption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Adoption $adoption)
    {
        //
    }
}
