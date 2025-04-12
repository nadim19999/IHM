<?php

namespace App\Http\Controllers;

use App\Models\Certificat;
use App\Models\Examen;
use App\Models\FormationSession;
use App\Models\SessionProgression;
use Carbon\Carbon;
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
        /*
        if (!$request->user() || !in_array($request->user()->role, ['admin', 'formateur'])) {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }
        */
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
        /*
        if (!$request->user() || !in_array($request->user()->role, ['admin', 'formateur'])) {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }
        */
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
        /*
        $user = request()->user();
        if (!$user || !in_array($user->role, ['admin', 'formateur'])) {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }
        */
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

            $examen = Examen::findOrFail($examenID);
            $formationSessionID = $examen->formationSessionID;

            // Vérifier la progression de l'utilisateur dans cette session de formation
            $progression = SessionProgression::where('candidatID', $user->id)
                ->where('formationSessionID', $formationSessionID)
                ->first();

            if (!$progression) {
                return response()->json(['message' => 'Aucune progression trouvée pour cette session'], 404);
            }

            $formationSession = FormationSession::findOrFail($formationSessionID);

            if ($progression->progression < $formationSession->nombreCours) {
                return response()->json(['message' => 'Vous n\'avez pas encore terminé la formation'], 403);
            }

            $questions = $examen->questions;

            $reponsesUtilisateur = $request->input('reponses');

            $score = 0;
            $totalNotes = 0;

            foreach ($questions as $question) {
                $bonnesReponses = $question->reponses->where('statut', true)->pluck('id')->toArray();

                $reponsesUser = isset($reponsesUtilisateur[$question->id]) ? $reponsesUtilisateur[$question->id] : [];

                if ($bonnesReponses === $reponsesUser) {
                    $score += $question->note;
                }

                $totalNotes += $question->note;
            }

            $pourcentage = ($totalNotes > 0) ? ($score / $totalNotes) * 100 : 0;
            $certificatCree = false;

            if ($pourcentage >= 70) {
                $certificatExistant = Certificat::where('candidatID', $user->id)
                    ->where('formationSessionID', $formationSessionID)
                    ->first();

                if (!$certificatExistant) {
                    Certificat::create([
                        'dateObtention' => Carbon::now(),
                        'note' => $score,
                        'statut' => 'validé',
                        'formationSessionID' => $formationSessionID,
                        'candidatID' => $user->id,
                    ]);
                    $certificatCree = true;
                }
            }

            return response()->json([
                'score' => $score,
                'total_notes' => $totalNotes,
                'pourcentage' => $pourcentage,
                'certificat_cree' => $certificatCree,
                'message' => $certificatCree ? 'Félicitations ! Certificat généré.' : 'Examen terminé, pas de certificat attribué.'
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur lors du calcul du score', 'error' => $e->getMessage()], 500);
        }
    }
}