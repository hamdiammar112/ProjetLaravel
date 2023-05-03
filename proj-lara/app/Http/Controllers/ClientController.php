<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Coach;
use App\Models\Abonnement;

class ClientController extends Controller
{



    public function getListeClients()
    {
        $data = Client::get();
        $title = "Liste Clients";
        // return $data;
        return view('/clients/clients', compact('data', 'title'));
    }



    public function createClient()
    {

        $title = "Creation Client";
        $coaches = Coach::get();

        return view('/clients/create-client', compact('title', 'coaches'));
    }

    public function saveClient(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'birthdate' => 'required',
            'email' => 'required|email|unique:clients,email',
            'cin' => 'required',
            'phone' => 'required',
            'coach_id' => 'required',
        ], [
            'email.unique' => 'This Email has already been taken.',

        ]);


        $nom = $request->nom;
        $prenom = $request->prenom;
        $birthdate = $request->birthdate;
        $email = $request->email;
        $cin = $request->cin;
        $phone = $request->phone;

        $coach_id = $request->coach_id;

        $cl = new Client();
        $cl->nom = $nom;
        $cl->prenom = $prenom;
        $cl->birthdate = $birthdate;
        $cl->email = $email;
        $cl->cin = $cin;
        $cl->phone = $phone;

        $cl->coach_id = $coach_id;


        $cl->save();

        return redirect('/liste-clients')->with('create', 'Client ajouté avec succès');
    }

    public function updateClient($id)
    {

        $title = "Modifier Client";
        $data = Client::where('id', '=', $id)->first();
        $coaches = Coach::get();

        return view('/clients/update-client', compact('data', 'title', 'coaches'));
    }


    public function editClient(Request $request)
    {
        // dd($request->all());
        $id = $request->id;

        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'birthdate' => 'required',
            'email' => 'required|email|unique:clients,email,' . $id . ',id',
            'cin' => 'required',
            'phone' => 'required',
            'coach_id' => 'required',
        ]);

        $id = $request->id;
        $nom = $request->nom;
        $prenom = $request->prenom;
        $birthdate = $request->birthdate;
        $email = $request->email;
        $cin = $request->cin;
        $phone = $request->phone;
        $coach_id = $request->coach_id;

        Client::where('id', '=', $id)->update([
            'nom' => $nom,
            'prenom' => $prenom,
            'birthdate' => $birthdate,
            'email' => $email,
            'cin' => $cin,
            'phone' => $phone,
            'coach_id' => $coach_id,
        ]);

        return redirect('/liste-clients')->with('update', 'Client modifié avec succès');
    }

    public function deleteClient(Request $request)
    {
        $id = $request->id;
        $client = Client::findOrFail($id);
        $hasActiveAbonnements = Abonnement::where('client_id', $id)
            ->where('statut', true)
            ->exists();

        if ($hasActiveAbonnements) {
            return redirect()->back()->with('no_delete', 'Ce Client ne peut pas être supprimé car il a un Abonnement Actif.');
        } else {
            Abonnement::where('client_id', $id)->delete();
            $client->delete();
            return redirect()->back()->with('delete', 'Client supprimé avec succès');
        }
    }



    public function showClient($id)
    {

        $title = "Info Client";
        $client = Client::where('id', '=', $id)->first();

        $sub = Abonnement::where('client_id', '=', $id)
            ->where('statut', '=', true)
            ->first();

        $other_subs = Abonnement::where('client_id', '=', $id)
            ->where('statut', '=', false)
            ->get();



        return view('/clients/show-client', compact('client', 'title', 'sub', 'other_subs'));
    }
}
