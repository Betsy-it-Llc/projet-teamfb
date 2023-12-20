<?php

namespace App\Http\Controllers;

//require_once(base_path('storage/app/secrets.php'));
require_once(__DIR__. '/../../../vendor/stripe/stripe-php/lib/Stripe.php');
require_once (__DIR__. '/../../../vendor/autoload.php');

use Illuminate\Http\Request;
use App\Models\FormulaireWebhook;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Group;
use \Stripe\Stripe;

class FormulaireWebhookController extends Controller {
    public function handleWebhook(Request $request){
        $endpoint_secret=null;
        $payload = file_get_contents('php://input');
        $data = json_decode($payload,true);
        vardump($data);
    }
}