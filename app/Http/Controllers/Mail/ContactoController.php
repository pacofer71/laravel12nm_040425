<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\ContactoMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function index()
    {
        return view('formcorreos.contacto');
    }

    public function sendMail(Request $request)
    {
        $rules = [
            'nombre' => ['required', 'string', 'min:3', 'max:100'],
            'contenido' => ['required', 'string', 'min:10', 'max:500'],
            'email' => ['nullable', 'email'],
        ];

        $email = ($request->email) ? $request->email : Auth::user()->email;

        try {
            Mail::to('contacto@iesalandalus.org')->send(new ContactoMailable($request->nombre, $email, $request->contenido));

            return redirect()->route('home')->with('mensaje', 'Mensaje enviado, gracias por su feedback');
        } catch (\Exception $ex) {
            dd($ex->getMessage());

            return redirect()->route('home')->with('mensaje', 'error: '.$ex->getMessage());
        }
    }
}
