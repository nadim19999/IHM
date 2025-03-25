<?php

namespace App\Http\Controllers;

use App\Models\Reponse;
use App\Models\Question;
use Illuminate\Http\Request;

class ReponseController extends Controller
{
    /**
     * Afficher toutes les réponses.
     */
    public function index()
    {
        try {
            $reponses = Reponse::all();
            return response()->json($reponses);
        } catch (\Exception $e) {
            return response()->json("Problème de récupération des réponses");
        }
    }

    /**
     * Ajouter une nouvelle réponse.
     */
    public function store(Request $request)
    {
        try {
            $question = Question::findOrFail($request->input("questionID"));
            $statut = $request->input("statut");

            // Vérifier si la réponse est correcte (statut = true)
            if ($statut) {
                if ($question->type !== "multiple") {
                    // Vérifier s'il existe déjà une réponse correcte pour cette question
                    $existingCorrectAnswer = Reponse::where('questionID', $question->id)->where('statut', true)->exists();
                    if ($existingCorrectAnswer) {
                        return response()->json("Cette question n'accepte qu'une seule bonne réponse", 400);
                    }
                }
            }

            // Ajouter la réponse
            $reponse = new Reponse([
                "texte" => $request->input("texte"),
                "statut" => $statut,
                "questionID" => $request->input("questionID")
            ]);
            $reponse->save();

            return response()->json($reponse);
        } catch (\Exception $e) {
            return response()->json("Insertion impossible");
        }
    }

    /**
     * Afficher une réponse spécifique.
     */
    public function show($id)
    {
        try {
            $reponse = Reponse::findOrFail($id);
            return response()->json($reponse);
        } catch (\Exception $e) {
            return response()->json("Problème de récupération des données");
        }
    }

    /**
     * Modifier une réponse.
     */
    public function update(Request $request, $id)
    {
        try {
            $reponse = Reponse::findOrFail($id);
            $question = Question::findOrFail($reponse->questionID);
            $statut = $request->input("statut");

            // Vérifier si la réponse est correcte (statut = true)
            if ($statut) {
                if ($question->type !== "multiple") {
                    // Vérifier s'il existe une autre réponse correcte pour cette question
                    $existingCorrectAnswer = Reponse::where('questionID', $question->id)
                        ->where('statut', true)
                        ->where('id', '!=', $id)
                        ->exists();

                    if ($existingCorrectAnswer) {
                        return response()->json("Cette question n'accepte qu'une seule bonne réponse", 400);
                    }
                }
            }

            // Mise à jour de la réponse
            $reponse->update($request->all());

            return response()->json($reponse);
        } catch (\Exception $e) {
            return response()->json("Problème de modification");
        }
    }

    /**
     * Supprimer une réponse.
     */
    public function destroy($id)
    {
        try {
            $reponse = Reponse::findOrFail($id);
            $reponse->delete();
            return response()->json("Réponse supprimée avec succès");
        } catch (\Exception $e) {
            return response()->json("Problème de suppression de la réponse");
        }
    }
}