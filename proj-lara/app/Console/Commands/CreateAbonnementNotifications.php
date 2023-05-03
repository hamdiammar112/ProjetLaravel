<?php

namespace App\Console\Commands;

use App\Models\Abonnement;
use App\Models\Client;
use Carbon\Carbon;
use DateTime;
use Illuminate\Console\Command;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class CreateAbonnementNotifications extends Command
{



    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:abonnements';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Abonnements';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        // perform other tasks
        // php artisan check:abonnements
        // php artisan schedule:work



        $this->line('Schedular Start');


        $subs = Abonnement::get();

        if ($subs->count() == 0) {
            $this->line('No subscriptions found');
            return 0;
        }
        $this->line('0');


        foreach ($subs as $sub) {
            $now = new DateTime();
            $expiration = new DateTime($sub->expiration);

            $interval = $expiration->diff($now);
            $days_to_expire = $interval->days;

            if ($sub->statut == true && $days_to_expire == 5) {
                // Notify user that the subscription is expiring in 5 days
                $client = Client::where('id', '=', $sub->client_id)->first();
                // Send email to the client
                $this->sendEmail($client->email, "Subscription Expiring Soon", "her Client, Votre abonnement expire dans 5 jours.");
                $this->info('Schedular case 1');
            } else if ($sub->statut == true && $expiration->format('Y-m-d') == $now->format('Y-m-d')) {
                // Set the subscription status to false and notify the user
                $sub->statut = false;
                $sub->save();
                $this->info('saving');
                $client = Client::where('id', '=', $sub->client_id)->first();
                // Send email to the client
                $this->sendEmail($client->email, "Subscription Expired", "Cher Client, votre abonnement est expiré.");
                $this->info('Schedular case 2');
            } else if ($sub->pay_statut == false && $days_to_expire <= 10) {
                // Notify user to pay for the subscription
                $client = Client::where('id', '=', $sub->client_id)->first();
                // Send email to the client
                $this->sendEmail($client->email, "Subscription Payment Due", "Cher Client, le paiement de votre abonnement est dû bientôt. Montant " . $sub->prix . "DT");
                $this->info('Schedular case 3');
            }
        }



        $this->line('Schedular Finished Scanning...');
    }



    private function sendEmail($to, $subject, $message)
    {
        // Send email using Laravel's Mail facade
        Mail::raw($message, function ($message) use ($to, $subject) {
            $message->to($to);
            $message->subject($subject);
        });
    }
}
