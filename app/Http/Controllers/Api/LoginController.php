<?php

namespace App\Http\Controllers\Api;

use App\Models\Login;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\LoginResource;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $logins = Login::paginate();

        return LoginResource::collection($logins);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LoginRequest $request)
{

    $validatedData = $request->validated();
    print($validatedData['email']);
    print($validatedData['password']);

    return Login::create([
        'email' => $validatedData['email'],
        'password' => $validatedData['password'], 
    ]);
}

    /**
     * Handle a login request.
     */
    public function login(LoginRequest $request)
{
    $validatedData = $request->validated();

    $user = Login::where('email', $request->email)->first();

    if ($user && $user->password === $request->password) {
        return response()->json(['message' => 'Exito'], 200);
    } else {
        return response()->json(['message' => 'Credencial incorrecta. Compruebe correo y contraseña nuevamente.'], 401);
    }
}
    /**
     * Display the specified resource.
     */
    public function show(Login $login): Login
    {
        return $login;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LoginRequest $request, Login $login): Login
    {
        $login->update($request->validated());

        return $login;
    }

    public function destroy(Login $login): Response
    {
        $login->delete();

        return response()->noContent();
    }

    public function deleteByEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
        ]);
        printf($request->email);
        $user = Login::where('email', $request->email)->first();

        if ($user) {
            $user->delete();
            return response()->json(['message' => 'Usuario eliminado exitosamente'], 200);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    }
}