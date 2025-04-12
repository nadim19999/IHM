<?php

namespace App\Http\Controllers;

use App\Models\SousCategorie;
use Illuminate\Http\Request;

class SousCategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $sousCategories = SousCategorie::all();
            return response()->json($sousCategories);
        } catch (\Exception $e) {
            return response()->json("Problème de récupération de la liste des sous-catégories");
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
            $sousCategorie = new SousCategorie([
                "nomSousCategorie" => $request->input("nomSousCategorie"),
                "categorieID" => $request->input("categorieID")
            ]);
            $sousCategorie->save();
            return response()->json($sousCategorie);
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
            $sousCategorie = SousCategorie::findOrFail($id);
            return response()->json($sousCategorie);
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
            $sousCategorie = SousCategorie::findOrFail($id);
            $sousCategorie->update($request->all());
            return response()->json($sousCategorie);
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
            $sousCategorie = SousCategorie::findOrFail($id);
            $sousCategorie->delete();
            return response()->json("Sous-catégorie supprimée avec succès");
        } catch (\Exception $e) {
            return response()->json("Problème de suppression de la sous-catégorie");
        }
    }

    public function getFormations($sousCategorieID)
    {
        $formations = SousCategorie::find($sousCategorieID)->formations;
        return response()->json($formations);
    }
}
