<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Obtenir un JWT via les identifiants donnés.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $input = $request->only('adresseMail', 'password');
        $jwt_token = null;
        if (!$jwt_token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Adresse e-mail ou mot de passe incorrect',
            ], Response::HTTP_UNAUTHORIZED);
        }
        return response()->json([
            'success' => true,
            'token' => $jwt_token,
            'user' => Auth::user(),
        ]);
    }

    /**
     * Inscrire un utilisateur.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|between:2,100',
            'prenom' => 'required|string|between:2,100',
            'dateNaissance' => 'required|date|before:16 years ago',
            'numeroTelephone' => 'required|numeric|digits:8',
            'adresse' => 'required|string|between:2,100',
            'adresseMail' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'role' => 'required|string|in:admin,formateur,candidat',
            'avatar' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)],
            ['isActive' => false]
        ));

        $verificationUrl = route('verify.adresseMail', ['adresseMail' => $user->adresseMail]);
        Mail::send([], [], function ($message) use ($user, $verificationUrl) {
            $message->to($user->adresseMail)
                ->subject('Vérification de votre e-mail')
                ->html("<h2>{$user->name} ! Merci de vous être inscrit sur notre site</h2>
                <h4>Veuillez vérifier votre e-mail pour continuer...</h4>
                <a href='{$verificationUrl}'>Cliquez ici</a>");
        });

        return response()->json([
            'message' => 'Utilisateur inscrit avec succès. Veuillez vérifier votre e-mail.',
            'user' => $user
        ], 201);
    }

    /**
     * Vérifier l'adresse e-mail de l'utilisateur.
     */
    public function verifyEmail(Request $request)
    {
        $user = User::where('adresseMail', $request->query('adresseMail'))->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Utilisateur introuvable'
            ], 404);
        }
        if ($user->isActive) {
            return response()->json([
                'success' => true,
                'message' => 'Compte déjà activé'
            ]);
        }

        $user->isActive = true;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Compte activé avec succès'
        ]);
    }

    /**
     * Déconnecter l'utilisateur (invalidé le token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            // Vérifier si le token est valide et associé à un utilisateur
            $user = JWTAuth::parseToken()->authenticate();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Utilisateur introuvable ou token invalide.',
                ], 401);
            }

            // Invalidé le token
            JWTAuth::invalidate(JWTAuth::parseToken());

            return response()->json([
                'status' => 'success',
                'message' => 'Déconnexion réussie.',
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Échec de la déconnexion, token invalide.',
            ], 401); // Utiliser 401 pour un token invalide
        }
    }

    /**
     * Retourner la garde d'authentification
     */
    private function guard()
    {
        return Auth::guard();
    }

    /**
     * Rafraîchir un token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        try {
            $newToken = JWTAuth::refresh(JWTAuth::getToken());
            return $this->createNewToken($newToken);
        } catch (JWTException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Échec du rafraîchissement du token, token invalide.',
            ], 401);
        }
    }

    /**
     * Obtenir le profil de l'utilisateur authentifié.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Obtenir la structure du tableau de token.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
            'user' => auth('api')->user()
        ]);
    }
}