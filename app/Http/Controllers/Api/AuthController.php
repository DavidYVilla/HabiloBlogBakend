<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // FUNCION DE REGISTRO
    public function registro(Request $request){
        $this->validate($request,[
            'name' =>'required|string|min:2|max:200',
            'email' => 'required|email|unique:users,email',
            'password'=>'required|string|min:6|max:20|confirmed'
        ]);
        $usuario=new User();
        $usuario->name=$request->name;
        $usuario->email=$request->email;
        $usuario->password=bcrypt($request->password);
        if($usuario->save()){
            $token=$usuario->createToken('Personal token')->plainTextToken;
            return response()->json([
                'mensaje'=> 'Registro Exitoso!',
                'usuario'=>$usuario,
                'token'=>$token,
            ]);
        }else{
            return response()->json([
                'mensaje'=>'No se pudo registrar',

            ],400);

        }
            }
///funcion para login
public function login(Request $request){
     $this->validate($request,[
            'email' => 'required|email',
            'password'=>'required|string|min:6|max:20'
        ]);
    $credenciales=request(["email","password"]);
    if(!Auth::attempt($credenciales)){
        return response()->json(["mensaje"=>"Usuario o contraseña no validos, intente de nuevo por favor"],401);
    }
    $usuario=$request->user();
    $token=$usuario->createToken('Personal  Token')->plainTextToken;
    return response()->json([
                'mensaje'=> 'Inicio Exitoso!',
                'usuario'=>$usuario,
                'token'=>$token,
            ]);
    }
}

