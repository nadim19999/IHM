<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormationSession;

class FormationSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $sessions = FormationSession::all();
            return response()->json($sessions);
        } catch (\Exception $e) {
            return response()->json("Problème de récupération de la liste des sessions de formation");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $session = new FormationSession([
                "formationID" => $request->input("formationID"),
                "formateurID" => $request->input("formateurID"),
                "dateDebut" => $request->input("dateDebut"),
                "dateFin" => $request->input("dateFin"),
                "statut" => $request->input("statut"),
                "capacite" => $request->input("capacite")
            ]);
            $session->save();
            return response()->json($session);
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
            $session = FormationSession::findOrFail($id);
            return response()->json($session);
        } catch (\Exception $e) {
            return response()->json("Problème de récupération des données");
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $session = FormationSession::findOrFail($id);
            $session->update($request->all());
            return response()->json($session);
        } catch (\Exception $e) {
            return response()->json("Problème de modification");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $session = FormationSession::findOrFail($id);
            $session->delete();
            return response()->json("Session supprimée avec succès");
        } catch (\Exception $e) {
            return response()->json("Problème de suppression de la session");
        }
    }

    public function getCours($formationSessionID)
    {
        $cours = FormationSession::find($formationSessionID)->cours;
        return response()->json($cours);
    }
}