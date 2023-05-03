<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Plan;
use App\Models\Abonnement;
use Carbon\Carbon;

class AbonnementController extends Controller
{
    public function getSubs()
    {
        $title = "Abonnements";
        $subs = Abonnement::get();

        return view('/abonnements/subs', compact('title', 'subs'));
    }

    public function createSub($id)
    {

        $title = "Creation Abonnement";
        $client = Client::where('id', '=', $id)->first();
        $plans = Plan::get();
        $sub = Abonnement::where('client_id', '=', $id)
            ->where('statut', '=', true)
            ->first();

        return view('/abonnements/create-sub', compact('title', 'client', 'plans', 'sub'));
    }

    public function saveSub(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'client_id' => 'required',
            'plan_id' => 'required',
            'type' => 'required',
            'pay_statut' => 'required|boolean',
        ]);

        $plan_id = $request->plan_id;
        $plan = Plan::where('id', '=', $plan_id)->first();

        $subscription = new Abonnement();

        $subscription->client_id = $request->client_id;
        $subscription->plan_id = $plan_id;
        $subscription->pay_statut = $request->pay_statut;
        $subscription->statut = true;

        switch ($request->type) {
            case 0:
                $subscription->type = strtoupper("Mensuel");
                $subscription->prix = $plan->prix_mensuel;
                $subscription->debut = Carbon::now()->format('Y-m-d');
                $subscription->expiration = Carbon::now()->addDays(30)->format('Y-m-d');
                break;
            case 1:
                $subscription->type = strtoupper("Trimestriel");
                $subscription->prix = $plan->prix_trimestriel;
                $subscription->debut = Carbon::now()->format('Y-m-d');
                $subscription->expiration = Carbon::now()->addMonths(3)->format('Y-m-d');
                break;
            case 2:
                $subscription->type = strtoupper("Semestriel");
                $subscription->prix = $plan->prix_semestriel;
                $subscription->debut = Carbon::now()->format('Y-m-d');
                $subscription->expiration = Carbon::now()->addMonths(6)->format('Y-m-d');
                break;
            case 3:
                $subscription->type = strtoupper("Annuel");
                $subscription->prix = $plan->prix_annuel;
                $subscription->debut = Carbon::now()->format('Y-m-d');
                $subscription->expiration = Carbon::now()->addYear()->format('Y-m-d');
                break;
            default:
                // traitement d'erreur pour le type d'abonnement inconnu
                return redirect()->back()->withErrors(['type' => 'Unknown subscription type']);
                break;
        }


        $subscription->save();


        return redirect('/show-client/' . $request->client_id)->with('create', 'Abonnement ajouté avec succès');
    }

    public function updatePayStatus(Request $request)
    {
        $id = $request->id;
        $sub = Abonnement::find($id);

        if ($sub) {
            $sub->pay_statut = !$sub->pay_statut; // Toggle the status between true and false
            $sub->save();
            return redirect()->back()->with('update_status', 'Statut de Paiement modifié avec succès');
        } else {
            return redirect()->back()->with('update_status', 'Statut Not Found');
        }
    }

    public function deleteAbonnement(Request $request)
    {
        $id = $request->id;
        Abonnement::where('id', '=', $id)->delete();
        return redirect()->back()->with('delete', 'Abonnement supprimé avec succès');
    }
}
