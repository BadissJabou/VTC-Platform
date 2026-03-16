<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'subject' => 'required|string|in:reservation,quote,info,partnership,other',
            'message' => 'required|string|max:2000',
            'privacy' => 'required'
        ], [
            'name.required' => 'Le nom complet est obligatoire.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse email valide.',
            'phone.required' => 'Le numéro de téléphone est obligatoire.',
            'subject.required' => 'Veuillez sélectionner un sujet.',
            'message.required' => 'Le message est obligatoire.',
            'privacy.required' => 'Vous devez accepter la politique de confidentialité.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // TODO: Send email notification
        // TODO: Store contact message in database
        // TODO: Send auto-reply to customer

        return redirect()->route('contact')
            ->with('success', 'Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.');
    }
}
