<?php

namespace App\Http\Controllers;

use App\Models\Examen;
use App\Models\FormationSession;
use App\Models\SessionProgression;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function passerExamen($formationSessionID)
    {
        $progression = SessionProgression::where('candidatID', Auth::id())
            ->where('formationSessionID', $formationSessionID)
            ->first();

        if (!$progression) {
            return response()->json(['message' => 'Aucune progression trouvée'], 404);
        }

        $formationSession = FormationSession::findOrFail($formationSessionID);

        if ($progression->progression < $formationSession->nombreCours) {
            return response()->json(['message' => 'Vous n\'avez pas encore terminé la formation'], 403);
        }

        $examen = Examen::where('formationSessionID', $formationSessionID)->first();

        if (!$examen) {
            return response()->json(['message' => 'Aucun examen trouvé pour cette formation'], 404);
        }

        $questions = $examen->questions()->with(['reponses' => function ($query) {
            $query->select('id', 'questionID', 'texte');
        }])->get();

        return response()->json(['examen' => $examen, 'questions' => $questions]);
    }

    public function calculerScore(Request $request, $examenID)
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json(['message' => 'Utilisateur non authentifié'], 401);
            }

            // Récupérer l'examen
            $examen = Examen::findOrFail($examenID);
            $questions = $examen->questions()->with('reponses')->get();

            // Récupérer les réponses envoyées par l'utilisateur
            $reponsesUtilisateur = $request->input('reponses'); // Tableau [questionID => [reponseID1, reponseID2]]

            $score = 0;
            $totalQuestions = $questions->count();

            foreach ($questions as $question) {
                // Récupérer les bonnes réponses de la base de données
                $bonnesReponses = $question->reponses->where('correcte', true)->pluck('id')->toArray();

                // Récupérer les réponses de l'utilisateur pour cette question
                $reponsesUser = isset($reponsesUtilisateur[$question->id]) ? $reponsesUtilisateur[$question->id] : [];

                // Vérifier si les réponses de l'utilisateur sont correctes
                sort($bonnesReponses);
                sort($reponsesUser);

                if ($bonnesReponses === $reponsesUser) {
                    $score++; // Score complet si toutes les réponses sont justes
                }
            }

            // Calcul du pourcentage de réussite
            $pourcentage = ($totalQuestions > 0) ? ($score / $totalQuestions) * 100 : 0;

            return response()->json([
                'score' => $score,
                'total_questions' => $totalQuestions,
                'pourcentage' => $pourcentage
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur lors du calcul du score', 'error' => $e->getMessage()], 500);
        }
    }
}