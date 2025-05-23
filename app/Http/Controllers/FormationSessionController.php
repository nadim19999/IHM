<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FormationSession;
use App\Models\SessionProgression;
use App\Models\User;

class FormationSessionController extends Controller
{
    /**
     * Afficher la liste des sessions de formation.
     */
    public function index()
    {
        try {
            $sessions = FormationSession::all();
            return response()->json($sessions);
        } catch (\Exception $e) {
            return response()->json("Problème de récupération de la liste des sessions de formation", 500);
        }
    }

    /**
     * Ajouter une nouvelle session de formation.
     */
    public function store(Request $request)
    {
        /*
        if (!$request->user() || $request->user()->role !== 'admin') {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }
        */
        try {
            $session = new FormationSession([
                "formationID" => $request->input("formationID"),
                "formateurID" => $request->input("formateurID"),
                "dateDebut" => $request->input("dateDebut"),
                "dateFin" => $request->input("dateFin"),
                "statut" => $request->input("statut"),
                "capacite" => $request->input("capacite"),
                "nombreInscrits" => 0,
                "nombreCours" => $request->input("nombreCours")
            ]);
            $session->save();
            return response()->json($session);
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
            $session = FormationSession::findOrFail($id);
            return response()->json($session);
        } catch (\Exception $e) {
            return response()->json("Problème de récupération des données", 404);
        }
    }

    /**
     * Mettre à jour une session de formation.
     */
    public function update(Request $request, $id)
    {
        /*
        if (!$request->user() || $request->user()->role !== 'admin') {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }
        */
        try {
            $session = FormationSession::findOrFail($id);
            $session->update($request->all());
            return response()->json($session);
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
        if (!$user || $user->role !== 'admin') {
            return response()->json(['error' => 'Accès non autorisé'], 403);
        }
        */
        try {
            $session = FormationSession::findOrFail($id);
            $session->delete();
            return response()->json("Session supprimée avec succès");
        } catch (\Exception $e) {
            return response()->json("Problème de suppression de la session", 500);
        }
    }

    public function getCours($formationSessionID)
    {
        $cours = FormationSession::find($formationSessionID)->cours;
        return response()->json($cours);
    }

    public function getCertificats($formationSessionID)
    {
        $certificats = FormationSession::find($formationSessionID)->certificats;
        return response()->json($certificats);
    }

    public function getProgressions($formationSessionID)
    {
        $progressions = FormationSession::find($formationSessionID)->progressions;
        return response()->json($progressions);
    }

    public function getCandidats($formationSessionID)
    {
        $candidats = FormationSession::find($formationSessionID)->candidats;
        return response()->json($candidats);
    }

    public function getFeedbacks($formationSessionID)
    {
        $feedbacks = FormationSession::find($formationSessionID)->feedbacks;
        return response()->json($feedbacks);
    }

    public function getExamen($formationSessionID)
    {
        $formationSession = FormationSession::find($formationSessionID);

        if (!$formationSession) {
            return response()->json(['message' => 'Session de formation non trouvée'], 404);
        }

        $examen = $formationSession->examen;

        return response()->json($examen);
    }


    public function registerToSession(Request $request, $sessionId)
    {
        try {
            /** @var \App\Models\User $user */
            $user = Auth::user();

            if (!$user) {
                return response()->json(['error' => 'Utilisateur non authentifié'], 401);
            }

            if ($user->role !== 'candidat') {
                return response()->json(['error' => 'Seuls les candidats peuvent s\'inscrire'], 403);
            }

            $session = FormationSession::findOrFail($sessionId);

            if ($session->statut !== 'Planifiée') {
                return response()->json(['error' => 'La session n\'est pas planifiée'], 400);
            }
            if ($session->nombreInscrits >= $session->capacite) {
                return response()->json(['error' => 'La session est complète'], 400);
            }

            $user->formationSessionID = $sessionId;
            $user->save();

            $session->increment('nombreInscrits');

            $progression = SessionProgression::where('candidatID', $user->id)
                ->where('formationSessionID', $sessionId)
                ->first();

            if (!$progression) {
                \App\Models\SessionProgression::create([
                    'candidatID' => $user->id,
                    'formationSessionID' => $sessionId,
                    'progression' => 0,
                    'courIDs' => []
                ]);
            }

            return response()->json([
                'message' => 'Inscription réussie et progression créée',
                'user' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Problème d\'inscription', 'details' => $e->getMessage()], 500);
        }
    }
}