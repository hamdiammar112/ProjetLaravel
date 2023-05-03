<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function getAllPlans()
    {
        $title = "Liste des Plans";
        $plans = Plan::get();


        return view('/plans/plans', compact('title', 'plans'));
    }

    public function deletePlan(Request $request)
    {
        $id = $request->id;
        Plan::where('id', '=', $id)->delete();
        return redirect()->back()->with('delete', 'Plan supprimé avec succès');
    }

    public function updatePlanStatus(Request $request)
    {
        $id = $request->id;
        $plan = Plan::find($id);

        if ($plan) {
            $plan->statut = !$plan->statut; // Toggle the status between true and false
            $plan->save();
            return redirect()->back()->with('update_status', 'Statut modifié avec succès');
        } else {
            return redirect()->back()->with('update_status', 'Statut Not Found');
        }
    }

    public function showPlan($id)
    {

        $title = "Info Plan";
        $plan = Plan::where('id', '=', $id)->first();
        return view('/plans/show-plan', compact('plan', 'title'));
    }

    public function createPlan()
    {

        $title = "Creation Plan";


        return view('/plans/create-plan', compact('title'));
    }

    public function savePlan(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'titre' => 'required|unique:plans,titre',
            'statut' => 'required|boolean',
            'description' => 'required',
            'features' => 'required',
            'prix_mensuel' => 'required|numeric',
            'prix_trimestriel' => 'required|numeric',
            'prix_semestriel' => 'required|numeric',
            'prix_annuel' => 'required|numeric',
        ]);




        $plan = new Plan();
        $plan->titre = strtoupper($request->titre);
        $plan->statut = $request->statut;
        $plan->description = $request->description;
        $plan->features = $request->features;
        $plan->prix_mensuel = $request->prix_mensuel;
        $plan->prix_trimestriel = $request->prix_trimestriel;
        $plan->prix_semestriel = $request->prix_semestriel;
        $plan->prix_annuel = $request->prix_annuel;



        $plan->save();

        return redirect('/liste-plans')->with('create', 'Plan ajouté avec succès');
    }

    public function updatePlan($id)
    {

        $title = "Modifier Plan";
        $plan = Plan::where('id', '=', $id)->first();

        return view('/plans/update-plan', compact('title', 'plan'));
    }

    public function editPlan(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'titre' => 'required|unique:plans,titre,' . $id . ',id',
            'statut' => 'required|boolean',
            'description' => 'required',
            'features' => 'required',
            'prix_mensuel' => 'required|numeric',
            'prix_trimestriel' => 'required|numeric',
            'prix_semestriel' => 'required|numeric',
            'prix_annuel' => 'required|numeric',
        ]);

        Plan::where('id', '=', $id)->update([
            'titre' => strtoupper($request->titre),
            'statut' => $request->statut,
            'description' => $request->description,
            'features' => $request->features,
            'prix_mensuel' => $request->prix_mensuel,
            'prix_trimestriel' => $request->prix_trimestriel,
            'prix_semestriel' => $request->prix_semestriel,
            'prix_annuel' => $request->prix_annuel,
        ]);

        return redirect('/liste-plans')->with('update', 'Plan modifié avec succès');
    }
}
