<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Examen;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Afficher la liste des questions.
     */
    public function index()
    {
        try {
            $questions = Question::all();
            return response()->json($questions);
        } catch (\Exception $e) {
            return response()->json("Problème de récupération de la liste des questions");
        }
    }

    /**
     * Ajouter une nouvelle question.
     */
    public function store(Request $request)
    {
        if (!$request->user() || !in_array($request->user()->role, ['admin', 'formateur'])) {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }
        
        try {
            $examen = Examen::findOrFail($request->input("examenID"));

            $nombreQuestionsExistantes = $examen->questions()->count();
            if ($nombreQuestionsExistantes >= $examen->nombreQuestion) {
                return response()->json("Nombre maximum de questions atteint pour cet examen", 400);
            }

            $question = new Question([
                "titre" => $request->input("titre"),
                "image" => $request->input("image"),
                "note" => $request->input("note"),
                "type" => $request->input("type"),
                "examenID" => $request->input("examenID")
            ]);
            $question->save();

            return response()->json($question);
        } catch (\Exception $e) {
            return response()->json("Insertion impossible");
        }
    }

    /**
     * Afficher une question spécifique.
     */
    public function show($id)
    {
        try {
            $question = Question::findOrFail($id);
            return response()->json($question);
        } catch (\Exception $e) {
            return response()->json("Problème de récupération des données");
        }
    }

    /**
     * Mettre à jour une question.
     */
    public function update(Request $request, $id)
    {
        if (!$request->user() || !in_array($request->user()->role, ['admin', 'formateur'])) {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }

        try {
            $question = Question::findOrFail($id);
            $question->update($request->all());
            return response()->json($question);
        } catch (\Exception $e) {
            return response()->json("Problème de modification");
        }
    }

    /**
     * Supprimer une question.
     */
    public function destroy($id)
    {
        $user = request()->user();
        if (!$user || !in_array($user->role, ['admin', 'formateur'])) {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }

        try {
            $question = Question::findOrFail($id);
            $question->delete();
            return response()->json("Question supprimée avec succès");
        } catch (\Exception $e) {
            return response()->json("Problème de suppression de la question");
        }
    }

    public function getReponses($questionID)
    {
        try {
            $reponses = Question::findOrFail($questionID)->reponses;
            return response()->json($reponses);
        } catch (\Exception $e) {
            return response()->json("Problème de récupération des questions");
        }
    }
}