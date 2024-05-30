<?php

namespace App\Http\Controllers\Api;

use App\Models\Login;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\DestroyRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\LoginResource;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Guardar un nuevo usuario.
     * 
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function store(LoginRequest $request):JsonResponse
    {
        $request->validated();

        try{
            Login::create([
                'email' => $request->email,
                'password' => $request->password 
            ]);  
        }
        catch(Exception $e){
            return response()->json(['message' => 'Ocurrió un problema creando el usuario.'], 500);
        } 
        return response()->json(['message' => 'Usuario creado exitosamente.'], 200);
    }   

    /**
     * Login de usuario.
     * 
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request):JsonResponse
    {
        $request->validated();

        $user = Login::where('email', $request->email)->first();

        if ($user && $user->password === $request->password) {
            return response()->json(['message' => 'Usuario logeado correctamente.'], 200);
        } else {
            return response()->json(['message' => 'Credencial incorrecta. Compruebe correo y contraseña nuevamente.'], 401);
        }
    }
    

    /**
     * Actualización contraseña de usuario.
     * 
     * @param UpdateRequest $request
     * @return JsonResponse
     */
    public function update(UpdateRequest $request):JsonResponse
    {
        $request->validated();

        $user = Login::where('email', $request->email)->first();

        if ($user && $user->password === $request->password)
        {
            $user->password = $request->newPassword;

            $user->save();

            return response()->json(['message' => 'Contraseña actualizada correctamente'], 200);
        }
        else
        {
            return response()->json(['message' => 'Credencial incorrecta. Compruebe correo y contraseña nuevamente.'], 401);
        }
    }

    
    /**
     * Borrar un usuario.
     * 
     * @param DestroyRequest $request
     * @return JsonResponse 
     */
    public function destroy(DestroyRequest $request):JsonResponse
    {
        $request->validated();

        $user = Login::where('email', $request->email)->first();

        if ($user) {
            $user->delete();
            return response()->json(['message' => 'Usuario eliminado exitosamente'], 200);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    }
}