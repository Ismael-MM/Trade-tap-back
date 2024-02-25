<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Trabajador;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistroCliente;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): Response
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'usuario' => $request->usuario,
            'apellido1' => $request->apellido1,
            'apellido2' => $request->apellido2,
            'rol' => $request->cif==''? 'cliente':'trabajador',
            'direccion' => $request->direccion,
            'provincia' => $request->provincia,
            'localidad' => $request->localidad,
            'cp' => $request->cp,
            'telefono' => $request->telefono,
            'password' => Hash::make($request->password),
        ]);

        if ($request->cif == '') {
            $cliente = Cliente::create();

            $cliente->user()->save($user);
        } else {
            $trabajador = Trabajador::create([
                'cif' => $request->cif,
            ]);

            $trabajador->profesions()->attach($request->profesiones);

            $trabajador->user()->save($user);
        }

        event(new Registered($user));

        Auth::login($user);

        Mail::to($user->email)->send(new RegistroCliente($user));

        return response()->noContent();
    }
}
