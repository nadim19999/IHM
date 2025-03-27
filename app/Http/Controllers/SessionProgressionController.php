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
        $progression = SessionProgression::firstOrCreate([
            'candidatID' => Auth::id(),
            'formationSessionID' => $formationSessionID,
        ]);

        $progression->progression += $request->progression;
        $progression->save();

        return response()->json(['message' => 'Progression mise à jour avec succès', 'progression' => $progression]);
    }
}