<?php

namespace App\Http\Controllers;

use App\Models\Certificat;
use Illuminate\Http\Request;

class CertificatController extends Controller
{
    /**
     * Afficher la liste des certificats.
     */
    public function index()
    {
        $certificats = Certificat::with(['formationSession', 'candidat'])->get();
        return response()->json($certificats);
    }

    /**
     * Afficher un certificat spécifique.
     */
    public function show($id)
    {
        $certificat = Certificat::with(['formationSession', 'candidat'])->find($id);

        if (!$certificat) {
            return response()->json(['message' => 'Certificat non trouvé'], 404);
        }

        return response()->json($certificat);
    }
}