<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'contact_first_name' => 'required|string|max:255',
                'contact_last_name' => 'required|string|max:255',
                'contact_telephone' => [
                    'required',
                    'regex:/^(06|07)[0-9]{8}$/'
                ],
                'contact_email' => 'required|email',
                'message' => 'required|string',
            ], [
                'contact_first_name.required' => 'Le champ prénom est requis.',
                'contact_last_name.required' => 'Le champ nom est requis.',
                'contact_telephone.required' => 'Le champ téléphone est requis.',
                'contact_telephone.regex' => 'Le numéro de téléphone doit commencer par 06 ou 07 et contenir exactement 10 chiffres.',
                'contact_email.required' => 'Le champ email est requis.',
                'contact_email.email' => 'Le champ email doit contenir une adresse email valide.',
                'message.required' => 'Le champ message est requis.',
            ]);


            $contact = Contact::create([
                'contact_first_name' => $request->contact_first_name,
                'contact_last_name' => $request->contact_last_name,
                'contact_telephone' => $request->contact_telephone,
                'contact_email' => $request->contact_email,
                'message' => $request->message,
            ]);

            return response()->json([
                'message' => 'contact ajoute avec succès',
                'contact' => $contact,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de l\'ajout de contact : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function list()
    {
        try {
            $contacts = Contact::all();

            if ($contacts->isEmpty()) {
                return response()->json([
                    'message' => 'Aucun contact touve',
                    'sections' => []
                ], 200);
            }

            return response()->json([
                'message' => 'Liste de toutes les contacts récupérée avec succès',
                'contacts' => $contacts
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la récupération des contacts : ' . $exception->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $contact = Contact::findOrFail($id);
            $contact->delete();
            return response()->json([
                'message' => 'message supprimé avec succès'
            ], 200);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'message' => 'contact non trouvé avec l\'identifiant ' . $id
            ], 404);
        } catch (Exception $exception) {
            return response()->json([
                'message' => 'Erreur lors de la suppression du contact : ' . $exception->getMessage()
            ], 500);
        }
    }
}
