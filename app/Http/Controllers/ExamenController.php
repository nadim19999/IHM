<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use Illuminate\Http\Request;

class ExamenController extends Controller
{
    /**
     * Afficher la liste des examens.
     */
    public function index()
    {
        try {
            $examens = Examen::all();
            return response()->json($examens);
        } catch (\Exception $e) {
            return response()->json("Problème de récupération de la liste des examens");
        }
    }

    /**
     * Ajouter un nouvel examen.
     */
    public function store(Request $request)
    {
        try {
            $examen = new Examen([
                "titre" => $request->input("titre"),
                "nombreQuestion" => $request->input("nombreQuestion"),
                "duree" => $request->input("duree"),
                "formationSessionID" => $request->input("formationSessionID")
            ]);
            $examen->save();
            return response()->json($examen);
        } catch (\Exception $e) {
            return response()->json("Insertion impossible");
        }
    }

    /**
     * Afficher un examen spécifique.
     */
    public function show($id)
    {
        try {
            $examen = Examen::findOrFail($id);
            return response()->json($examen);
        } catch (\Exception $e) {
            return response()->json("Problème de récupération des données");
        }
    }

    /**
     * Mettre à jour un examen.
     */
    public function update(Request $request, $id)
    {
        try {
            $examen = Examen::findOrFail($id);
            $examen->update($request->all());
            return response()->json($examen);
        } catch (\Exception $e) {
            return response()->json("Problème de modification");
        }
    }

    /**
     * Supprimer un examen.
     */
    public function destroy($id)
    {
        try {
            $examen = Examen::findOrFail($id);
            $examen->delete();
            return response()->json("Examen supprimé avec succès");
        } catch (\Exception $e) {
            return response()->json("Problème de suppression de l'examen");
        }
    }

    /**
     * Récupérer les questions d'un examen.
     */
    public function getQuestions($examenID)
    {
        try {
            $questions = Examen::findOrFail($examenID)->questions;
            return response()->json($questions);
        } catch (\Exception $e) {
            return response()->json("Problème de récupération des questions");
        }
    }
}