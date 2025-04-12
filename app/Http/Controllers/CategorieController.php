<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = Categorie::all();
            return response()->json($categories);
        } catch (\Exception $e) {
            return response()->json("Problème de récupération de la liste des catégories");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /*
        if (!$request->user() || $request->user()->role !== 'admin') {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }
        */
        try {
            $categorie = new Categorie([
                "nomCategorie" => $request->input("nomCategorie")
            ]);
            $categorie->save();
            return response()->json($categorie);
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
            $categorie = Categorie::findOrFail($id);
            return response()->json($categorie);
        } catch (\Exception $e) {
            return response()->json("Problème de récupération des données");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        /*
        if (!$request->user() || $request->user()->role !== 'admin') {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }
            */
        try {
            $categorie = Categorie::findOrFail($id);
            $categorie->update($request->all());
            return response()->json($categorie);
        } catch (\Exception $e) {
            return response()->json("Problème de modification");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        /*
        $user = request()->user();
        if (!$user || $user->role !== 'admin') {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }
        */
        try {
            $categorie = Categorie::findOrFail($id);
            $categorie->delete();
            return response()->json("Catégorie supprimée avec succès");
        } catch (\Exception $e) {
            return response()->json("Problème de suppression de la catégorie");
        }
    }

    public function getSousCategories($categorieID)
    {
        $sousCategories = Categorie::find($categorieID)->sousCategories;
        return response()->json($sousCategories);
    }
}
