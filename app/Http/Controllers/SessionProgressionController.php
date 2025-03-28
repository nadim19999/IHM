<?php

namespace App\Http\Controllers;

use App\Models\SessionProgression;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionProgressionController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show($formationSessionID)
    {
        $progression = SessionProgression::where('candidatID', Auth::id())
            ->where('formationSessionID', $formationSessionID)
            ->first();

        if (!$progression) {
            return response()->json(['message' => 'Progression non trouvée'], 404);
        }

        return response()->json($progression);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $formationSessionID)
    {
        $userID = Auth::id();
        $newCourID = $request->input('courID');

        $progression = SessionProgression::where('candidatID', $userID)
            ->where('formationSessionID', $formationSessionID)
            ->first();

        if (!$progression) {
            return response()->json([
                'message' => 'Aucune progression trouvée pour cette session',
            ], 404);
        }

        $courIDs = $progression->courIDs ? json_decode($progression->courIDs, true) : [];

        if (!in_array($newCourID, $courIDs)) {
            array_push($courIDs, $newCourID);
            $progression->courIDs = json_encode($courIDs);
            $progression->progression = count($courIDs);
            $progression->save();
            return response()->json([
                'message' => 'Progression mise à jour avec succès',
                'progression' => $progression->progression,
            ]);
        }

        return response()->json([
            'message' => 'Le cours est déjà enregistré dans la progression.',
            'progression' => $progression->progression,
        ]);
    }
}
