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
    public function create(Request $request, Dog $dog)
    {
        $user = auth()->user();
        
        $is_indonesian = $request->input('is_indonesian'); // params is_indonesian yang terdapat di url
        $nationality_checked = !$request->input('is_indonesian') == null; // untuk mengecek apakah ada params is_indonesian di action ini
        // note: params yang kutau adalah parameter atau data yang dikirim kepada url atau route yang dapat kita olah atau gunakan nanti

        return view('adoptions.create', compact('nationality_checked', 'user', 'dog'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdoptionRequest $request)
    {
        $adoption = Adoption::create($request->validated()); // jangan lupa mengisikan method ->validated() jika ingin melakukan create secara langsung

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
