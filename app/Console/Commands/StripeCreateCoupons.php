<?php

namespace App\Console\Commands;

use App\Models\experienceApp\Remise;
use DateTimeZone;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Nette\Utils\DateTime;

class StripeCreateCoupons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'coupons:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creation remise stripe';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

            $rem = Remise::all();
            foreach ($rem as $remise) {
                if(!is_null($remise->date_debut)&&isset($remise->date_debut)){
                    if(new DateTime()>=new DateTime($remise->date_debut)&&!isset($remise->id_stripe_remise)){
                        if (!is_null($remise->taux)) {
                            if(isset($remise->date_fin)){
                                $coupon = $stripe->coupons->create([
                                    'percent_off' => floatval($remise->taux),
                                    'duration' => 'forever',
                                    'name' => $remise->nom_remise,
                                    'metadata' =>
                                        [
                                            'type_remise' => $remise->type_remise,
                                            'statut' => $remise->statut,
                                            'id_remise' => $remise->id_remise,
                                        ]
                                ]);
                            }else{
                                $coupon = $stripe->coupons->create([
                                    'percent_off' => floatval($remise->taux),
                                    'duration' => 'forever',
                                    'name' => $remise->nom_remise,
                                    'metadata' =>
                                        [
                                            'type_remise' => $remise->type_remise,
                                            'statut' => $remise->statut,
                                            'id_remise' => $remise->id_remise,
                                        ]
                                ]);
                            }
                            $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                            DB::connection('mysql2')
                            ->update('UPDATE remise SET remise.id_stripe_remise="' . $coupon['id'] . '", remise.url_stripe_remise="https://dashboard.stripe.com/test/coupons/' . $coupon['id'] . '",remise.date_update="' . $current_date->format('Y-m-d H:i:s') . '" WHERE remise.id_remise=' . $remise->id_remise . '');
                        }
                    }
                    if (!is_null($remise->montant)) {
                        if(isset($remise->date_fin)){
                            $coupon = $stripe->coupons->create([
                                'amount_off' => floatval($remise->montant) * 100,
                                'duration' => 'forever',
                                'name' => $remise->nom_remise,
                                'metadata' =>
                                    [
                                        'type_remise' => $remise->type_remise,
                                        'statut' => $remise->statut,
                                        'id_remise' => $remise->id_remise,
                                    ]
                            ]);
                        }else{
                            $coupon = $stripe->coupons->create([
                                'amount_off' => floatval($remise->montant) * 100,
                                'duration' => 'forever',
                                'name' => $remise->nom_remise,
                                'metadata' =>
                                    [
                                        'type_remise' => $remise->type_remise,
                                        'statut' => $remise->statut,
                                        'id_remise' => $remise->id_remise,
                                    ]
                            ]);
                        }
                        $current_date = new DateTime("now", new DateTimeZone('Europe/Paris'));
                        DB::connection('mysql2')
                        ->update('UPDATE remise SET remise.id_stripe_remise="' . $coupon['id'] . '", remise.url_stripe_remise="https://dashboard.stripe.com/test/coupons/' . $coupon['id'] . '",remise.date_update="' . $current_date->format('Y-m-d H:i:s') . '" WHERE remise.id_remise=' . $remise->id_remise . '');
                    }
                }
            }
        }
    }