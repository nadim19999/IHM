<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $formations = Formation::all();
            return response()->json($formations);
        } catch (\Exception $e) {
            return response()->json("Problème de récupération de la liste des formations");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$request->user() || $request->user()->role !== 'admin') {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }

        try {
            $formation = new Formation([
                "nomFormation" => $request->input("nomFormation"),
                "description" => $request->input("description"),
                "niveau" => $request->input("niveau"),
                "image" => $request->input("image"),
                "duree" => $request->input("duree"),
                "sousCategorieID" => $request->input("sousCategorieID")
            ]);
            $formation->save();
            return response()->json($formation);
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
            $formation = Formation::findOrFail($id);
            return response()->json($formation);
        } catch (\Exception $e) {
            return response()->json("Problème de récupération des données");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (!$request->user() || $request->user()->role !== 'admin') {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }

        try {
            $formation = Formation::findOrFail($id);
            $formation->update($request->all());
            return response()->json($formation);
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
        if (!$user || $user->role !== 'admin') {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }

        try {
            $formation = Formation::findOrFail($id);
            $formation->delete();
            return response()->json("Formation supprimée avec succès");
        } catch (\Exception $e) {
            return response()->json("Problème de suppression de la formation");
        }
    }

    public function getFormationSessions($formationID)
    {
        $formationSessions = Formation::find($formationID)->formationSessions;
        return response()->json($formationSessions);
    }
}