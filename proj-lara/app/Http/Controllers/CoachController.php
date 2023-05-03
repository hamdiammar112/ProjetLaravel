<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coach;
use App\Models\Client;

class CoachController extends Controller
{


    public function getListeCoaches()
    {
        $data = Coach::get();
        $title = "Liste Coaches";
        // return $data;
        return view('/coaches/coaches', compact('data', 'title'));
    }

    public function showCoach($id)
    {
        $clients = Client::where('coach_id', '=', $id)->get();
        $title = "Info Coach";
        $coach = Coach::where('id', '=', $id)->first();
        return view('/coaches/show-coach', compact('coach', 'title', 'clients'));
    }


    // public function deleteCoach(Request $request)
    // {
    //     $id = $request->id;
    //     Coach::where('id', '=', $id)->delete();
    //     return redirect()->back()->with('delete', 'Coach supprimé avec succès');
    // }

    public function deleteCoach(Request $request)
    {
        $id = $request->id;
        $coach = Coach::find($id);

        if ($coach->clients()->count() > 0) {
            // coach has Clients, cannot be deleted
            return redirect()->back()->with('no_delete', 'Ce Coach ne peut pas être supprimé car il a des clients associées.');
        } else {
            // coach has no Clients, can be deleted
            $coach->delete();
            return redirect()->back()->with('delete', 'Coach supprimé avec succès');
        }
    }

    public function createCoach()
    {

        $title = "Creation Coach";


        return view('/coaches/create-coach', compact('title'));
    }

    public function saveCoach(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'birthdate' => 'required',
            'email' => 'required|email|unique:coaches,email',
            'cin' => 'required',
            'phone' => 'required',
        ], [
            'email.unique' => 'This Email has already been taken.',

        ]);


        $nom = $request->nom;
        $prenom = $request->prenom;
        $birthdate = $request->birthdate;
        $email = $request->email;
        $cin = $request->cin;
        $phone = $request->phone;



        $coach = new Coach();
        $coach->nom = $nom;
        $coach->prenom = $prenom;
        $coach->birthdate = $birthdate;
        $coach->email = $email;
        $coach->cin = $cin;
        $coach->phone = $phone;




        $coach->save();

        return redirect('/liste-coaches')->with('create', 'Coach ajouté avec succès');
    }

    public function updateCoach($id)
    {

        $title = "Modifier Coach";
        $coach = Coach::where('id', '=', $id)->first();

        return view('/coaches/update-coach', compact('title', 'coach'));
    }

    public function editCoach(Request $request)
    {
        // dd($request->all());
        $id = $request->id;

        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'birthdate' => 'required',
            'email' => 'required|email|unique:coaches,email,' . $id . ',id',
            'cin' => 'required',
            'phone' => 'required',

        ]);


        $nom = $request->nom;
        $prenom = $request->prenom;
        $birthdate = $request->birthdate;
        $email = $request->email;
        $cin = $request->cin;
        $phone = $request->phone;


        Coach::where('id', '=', $id)->update([
            'nom' => $nom,
            'prenom' => $prenom,
            'birthdate' => $birthdate,
            'email' => $email,
            'cin' => $cin,
            'phone' => $phone,

        ]);

        return redirect('/liste-coaches')->with('update', 'Coach modifié avec succès');
    }
}
