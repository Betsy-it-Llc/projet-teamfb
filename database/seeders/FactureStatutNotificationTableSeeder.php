<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FactureStatutNotificationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('facture_statut_notification')->delete();
        
        \DB::connection('mysql2')->table('facture_statut_notification')->insert(array (
            0 => 
            array (
                'id_notification' => 2,
                'date_statut' => NULL,
                'num_facture' => 84,
                'id_facture_statut' => 6,
            ),
            1 => 
            array (
                'id_notification' => 3,
                'date_statut' => NULL,
                'num_facture' => 53,
                'id_facture_statut' => 6,
            ),
            2 => 
            array (
                'id_notification' => 4,
                'date_statut' => NULL,
                'num_facture' => 83,
                'id_facture_statut' => 2,
            ),
            3 => 
            array (
                'id_notification' => 29,
                'date_statut' => '2023-04-14 00:00:00',
                'num_facture' => 87,
                'id_facture_statut' => 2,
            ),
            4 => 
            array (
                'id_notification' => 30,
                'date_statut' => '2023-04-14 00:00:00',
                'num_facture' => 87,
                'id_facture_statut' => 6,
            ),
            5 => 
            array (
                'id_notification' => 31,
                'date_statut' => '2023-04-19 00:00:00',
                'num_facture' => 97,
                'id_facture_statut' => 6,
            ),
            6 => 
            array (
                'id_notification' => 35,
                'date_statut' => '2023-05-04 00:00:00',
                'num_facture' => 98,
                'id_facture_statut' => 2,
            ),
            7 => 
            array (
                'id_notification' => 79,
                'date_statut' => '2023-05-06 00:00:00',
                'num_facture' => 116,
                'id_facture_statut' => 1,
            ),
            8 => 
            array (
                'id_notification' => 80,
                'date_statut' => '2023-05-06 00:00:00',
                'num_facture' => 117,
                'id_facture_statut' => 1,
            ),
            9 => 
            array (
                'id_notification' => 84,
                'date_statut' => '2023-05-06 00:00:00',
                'num_facture' => 117,
                'id_facture_statut' => 2,
            ),
            10 => 
            array (
                'id_notification' => 85,
                'date_statut' => '2023-05-09 00:00:00',
                'num_facture' => 117,
                'id_facture_statut' => 5,
            ),
            11 => 
            array (
                'id_notification' => 86,
                'date_statut' => '2023-05-09 00:00:00',
                'num_facture' => 117,
                'id_facture_statut' => 6,
            ),
            12 => 
            array (
                'id_notification' => 89,
                'date_statut' => '2023-05-12 00:00:00',
                'num_facture' => 119,
                'id_facture_statut' => 2,
            ),
            13 => 
            array (
                'id_notification' => 90,
                'date_statut' => '2023-05-12 00:00:00',
                'num_facture' => 119,
                'id_facture_statut' => 6,
            ),
            14 => 
            array (
                'id_notification' => 118,
                'date_statut' => '2023-05-16 00:00:00',
                'num_facture' => 133,
                'id_facture_statut' => 2,
            ),
            15 => 
            array (
                'id_notification' => 119,
                'date_statut' => '2023-05-16 00:00:00',
                'num_facture' => 133,
                'id_facture_statut' => 2,
            ),
            16 => 
            array (
                'id_notification' => 120,
                'date_statut' => '2023-05-16 00:00:00',
                'num_facture' => 133,
                'id_facture_statut' => 3,
            ),
            17 => 
            array (
                'id_notification' => 121,
                'date_statut' => '2023-05-16 00:00:00',
                'num_facture' => 133,
                'id_facture_statut' => 5,
            ),
            18 => 
            array (
                'id_notification' => 122,
                'date_statut' => '2023-05-16 00:00:00',
                'num_facture' => 133,
                'id_facture_statut' => 6,
            ),
            19 => 
            array (
                'id_notification' => 130,
                'date_statut' => '2023-05-16 00:00:00',
                'num_facture' => 134,
                'id_facture_statut' => 2,
            ),
            20 => 
            array (
                'id_notification' => 131,
                'date_statut' => '2023-05-16 00:00:00',
                'num_facture' => 134,
                'id_facture_statut' => 6,
            ),
            21 => 
            array (
                'id_notification' => 136,
                'date_statut' => '2023-05-16 00:00:00',
                'num_facture' => 136,
                'id_facture_statut' => 2,
            ),
            22 => 
            array (
                'id_notification' => 137,
                'date_statut' => '2023-05-16 00:00:00',
                'num_facture' => 136,
                'id_facture_statut' => 6,
            ),
            23 => 
            array (
                'id_notification' => 151,
                'date_statut' => '2023-05-22 00:00:00',
                'num_facture' => 138,
                'id_facture_statut' => 2,
            ),
            24 => 
            array (
                'id_notification' => 152,
                'date_statut' => '2023-05-22 00:00:00',
                'num_facture' => 138,
                'id_facture_statut' => 2,
            ),
            25 => 
            array (
                'id_notification' => 153,
                'date_statut' => '2023-05-22 00:00:00',
                'num_facture' => 138,
                'id_facture_statut' => 3,
            ),
            26 => 
            array (
                'id_notification' => 154,
                'date_statut' => '2023-05-22 00:00:00',
                'num_facture' => 138,
                'id_facture_statut' => 5,
            ),
            27 => 
            array (
                'id_notification' => 155,
                'date_statut' => '2023-05-22 00:00:00',
                'num_facture' => 138,
                'id_facture_statut' => 6,
            ),
            28 => 
            array (
                'id_notification' => 170,
                'date_statut' => '2023-05-24 00:00:00',
                'num_facture' => 139,
                'id_facture_statut' => 2,
            ),
            29 => 
            array (
                'id_notification' => 175,
                'date_statut' => '2023-05-26 00:00:00',
                'num_facture' => 139,
                'id_facture_statut' => 3,
            ),
            30 => 
            array (
                'id_notification' => 176,
                'date_statut' => '2023-05-27 00:00:00',
                'num_facture' => 140,
                'id_facture_statut' => 2,
            ),
            31 => 
            array (
                'id_notification' => 177,
                'date_statut' => '2023-05-27 00:00:00',
                'num_facture' => 140,
                'id_facture_statut' => 2,
            ),
            32 => 
            array (
                'id_notification' => 178,
                'date_statut' => '2023-05-27 00:00:00',
                'num_facture' => 140,
                'id_facture_statut' => 3,
            ),
            33 => 
            array (
                'id_notification' => 180,
                'date_statut' => '2023-05-30 00:00:00',
                'num_facture' => 141,
                'id_facture_statut' => 2,
            ),
            34 => 
            array (
                'id_notification' => 182,
                'date_statut' => '2023-05-30 00:00:00',
                'num_facture' => 142,
                'id_facture_statut' => 2,
            ),
            35 => 
            array (
                'id_notification' => 183,
                'date_statut' => '2023-05-30 00:00:00',
                'num_facture' => 142,
                'id_facture_statut' => 2,
            ),
            36 => 
            array (
                'id_notification' => 184,
                'date_statut' => '2023-05-30 00:00:00',
                'num_facture' => 142,
                'id_facture_statut' => 3,
            ),
            37 => 
            array (
                'id_notification' => 185,
                'date_statut' => '2023-05-30 00:00:00',
                'num_facture' => 142,
                'id_facture_statut' => 2,
            ),
            38 => 
            array (
                'id_notification' => 186,
                'date_statut' => '2023-05-30 00:00:00',
                'num_facture' => 142,
                'id_facture_statut' => 3,
            ),
            39 => 
            array (
                'id_notification' => 187,
                'date_statut' => '2023-05-30 00:00:00',
                'num_facture' => 142,
                'id_facture_statut' => 5,
            ),
            40 => 
            array (
                'id_notification' => 188,
                'date_statut' => '2023-05-30 00:00:00',
                'num_facture' => 142,
                'id_facture_statut' => 6,
            ),
            41 => 
            array (
                'id_notification' => 190,
                'date_statut' => '2023-05-30 00:00:00',
                'num_facture' => 141,
                'id_facture_statut' => 5,
            ),
            42 => 
            array (
                'id_notification' => 191,
                'date_statut' => '2023-05-30 00:00:00',
                'num_facture' => 141,
                'id_facture_statut' => 6,
            ),
            43 => 
            array (
                'id_notification' => 193,
                'date_statut' => '2023-05-30 00:00:00',
                'num_facture' => 143,
                'id_facture_statut' => 2,
            ),
            44 => 
            array (
                'id_notification' => 194,
                'date_statut' => '2023-05-30 00:00:00',
                'num_facture' => 143,
                'id_facture_statut' => 2,
            ),
            45 => 
            array (
                'id_notification' => 195,
                'date_statut' => '2023-05-30 00:00:00',
                'num_facture' => 143,
                'id_facture_statut' => 3,
            ),
            46 => 
            array (
                'id_notification' => 196,
                'date_statut' => '2023-05-30 00:00:00',
                'num_facture' => 143,
                'id_facture_statut' => 5,
            ),
            47 => 
            array (
                'id_notification' => 197,
                'date_statut' => '2023-05-30 00:00:00',
                'num_facture' => 143,
                'id_facture_statut' => 6,
            ),
            48 => 
            array (
                'id_notification' => 200,
                'date_statut' => '2023-06-01 00:00:00',
                'num_facture' => 139,
                'id_facture_statut' => 5,
            ),
            49 => 
            array (
                'id_notification' => 201,
                'date_statut' => '2023-06-01 00:00:00',
                'num_facture' => 139,
                'id_facture_statut' => 6,
            ),
            50 => 
            array (
                'id_notification' => 205,
                'date_statut' => '2023-06-03 00:00:00',
                'num_facture' => 144,
                'id_facture_statut' => 2,
            ),
            51 => 
            array (
                'id_notification' => 207,
                'date_statut' => '2023-06-03 00:00:00',
                'num_facture' => 144,
                'id_facture_statut' => 10,
            ),
            52 => 
            array (
                'id_notification' => 208,
                'date_statut' => '2023-06-03 00:00:00',
                'num_facture' => 144,
                'id_facture_statut' => 3,
            ),
            53 => 
            array (
                'id_notification' => 209,
                'date_statut' => '2023-06-03 00:00:00',
                'num_facture' => 144,
                'id_facture_statut' => 3,
            ),
            54 => 
            array (
                'id_notification' => 210,
                'date_statut' => '2023-06-04 00:00:00',
                'num_facture' => 144,
                'id_facture_statut' => 5,
            ),
            55 => 
            array (
                'id_notification' => 211,
                'date_statut' => '2023-06-04 00:00:00',
                'num_facture' => 144,
                'id_facture_statut' => 6,
            ),
            56 => 
            array (
                'id_notification' => 272,
                'date_statut' => '2023-06-09 11:36:00',
                'num_facture' => 146,
                'id_facture_statut' => 2,
            ),
            57 => 
            array (
                'id_notification' => 273,
                'date_statut' => '2023-06-09 00:00:00',
                'num_facture' => 146,
                'id_facture_statut' => 10,
            ),
            58 => 
            array (
                'id_notification' => 274,
                'date_statut' => '2023-06-09 00:00:00',
                'num_facture' => 146,
                'id_facture_statut' => 3,
            ),
            59 => 
            array (
                'id_notification' => 275,
                'date_statut' => '2023-06-09 00:00:00',
                'num_facture' => 146,
                'id_facture_statut' => 5,
            ),
            60 => 
            array (
                'id_notification' => 276,
                'date_statut' => '2023-06-09 00:00:00',
                'num_facture' => 146,
                'id_facture_statut' => 6,
            ),
            61 => 
            array (
                'id_notification' => 285,
                'date_statut' => '2023-06-19 13:04:00',
                'num_facture' => 147,
                'id_facture_statut' => 2,
            ),
            62 => 
            array (
                'id_notification' => 286,
                'date_statut' => '2023-06-19 13:04:00',
                'num_facture' => 147,
                'id_facture_statut' => 2,
            ),
            63 => 
            array (
                'id_notification' => 287,
                'date_statut' => '2023-06-19 13:04:00',
                'num_facture' => 147,
                'id_facture_statut' => 3,
            ),
            64 => 
            array (
                'id_notification' => 288,
                'date_statut' => '2023-06-19 11:08:38',
                'num_facture' => 147,
                'id_facture_statut' => 5,
            ),
            65 => 
            array (
                'id_notification' => 289,
                'date_statut' => '2023-06-19 11:08:38',
                'num_facture' => 147,
                'id_facture_statut' => 6,
            ),
            66 => 
            array (
                'id_notification' => 290,
                'date_statut' => '2023-06-19 11:08:55',
                'num_facture' => 147,
                'id_facture_statut' => 5,
            ),
            67 => 
            array (
                'id_notification' => 291,
                'date_statut' => '2023-06-19 11:08:55',
                'num_facture' => 147,
                'id_facture_statut' => 6,
            ),
            68 => 
            array (
                'id_notification' => 292,
                'date_statut' => '2023-06-19 13:58:00',
                'num_facture' => 147,
                'id_facture_statut' => 2,
            ),
            69 => 
            array (
                'id_notification' => 293,
                'date_statut' => '2023-06-19 13:58:00',
                'num_facture' => 147,
                'id_facture_statut' => 3,
            ),
            70 => 
            array (
                'id_notification' => 294,
                'date_statut' => '2023-06-19 12:09:20',
                'num_facture' => 147,
                'id_facture_statut' => 5,
            ),
            71 => 
            array (
                'id_notification' => 295,
                'date_statut' => '2023-06-19 12:09:20',
                'num_facture' => 147,
                'id_facture_statut' => 6,
            ),
            72 => 
            array (
                'id_notification' => 296,
                'date_statut' => '2023-06-19 16:07:15',
                'num_facture' => 147,
                'id_facture_statut' => 5,
            ),
            73 => 
            array (
                'id_notification' => 297,
                'date_statut' => '2023-06-19 16:07:15',
                'num_facture' => 147,
                'id_facture_statut' => 6,
            ),
            74 => 
            array (
                'id_notification' => 305,
                'date_statut' => '2023-06-21 10:36:00',
                'num_facture' => 149,
                'id_facture_statut' => 2,
            ),
            75 => 
            array (
                'id_notification' => 306,
                'date_statut' => '2023-06-21 10:37:00',
                'num_facture' => 149,
                'id_facture_statut' => 2,
            ),
            76 => 
            array (
                'id_notification' => 307,
                'date_statut' => '2023-06-21 10:37:00',
                'num_facture' => 149,
                'id_facture_statut' => 3,
            ),
            77 => 
            array (
                'id_notification' => 308,
                'date_statut' => '2023-06-21 08:39:32',
                'num_facture' => 149,
                'id_facture_statut' => 5,
            ),
            78 => 
            array (
                'id_notification' => 309,
                'date_statut' => '2023-06-21 08:39:32',
                'num_facture' => 149,
                'id_facture_statut' => 6,
            ),
            79 => 
            array (
                'id_notification' => 342,
                'date_statut' => '2023-06-29 16:49:12',
                'num_facture' => 153,
                'id_facture_statut' => 2,
            ),
            80 => 
            array (
                'id_notification' => 344,
                'date_statut' => '2023-06-29 16:49:12',
                'num_facture' => 153,
                'id_facture_statut' => 10,
            ),
            81 => 
            array (
                'id_notification' => 346,
                'date_statut' => '2023-06-29 16:49:16',
                'num_facture' => 153,
                'id_facture_statut' => 3,
            ),
            82 => 
            array (
                'id_notification' => 347,
                'date_statut' => '2023-06-29 14:53:55',
                'num_facture' => 153,
                'id_facture_statut' => 5,
            ),
            83 => 
            array (
                'id_notification' => 348,
                'date_statut' => '2023-06-29 14:53:55',
                'num_facture' => 153,
                'id_facture_statut' => 6,
            ),
            84 => 
            array (
                'id_notification' => 600,
                'date_statut' => '2019-04-21 09:49:00',
                'num_facture' => 200,
                'id_facture_statut' => 2,
            ),
            85 => 
            array (
                'id_notification' => 601,
                'date_statut' => '2019-04-21 10:20:00',
                'num_facture' => 201,
                'id_facture_statut' => 2,
            ),
            86 => 
            array (
                'id_notification' => 602,
                'date_statut' => '2019-05-10 18:24:00',
                'num_facture' => 202,
                'id_facture_statut' => 2,
            ),
            87 => 
            array (
                'id_notification' => 603,
                'date_statut' => '2019-07-03 13:10:00',
                'num_facture' => 203,
                'id_facture_statut' => 2,
            ),
            88 => 
            array (
                'id_notification' => 604,
                'date_statut' => '2019-07-24 08:31:00',
                'num_facture' => 204,
                'id_facture_statut' => 2,
            ),
            89 => 
            array (
                'id_notification' => 605,
                'date_statut' => '2019-08-30 17:38:00',
                'num_facture' => 205,
                'id_facture_statut' => 2,
            ),
            90 => 
            array (
                'id_notification' => 606,
                'date_statut' => '2019-11-05 12:12:00',
                'num_facture' => 206,
                'id_facture_statut' => 2,
            ),
            91 => 
            array (
                'id_notification' => 607,
                'date_statut' => '2019-11-18 19:32:00',
                'num_facture' => 207,
                'id_facture_statut' => 2,
            ),
            92 => 
            array (
                'id_notification' => 608,
                'date_statut' => '2019-11-20 13:13:00',
                'num_facture' => 208,
                'id_facture_statut' => 2,
            ),
            93 => 
            array (
                'id_notification' => 609,
                'date_statut' => '2019-11-28 22:41:00',
                'num_facture' => 209,
                'id_facture_statut' => 2,
            ),
            94 => 
            array (
                'id_notification' => 610,
                'date_statut' => '2019-12-15 09:15:00',
                'num_facture' => 210,
                'id_facture_statut' => 2,
            ),
            95 => 
            array (
                'id_notification' => 611,
                'date_statut' => '2019-12-16 09:20:00',
                'num_facture' => 211,
                'id_facture_statut' => 2,
            ),
            96 => 
            array (
                'id_notification' => 612,
                'date_statut' => '2019-12-16 15:43:00',
                'num_facture' => 212,
                'id_facture_statut' => 2,
            ),
            97 => 
            array (
                'id_notification' => 613,
                'date_statut' => '2019-12-17 18:26:00',
                'num_facture' => 213,
                'id_facture_statut' => 2,
            ),
            98 => 
            array (
                'id_notification' => 614,
                'date_statut' => '2019-12-24 10:57:00',
                'num_facture' => 214,
                'id_facture_statut' => 2,
            ),
            99 => 
            array (
                'id_notification' => 615,
                'date_statut' => '2020-01-21 19:13:00',
                'num_facture' => 215,
                'id_facture_statut' => 2,
            ),
            100 => 
            array (
                'id_notification' => 616,
                'date_statut' => '2020-03-04 15:06:00',
                'num_facture' => 216,
                'id_facture_statut' => 2,
            ),
            101 => 
            array (
                'id_notification' => 617,
                'date_statut' => '2020-03-04 23:21:00',
                'num_facture' => 217,
                'id_facture_statut' => 2,
            ),
            102 => 
            array (
                'id_notification' => 618,
                'date_statut' => '2020-07-08 07:01:00',
                'num_facture' => 218,
                'id_facture_statut' => 2,
            ),
            103 => 
            array (
                'id_notification' => 619,
                'date_statut' => '2020-07-08 08:22:00',
                'num_facture' => 219,
                'id_facture_statut' => 2,
            ),
            104 => 
            array (
                'id_notification' => 620,
                'date_statut' => '2020-07-09 18:21:00',
                'num_facture' => 220,
                'id_facture_statut' => 2,
            ),
            105 => 
            array (
                'id_notification' => 621,
                'date_statut' => '2020-08-01 08:57:00',
                'num_facture' => 221,
                'id_facture_statut' => 2,
            ),
            106 => 
            array (
                'id_notification' => 622,
                'date_statut' => '2020-08-08 14:27:00',
                'num_facture' => 222,
                'id_facture_statut' => 2,
            ),
            107 => 
            array (
                'id_notification' => 623,
                'date_statut' => '2020-08-11 09:58:00',
                'num_facture' => 223,
                'id_facture_statut' => 2,
            ),
            108 => 
            array (
                'id_notification' => 624,
                'date_statut' => '2020-08-27 19:39:00',
                'num_facture' => 224,
                'id_facture_statut' => 2,
            ),
            109 => 
            array (
                'id_notification' => 625,
                'date_statut' => '2020-09-02 05:39:00',
                'num_facture' => 225,
                'id_facture_statut' => 2,
            ),
            110 => 
            array (
                'id_notification' => 626,
                'date_statut' => '2020-09-09 08:25:00',
                'num_facture' => 226,
                'id_facture_statut' => 2,
            ),
            111 => 
            array (
                'id_notification' => 627,
                'date_statut' => '2020-09-17 15:59:00',
                'num_facture' => 227,
                'id_facture_statut' => 2,
            ),
            112 => 
            array (
                'id_notification' => 628,
                'date_statut' => '2020-10-25 08:18:00',
                'num_facture' => 228,
                'id_facture_statut' => 2,
            ),
            113 => 
            array (
                'id_notification' => 629,
                'date_statut' => '2020-10-31 17:48:00',
                'num_facture' => 229,
                'id_facture_statut' => 2,
            ),
            114 => 
            array (
                'id_notification' => 630,
                'date_statut' => '2020-11-28 17:09:00',
                'num_facture' => 230,
                'id_facture_statut' => 2,
            ),
            115 => 
            array (
                'id_notification' => 631,
                'date_statut' => '2020-12-04 11:14:00',
                'num_facture' => 231,
                'id_facture_statut' => 2,
            ),
            116 => 
            array (
                'id_notification' => 632,
                'date_statut' => '2020-12-05 09:37:00',
                'num_facture' => 232,
                'id_facture_statut' => 2,
            ),
            117 => 
            array (
                'id_notification' => 633,
                'date_statut' => '2020-12-06 16:27:00',
                'num_facture' => 233,
                'id_facture_statut' => 2,
            ),
            118 => 
            array (
                'id_notification' => 634,
                'date_statut' => '2020-12-07 13:17:00',
                'num_facture' => 234,
                'id_facture_statut' => 2,
            ),
            119 => 
            array (
                'id_notification' => 635,
                'date_statut' => '2020-12-08 10:49:00',
                'num_facture' => 235,
                'id_facture_statut' => 2,
            ),
            120 => 
            array (
                'id_notification' => 636,
                'date_statut' => '2020-12-11 08:09:00',
                'num_facture' => 236,
                'id_facture_statut' => 2,
            ),
            121 => 
            array (
                'id_notification' => 637,
                'date_statut' => '2020-12-11 09:36:00',
                'num_facture' => 237,
                'id_facture_statut' => 2,
            ),
            122 => 
            array (
                'id_notification' => 638,
                'date_statut' => '2020-12-11 17:44:00',
                'num_facture' => 238,
                'id_facture_statut' => 2,
            ),
            123 => 
            array (
                'id_notification' => 639,
                'date_statut' => '2020-12-12 08:28:00',
                'num_facture' => 239,
                'id_facture_statut' => 2,
            ),
            124 => 
            array (
                'id_notification' => 640,
                'date_statut' => '2020-12-12 14:09:00',
                'num_facture' => 240,
                'id_facture_statut' => 2,
            ),
            125 => 
            array (
                'id_notification' => 641,
                'date_statut' => '2020-12-13 14:47:00',
                'num_facture' => 241,
                'id_facture_statut' => 2,
            ),
            126 => 
            array (
                'id_notification' => 642,
                'date_statut' => '2021-01-21 16:47:00',
                'num_facture' => 242,
                'id_facture_statut' => 2,
            ),
            127 => 
            array (
                'id_notification' => 643,
                'date_statut' => '2021-01-28 06:53:00',
                'num_facture' => 243,
                'id_facture_statut' => 2,
            ),
            128 => 
            array (
                'id_notification' => 644,
                'date_statut' => '2021-02-15 09:33:00',
                'num_facture' => 244,
                'id_facture_statut' => 2,
            ),
            129 => 
            array (
                'id_notification' => 645,
                'date_statut' => '2021-03-13 08:09:00',
                'num_facture' => 245,
                'id_facture_statut' => 2,
            ),
            130 => 
            array (
                'id_notification' => 646,
                'date_statut' => '2021-03-22 07:18:00',
                'num_facture' => 246,
                'id_facture_statut' => 2,
            ),
            131 => 
            array (
                'id_notification' => 647,
                'date_statut' => '2021-04-02 08:50:00',
                'num_facture' => 247,
                'id_facture_statut' => 2,
            ),
            132 => 
            array (
                'id_notification' => 648,
                'date_statut' => '2021-05-26 18:14:00',
                'num_facture' => 248,
                'id_facture_statut' => 2,
            ),
            133 => 
            array (
                'id_notification' => 649,
                'date_statut' => '2021-06-04 10:51:00',
                'num_facture' => 249,
                'id_facture_statut' => 2,
            ),
            134 => 
            array (
                'id_notification' => 650,
                'date_statut' => '2021-06-08 19:40:00',
                'num_facture' => 250,
                'id_facture_statut' => 2,
            ),
            135 => 
            array (
                'id_notification' => 651,
                'date_statut' => '2021-06-14 11:07:00',
                'num_facture' => 251,
                'id_facture_statut' => 2,
            ),
            136 => 
            array (
                'id_notification' => 652,
                'date_statut' => '2021-07-02 07:51:00',
                'num_facture' => 252,
                'id_facture_statut' => 2,
            ),
            137 => 
            array (
                'id_notification' => 653,
                'date_statut' => '2021-07-09 05:20:00',
                'num_facture' => 253,
                'id_facture_statut' => 2,
            ),
            138 => 
            array (
                'id_notification' => 654,
                'date_statut' => '2021-08-05 10:45:00',
                'num_facture' => 254,
                'id_facture_statut' => 2,
            ),
            139 => 
            array (
                'id_notification' => 655,
                'date_statut' => '2021-08-06 13:03:00',
                'num_facture' => 255,
                'id_facture_statut' => 2,
            ),
            140 => 
            array (
                'id_notification' => 656,
                'date_statut' => '2021-08-16 10:52:00',
                'num_facture' => 256,
                'id_facture_statut' => 2,
            ),
            141 => 
            array (
                'id_notification' => 657,
                'date_statut' => '2021-10-08 16:13:00',
                'num_facture' => 257,
                'id_facture_statut' => 2,
            ),
            142 => 
            array (
                'id_notification' => 658,
                'date_statut' => '2021-10-10 15:28:00',
                'num_facture' => 258,
                'id_facture_statut' => 2,
            ),
            143 => 
            array (
                'id_notification' => 659,
                'date_statut' => '2021-10-15 06:26:00',
                'num_facture' => 259,
                'id_facture_statut' => 2,
            ),
            144 => 
            array (
                'id_notification' => 660,
                'date_statut' => '2021-10-16 12:04:00',
                'num_facture' => 260,
                'id_facture_statut' => 2,
            ),
            145 => 
            array (
                'id_notification' => 661,
                'date_statut' => '2021-10-21 12:30:00',
                'num_facture' => 261,
                'id_facture_statut' => 2,
            ),
            146 => 
            array (
                'id_notification' => 662,
                'date_statut' => '2021-10-29 14:47:00',
                'num_facture' => 262,
                'id_facture_statut' => 2,
            ),
            147 => 
            array (
                'id_notification' => 663,
                'date_statut' => '2021-11-07 12:17:00',
                'num_facture' => 263,
                'id_facture_statut' => 2,
            ),
            148 => 
            array (
                'id_notification' => 664,
                'date_statut' => '2021-11-20 10:48:00',
                'num_facture' => 264,
                'id_facture_statut' => 2,
            ),
            149 => 
            array (
                'id_notification' => 665,
                'date_statut' => '2021-12-02 10:22:00',
                'num_facture' => 265,
                'id_facture_statut' => 2,
            ),
            150 => 
            array (
                'id_notification' => 666,
                'date_statut' => '2021-12-15 21:55:00',
                'num_facture' => 266,
                'id_facture_statut' => 2,
            ),
            151 => 
            array (
                'id_notification' => 667,
                'date_statut' => '2021-12-18 10:10:00',
                'num_facture' => 267,
                'id_facture_statut' => 2,
            ),
            152 => 
            array (
                'id_notification' => 668,
                'date_statut' => '2021-12-19 10:59:00',
                'num_facture' => 268,
                'id_facture_statut' => 2,
            ),
            153 => 
            array (
                'id_notification' => 669,
                'date_statut' => '2021-12-22 08:09:00',
                'num_facture' => 269,
                'id_facture_statut' => 2,
            ),
            154 => 
            array (
                'id_notification' => 670,
                'date_statut' => '2021-12-22 15:20:00',
                'num_facture' => 270,
                'id_facture_statut' => 2,
            ),
            155 => 
            array (
                'id_notification' => 671,
                'date_statut' => '2021-12-23 11:54:00',
                'num_facture' => 271,
                'id_facture_statut' => 2,
            ),
            156 => 
            array (
                'id_notification' => 672,
                'date_statut' => '2022-01-13 19:06:00',
                'num_facture' => 272,
                'id_facture_statut' => 2,
            ),
            157 => 
            array (
                'id_notification' => 673,
                'date_statut' => '2022-01-19 12:16:00',
                'num_facture' => 273,
                'id_facture_statut' => 2,
            ),
            158 => 
            array (
                'id_notification' => 674,
                'date_statut' => '2022-01-25 09:16:00',
                'num_facture' => 274,
                'id_facture_statut' => 2,
            ),
            159 => 
            array (
                'id_notification' => 675,
                'date_statut' => '2022-01-29 15:09:00',
                'num_facture' => 275,
                'id_facture_statut' => 2,
            ),
            160 => 
            array (
                'id_notification' => 676,
                'date_statut' => '2022-02-01 14:24:00',
                'num_facture' => 276,
                'id_facture_statut' => 2,
            ),
            161 => 
            array (
                'id_notification' => 677,
                'date_statut' => '2022-02-05 14:01:00',
                'num_facture' => 277,
                'id_facture_statut' => 2,
            ),
            162 => 
            array (
                'id_notification' => 678,
                'date_statut' => '2022-02-14 21:39:00',
                'num_facture' => 278,
                'id_facture_statut' => 2,
            ),
            163 => 
            array (
                'id_notification' => 679,
                'date_statut' => '2022-02-18 08:59:00',
                'num_facture' => 279,
                'id_facture_statut' => 2,
            ),
            164 => 
            array (
                'id_notification' => 680,
                'date_statut' => '2022-03-08 15:46:00',
                'num_facture' => 280,
                'id_facture_statut' => 2,
            ),
            165 => 
            array (
                'id_notification' => 681,
                'date_statut' => '2022-03-14 09:35:00',
                'num_facture' => 281,
                'id_facture_statut' => 2,
            ),
            166 => 
            array (
                'id_notification' => 682,
                'date_statut' => '2022-03-23 08:12:00',
                'num_facture' => 282,
                'id_facture_statut' => 2,
            ),
            167 => 
            array (
                'id_notification' => 683,
                'date_statut' => '2022-03-23 09:17:00',
                'num_facture' => 283,
                'id_facture_statut' => 2,
            ),
            168 => 
            array (
                'id_notification' => 684,
                'date_statut' => '2022-03-24 06:39:00',
                'num_facture' => 284,
                'id_facture_statut' => 2,
            ),
            169 => 
            array (
                'id_notification' => 685,
                'date_statut' => '2022-04-30 07:52:00',
                'num_facture' => 285,
                'id_facture_statut' => 2,
            ),
            170 => 
            array (
                'id_notification' => 686,
                'date_statut' => '2022-05-03 13:02:00',
                'num_facture' => 286,
                'id_facture_statut' => 2,
            ),
            171 => 
            array (
                'id_notification' => 687,
                'date_statut' => '2022-05-10 13:28:00',
                'num_facture' => 287,
                'id_facture_statut' => 2,
            ),
            172 => 
            array (
                'id_notification' => 688,
                'date_statut' => '2022-05-18 21:39:00',
                'num_facture' => 288,
                'id_facture_statut' => 2,
            ),
            173 => 
            array (
                'id_notification' => 689,
                'date_statut' => '2022-05-21 08:57:00',
                'num_facture' => 289,
                'id_facture_statut' => 2,
            ),
            174 => 
            array (
                'id_notification' => 690,
                'date_statut' => '2022-05-24 19:00:00',
                'num_facture' => 290,
                'id_facture_statut' => 2,
            ),
            175 => 
            array (
                'id_notification' => 691,
                'date_statut' => '2022-05-24 19:21:00',
                'num_facture' => 291,
                'id_facture_statut' => 2,
            ),
            176 => 
            array (
                'id_notification' => 692,
                'date_statut' => '2022-05-27 13:13:00',
                'num_facture' => 292,
                'id_facture_statut' => 2,
            ),
            177 => 
            array (
                'id_notification' => 693,
                'date_statut' => '2022-05-28 10:42:00',
                'num_facture' => 293,
                'id_facture_statut' => 2,
            ),
            178 => 
            array (
                'id_notification' => 694,
                'date_statut' => '2022-06-06 12:40:00',
                'num_facture' => 294,
                'id_facture_statut' => 2,
            ),
            179 => 
            array (
                'id_notification' => 695,
                'date_statut' => '2022-06-10 16:44:00',
                'num_facture' => 295,
                'id_facture_statut' => 2,
            ),
            180 => 
            array (
                'id_notification' => 696,
                'date_statut' => '2022-07-08 08:44:00',
                'num_facture' => 296,
                'id_facture_statut' => 2,
            ),
            181 => 
            array (
                'id_notification' => 697,
                'date_statut' => '2022-07-15 15:18:00',
                'num_facture' => 297,
                'id_facture_statut' => 2,
            ),
            182 => 
            array (
                'id_notification' => 698,
                'date_statut' => '2022-08-18 18:16:00',
                'num_facture' => 298,
                'id_facture_statut' => 2,
            ),
            183 => 
            array (
                'id_notification' => 699,
                'date_statut' => '0000-00-00 00:00:00',
                'num_facture' => 299,
                'id_facture_statut' => 2,
            ),
            184 => 
            array (
                'id_notification' => 700,
                'date_statut' => '2022-09-18 20:19:00',
                'num_facture' => 300,
                'id_facture_statut' => 2,
            ),
            185 => 
            array (
                'id_notification' => 701,
                'date_statut' => '2022-09-26 22:55:00',
                'num_facture' => 301,
                'id_facture_statut' => 2,
            ),
            186 => 
            array (
                'id_notification' => 702,
                'date_statut' => '2022-09-28 13:11:00',
                'num_facture' => 302,
                'id_facture_statut' => 2,
            ),
            187 => 
            array (
                'id_notification' => 703,
                'date_statut' => '2022-10-07 22:19:00',
                'num_facture' => 303,
                'id_facture_statut' => 2,
            ),
            188 => 
            array (
                'id_notification' => 704,
                'date_statut' => '2022-10-17 06:48:00',
                'num_facture' => 304,
                'id_facture_statut' => 2,
            ),
            189 => 
            array (
                'id_notification' => 705,
                'date_statut' => '2022-10-20 08:23:00',
                'num_facture' => 305,
                'id_facture_statut' => 2,
            ),
            190 => 
            array (
                'id_notification' => 706,
                'date_statut' => '2022-10-24 18:03:00',
                'num_facture' => 306,
                'id_facture_statut' => 2,
            ),
            191 => 
            array (
                'id_notification' => 707,
                'date_statut' => '2022-11-05 09:55:00',
                'num_facture' => 307,
                'id_facture_statut' => 2,
            ),
            192 => 
            array (
                'id_notification' => 708,
                'date_statut' => '2022-11-20 01:37:00',
                'num_facture' => 308,
                'id_facture_statut' => 2,
            ),
            193 => 
            array (
                'id_notification' => 709,
                'date_statut' => '2022-11-27 10:07:00',
                'num_facture' => 309,
                'id_facture_statut' => 2,
            ),
            194 => 
            array (
                'id_notification' => 710,
                'date_statut' => '2022-11-28 12:54:00',
                'num_facture' => 310,
                'id_facture_statut' => 2,
            ),
            195 => 
            array (
                'id_notification' => 711,
                'date_statut' => '2022-12-09 13:38:00',
                'num_facture' => 311,
                'id_facture_statut' => 2,
            ),
            196 => 
            array (
                'id_notification' => 712,
                'date_statut' => '2022-12-09 13:50:00',
                'num_facture' => 312,
                'id_facture_statut' => 2,
            ),
            197 => 
            array (
                'id_notification' => 713,
                'date_statut' => '2022-12-09 20:15:00',
                'num_facture' => 313,
                'id_facture_statut' => 2,
            ),
            198 => 
            array (
                'id_notification' => 714,
                'date_statut' => '2022-12-16 16:17:00',
                'num_facture' => 314,
                'id_facture_statut' => 2,
            ),
            199 => 
            array (
                'id_notification' => 715,
                'date_statut' => '2022-12-16 20:45:00',
                'num_facture' => 315,
                'id_facture_statut' => 2,
            ),
            200 => 
            array (
                'id_notification' => 716,
                'date_statut' => '2022-12-20 22:26:00',
                'num_facture' => 316,
                'id_facture_statut' => 2,
            ),
            201 => 
            array (
                'id_notification' => 717,
                'date_statut' => '2022-12-21 09:56:00',
                'num_facture' => 317,
                'id_facture_statut' => 2,
            ),
            202 => 
            array (
                'id_notification' => 718,
                'date_statut' => '2022-12-23 10:17:00',
                'num_facture' => 318,
                'id_facture_statut' => 2,
            ),
            203 => 
            array (
                'id_notification' => 719,
                'date_statut' => '2022-12-26 19:28:00',
                'num_facture' => 319,
                'id_facture_statut' => 2,
            ),
            204 => 
            array (
                'id_notification' => 720,
                'date_statut' => '2022-12-26 20:14:00',
                'num_facture' => 320,
                'id_facture_statut' => 2,
            ),
            205 => 
            array (
                'id_notification' => 721,
                'date_statut' => '2023-01-27 15:09:00',
                'num_facture' => 321,
                'id_facture_statut' => 2,
            ),
            206 => 
            array (
                'id_notification' => 722,
                'date_statut' => '2023-02-15 22:18:00',
                'num_facture' => 53,
                'id_facture_statut' => 2,
            ),
            207 => 
            array (
                'id_notification' => 723,
                'date_statut' => '2023-02-18 13:17:00',
                'num_facture' => 323,
                'id_facture_statut' => 2,
            ),
            208 => 
            array (
                'id_notification' => 724,
                'date_statut' => '2023-02-19 18:10:00',
                'num_facture' => 324,
                'id_facture_statut' => 2,
            ),
            209 => 
            array (
                'id_notification' => 725,
                'date_statut' => '2023-02-20 10:01:00',
                'num_facture' => 325,
                'id_facture_statut' => 2,
            ),
            210 => 
            array (
                'id_notification' => 726,
                'date_statut' => '2023-02-22 22:33:00',
                'num_facture' => 84,
                'id_facture_statut' => 2,
            ),
            211 => 
            array (
                'id_notification' => 727,
                'date_statut' => '2023-03-16 23:07:00',
                'num_facture' => 327,
                'id_facture_statut' => 2,
            ),
            212 => 
            array (
                'id_notification' => 728,
                'date_statut' => '2023-03-21 20:50:00',
                'num_facture' => 328,
                'id_facture_statut' => 2,
            ),
            213 => 
            array (
                'id_notification' => 729,
                'date_statut' => '2023-04-07 18:38:00',
                'num_facture' => 329,
                'id_facture_statut' => 2,
            ),
            214 => 
            array (
                'id_notification' => 730,
                'date_statut' => '2023-04-14 14:57:00',
                'num_facture' => 87,
                'id_facture_statut' => 2,
            ),
            215 => 
            array (
                'id_notification' => 731,
                'date_statut' => '2023-04-19 10:36:00',
                'num_facture' => 96,
                'id_facture_statut' => 2,
            ),
            216 => 
            array (
                'id_notification' => 732,
                'date_statut' => '2023-05-09 06:45:00',
                'num_facture' => 117,
                'id_facture_statut' => 2,
            ),
            217 => 
            array (
                'id_notification' => 733,
                'date_statut' => '2023-05-12 14:22:00',
                'num_facture' => 119,
                'id_facture_statut' => 2,
            ),
            218 => 
            array (
                'id_notification' => 734,
                'date_statut' => '2023-05-16 09:32:00',
                'num_facture' => 133,
                'id_facture_statut' => 2,
            ),
            219 => 
            array (
                'id_notification' => 735,
                'date_statut' => '2023-05-16 16:24:00',
                'num_facture' => 134,
                'id_facture_statut' => 2,
            ),
            220 => 
            array (
                'id_notification' => 736,
                'date_statut' => '2023-05-16 16:26:00',
                'num_facture' => 136,
                'id_facture_statut' => 2,
            ),
            221 => 
            array (
                'id_notification' => 737,
                'date_statut' => '2023-05-22 16:21:00',
                'num_facture' => 138,
                'id_facture_statut' => 2,
            ),
            222 => 
            array (
                'id_notification' => 738,
                'date_statut' => '2023-05-25 19:45:00',
                'num_facture' => 338,
                'id_facture_statut' => 2,
            ),
            223 => 
            array (
                'id_notification' => 739,
                'date_statut' => '0000-00-00 00:00:00',
                'num_facture' => 140,
                'id_facture_statut' => 2,
            ),
            224 => 
            array (
                'id_notification' => 740,
                'date_statut' => '2023-05-30 09:44:00',
                'num_facture' => 142,
                'id_facture_statut' => 2,
            ),
            225 => 
            array (
                'id_notification' => 741,
                'date_statut' => '2023-05-30 10:15:00',
                'num_facture' => 141,
                'id_facture_statut' => 2,
            ),
            226 => 
            array (
                'id_notification' => 742,
                'date_statut' => '2023-05-30 11:04:00',
                'num_facture' => 143,
                'id_facture_statut' => 2,
            ),
            227 => 
            array (
                'id_notification' => 743,
                'date_statut' => '2023-06-01 11:23:00',
                'num_facture' => 139,
                'id_facture_statut' => 2,
            ),
            228 => 
            array (
                'id_notification' => 744,
                'date_statut' => '2023-06-03 20:20:00',
                'num_facture' => 144,
                'id_facture_statut' => 2,
            ),
            229 => 
            array (
                'id_notification' => 745,
                'date_statut' => '2023-06-04 09:51:00',
                'num_facture' => 345,
                'id_facture_statut' => 2,
            ),
            230 => 
            array (
                'id_notification' => 746,
                'date_statut' => '2023-06-09 09:54:00',
                'num_facture' => 146,
                'id_facture_statut' => 2,
            ),
            231 => 
            array (
                'id_notification' => 750,
                'date_statut' => '2019-04-21 10:20:00',
                'num_facture' => 201,
                'id_facture_statut' => 6,
            ),
            232 => 
            array (
                'id_notification' => 751,
                'date_statut' => '2019-05-10 18:24:00',
                'num_facture' => 202,
                'id_facture_statut' => 6,
            ),
            233 => 
            array (
                'id_notification' => 752,
                'date_statut' => '2019-07-03 13:10:00',
                'num_facture' => 203,
                'id_facture_statut' => 6,
            ),
            234 => 
            array (
                'id_notification' => 753,
                'date_statut' => '2019-07-24 08:31:00',
                'num_facture' => 204,
                'id_facture_statut' => 6,
            ),
            235 => 
            array (
                'id_notification' => 754,
                'date_statut' => '2019-08-30 17:38:00',
                'num_facture' => 205,
                'id_facture_statut' => 6,
            ),
            236 => 
            array (
                'id_notification' => 755,
                'date_statut' => '2019-11-05 12:12:00',
                'num_facture' => 206,
                'id_facture_statut' => 6,
            ),
            237 => 
            array (
                'id_notification' => 756,
                'date_statut' => '2019-11-18 19:32:00',
                'num_facture' => 207,
                'id_facture_statut' => 6,
            ),
            238 => 
            array (
                'id_notification' => 757,
                'date_statut' => '2019-11-20 13:13:00',
                'num_facture' => 208,
                'id_facture_statut' => 6,
            ),
            239 => 
            array (
                'id_notification' => 758,
                'date_statut' => '2019-11-28 22:41:00',
                'num_facture' => 209,
                'id_facture_statut' => 6,
            ),
            240 => 
            array (
                'id_notification' => 759,
                'date_statut' => '2019-12-15 09:15:00',
                'num_facture' => 210,
                'id_facture_statut' => 6,
            ),
            241 => 
            array (
                'id_notification' => 760,
                'date_statut' => '2019-12-16 09:20:00',
                'num_facture' => 211,
                'id_facture_statut' => 6,
            ),
            242 => 
            array (
                'id_notification' => 761,
                'date_statut' => '2019-12-16 15:43:00',
                'num_facture' => 212,
                'id_facture_statut' => 6,
            ),
            243 => 
            array (
                'id_notification' => 762,
                'date_statut' => '2019-12-17 18:26:00',
                'num_facture' => 213,
                'id_facture_statut' => 6,
            ),
            244 => 
            array (
                'id_notification' => 763,
                'date_statut' => '2019-12-24 10:57:00',
                'num_facture' => 214,
                'id_facture_statut' => 6,
            ),
            245 => 
            array (
                'id_notification' => 764,
                'date_statut' => '2020-01-21 19:13:00',
                'num_facture' => 215,
                'id_facture_statut' => 6,
            ),
            246 => 
            array (
                'id_notification' => 765,
                'date_statut' => '2020-03-04 15:06:00',
                'num_facture' => 216,
                'id_facture_statut' => 6,
            ),
            247 => 
            array (
                'id_notification' => 766,
                'date_statut' => '2020-03-04 23:21:00',
                'num_facture' => 217,
                'id_facture_statut' => 6,
            ),
            248 => 
            array (
                'id_notification' => 767,
                'date_statut' => '2020-07-08 07:01:00',
                'num_facture' => 218,
                'id_facture_statut' => 6,
            ),
            249 => 
            array (
                'id_notification' => 768,
                'date_statut' => '2020-07-09 18:21:00',
                'num_facture' => 220,
                'id_facture_statut' => 6,
            ),
            250 => 
            array (
                'id_notification' => 769,
                'date_statut' => '2020-08-08 14:27:00',
                'num_facture' => 222,
                'id_facture_statut' => 6,
            ),
            251 => 
            array (
                'id_notification' => 770,
                'date_statut' => '2020-08-11 09:58:00',
                'num_facture' => 223,
                'id_facture_statut' => 6,
            ),
            252 => 
            array (
                'id_notification' => 771,
                'date_statut' => '2020-08-27 19:39:00',
                'num_facture' => 224,
                'id_facture_statut' => 6,
            ),
            253 => 
            array (
                'id_notification' => 772,
                'date_statut' => '2020-09-02 05:39:00',
                'num_facture' => 225,
                'id_facture_statut' => 6,
            ),
            254 => 
            array (
                'id_notification' => 773,
                'date_statut' => '2020-09-09 08:25:00',
                'num_facture' => 226,
                'id_facture_statut' => 6,
            ),
            255 => 
            array (
                'id_notification' => 774,
                'date_statut' => '2020-09-17 15:59:00',
                'num_facture' => 227,
                'id_facture_statut' => 6,
            ),
            256 => 
            array (
                'id_notification' => 775,
                'date_statut' => '2020-10-25 08:18:00',
                'num_facture' => 228,
                'id_facture_statut' => 6,
            ),
            257 => 
            array (
                'id_notification' => 776,
                'date_statut' => '2020-10-31 17:48:00',
                'num_facture' => 229,
                'id_facture_statut' => 6,
            ),
            258 => 
            array (
                'id_notification' => 777,
                'date_statut' => '2020-11-28 17:09:00',
                'num_facture' => 230,
                'id_facture_statut' => 6,
            ),
            259 => 
            array (
                'id_notification' => 778,
                'date_statut' => '2020-12-04 11:14:00',
                'num_facture' => 231,
                'id_facture_statut' => 6,
            ),
            260 => 
            array (
                'id_notification' => 779,
                'date_statut' => '2020-12-05 09:37:00',
                'num_facture' => 232,
                'id_facture_statut' => 6,
            ),
            261 => 
            array (
                'id_notification' => 780,
                'date_statut' => '2020-12-06 16:27:00',
                'num_facture' => 233,
                'id_facture_statut' => 6,
            ),
            262 => 
            array (
                'id_notification' => 781,
                'date_statut' => '2020-12-07 13:17:00',
                'num_facture' => 234,
                'id_facture_statut' => 6,
            ),
            263 => 
            array (
                'id_notification' => 782,
                'date_statut' => '2020-12-08 10:49:00',
                'num_facture' => 235,
                'id_facture_statut' => 6,
            ),
            264 => 
            array (
                'id_notification' => 783,
                'date_statut' => '2020-12-11 08:09:00',
                'num_facture' => 236,
                'id_facture_statut' => 6,
            ),
            265 => 
            array (
                'id_notification' => 784,
                'date_statut' => '2020-12-11 09:36:00',
                'num_facture' => 237,
                'id_facture_statut' => 6,
            ),
            266 => 
            array (
                'id_notification' => 785,
                'date_statut' => '2020-12-11 17:44:00',
                'num_facture' => 238,
                'id_facture_statut' => 6,
            ),
            267 => 
            array (
                'id_notification' => 786,
                'date_statut' => '2020-12-12 08:28:00',
                'num_facture' => 239,
                'id_facture_statut' => 6,
            ),
            268 => 
            array (
                'id_notification' => 787,
                'date_statut' => '2020-12-12 14:09:00',
                'num_facture' => 240,
                'id_facture_statut' => 6,
            ),
            269 => 
            array (
                'id_notification' => 788,
                'date_statut' => '2020-12-13 14:47:00',
                'num_facture' => 241,
                'id_facture_statut' => 6,
            ),
            270 => 
            array (
                'id_notification' => 789,
                'date_statut' => '2021-01-21 16:47:00',
                'num_facture' => 242,
                'id_facture_statut' => 6,
            ),
            271 => 
            array (
                'id_notification' => 790,
                'date_statut' => '2021-01-28 06:53:00',
                'num_facture' => 243,
                'id_facture_statut' => 6,
            ),
            272 => 
            array (
                'id_notification' => 791,
                'date_statut' => '2021-02-15 09:33:00',
                'num_facture' => 244,
                'id_facture_statut' => 6,
            ),
            273 => 
            array (
                'id_notification' => 792,
                'date_statut' => '2021-03-13 08:09:00',
                'num_facture' => 245,
                'id_facture_statut' => 6,
            ),
            274 => 
            array (
                'id_notification' => 793,
                'date_statut' => '2021-03-22 07:18:00',
                'num_facture' => 246,
                'id_facture_statut' => 6,
            ),
            275 => 
            array (
                'id_notification' => 794,
                'date_statut' => '2021-04-02 08:50:00',
                'num_facture' => 247,
                'id_facture_statut' => 6,
            ),
            276 => 
            array (
                'id_notification' => 795,
                'date_statut' => '2021-05-26 18:14:00',
                'num_facture' => 248,
                'id_facture_statut' => 6,
            ),
            277 => 
            array (
                'id_notification' => 796,
                'date_statut' => '2021-06-04 10:51:00',
                'num_facture' => 249,
                'id_facture_statut' => 6,
            ),
            278 => 
            array (
                'id_notification' => 797,
                'date_statut' => '2021-06-08 19:40:00',
                'num_facture' => 250,
                'id_facture_statut' => 6,
            ),
            279 => 
            array (
                'id_notification' => 798,
                'date_statut' => '2021-06-14 11:07:00',
                'num_facture' => 251,
                'id_facture_statut' => 6,
            ),
            280 => 
            array (
                'id_notification' => 799,
                'date_statut' => '2021-07-02 07:51:00',
                'num_facture' => 252,
                'id_facture_statut' => 6,
            ),
            281 => 
            array (
                'id_notification' => 800,
                'date_statut' => '2021-07-09 05:20:00',
                'num_facture' => 253,
                'id_facture_statut' => 6,
            ),
            282 => 
            array (
                'id_notification' => 801,
                'date_statut' => '2021-08-05 10:45:00',
                'num_facture' => 254,
                'id_facture_statut' => 6,
            ),
            283 => 
            array (
                'id_notification' => 802,
                'date_statut' => '2021-08-06 13:03:00',
                'num_facture' => 255,
                'id_facture_statut' => 6,
            ),
            284 => 
            array (
                'id_notification' => 803,
                'date_statut' => '2021-08-16 10:52:00',
                'num_facture' => 256,
                'id_facture_statut' => 6,
            ),
            285 => 
            array (
                'id_notification' => 804,
                'date_statut' => '2021-10-08 16:13:00',
                'num_facture' => 257,
                'id_facture_statut' => 6,
            ),
            286 => 
            array (
                'id_notification' => 805,
                'date_statut' => '2021-10-10 15:28:00',
                'num_facture' => 258,
                'id_facture_statut' => 6,
            ),
            287 => 
            array (
                'id_notification' => 806,
                'date_statut' => '2021-10-15 06:26:00',
                'num_facture' => 259,
                'id_facture_statut' => 6,
            ),
            288 => 
            array (
                'id_notification' => 807,
                'date_statut' => '2021-10-21 12:30:00',
                'num_facture' => 261,
                'id_facture_statut' => 6,
            ),
            289 => 
            array (
                'id_notification' => 808,
                'date_statut' => '2021-10-29 14:47:00',
                'num_facture' => 262,
                'id_facture_statut' => 6,
            ),
            290 => 
            array (
                'id_notification' => 809,
                'date_statut' => '2021-11-07 12:17:00',
                'num_facture' => 263,
                'id_facture_statut' => 6,
            ),
            291 => 
            array (
                'id_notification' => 810,
                'date_statut' => '2021-11-20 10:48:00',
                'num_facture' => 264,
                'id_facture_statut' => 6,
            ),
            292 => 
            array (
                'id_notification' => 811,
                'date_statut' => '2021-12-02 10:22:00',
                'num_facture' => 265,
                'id_facture_statut' => 6,
            ),
            293 => 
            array (
                'id_notification' => 812,
                'date_statut' => '2021-12-15 21:55:00',
                'num_facture' => 266,
                'id_facture_statut' => 6,
            ),
            294 => 
            array (
                'id_notification' => 813,
                'date_statut' => '2021-12-18 10:10:00',
                'num_facture' => 267,
                'id_facture_statut' => 6,
            ),
            295 => 
            array (
                'id_notification' => 814,
                'date_statut' => '2021-12-19 10:59:00',
                'num_facture' => 268,
                'id_facture_statut' => 6,
            ),
            296 => 
            array (
                'id_notification' => 815,
                'date_statut' => '2021-12-22 08:09:00',
                'num_facture' => 269,
                'id_facture_statut' => 6,
            ),
            297 => 
            array (
                'id_notification' => 816,
                'date_statut' => '2021-12-22 15:20:00',
                'num_facture' => 270,
                'id_facture_statut' => 6,
            ),
            298 => 
            array (
                'id_notification' => 817,
                'date_statut' => '2021-12-23 11:54:00',
                'num_facture' => 271,
                'id_facture_statut' => 6,
            ),
            299 => 
            array (
                'id_notification' => 818,
                'date_statut' => '2022-01-13 19:06:00',
                'num_facture' => 272,
                'id_facture_statut' => 6,
            ),
            300 => 
            array (
                'id_notification' => 819,
                'date_statut' => '2022-01-19 12:16:00',
                'num_facture' => 273,
                'id_facture_statut' => 6,
            ),
            301 => 
            array (
                'id_notification' => 820,
                'date_statut' => '2022-01-25 09:16:00',
                'num_facture' => 274,
                'id_facture_statut' => 6,
            ),
            302 => 
            array (
                'id_notification' => 821,
                'date_statut' => '2022-01-29 15:09:00',
                'num_facture' => 275,
                'id_facture_statut' => 6,
            ),
            303 => 
            array (
                'id_notification' => 822,
                'date_statut' => '2022-02-01 14:24:00',
                'num_facture' => 276,
                'id_facture_statut' => 6,
            ),
            304 => 
            array (
                'id_notification' => 823,
                'date_statut' => '2022-02-05 14:01:00',
                'num_facture' => 277,
                'id_facture_statut' => 6,
            ),
            305 => 
            array (
                'id_notification' => 824,
                'date_statut' => '2022-02-14 21:39:00',
                'num_facture' => 278,
                'id_facture_statut' => 6,
            ),
            306 => 
            array (
                'id_notification' => 825,
                'date_statut' => '2022-02-18 08:59:00',
                'num_facture' => 279,
                'id_facture_statut' => 6,
            ),
            307 => 
            array (
                'id_notification' => 826,
                'date_statut' => '2022-03-08 15:46:00',
                'num_facture' => 280,
                'id_facture_statut' => 6,
            ),
            308 => 
            array (
                'id_notification' => 827,
                'date_statut' => '2022-03-14 09:35:00',
                'num_facture' => 281,
                'id_facture_statut' => 6,
            ),
            309 => 
            array (
                'id_notification' => 828,
                'date_statut' => '2022-03-23 09:17:00',
                'num_facture' => 283,
                'id_facture_statut' => 6,
            ),
            310 => 
            array (
                'id_notification' => 829,
                'date_statut' => '2022-03-24 06:39:00',
                'num_facture' => 284,
                'id_facture_statut' => 6,
            ),
            311 => 
            array (
                'id_notification' => 830,
                'date_statut' => '2022-04-30 07:52:00',
                'num_facture' => 285,
                'id_facture_statut' => 6,
            ),
            312 => 
            array (
                'id_notification' => 831,
                'date_statut' => '2022-05-03 13:02:00',
                'num_facture' => 286,
                'id_facture_statut' => 6,
            ),
            313 => 
            array (
                'id_notification' => 832,
                'date_statut' => '2022-05-10 13:28:00',
                'num_facture' => 287,
                'id_facture_statut' => 6,
            ),
            314 => 
            array (
                'id_notification' => 833,
                'date_statut' => '2022-05-18 21:39:00',
                'num_facture' => 288,
                'id_facture_statut' => 6,
            ),
            315 => 
            array (
                'id_notification' => 834,
                'date_statut' => '2022-05-24 19:00:00',
                'num_facture' => 290,
                'id_facture_statut' => 6,
            ),
            316 => 
            array (
                'id_notification' => 835,
                'date_statut' => '2022-05-24 19:21:00',
                'num_facture' => 291,
                'id_facture_statut' => 6,
            ),
            317 => 
            array (
                'id_notification' => 836,
                'date_statut' => '2022-05-27 13:13:00',
                'num_facture' => 292,
                'id_facture_statut' => 6,
            ),
            318 => 
            array (
                'id_notification' => 837,
                'date_statut' => '2022-05-28 10:42:00',
                'num_facture' => 293,
                'id_facture_statut' => 6,
            ),
            319 => 
            array (
                'id_notification' => 838,
                'date_statut' => '2022-06-06 12:40:00',
                'num_facture' => 294,
                'id_facture_statut' => 6,
            ),
            320 => 
            array (
                'id_notification' => 839,
                'date_statut' => '2022-06-10 16:44:00',
                'num_facture' => 295,
                'id_facture_statut' => 6,
            ),
            321 => 
            array (
                'id_notification' => 840,
                'date_statut' => '2022-07-08 08:44:00',
                'num_facture' => 296,
                'id_facture_statut' => 6,
            ),
            322 => 
            array (
                'id_notification' => 841,
                'date_statut' => '2022-07-15 15:18:00',
                'num_facture' => 297,
                'id_facture_statut' => 6,
            ),
            323 => 
            array (
                'id_notification' => 842,
                'date_statut' => '2022-08-18 18:16:00',
                'num_facture' => 298,
                'id_facture_statut' => 6,
            ),
            324 => 
            array (
                'id_notification' => 843,
                'date_statut' => '0000-00-00 00:00:00',
                'num_facture' => 299,
                'id_facture_statut' => 6,
            ),
            325 => 
            array (
                'id_notification' => 844,
                'date_statut' => '2022-09-18 20:19:00',
                'num_facture' => 300,
                'id_facture_statut' => 6,
            ),
            326 => 
            array (
                'id_notification' => 845,
                'date_statut' => '2022-09-26 22:55:00',
                'num_facture' => 301,
                'id_facture_statut' => 6,
            ),
            327 => 
            array (
                'id_notification' => 846,
                'date_statut' => '2022-09-28 13:11:00',
                'num_facture' => 302,
                'id_facture_statut' => 6,
            ),
            328 => 
            array (
                'id_notification' => 847,
                'date_statut' => '2022-10-07 22:19:00',
                'num_facture' => 303,
                'id_facture_statut' => 6,
            ),
            329 => 
            array (
                'id_notification' => 848,
                'date_statut' => '2022-10-17 06:48:00',
                'num_facture' => 304,
                'id_facture_statut' => 6,
            ),
            330 => 
            array (
                'id_notification' => 849,
                'date_statut' => '2022-10-20 08:23:00',
                'num_facture' => 305,
                'id_facture_statut' => 6,
            ),
            331 => 
            array (
                'id_notification' => 850,
                'date_statut' => '2022-10-24 18:03:00',
                'num_facture' => 306,
                'id_facture_statut' => 6,
            ),
            332 => 
            array (
                'id_notification' => 851,
                'date_statut' => '2022-11-05 09:55:00',
                'num_facture' => 307,
                'id_facture_statut' => 6,
            ),
            333 => 
            array (
                'id_notification' => 852,
                'date_statut' => '2022-11-20 01:37:00',
                'num_facture' => 308,
                'id_facture_statut' => 6,
            ),
            334 => 
            array (
                'id_notification' => 853,
                'date_statut' => '2022-11-27 10:07:00',
                'num_facture' => 309,
                'id_facture_statut' => 6,
            ),
            335 => 
            array (
                'id_notification' => 854,
                'date_statut' => '2022-11-28 12:54:00',
                'num_facture' => 310,
                'id_facture_statut' => 6,
            ),
            336 => 
            array (
                'id_notification' => 855,
                'date_statut' => '2022-12-09 13:38:00',
                'num_facture' => 311,
                'id_facture_statut' => 6,
            ),
            337 => 
            array (
                'id_notification' => 856,
                'date_statut' => '2022-12-09 13:50:00',
                'num_facture' => 312,
                'id_facture_statut' => 6,
            ),
            338 => 
            array (
                'id_notification' => 857,
                'date_statut' => '2022-12-09 20:15:00',
                'num_facture' => 313,
                'id_facture_statut' => 6,
            ),
            339 => 
            array (
                'id_notification' => 858,
                'date_statut' => '2022-12-16 16:17:00',
                'num_facture' => 314,
                'id_facture_statut' => 6,
            ),
            340 => 
            array (
                'id_notification' => 859,
                'date_statut' => '2022-12-16 20:45:00',
                'num_facture' => 315,
                'id_facture_statut' => 6,
            ),
            341 => 
            array (
                'id_notification' => 860,
                'date_statut' => '2022-12-20 22:26:00',
                'num_facture' => 316,
                'id_facture_statut' => 6,
            ),
            342 => 
            array (
                'id_notification' => 861,
                'date_statut' => '2022-12-21 09:56:00',
                'num_facture' => 317,
                'id_facture_statut' => 6,
            ),
            343 => 
            array (
                'id_notification' => 862,
                'date_statut' => '2022-12-23 10:17:00',
                'num_facture' => 318,
                'id_facture_statut' => 6,
            ),
            344 => 
            array (
                'id_notification' => 863,
                'date_statut' => '2022-12-26 19:28:00',
                'num_facture' => 319,
                'id_facture_statut' => 6,
            ),
            345 => 
            array (
                'id_notification' => 864,
                'date_statut' => '2022-12-26 20:14:00',
                'num_facture' => 320,
                'id_facture_statut' => 6,
            ),
            346 => 
            array (
                'id_notification' => 865,
                'date_statut' => '2023-02-15 22:18:00',
                'num_facture' => 53,
                'id_facture_statut' => 6,
            ),
            347 => 
            array (
                'id_notification' => 866,
                'date_statut' => '2023-02-18 13:17:00',
                'num_facture' => 323,
                'id_facture_statut' => 6,
            ),
            348 => 
            array (
                'id_notification' => 867,
                'date_statut' => '2023-02-20 10:01:00',
                'num_facture' => 325,
                'id_facture_statut' => 6,
            ),
            349 => 
            array (
                'id_notification' => 868,
                'date_statut' => '2023-02-22 22:33:00',
                'num_facture' => 84,
                'id_facture_statut' => 6,
            ),
            350 => 
            array (
                'id_notification' => 869,
                'date_statut' => '2023-03-16 23:07:00',
                'num_facture' => 327,
                'id_facture_statut' => 6,
            ),
            351 => 
            array (
                'id_notification' => 870,
                'date_statut' => '2023-03-21 20:50:00',
                'num_facture' => 328,
                'id_facture_statut' => 6,
            ),
            352 => 
            array (
                'id_notification' => 871,
                'date_statut' => '2023-04-07 18:38:00',
                'num_facture' => 329,
                'id_facture_statut' => 6,
            ),
            353 => 
            array (
                'id_notification' => 872,
                'date_statut' => '2023-04-14 14:57:00',
                'num_facture' => 87,
                'id_facture_statut' => 6,
            ),
            354 => 
            array (
                'id_notification' => 873,
                'date_statut' => '2023-04-19 10:36:00',
                'num_facture' => 96,
                'id_facture_statut' => 6,
            ),
            355 => 
            array (
                'id_notification' => 874,
                'date_statut' => '2023-05-09 06:45:00',
                'num_facture' => 117,
                'id_facture_statut' => 6,
            ),
            356 => 
            array (
                'id_notification' => 875,
                'date_statut' => '2023-05-12 14:22:00',
                'num_facture' => 119,
                'id_facture_statut' => 6,
            ),
            357 => 
            array (
                'id_notification' => 876,
                'date_statut' => '2023-05-16 09:32:00',
                'num_facture' => 133,
                'id_facture_statut' => 6,
            ),
            358 => 
            array (
                'id_notification' => 877,
                'date_statut' => '2023-05-16 16:24:00',
                'num_facture' => 134,
                'id_facture_statut' => 6,
            ),
            359 => 
            array (
                'id_notification' => 878,
                'date_statut' => '2023-05-16 16:26:00',
                'num_facture' => 136,
                'id_facture_statut' => 6,
            ),
            360 => 
            array (
                'id_notification' => 879,
                'date_statut' => '2023-05-22 16:21:00',
                'num_facture' => 138,
                'id_facture_statut' => 6,
            ),
            361 => 
            array (
                'id_notification' => 880,
                'date_statut' => '2023-05-30 09:44:00',
                'num_facture' => 142,
                'id_facture_statut' => 6,
            ),
            362 => 
            array (
                'id_notification' => 881,
                'date_statut' => '2023-05-30 10:15:00',
                'num_facture' => 141,
                'id_facture_statut' => 6,
            ),
            363 => 
            array (
                'id_notification' => 882,
                'date_statut' => '2023-05-30 11:04:00',
                'num_facture' => 143,
                'id_facture_statut' => 6,
            ),
            364 => 
            array (
                'id_notification' => 883,
                'date_statut' => '2023-06-01 11:23:00',
                'num_facture' => 139,
                'id_facture_statut' => 6,
            ),
            365 => 
            array (
                'id_notification' => 884,
                'date_statut' => '2023-06-03 20:20:00',
                'num_facture' => 144,
                'id_facture_statut' => 6,
            ),
            366 => 
            array (
                'id_notification' => 885,
                'date_statut' => '2023-06-04 09:51:00',
                'num_facture' => 345,
                'id_facture_statut' => 6,
            ),
            367 => 
            array (
                'id_notification' => 886,
                'date_statut' => '2023-06-09 09:54:00',
                'num_facture' => 146,
                'id_facture_statut' => 6,
            ),
            368 => 
            array (
                'id_notification' => 890,
                'date_statut' => '2020-12-10 12:14:00',
                'num_facture' => 235,
                'id_facture_statut' => 7,
            ),
            369 => 
            array (
                'id_notification' => 891,
                'date_statut' => '2021-10-18 22:05:00',
                'num_facture' => 257,
                'id_facture_statut' => 7,
            ),
            370 => 
            array (
                'id_notification' => 1024,
                'date_statut' => '2023-07-06 22:08:00',
                'num_facture' => 154,
                'id_facture_statut' => 1,
            ),
            371 => 
            array (
                'id_notification' => 1025,
                'date_statut' => '2023-07-07 21:00:00',
                'num_facture' => 346,
                'id_facture_statut' => 2,
            ),
            372 => 
            array (
                'id_notification' => 1026,
                'date_statut' => '2023-07-07 21:01:00',
                'num_facture' => 346,
                'id_facture_statut' => 2,
            ),
            373 => 
            array (
                'id_notification' => 1027,
                'date_statut' => '2023-07-07 21:01:00',
                'num_facture' => 346,
                'id_facture_statut' => 3,
            ),
            374 => 
            array (
                'id_notification' => 1041,
                'date_statut' => '2023-07-12 22:19:09',
                'num_facture' => 351,
                'id_facture_statut' => 11,
            ),
            375 => 
            array (
                'id_notification' => 1048,
                'date_statut' => '2023-07-12 22:25:33',
                'num_facture' => 351,
                'id_facture_statut' => 2,
            ),
            376 => 
            array (
                'id_notification' => 1049,
                'date_statut' => '2023-07-12 22:31:38',
                'num_facture' => 351,
                'id_facture_statut' => 3,
            ),
            377 => 
            array (
                'id_notification' => 1057,
                'date_statut' => '2023-07-17 20:47:21',
                'num_facture' => 352,
                'id_facture_statut' => 2,
            ),
            378 => 
            array (
                'id_notification' => 1059,
                'date_statut' => '2023-07-17 20:47:21',
                'num_facture' => 352,
                'id_facture_statut' => 10,
            ),
            379 => 
            array (
                'id_notification' => 1062,
                'date_statut' => '2023-07-17 20:47:25',
                'num_facture' => 352,
                'id_facture_statut' => 3,
            ),
            380 => 
            array (
                'id_notification' => 1063,
                'date_statut' => '2023-07-12 21:05:51',
                'num_facture' => 351,
                'id_facture_statut' => 6,
            ),
            381 => 
            array (
                'id_notification' => 1064,
                'date_statut' => '2023-07-18 12:41:08',
                'num_facture' => 352,
                'id_facture_statut' => 5,
            ),
            382 => 
            array (
                'id_notification' => 1065,
                'date_statut' => '2023-07-18 12:41:08',
                'num_facture' => 352,
                'id_facture_statut' => 6,
            ),
            383 => 
            array (
                'id_notification' => 1127,
                'date_statut' => '2023-08-02 07:49:13',
                'num_facture' => 353,
                'id_facture_statut' => 2,
            ),
            384 => 
            array (
                'id_notification' => 1128,
                'date_statut' => '2023-08-02 07:49:13',
                'num_facture' => 353,
                'id_facture_statut' => 6,
            ),
            385 => 
            array (
                'id_notification' => 1129,
                'date_statut' => '2023-08-02 07:49:31',
                'num_facture' => 354,
                'id_facture_statut' => 2,
            ),
            386 => 
            array (
                'id_notification' => 1130,
                'date_statut' => '2023-08-02 07:49:31',
                'num_facture' => 354,
                'id_facture_statut' => 6,
            ),
            387 => 
            array (
                'id_notification' => 1131,
                'date_statut' => '2023-08-02 07:52:31',
                'num_facture' => 355,
                'id_facture_statut' => 2,
            ),
            388 => 
            array (
                'id_notification' => 1132,
                'date_statut' => '2023-08-02 07:52:31',
                'num_facture' => 355,
                'id_facture_statut' => 6,
            ),
            389 => 
            array (
                'id_notification' => 1134,
                'date_statut' => '2023-08-02 08:49:59',
                'num_facture' => 356,
                'id_facture_statut' => 2,
            ),
            390 => 
            array (
                'id_notification' => 1135,
                'date_statut' => '2023-08-02 08:49:59',
                'num_facture' => 356,
                'id_facture_statut' => 6,
            ),
            391 => 
            array (
                'id_notification' => 1136,
                'date_statut' => '2023-08-02 12:58:33',
                'num_facture' => 357,
                'id_facture_statut' => 2,
            ),
            392 => 
            array (
                'id_notification' => 1137,
                'date_statut' => '2023-08-02 12:58:33',
                'num_facture' => 357,
                'id_facture_statut' => 6,
            ),
            393 => 
            array (
                'id_notification' => 1139,
                'date_statut' => '2023-08-02 13:12:39',
                'num_facture' => 358,
                'id_facture_statut' => 2,
            ),
            394 => 
            array (
                'id_notification' => 1140,
                'date_statut' => '2023-08-02 13:12:39',
                'num_facture' => 358,
                'id_facture_statut' => 6,
            ),
            395 => 
            array (
                'id_notification' => 1142,
                'date_statut' => '2023-08-02 18:00:37',
                'num_facture' => 359,
                'id_facture_statut' => 2,
            ),
            396 => 
            array (
                'id_notification' => 1143,
                'date_statut' => '2023-08-02 18:00:37',
                'num_facture' => 359,
                'id_facture_statut' => 6,
            ),
            397 => 
            array (
                'id_notification' => 1145,
                'date_statut' => '2023-08-02 18:12:47',
                'num_facture' => 360,
                'id_facture_statut' => 2,
            ),
            398 => 
            array (
                'id_notification' => 1146,
                'date_statut' => '2023-08-02 18:12:47',
                'num_facture' => 360,
                'id_facture_statut' => 6,
            ),
            399 => 
            array (
                'id_notification' => 1148,
                'date_statut' => '2023-08-02 18:19:52',
                'num_facture' => 361,
                'id_facture_statut' => 2,
            ),
            400 => 
            array (
                'id_notification' => 1149,
                'date_statut' => '2023-08-02 18:19:52',
                'num_facture' => 361,
                'id_facture_statut' => 6,
            ),
            401 => 
            array (
                'id_notification' => 1191,
                'date_statut' => '2023-08-10 15:37:14',
                'num_facture' => 362,
                'id_facture_statut' => 6,
            ),
            402 => 
            array (
                'id_notification' => 1197,
                'date_statut' => '2023-08-10 15:37:20',
                'num_facture' => 362,
                'id_facture_statut' => 6,
            ),
            403 => 
            array (
                'id_notification' => 1198,
                'date_statut' => '2023-08-10 15:38:04',
                'num_facture' => 362,
                'id_facture_statut' => 6,
            ),
            404 => 
            array (
                'id_notification' => 1199,
                'date_statut' => '2023-08-10 15:38:16',
                'num_facture' => 362,
                'id_facture_statut' => 6,
            ),
            405 => 
            array (
                'id_notification' => 1201,
                'date_statut' => '2023-08-10 17:36:14',
                'num_facture' => 271,
                'id_facture_statut' => 10,
            ),
            406 => 
            array (
                'id_notification' => 1202,
                'date_statut' => '2023-08-10 17:36:25',
                'num_facture' => 269,
                'id_facture_statut' => 10,
            ),
            407 => 
            array (
                'id_notification' => 1218,
                'date_statut' => '2023-08-22 10:59:07',
                'num_facture' => 363,
                'id_facture_statut' => 2,
            ),
            408 => 
            array (
                'id_notification' => 1219,
                'date_statut' => '2023-08-22 10:59:07',
                'num_facture' => 363,
                'id_facture_statut' => 6,
            ),
            409 => 
            array (
                'id_notification' => 1221,
                'date_statut' => '2023-08-24 15:36:36',
                'num_facture' => 364,
                'id_facture_statut' => 2,
            ),
            410 => 
            array (
                'id_notification' => 1222,
                'date_statut' => '2023-08-24 15:36:36',
                'num_facture' => 364,
                'id_facture_statut' => 6,
            ),
            411 => 
            array (
                'id_notification' => 1224,
                'date_statut' => '2023-08-24 15:38:37',
                'num_facture' => 365,
                'id_facture_statut' => 2,
            ),
            412 => 
            array (
                'id_notification' => 1225,
                'date_statut' => '2023-08-24 15:38:37',
                'num_facture' => 365,
                'id_facture_statut' => 6,
            ),
            413 => 
            array (
                'id_notification' => 1233,
                'date_statut' => '2023-08-24 15:50:00',
                'num_facture' => 366,
                'id_facture_statut' => 2,
            ),
            414 => 
            array (
                'id_notification' => 1234,
                'date_statut' => '2023-08-24 15:50:00',
                'num_facture' => 366,
                'id_facture_statut' => 6,
            ),
            415 => 
            array (
                'id_notification' => 1240,
                'date_statut' => '2023-08-24 17:16:33',
                'num_facture' => 367,
                'id_facture_statut' => 2,
            ),
            416 => 
            array (
                'id_notification' => 1241,
                'date_statut' => '2023-08-24 17:16:33',
                'num_facture' => 367,
                'id_facture_statut' => 6,
            ),
            417 => 
            array (
                'id_notification' => 1243,
                'date_statut' => '2023-08-24 18:27:51',
                'num_facture' => 368,
                'id_facture_statut' => 2,
            ),
            418 => 
            array (
                'id_notification' => 1244,
                'date_statut' => '2023-08-24 18:27:51',
                'num_facture' => 368,
                'id_facture_statut' => 6,
            ),
            419 => 
            array (
                'id_notification' => 1246,
                'date_statut' => '2023-08-24 19:23:14',
                'num_facture' => 369,
                'id_facture_statut' => 2,
            ),
            420 => 
            array (
                'id_notification' => 1247,
                'date_statut' => '2023-08-24 19:23:14',
                'num_facture' => 369,
                'id_facture_statut' => 6,
            ),
            421 => 
            array (
                'id_notification' => 1250,
                'date_statut' => '2023-08-24 19:23:49',
                'num_facture' => 370,
                'id_facture_statut' => 2,
            ),
            422 => 
            array (
                'id_notification' => 1251,
                'date_statut' => '2023-08-24 19:23:49',
                'num_facture' => 370,
                'id_facture_statut' => 6,
            ),
            423 => 
            array (
                'id_notification' => 1256,
                'date_statut' => '2023-08-24 19:28:41',
                'num_facture' => 371,
                'id_facture_statut' => 2,
            ),
            424 => 
            array (
                'id_notification' => 1257,
                'date_statut' => '2023-08-24 19:28:41',
                'num_facture' => 371,
                'id_facture_statut' => 6,
            ),
            425 => 
            array (
                'id_notification' => 1261,
                'date_statut' => '2023-08-24 19:30:26',
                'num_facture' => 372,
                'id_facture_statut' => 2,
            ),
            426 => 
            array (
                'id_notification' => 1262,
                'date_statut' => '2023-08-24 19:30:26',
                'num_facture' => 372,
                'id_facture_statut' => 6,
            ),
            427 => 
            array (
                'id_notification' => 1266,
                'date_statut' => '2023-08-24 19:34:33',
                'num_facture' => 373,
                'id_facture_statut' => 2,
            ),
            428 => 
            array (
                'id_notification' => 1267,
                'date_statut' => '2023-08-24 19:34:33',
                'num_facture' => 373,
                'id_facture_statut' => 6,
            ),
            429 => 
            array (
                'id_notification' => 1271,
                'date_statut' => '2023-08-24 19:51:21',
                'num_facture' => 374,
                'id_facture_statut' => 2,
            ),
            430 => 
            array (
                'id_notification' => 1272,
                'date_statut' => '2023-08-24 19:51:21',
                'num_facture' => 374,
                'id_facture_statut' => 6,
            ),
            431 => 
            array (
                'id_notification' => 1276,
                'date_statut' => '2023-08-24 20:23:24',
                'num_facture' => 375,
                'id_facture_statut' => 2,
            ),
            432 => 
            array (
                'id_notification' => 1277,
                'date_statut' => '2023-08-24 20:23:24',
                'num_facture' => 375,
                'id_facture_statut' => 6,
            ),
            433 => 
            array (
                'id_notification' => 1281,
                'date_statut' => '2023-08-24 20:28:58',
                'num_facture' => 376,
                'id_facture_statut' => 2,
            ),
            434 => 
            array (
                'id_notification' => 1282,
                'date_statut' => '2023-08-24 20:28:58',
                'num_facture' => 376,
                'id_facture_statut' => 6,
            ),
            435 => 
            array (
                'id_notification' => 1286,
                'date_statut' => '2023-08-24 20:30:57',
                'num_facture' => 377,
                'id_facture_statut' => 2,
            ),
            436 => 
            array (
                'id_notification' => 1287,
                'date_statut' => '2023-08-24 20:30:57',
                'num_facture' => 377,
                'id_facture_statut' => 6,
            ),
            437 => 
            array (
                'id_notification' => 1291,
                'date_statut' => '2023-08-24 20:34:55',
                'num_facture' => 378,
                'id_facture_statut' => 2,
            ),
            438 => 
            array (
                'id_notification' => 1292,
                'date_statut' => '2023-08-24 20:34:55',
                'num_facture' => 378,
                'id_facture_statut' => 6,
            ),
            439 => 
            array (
                'id_notification' => 1296,
                'date_statut' => '2023-08-24 20:51:44',
                'num_facture' => 379,
                'id_facture_statut' => 2,
            ),
            440 => 
            array (
                'id_notification' => 1297,
                'date_statut' => '2023-08-24 20:51:44',
                'num_facture' => 379,
                'id_facture_statut' => 6,
            ),
            441 => 
            array (
                'id_notification' => 1301,
                'date_statut' => '2023-08-24 22:30:05',
                'num_facture' => 380,
                'id_facture_statut' => 2,
            ),
            442 => 
            array (
                'id_notification' => 1302,
                'date_statut' => '2023-08-24 22:30:05',
                'num_facture' => 380,
                'id_facture_statut' => 6,
            ),
            443 => 
            array (
                'id_notification' => 1306,
                'date_statut' => '2023-08-24 22:31:32',
                'num_facture' => 381,
                'id_facture_statut' => 2,
            ),
            444 => 
            array (
                'id_notification' => 1307,
                'date_statut' => '2023-08-24 22:31:32',
                'num_facture' => 381,
                'id_facture_statut' => 6,
            ),
            445 => 
            array (
                'id_notification' => 1311,
                'date_statut' => '2023-08-24 22:35:05',
                'num_facture' => 382,
                'id_facture_statut' => 2,
            ),
            446 => 
            array (
                'id_notification' => 1312,
                'date_statut' => '2023-08-24 22:35:05',
                'num_facture' => 382,
                'id_facture_statut' => 6,
            ),
            447 => 
            array (
                'id_notification' => 1316,
                'date_statut' => '2023-08-24 22:53:11',
                'num_facture' => 383,
                'id_facture_statut' => 2,
            ),
            448 => 
            array (
                'id_notification' => 1317,
                'date_statut' => '2023-08-24 22:53:11',
                'num_facture' => 383,
                'id_facture_statut' => 6,
            ),
            449 => 
            array (
                'id_notification' => 1324,
                'date_statut' => '2023-08-28 22:52:06',
                'num_facture' => 384,
                'id_facture_statut' => 10,
            ),
            450 => 
            array (
                'id_notification' => 1326,
                'date_statut' => '2023-08-28 22:52:33',
                'num_facture' => 385,
                'id_facture_statut' => 2,
            ),
            451 => 
            array (
                'id_notification' => 1329,
                'date_statut' => '2023-08-28 22:53:27',
                'num_facture' => 386,
                'id_facture_statut' => 2,
            ),
            452 => 
            array (
                'id_notification' => 1331,
                'date_statut' => '2023-08-28 22:59:00',
                'num_facture' => 387,
                'id_facture_statut' => 2,
            ),
            453 => 
            array (
                'id_notification' => 1333,
                'date_statut' => '2023-08-28 23:27:44',
                'num_facture' => 388,
                'id_facture_statut' => 2,
            ),
            454 => 
            array (
                'id_notification' => 1334,
                'date_statut' => '2023-08-28 23:27:58',
                'num_facture' => 389,
                'id_facture_statut' => 10,
            ),
            455 => 
            array (
                'id_notification' => 1336,
                'date_statut' => '2023-08-28 23:27:58',
                'num_facture' => 390,
                'id_facture_statut' => 10,
            ),
            456 => 
            array (
                'id_notification' => 1338,
                'date_statut' => '2023-08-28 23:30:18',
                'num_facture' => 391,
                'id_facture_statut' => 2,
            ),
            457 => 
            array (
                'id_notification' => 1340,
                'date_statut' => '2023-08-28 23:30:21',
                'num_facture' => 391,
                'id_facture_statut' => 10,
            ),
            458 => 
            array (
                'id_notification' => 1349,
                'date_statut' => '2023-08-30 12:06:06',
                'num_facture' => 392,
                'id_facture_statut' => 2,
            ),
            459 => 
            array (
                'id_notification' => 1352,
                'date_statut' => '2023-08-30 12:07:41',
                'num_facture' => 393,
                'id_facture_statut' => 2,
            ),
            460 => 
            array (
                'id_notification' => 1355,
                'date_statut' => '2023-08-30 12:07:44',
                'num_facture' => 393,
                'id_facture_statut' => 10,
            ),
            461 => 
            array (
                'id_notification' => 1356,
                'date_statut' => '2023-08-30 12:08:43',
                'num_facture' => 394,
                'id_facture_statut' => 2,
            ),
            462 => 
            array (
                'id_notification' => 1359,
                'date_statut' => '2023-08-30 12:08:47',
                'num_facture' => 394,
                'id_facture_statut' => 10,
            ),
            463 => 
            array (
                'id_notification' => 1360,
                'date_statut' => '2023-08-30 12:44:38',
                'num_facture' => 392,
                'id_facture_statut' => 5,
            ),
            464 => 
            array (
                'id_notification' => 1361,
                'date_statut' => '2023-08-30 12:44:56',
                'num_facture' => 392,
                'id_facture_statut' => 5,
            ),
            465 => 
            array (
                'id_notification' => 1362,
                'date_statut' => '2023-08-30 15:01:32',
                'num_facture' => 395,
                'id_facture_statut' => 2,
            ),
            466 => 
            array (
                'id_notification' => 1365,
                'date_statut' => '2023-08-30 15:01:36',
                'num_facture' => 395,
                'id_facture_statut' => 10,
            ),
            467 => 
            array (
                'id_notification' => 1366,
                'date_statut' => '2023-08-30 15:02:47',
                'num_facture' => 396,
                'id_facture_statut' => 2,
            ),
            468 => 
            array (
                'id_notification' => 1369,
                'date_statut' => '2023-08-30 15:02:51',
                'num_facture' => 396,
                'id_facture_statut' => 10,
            ),
            469 => 
            array (
                'id_notification' => 1370,
                'date_statut' => '2023-08-30 13:02:53',
                'num_facture' => 396,
                'id_facture_statut' => 5,
            ),
            470 => 
            array (
                'id_notification' => 1371,
                'date_statut' => '2023-08-30 13:02:53',
                'num_facture' => 396,
                'id_facture_statut' => 6,
            ),
            471 => 
            array (
                'id_notification' => 1374,
                'date_statut' => '2023-08-30 14:03:07',
                'num_facture' => 396,
                'id_facture_statut' => 5,
            ),
            472 => 
            array (
                'id_notification' => 1375,
                'date_statut' => '2023-08-30 14:03:07',
                'num_facture' => 396,
                'id_facture_statut' => 6,
            ),
            473 => 
            array (
                'id_notification' => 1376,
                'date_statut' => '2023-09-06 18:24:02',
                'num_facture' => 397,
                'id_facture_statut' => 10,
            ),
            474 => 
            array (
                'id_notification' => 1378,
                'date_statut' => '2023-09-06 18:24:07',
                'num_facture' => 397,
                'id_facture_statut' => 10,
            ),
            475 => 
            array (
                'id_notification' => 1379,
                'date_statut' => '2023-09-06 18:25:09',
                'num_facture' => 397,
                'id_facture_statut' => 10,
            ),
            476 => 
            array (
                'id_notification' => 1380,
                'date_statut' => '2023-09-06 16:29:13',
                'num_facture' => 397,
                'id_facture_statut' => 5,
            ),
            477 => 
            array (
                'id_notification' => 1381,
                'date_statut' => '2023-09-06 16:29:13',
                'num_facture' => 397,
                'id_facture_statut' => 6,
            ),
            478 => 
            array (
                'id_notification' => 1383,
                'date_statut' => '2023-09-06 18:32:29',
                'num_facture' => 398,
                'id_facture_statut' => 2,
            ),
            479 => 
            array (
                'id_notification' => 1385,
                'date_statut' => '2023-09-06 18:32:34',
                'num_facture' => 398,
                'id_facture_statut' => 10,
            ),
            480 => 
            array (
                'id_notification' => 1386,
                'date_statut' => '2023-09-06 16:33:31',
                'num_facture' => 398,
                'id_facture_statut' => 5,
            ),
            481 => 
            array (
                'id_notification' => 1387,
                'date_statut' => '2023-09-06 16:33:31',
                'num_facture' => 398,
                'id_facture_statut' => 6,
            ),
            482 => 
            array (
                'id_notification' => 1388,
                'date_statut' => '2023-09-06 16:33:34',
                'num_facture' => 398,
                'id_facture_statut' => 5,
            ),
            483 => 
            array (
                'id_notification' => 1389,
                'date_statut' => '2023-09-06 16:33:35',
                'num_facture' => 398,
                'id_facture_statut' => 6,
            ),
            484 => 
            array (
                'id_notification' => 1392,
                'date_statut' => '2023-09-06 18:36:50',
                'num_facture' => 399,
                'id_facture_statut' => 2,
            ),
            485 => 
            array (
                'id_notification' => 1394,
                'date_statut' => '2023-09-06 18:36:55',
                'num_facture' => 399,
                'id_facture_statut' => 10,
            ),
            486 => 
            array (
                'id_notification' => 1395,
                'date_statut' => '2023-09-06 16:38:20',
                'num_facture' => 399,
                'id_facture_statut' => 5,
            ),
            487 => 
            array (
                'id_notification' => 1396,
                'date_statut' => '2023-09-06 16:38:20',
                'num_facture' => 399,
                'id_facture_statut' => 6,
            ),
            488 => 
            array (
                'id_notification' => 1397,
                'date_statut' => '2023-09-06 16:38:23',
                'num_facture' => 399,
                'id_facture_statut' => 5,
            ),
            489 => 
            array (
                'id_notification' => 1398,
                'date_statut' => '2023-09-06 16:38:23',
                'num_facture' => 399,
                'id_facture_statut' => 6,
            ),
            490 => 
            array (
                'id_notification' => 1401,
                'date_statut' => '2023-09-06 18:47:00',
                'num_facture' => 400,
                'id_facture_statut' => 2,
            ),
            491 => 
            array (
                'id_notification' => 1403,
                'date_statut' => '2023-09-06 18:47:04',
                'num_facture' => 400,
                'id_facture_statut' => 10,
            ),
            492 => 
            array (
                'id_notification' => 1404,
                'date_statut' => '2023-09-06 16:48:02',
                'num_facture' => 400,
                'id_facture_statut' => 5,
            ),
            493 => 
            array (
                'id_notification' => 1405,
                'date_statut' => '2023-09-06 16:48:02',
                'num_facture' => 400,
                'id_facture_statut' => 6,
            ),
            494 => 
            array (
                'id_notification' => 1406,
                'date_statut' => '2023-09-06 16:48:05',
                'num_facture' => 400,
                'id_facture_statut' => 5,
            ),
            495 => 
            array (
                'id_notification' => 1407,
                'date_statut' => '2023-09-06 16:48:05',
                'num_facture' => 400,
                'id_facture_statut' => 6,
            ),
            496 => 
            array (
                'id_notification' => 1410,
                'date_statut' => '2023-09-06 18:53:02',
                'num_facture' => 401,
                'id_facture_statut' => 2,
            ),
            497 => 
            array (
                'id_notification' => 1412,
                'date_statut' => '2023-09-06 18:53:07',
                'num_facture' => 401,
                'id_facture_statut' => 10,
            ),
            498 => 
            array (
                'id_notification' => 1413,
                'date_statut' => '2023-09-06 16:57:20',
                'num_facture' => 401,
                'id_facture_statut' => 5,
            ),
            499 => 
            array (
                'id_notification' => 1414,
                'date_statut' => '2023-09-06 16:57:20',
                'num_facture' => 401,
                'id_facture_statut' => 6,
            ),
        ));
        \DB::connection('mysql2')->table('facture_statut_notification')->insert(array (
            0 => 
            array (
                'id_notification' => 1415,
                'date_statut' => '2023-09-06 16:57:25',
                'num_facture' => 401,
                'id_facture_statut' => 5,
            ),
            1 => 
            array (
                'id_notification' => 1416,
                'date_statut' => '2023-09-06 16:57:25',
                'num_facture' => 401,
                'id_facture_statut' => 6,
            ),
            2 => 
            array (
                'id_notification' => 1418,
                'date_statut' => '2023-09-06 19:01:04',
                'num_facture' => 402,
                'id_facture_statut' => 2,
            ),
            3 => 
            array (
                'id_notification' => 1420,
                'date_statut' => '2023-09-06 19:01:08',
                'num_facture' => 402,
                'id_facture_statut' => 10,
            ),
            4 => 
            array (
                'id_notification' => 1421,
                'date_statut' => '2023-09-06 17:01:44',
                'num_facture' => 402,
                'id_facture_statut' => 5,
            ),
            5 => 
            array (
                'id_notification' => 1422,
                'date_statut' => '2023-09-06 17:01:44',
                'num_facture' => 402,
                'id_facture_statut' => 6,
            ),
            6 => 
            array (
                'id_notification' => 1423,
                'date_statut' => '2023-09-06 17:01:47',
                'num_facture' => 402,
                'id_facture_statut' => 5,
            ),
            7 => 
            array (
                'id_notification' => 1424,
                'date_statut' => '2023-09-06 17:01:48',
                'num_facture' => 402,
                'id_facture_statut' => 6,
            ),
            8 => 
            array (
                'id_notification' => 1426,
                'date_statut' => '2023-09-06 19:03:12',
                'num_facture' => 403,
                'id_facture_statut' => 2,
            ),
            9 => 
            array (
                'id_notification' => 1428,
                'date_statut' => '2023-09-06 19:03:17',
                'num_facture' => 403,
                'id_facture_statut' => 10,
            ),
            10 => 
            array (
                'id_notification' => 1429,
                'date_statut' => '2023-09-06 17:04:14',
                'num_facture' => 403,
                'id_facture_statut' => 5,
            ),
            11 => 
            array (
                'id_notification' => 1430,
                'date_statut' => '2023-09-06 17:04:14',
                'num_facture' => 403,
                'id_facture_statut' => 6,
            ),
            12 => 
            array (
                'id_notification' => 1431,
                'date_statut' => '2023-09-06 17:04:17',
                'num_facture' => 403,
                'id_facture_statut' => 5,
            ),
            13 => 
            array (
                'id_notification' => 1432,
                'date_statut' => '2023-09-06 17:04:17',
                'num_facture' => 403,
                'id_facture_statut' => 6,
            ),
            14 => 
            array (
                'id_notification' => 1435,
                'date_statut' => '2023-09-06 19:12:16',
                'num_facture' => 404,
                'id_facture_statut' => 2,
            ),
            15 => 
            array (
                'id_notification' => 1437,
                'date_statut' => '2023-09-06 19:12:21',
                'num_facture' => 404,
                'id_facture_statut' => 10,
            ),
            16 => 
            array (
                'id_notification' => 1438,
                'date_statut' => '2023-09-06 17:12:49',
                'num_facture' => 404,
                'id_facture_statut' => 5,
            ),
            17 => 
            array (
                'id_notification' => 1439,
                'date_statut' => '2023-09-06 17:12:49',
                'num_facture' => 404,
                'id_facture_statut' => 6,
            ),
            18 => 
            array (
                'id_notification' => 1440,
                'date_statut' => '2023-09-06 17:12:52',
                'num_facture' => 404,
                'id_facture_statut' => 5,
            ),
            19 => 
            array (
                'id_notification' => 1441,
                'date_statut' => '2023-09-06 17:12:52',
                'num_facture' => 404,
                'id_facture_statut' => 6,
            ),
            20 => 
            array (
                'id_notification' => 1443,
                'date_statut' => '2023-09-06 19:15:44',
                'num_facture' => 405,
                'id_facture_statut' => 2,
            ),
            21 => 
            array (
                'id_notification' => 1445,
                'date_statut' => '2023-09-06 19:15:49',
                'num_facture' => 405,
                'id_facture_statut' => 10,
            ),
            22 => 
            array (
                'id_notification' => 1446,
                'date_statut' => '2023-09-06 17:17:17',
                'num_facture' => 405,
                'id_facture_statut' => 5,
            ),
            23 => 
            array (
                'id_notification' => 1447,
                'date_statut' => '2023-09-06 17:17:17',
                'num_facture' => 405,
                'id_facture_statut' => 6,
            ),
            24 => 
            array (
                'id_notification' => 1448,
                'date_statut' => '2023-09-06 17:17:21',
                'num_facture' => 405,
                'id_facture_statut' => 5,
            ),
            25 => 
            array (
                'id_notification' => 1449,
                'date_statut' => '2023-09-06 17:17:21',
                'num_facture' => 405,
                'id_facture_statut' => 6,
            ),
            26 => 
            array (
                'id_notification' => 1451,
                'date_statut' => '2023-09-06 19:22:30',
                'num_facture' => 406,
                'id_facture_statut' => 2,
            ),
            27 => 
            array (
                'id_notification' => 1453,
                'date_statut' => '2023-09-06 19:22:34',
                'num_facture' => 406,
                'id_facture_statut' => 10,
            ),
            28 => 
            array (
                'id_notification' => 1454,
                'date_statut' => '2023-09-06 17:23:07',
                'num_facture' => 406,
                'id_facture_statut' => 5,
            ),
            29 => 
            array (
                'id_notification' => 1455,
                'date_statut' => '2023-09-06 17:23:07',
                'num_facture' => 406,
                'id_facture_statut' => 6,
            ),
            30 => 
            array (
                'id_notification' => 1456,
                'date_statut' => '2023-09-06 17:23:10',
                'num_facture' => 406,
                'id_facture_statut' => 5,
            ),
            31 => 
            array (
                'id_notification' => 1457,
                'date_statut' => '2023-09-06 17:23:11',
                'num_facture' => 406,
                'id_facture_statut' => 6,
            ),
            32 => 
            array (
                'id_notification' => 1459,
                'date_statut' => '2023-09-06 19:24:35',
                'num_facture' => 407,
                'id_facture_statut' => 2,
            ),
            33 => 
            array (
                'id_notification' => 1461,
                'date_statut' => '2023-09-06 19:24:40',
                'num_facture' => 407,
                'id_facture_statut' => 10,
            ),
            34 => 
            array (
                'id_notification' => 1462,
                'date_statut' => '2023-09-06 17:26:38',
                'num_facture' => 407,
                'id_facture_statut' => 5,
            ),
            35 => 
            array (
                'id_notification' => 1463,
                'date_statut' => '2023-09-06 17:26:38',
                'num_facture' => 407,
                'id_facture_statut' => 6,
            ),
            36 => 
            array (
                'id_notification' => 1464,
                'date_statut' => '2023-09-06 17:26:41',
                'num_facture' => 407,
                'id_facture_statut' => 5,
            ),
            37 => 
            array (
                'id_notification' => 1465,
                'date_statut' => '2023-09-06 17:26:42',
                'num_facture' => 407,
                'id_facture_statut' => 6,
            ),
            38 => 
            array (
                'id_notification' => 1467,
                'date_statut' => '2023-09-06 19:30:08',
                'num_facture' => 408,
                'id_facture_statut' => 2,
            ),
            39 => 
            array (
                'id_notification' => 1469,
                'date_statut' => '2023-09-06 19:30:13',
                'num_facture' => 408,
                'id_facture_statut' => 10,
            ),
            40 => 
            array (
                'id_notification' => 1470,
                'date_statut' => '2023-09-06 17:32:08',
                'num_facture' => 408,
                'id_facture_statut' => 5,
            ),
            41 => 
            array (
                'id_notification' => 1471,
                'date_statut' => '2023-09-06 17:32:08',
                'num_facture' => 408,
                'id_facture_statut' => 6,
            ),
            42 => 
            array (
                'id_notification' => 1472,
                'date_statut' => '2023-09-06 17:32:11',
                'num_facture' => 408,
                'id_facture_statut' => 5,
            ),
            43 => 
            array (
                'id_notification' => 1473,
                'date_statut' => '2023-09-06 17:32:12',
                'num_facture' => 408,
                'id_facture_statut' => 6,
            ),
            44 => 
            array (
                'id_notification' => 1476,
                'date_statut' => '2023-09-06 19:41:44',
                'num_facture' => 409,
                'id_facture_statut' => 2,
            ),
            45 => 
            array (
                'id_notification' => 1478,
                'date_statut' => '2023-09-06 19:41:49',
                'num_facture' => 409,
                'id_facture_statut' => 10,
            ),
            46 => 
            array (
                'id_notification' => 1479,
                'date_statut' => '2023-09-06 17:44:37',
                'num_facture' => 409,
                'id_facture_statut' => 5,
            ),
            47 => 
            array (
                'id_notification' => 1480,
                'date_statut' => '2023-09-06 17:44:37',
                'num_facture' => 409,
                'id_facture_statut' => 6,
            ),
            48 => 
            array (
                'id_notification' => 1481,
                'date_statut' => '2023-09-06 17:44:41',
                'num_facture' => 409,
                'id_facture_statut' => 5,
            ),
            49 => 
            array (
                'id_notification' => 1482,
                'date_statut' => '2023-09-06 17:44:42',
                'num_facture' => 409,
                'id_facture_statut' => 6,
            ),
            50 => 
            array (
                'id_notification' => 1484,
                'date_statut' => '2023-09-06 19:54:01',
                'num_facture' => 410,
                'id_facture_statut' => 2,
            ),
            51 => 
            array (
                'id_notification' => 1486,
                'date_statut' => '2023-09-06 19:54:05',
                'num_facture' => 410,
                'id_facture_statut' => 10,
            ),
            52 => 
            array (
                'id_notification' => 1487,
                'date_statut' => '2023-09-06 17:57:02',
                'num_facture' => 410,
                'id_facture_statut' => 5,
            ),
            53 => 
            array (
                'id_notification' => 1488,
                'date_statut' => '2023-09-06 17:57:02',
                'num_facture' => 410,
                'id_facture_statut' => 6,
            ),
            54 => 
            array (
                'id_notification' => 1489,
                'date_statut' => '2023-09-06 17:57:05',
                'num_facture' => 410,
                'id_facture_statut' => 5,
            ),
            55 => 
            array (
                'id_notification' => 1490,
                'date_statut' => '2023-09-06 17:57:05',
                'num_facture' => 410,
                'id_facture_statut' => 6,
            ),
            56 => 
            array (
                'id_notification' => 1492,
                'date_statut' => '2023-09-06 19:58:50',
                'num_facture' => 411,
                'id_facture_statut' => 2,
            ),
            57 => 
            array (
                'id_notification' => 1494,
                'date_statut' => '2023-09-06 19:58:54',
                'num_facture' => 411,
                'id_facture_statut' => 10,
            ),
            58 => 
            array (
                'id_notification' => 1495,
                'date_statut' => '2023-09-07 17:33:55',
                'num_facture' => 411,
                'id_facture_statut' => 5,
            ),
            59 => 
            array (
                'id_notification' => 1496,
                'date_statut' => '2023-09-07 17:33:55',
                'num_facture' => 411,
                'id_facture_statut' => 6,
            ),
            60 => 
            array (
                'id_notification' => 1497,
                'date_statut' => '2023-09-07 17:34:05',
                'num_facture' => 411,
                'id_facture_statut' => 5,
            ),
            61 => 
            array (
                'id_notification' => 1498,
                'date_statut' => '2023-09-07 17:34:05',
                'num_facture' => 411,
                'id_facture_statut' => 6,
            ),
            62 => 
            array (
                'id_notification' => 1500,
                'date_statut' => '2023-09-07 19:38:20',
                'num_facture' => 412,
                'id_facture_statut' => 2,
            ),
            63 => 
            array (
                'id_notification' => 1502,
                'date_statut' => '2023-09-07 19:38:25',
                'num_facture' => 412,
                'id_facture_statut' => 10,
            ),
            64 => 
            array (
                'id_notification' => 1503,
                'date_statut' => '2023-09-07 17:39:14',
                'num_facture' => 412,
                'id_facture_statut' => 5,
            ),
            65 => 
            array (
                'id_notification' => 1504,
                'date_statut' => '2023-09-07 17:39:14',
                'num_facture' => 412,
                'id_facture_statut' => 6,
            ),
            66 => 
            array (
                'id_notification' => 1505,
                'date_statut' => '2023-09-07 17:39:18',
                'num_facture' => 412,
                'id_facture_statut' => 5,
            ),
            67 => 
            array (
                'id_notification' => 1506,
                'date_statut' => '2023-09-07 17:39:18',
                'num_facture' => 412,
                'id_facture_statut' => 6,
            ),
            68 => 
            array (
                'id_notification' => 1508,
                'date_statut' => '2023-09-07 19:52:41',
                'num_facture' => 413,
                'id_facture_statut' => 2,
            ),
            69 => 
            array (
                'id_notification' => 1510,
                'date_statut' => '2023-09-07 19:52:46',
                'num_facture' => 413,
                'id_facture_statut' => 10,
            ),
            70 => 
            array (
                'id_notification' => 1511,
                'date_statut' => '2023-09-07 17:59:37',
                'num_facture' => 413,
                'id_facture_statut' => 5,
            ),
            71 => 
            array (
                'id_notification' => 1512,
                'date_statut' => '2023-09-07 17:59:37',
                'num_facture' => 413,
                'id_facture_statut' => 6,
            ),
            72 => 
            array (
                'id_notification' => 1513,
                'date_statut' => '2023-09-07 17:59:42',
                'num_facture' => 413,
                'id_facture_statut' => 5,
            ),
            73 => 
            array (
                'id_notification' => 1514,
                'date_statut' => '2023-09-07 17:59:43',
                'num_facture' => 413,
                'id_facture_statut' => 6,
            ),
            74 => 
            array (
                'id_notification' => 1517,
                'date_statut' => '2023-09-07 21:22:00',
                'num_facture' => 414,
                'id_facture_statut' => 2,
            ),
            75 => 
            array (
                'id_notification' => 1519,
                'date_statut' => '2023-09-07 21:22:01',
                'num_facture' => 414,
                'id_facture_statut' => 10,
            ),
            76 => 
            array (
                'id_notification' => 1520,
                'date_statut' => '2023-09-07 21:22:09',
                'num_facture' => 414,
                'id_facture_statut' => 3,
            ),
            77 => 
            array (
                'id_notification' => 1529,
                'date_statut' => '2023-09-07 21:13:20',
                'num_facture' => 414,
                'id_facture_statut' => 5,
            ),
            78 => 
            array (
                'id_notification' => 1530,
                'date_statut' => '2023-09-07 21:13:20',
                'num_facture' => 414,
                'id_facture_statut' => 6,
            ),
            79 => 
            array (
                'id_notification' => 1531,
                'date_statut' => '2023-09-07 21:13:23',
                'num_facture' => 414,
                'id_facture_statut' => 5,
            ),
            80 => 
            array (
                'id_notification' => 1532,
                'date_statut' => '2023-09-07 21:13:24',
                'num_facture' => 414,
                'id_facture_statut' => 6,
            ),
            81 => 
            array (
                'id_notification' => 1564,
                'date_statut' => '2023-09-19 18:09:44',
                'num_facture' => 419,
                'id_facture_statut' => 11,
            ),
            82 => 
            array (
                'id_notification' => 1565,
                'date_statut' => '2023-09-19 18:09:59',
                'num_facture' => 420,
                'id_facture_statut' => 3,
            ),
            83 => 
            array (
                'id_notification' => 1567,
                'date_statut' => '2023-09-19 18:10:39',
                'num_facture' => 421,
                'id_facture_statut' => 2,
            ),
            84 => 
            array (
                'id_notification' => 1569,
                'date_statut' => '2023-09-19 18:10:42',
                'num_facture' => 421,
                'id_facture_statut' => 10,
            ),
            85 => 
            array (
                'id_notification' => 1570,
                'date_statut' => '2023-09-19 18:14:08',
                'num_facture' => 422,
                'id_facture_statut' => 11,
            ),
            86 => 
            array (
                'id_notification' => 1572,
                'date_statut' => '2023-09-19 18:17:07',
                'num_facture' => 423,
                'id_facture_statut' => 2,
            ),
            87 => 
            array (
                'id_notification' => 1574,
                'date_statut' => '2023-09-19 18:17:09',
                'num_facture' => 423,
                'id_facture_statut' => 10,
            ),
            88 => 
            array (
                'id_notification' => 1575,
                'date_statut' => '2023-09-19 18:17:22',
                'num_facture' => 424,
                'id_facture_statut' => 2,
            ),
            89 => 
            array (
                'id_notification' => 1577,
                'date_statut' => '2023-09-19 18:17:25',
                'num_facture' => 424,
                'id_facture_statut' => 10,
            ),
            90 => 
            array (
                'id_notification' => 1578,
                'date_statut' => '2023-09-19 18:19:43',
                'num_facture' => 425,
                'id_facture_statut' => 3,
            ),
            91 => 
            array (
                'id_notification' => 1580,
                'date_statut' => '2023-09-19 18:19:51',
                'num_facture' => 426,
                'id_facture_statut' => 2,
            ),
            92 => 
            array (
                'id_notification' => 1581,
                'date_statut' => '2023-09-19 18:20:24',
                'num_facture' => 427,
                'id_facture_statut' => 2,
            ),
            93 => 
            array (
                'id_notification' => 1583,
                'date_statut' => '2023-09-19 18:20:27',
                'num_facture' => 427,
                'id_facture_statut' => 10,
            ),
            94 => 
            array (
                'id_notification' => 1584,
                'date_statut' => '2023-09-19 18:20:45',
                'num_facture' => 428,
                'id_facture_statut' => 2,
            ),
            95 => 
            array (
                'id_notification' => 1586,
                'date_statut' => '2023-09-19 18:20:47',
                'num_facture' => 428,
                'id_facture_statut' => 10,
            ),
            96 => 
            array (
                'id_notification' => 1588,
                'date_statut' => '2023-09-20 09:37:37',
                'num_facture' => 429,
                'id_facture_statut' => 2,
            ),
            97 => 
            array (
                'id_notification' => 1589,
                'date_statut' => '2023-09-20 09:37:37',
                'num_facture' => 429,
                'id_facture_statut' => 10,
            ),
            98 => 
            array (
                'id_notification' => 1590,
                'date_statut' => '2023-09-20 09:38:31',
                'num_facture' => 430,
                'id_facture_statut' => 2,
            ),
            99 => 
            array (
                'id_notification' => 1592,
                'date_statut' => '2023-09-20 09:38:33',
                'num_facture' => 430,
                'id_facture_statut' => 10,
            ),
            100 => 
            array (
                'id_notification' => 1595,
                'date_statut' => '2023-09-20 07:56:43',
                'num_facture' => 396,
                'id_facture_statut' => 5,
            ),
            101 => 
            array (
                'id_notification' => 1596,
                'date_statut' => '2023-09-20 07:56:43',
                'num_facture' => 396,
                'id_facture_statut' => 6,
            ),
            102 => 
            array (
                'id_notification' => 1598,
                'date_statut' => '2023-09-20 10:23:04',
                'num_facture' => 431,
                'id_facture_statut' => 2,
            ),
            103 => 
            array (
                'id_notification' => 1599,
                'date_statut' => '2023-09-20 10:23:04',
                'num_facture' => 431,
                'id_facture_statut' => 10,
            ),
            104 => 
            array (
                'id_notification' => 1600,
                'date_statut' => '2023-09-20 10:23:32',
                'num_facture' => 432,
                'id_facture_statut' => 2,
            ),
            105 => 
            array (
                'id_notification' => 1602,
                'date_statut' => '2023-09-20 10:23:33',
                'num_facture' => 432,
                'id_facture_statut' => 10,
            ),
            106 => 
            array (
                'id_notification' => 1603,
                'date_statut' => '2023-09-20 08:23:34',
                'num_facture' => 432,
                'id_facture_statut' => 5,
            ),
            107 => 
            array (
                'id_notification' => 1604,
                'date_statut' => '2023-09-20 08:23:34',
                'num_facture' => 432,
                'id_facture_statut' => 6,
            ),
            108 => 
            array (
                'id_notification' => 1605,
                'date_statut' => '2023-09-20 10:24:41',
                'num_facture' => 433,
                'id_facture_statut' => 2,
            ),
            109 => 
            array (
                'id_notification' => 1606,
                'date_statut' => '2023-09-20 10:24:49',
                'num_facture' => 434,
                'id_facture_statut' => 2,
            ),
            110 => 
            array (
                'id_notification' => 1608,
                'date_statut' => '2023-09-20 10:24:50',
                'num_facture' => 434,
                'id_facture_statut' => 10,
            ),
            111 => 
            array (
                'id_notification' => 1609,
                'date_statut' => '2023-09-20 08:24:52',
                'num_facture' => 434,
                'id_facture_statut' => 5,
            ),
            112 => 
            array (
                'id_notification' => 1610,
                'date_statut' => '2023-09-20 08:24:52',
                'num_facture' => 434,
                'id_facture_statut' => 6,
            ),
            113 => 
            array (
                'id_notification' => 1611,
                'date_statut' => '2023-09-20 10:25:11',
                'num_facture' => 435,
                'id_facture_statut' => 2,
            ),
            114 => 
            array (
                'id_notification' => 1612,
                'date_statut' => '2023-09-20 10:25:11',
                'num_facture' => 435,
                'id_facture_statut' => 10,
            ),
            115 => 
            array (
                'id_notification' => 1613,
                'date_statut' => '2023-09-20 10:26:03',
                'num_facture' => 436,
                'id_facture_statut' => 2,
            ),
            116 => 
            array (
                'id_notification' => 1614,
                'date_statut' => '2023-09-20 10:26:03',
                'num_facture' => 436,
                'id_facture_statut' => 10,
            ),
            117 => 
            array (
                'id_notification' => 1617,
                'date_statut' => '2023-09-20 10:57:12',
                'num_facture' => 389,
                'id_facture_statut' => 10,
            ),
            118 => 
            array (
                'id_notification' => 1618,
                'date_statut' => '2023-09-20 10:57:49',
                'num_facture' => 390,
                'id_facture_statut' => 10,
            ),
            119 => 
            array (
                'id_notification' => 1619,
                'date_statut' => '2023-09-20 10:59:43',
                'num_facture' => 154,
                'id_facture_statut' => 10,
            ),
            120 => 
            array (
                'id_notification' => 1620,
                'date_statut' => '2023-09-20 11:02:26',
                'num_facture' => 384,
                'id_facture_statut' => 10,
            ),
            121 => 
            array (
                'id_notification' => 1625,
                'date_statut' => '2023-09-20 12:07:27',
                'num_facture' => 437,
                'id_facture_statut' => 2,
            ),
            122 => 
            array (
                'id_notification' => 1627,
                'date_statut' => '2023-09-20 12:07:27',
                'num_facture' => 437,
                'id_facture_statut' => 10,
            ),
            123 => 
            array (
                'id_notification' => 1628,
                'date_statut' => '2023-09-20 12:07:30',
                'num_facture' => 437,
                'id_facture_statut' => 3,
            ),
            124 => 
            array (
                'id_notification' => 1631,
                'date_statut' => '2023-09-20 12:12:28',
                'num_facture' => 438,
                'id_facture_statut' => 2,
            ),
            125 => 
            array (
                'id_notification' => 1633,
                'date_statut' => '2023-09-20 12:12:28',
                'num_facture' => 438,
                'id_facture_statut' => 10,
            ),
            126 => 
            array (
                'id_notification' => 1634,
                'date_statut' => '2023-09-20 12:12:31',
                'num_facture' => 438,
                'id_facture_statut' => 3,
            ),
            127 => 
            array (
                'id_notification' => 1635,
                'date_statut' => '2023-09-20 12:13:06',
                'num_facture' => 439,
                'id_facture_statut' => 2,
            ),
            128 => 
            array (
                'id_notification' => 1637,
                'date_statut' => '2023-09-20 12:13:22',
                'num_facture' => 440,
                'id_facture_statut' => 2,
            ),
            129 => 
            array (
                'id_notification' => 1639,
                'date_statut' => '2023-09-20 12:13:22',
                'num_facture' => 440,
                'id_facture_statut' => 10,
            ),
        ));
        
        
    }
}