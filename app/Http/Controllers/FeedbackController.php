<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $feedbacks = Feedback::all();
            return response()->json($feedbacks);
        } catch (\Exception $e) {
            return response()->json("Problème de récupération de la liste des feedbacks", 500);
        }
    }

    /**
     * Ajouter une nouvelle session de formation.
     */
    public function store(Request $request)
    {
        try {
            $feedback = new Feedback([
                "formationSessionID" => $request->input("formationSessionID"),
                "candidatID" => $request->input("candidatID"),
                "texte" => $request->input("texte")
            ]);
            $feedback->save();
            return response()->json($feedback);
        } catch (\Exception $e) {
            return response()->json("Insertion impossible", 500);
        }
    }

    /**
     * Afficher une session spécifique.
     */
    public function show($id)
    {
        try {
            $feedback = Feedback::findOrFail($id);
            return response()->json($feedback);
        } catch (\Exception $e) {
            return response()->json("Problème de récupération des données", 404);
        }
    }

    /**
     * Mettre à jour une session de formation.
     */
    public function update(Request $request, $id)
    {
        try {
            $feedback = Feedback::findOrFail($id);
            $feedback->update($request->all());
            return response()->json($feedback);
        } catch (\Exception $e) {
            return response()->json("Problème de modification", 500);
        }
    }

    /**
     * Supprimer une session de formation.
     */
    public function destroy($id)
    {
        /*
        $user = request()->user();
        if (!$user || $user->role != 'admin') {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }
        */
        try {
            $feedback = Feedback::findOrFail($id);
            $feedback->delete();
            return response()->json("Feedback supprimée avec succès");
        } catch (\Exception $e) {
            return response()->json("Problème de suppression du feedback", 500);
        }
    }
}
