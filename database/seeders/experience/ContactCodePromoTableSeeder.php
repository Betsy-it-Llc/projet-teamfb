<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContactCodePromoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('contact_code_promo')->delete();
        
        \DB::table('contact_code_promo')->insert(array (
            0 => 
            array (
                'id_code' => 10,
                'id_contact' => 292,
            ),
            1 => 
            array (
                'id_code' => 11,
                'id_contact' => 157,
            ),
            2 => 
            array (
                'id_code' => 12,
                'id_contact' => 307,
            ),
        ));
        
        
    }
}