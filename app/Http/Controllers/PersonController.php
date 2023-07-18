<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $people = Person::all();
        return response()->json($people);
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

        $request->validate([
            'name' => 'required',
            'contacts' => 'required|array'
        ]);

        $data = $request->json()->all();

        $person = Person::create([
            'id' => (string) \Illuminate\Support\Str::uuid(),
            'name' => $data['name'],
            'contacts' => $data['contacts']
        ]);

        // Realizar outras operações ou retornar a resposta adequada

        return response()->json($person, 201);
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'contacts' => 'required|array'
    //     ]);

    //     $person = Person::create([
    //         'id' => (string) \Illuminate\Support\Str::uuid(),
    //         'name' => $request->input('name'),
    //         'contacts' => $request->input('contacts'),
    //     ]);

    //     return response()->json($person, 201);
    // }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $person = Person::findOrFail($id);
        return response()->json($person);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'contacts' => 'required|array'
        ]);

        $person = Person::findOrFail($id);
        $person->name = $request->input('name');
        $person->contacts = $request->input('contacts');
        $person->save();

        return response()->json($person);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $person = Person::findOrFail($id);
        $person->delete();

        return response()->json(null, 204);
    }
}
