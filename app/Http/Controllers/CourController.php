<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cour;

class CourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $cours = Cour::all();
            return response()->json($cours);
        } catch (\Exception $e) {
            return response()->json("Problème de récupération de la liste des cours");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$request->user() || !in_array($request->user()->role, ['admin', 'formateur'])) {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }
        
        try {
            $cours = new Cour([
                "titre" => $request->input("titre"),
                "description" => $request->input("description"),
                "videoURL" => $request->input("videoURL"),
                "formationSessionID" => $request->input("formationSessionID")
            ]);
            $cours->save();
            return response()->json($cours);
        } catch (\Exception $e) {
            return response()->json("Insertion impossible");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $cours = Cour::findOrFail($id);
            return response()->json($cours);
        } catch (\Exception $e) {
            return response()->json("Problème de récupération des données");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!$request->user() || !in_array($request->user()->role, ['admin', 'formateur'])) {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }
        
        try {
            $cours = Cour::findOrFail($id);
            $cours->update($request->all());
            return response()->json($cours);
        } catch (\Exception $e) {
            return response()->json("Problème de modification");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = request()->user();
        if (!$user || !in_array($user->role, ['admin', 'formateur'])) {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }

        try {
            $cours = Cour::findOrFail($id);
            $cours->delete();
            return response()->json("Cours supprimé avec succès");
        } catch (\Exception $e) {
            return response()->json("Problème de suppression du cours");
        }
    }
}
