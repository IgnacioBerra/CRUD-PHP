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
     * Store a new user
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
     * User's password update
     */
    public function update(Request $request)
    {
        $request->validate([
             'email' => 'required|string',
             'password' => 'required|string',
             'newPassword' => 'required|string'
        ]);

        $user = Login::where('email', $request->email)->first();

        if ($user && $user->password === $request->password)
        {

            $user->password = $request->newPassword;
            $user->save();
            return response()->json(['message' => 'Contraseña actualizada correctamente'], 200);}

            else{

            return response()->json(['message' => 'Credencial incorrecta. Compruebe correo y contraseña nuevamente.'], 401);
        }
      
    }

    
    /**
     * Delete an user. 
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
        ]);


        $user = Login::where('email', $request->email)->first();

        if ($user) {
            $user->delete();
            return response()->json(['message' => 'Usuario eliminado exitosamente'], 200);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    }
}