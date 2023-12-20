<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AmbassadeursTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('ambassadeurs')->delete();
        
        \DB::table('ambassadeurs')->insert(array (
            0 => 
            array (
                'id_ambassadeur' => 3,
                'login' => 'la@la.fr',
                'mdp' => '12345678',
                'authentification_facebook' => 'Non',
                'cookies' => NULL,
                'created_at' => '2022-05-20 12:40:50',
                'updated_at' => '2022-05-20 12:40:50',
            ),
            1 => 
            array (
                'id_ambassadeur' => 155,
                'login' => 'Bonjour.lalachante@gmail.com',
                'mdp' => 'des,1152',
                'authentification_facebook' => 'oui',
                'cookies' => '[  {    ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id_ambassadeur' => 469,
                'login' => 'studiolalachante@gmail.com',
                'mdp' => 'lala31_ç,;',
                'authentification_facebook' => 'oui',
                'cookies' => '[
{
"name": "fr",
"value": "1aoSOqxYzGJJSWnRR.AWUjST9kkXLWY7x9tQkA7RftrLs.BhQJ1m.O1.AAA.0.0.Bha8xX.AWUW4SRT9cw",
"domain": ".facebook.com",
"path": "/",
"expires": 1642230616.586242,
"size": 84,
"httpOnly": true,
"secure": true,
"session": false,
"sameSite": "None"
},
{
"name": "m_pixel_ratio",
"value": "1.0000000298023224",
"domain": ".facebook.com",
"path": "/",
"expires": -1,
"size": 31,
"httpOnly": false,
"secure": true,
"session": true
},
{
"name": "wd",
"value": "800x600",
"domain": ".facebook.com",
"path": "/",
"expires": 1635058867,
"size": 9,
"httpOnly": false,
"secure": true,
"session": false,
"sameSite": "Lax"
},
{
"name": "datr",
"value": "z8o4YVWaFSQyOxJiA1HqpLFl",
"domain": ".facebook.com",
"path": "/",
"expires": 1697526066.811853,
"size": 28,
"httpOnly": true,
"secure": true,
"session": false,
"sameSite": "None"
},
{
"name": "dpr",
"value": "1.0000000298023224",
"domain": ".facebook.com",
"path": "/",
"expires": 1635058865,
"size": 21,
"httpOnly": false,
"secure": true,
"session": false,
"sameSite": "None"
},
{
"name": "sb",
"value": "3co4YfL-I8P167_SJjL1Zwbx",
"domain": ".facebook.com",
"path": "/",
"expires": 1694183903.529369,
"size": 26,
"httpOnly": true,
"secure": true,
"session": false,
"sameSite": "None"
},
{
"name": "usida",
"value": "%7B%22ver%22%3A1%2C%22id%22%3A%22Aqz4f9a1t69mwj%22%2C%22time%22%3A1631113534%7D",
"domain": ".facebook.com",
"path": "/",
"expires": -1,
"size": 84,
"httpOnly": false,
"secure": true,
"session": true,
"sameSite": "None"
},
{
"name": "x-referer",
"value": "eyJyIjoiL2dyb3VwL3NldHRpbmdzLz9ncm91cF9pZD01NDA5NDUyOTI3NjY0NDIiLCJoIjoiL2dyb3VwL3NldHRpbmdzLz9ncm91cF9pZD01NDA5NDUyOTI3NjY0NDIiLCJzIjoibSJ9",
"domain": ".facebook.com",
"path": "/",
"expires": -1,
"size": 149,
"httpOnly": false,
"secure": true,
"session": true,
"sameSite": "None"
}
]',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id_ambassadeur' => 1274,
                'login' => 'hugo.rap.lalachante@gmail.com',
                'mdp' => 'hugoraplalachante',
                'authentification_facebook' => 'oui',
                'cookies' => '[
{
"name": "datr",
"value": "EEI6YXRXkn5VrxdIdXwTzhvb",
"domain": ".facebook.com",
"path": "/",
"expires": 1694279957.904416,
"size": 28,
"httpOnly": true,
"secure": true,
"session": false,
"sameSite": "None"
},
{
"name": "dpr",
"value": "1.0000000298023224",
"domain": ".facebook.com",
"path": "/",
"expires": 1634491550,
"size": 21,
"httpOnly": false,
"secure": true,
"session": false,
"sameSite": "None"
},
{
"name": "c_user",
"value": "100072668672263",
"domain": ".facebook.com",
"path": "/",
"expires": 1665422265.445617,
"size": 21,
"httpOnly": false,
"secure": true,
"session": false,
"sameSite": "None"
},
{
"name": "wd",
"value": "783x600",
"domain": ".facebook.com",
"path": "/",
"expires": 1634222946,
"size": 9,
"httpOnly": false,
"secure": true,
"session": false,
"sameSite": "Lax"
},
{
"name": "m_pixel_ratio",
"value": "1.0000000298023224",
"domain": ".facebook.com",
"path": "/",
"expires": -1,
"size": 31,
"httpOnly": false,
"secure": true,
"session": true
},
{
"name": "spin",
"value": "r.1004529660_b.trunk_t.1633886264_s.1_v.2_",
"domain": ".facebook.com",
"path": "/",
"expires": 1633976265.195403,
"size": 46,
"httpOnly": true,
"secure": true,
"session": false,
"sameSite": "None"
},
{
"name": "xs",
"value": "27%3AstXmJyowKnxINw%3A2%3A1631207964%3A-1%3A11746%3A%3AAcXVefiknMnrzYeLe9J-s_oXwLrnezAcppVPPX318Q",
"domain": ".facebook.com",
"path": "/",
"expires": 1665422265.445731,
"size": 99,
"httpOnly": true,
"secure": true,
"session": false,
"sameSite": "None"
},
{
"name": "sb",
"value": "G0I6YZ32LfiCV-_fQ-5Bfb6D",
"domain": ".facebook.com",
"path": "/",
"expires": 1694279966.882575,
"size": 26,
"httpOnly": true,
"secure": true,
"session": false,
"sameSite": "None"
},
{
"name": "fr",
"value": "0JdWtJmzyE1p0RH7k.AWV_yL8Z3yIapeLOHOPULv5xvig.BhYyA5.pd.AAA.0.0.BhYyA5.AWXqznCFoso",
"domain": ".facebook.com",
"path": "/",
"expires": 1641662264.445807,
"size": 84,
"httpOnly": true,
"secure": true,
"session": false,
"sameSite": "None"
}
]',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id_ambassadeur' => 1384,
                'login' => 'sens.cm.lalachante@gmail.com',
                'mdp' => '152df,;',
                'authentification_facebook' => 'oui',
                'cookies' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id_ambassadeur' => 1385,
                'login' => 'lalachante.cm@gmail.com',
                'mdp' => 'Lalachante31fb2',
                'authentification_facebook' => 'oui',
                'cookies' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id_ambassadeur' => 1,
                'login' => 'lalachante.reseaux@gmail.com',
                'mdp' => '$x5b1rZ2',
                'authentification_facebook' => '[
{
"name": "fr",
"value": "0cVo2s9vyDVCsyRVx.AWUW0cEhYxX_3zmsSrKbcHGHGY8.BiTYNp.yI.AAA.0.0.BiTYNp.AWU_3ERMR3o",
"domain": ".facebook.com",
"path": "/",
"expires": 1657023079.43865,
"size": 84,
"httpOnly": true,
"secure": true,
"session": false,
"sameSite": "None",
"sameParty": false,
"sourceScheme": "Secure",
"sourcePort": 443
},
{
"name": "presence",
"value": "C%7B%22t3%22%3A%5B%5D%2C%22utc3%22%3A1648564390513%2C%22v%22%3A1%7D",
"domain": ".facebook.com",
"path": "/",
"expires": -1,
"size": 75,
"httpOnly": false,
"secure": true,
"session": true,
"sameParty": false,
"sourceScheme": "Secure",
"sourcePort": 443
},
{
"name": "xs",
"value": "3%3Ab-Mx8OJ_CG6saA%3A2%3A1628502173%3A-1%3A11759%3A%3AAcXnqqYG8nnQEhHiqFvI33uFI4xKHAoRKF14gm8ol2wW",
"domain": ".facebook.com",
"path": "/",
"expires": 1680783080.438633,
"size": 100,
"httpOnly": true,
"secure": true,
"session": false,
"sameSite": "None",
"sameParty": false,
"sourceScheme": "Secure",
"sourcePort": 443
},
{
"name": "x-referer",
"value": "eyJyIjoiL2dyb3Vwcy8xNDUwNDAyODU4NTM4NzA3P3ZpZXc9aW5mbyZtZHM9JTJGcmFwaWRfcmVwb3J0JTJGJTNGY29udGV4dCUzRCUyNTdCJTI1MjJzZXNzaW9uX2lkJTI1MjIlMjUzQSUyNTIyNTljZmY2YTItY2FlYy00MGY0LThhZDItYTNhN2UyYzMwMDY4JTI1MjIlMjUyQyUyNTIydHlwZSUyNTIyJTI1M0EyJTI1MkMlMjUyMnN0b3J5X2xvY2F0aW9uJTI1MjIlMjUzQSUyNTIyZ3JvdXAlMjUyMiUyNTJDJTI1MjJlbnRyeV9wb2ludCUyNTIyJTI1M0ElMjUyMmdyb3Vwc19yZXBvcnQlMjUyMiUyNTJDJTI1MjJyZXBvcnRhYmxlX2VudF90b2tlbiUyNTIyJTI1M0ElMjUyMjE0NTA0MDI4NTg1Mzg3MDclMjUyMiUyNTdEJTI2YXYlM0QxMDAwNDkzODgyOTIwNjcmbWRmPTEiLCJoIjoiL2dyb3Vwcy8xNDUwNDAyODU4NTM4NzA3P3ZpZXc9aW5mbyZtZHM9JTJGcmFwaWRfcmVwb3J0JTJGJTNGY29udGV4dCUzRCUyNTdCJTI1MjJzZXNzaW9uX2lkJTI1MjIlMjUzQSUyNTIyNTljZmY2YTItY2FlYy00MGY0LThhZDItYTNhN2UyYzMwMDY4JTI1MjIlMjUyQyUyNTIydHlwZSUyNTIyJTI1M0EyJTI1MkMlMjUyMnN0b3J5X2xvY2F0aW9uJTI1MjIlMjUzQSUyNTIyZ3JvdXAlMjUyMiUyNTJDJTI1MjJlbnRyeV9wb2ludCUyNTIyJTI1M0ElMjUyMmdyb3Vwc19yZXBvcnQlMjUyMiUyNTJDJTI1MjJyZXBvcnRhYmxlX2VudF90b2tlbiUyNTIyJTI1M0ElMjUyMjE0NTA0MDI4NTg1Mzg3MDclMjUyMiUyNTdEJTI2YXYlM0QxMDAwNDkzODgyOTIwNjcmbWRmPTEiLCJzIjoibSJ9",
"domain": ".facebook.com",
"path": "/",
"expires": -1,
"size": 1037,
"httpOnly": false,
"secure": true,
"session": true,
"sameSite": "None",
"sameParty": false,
"sourceScheme": "Secure",
"sourcePort": 443
},
{
"name": "datr",
"value": "XvgQYUBsxRqX25PyWVYeXyWy",
"domain": ".facebook.com",
"path": "/",
"expires": 1691574113.780682,
"size": 28,
"httpOnly": true,
"secure": true,
"session": false,
"sameSite": "None",
"sameParty": false,
"sourceScheme": "Secure",
"sourcePort": 443
},
{
"name": "sb",
"value": "lvgQYevlOptN8Lx72Y5G14ao",
"domain": ".facebook.com",
"path": "/",
"expires": 1691574172.271609,
"size": 26,
"httpOnly": true,
"secure": true,
"session": false,
"sameSite": "None",
"sameParty": false,
"sourceScheme": "Secure",
"sourcePort": 443
},
{
"name": "usida",
"value": "eyJ2ZXIiOjEsImlkIjoiQXI5M3NycnFhOTdnYiIsInRpbWUiOjE2NDc4ODA1NTF9",
"domain": ".facebook.com",
"path": "/",
"expires": -1,
"size": 69,
"httpOnly": false,
"secure": true,
"session": true,
"sameSite": "None",
"sameParty": false,
"sourceScheme": "Secure",
"sourcePort": 443
},
{
"name": "m_pixel_ratio",
"value": "1",
"domain": ".facebook.com",
"path": "/",
"expires": -1,
"size": 14,
"httpOnly": false,
"secure": true,
"session": true,
"sameParty": false,
"sourceScheme": "Secure",
"sourcePort": 443
},
{
"name": "c_user",
"value": "100049388292067",
"domain": ".facebook.com",
"path": "/",
"expires": 1680783080.438592,
"size": 21,
"httpOnly": false,
"secure": true,
"session": false,
"sameSite": "None",
"sameParty": false,
"sourceScheme": "Secure",
"sourcePort": 443
},
{
"name": "m_page_voice",
"value": "211561366395565",
"domain": ".facebook.com",
"path": "/",
"expires": 1655656560.496229,
"size": 27,
"httpOnly": true,
"secure": true,
"session": false,
"sameSite": "None",
"sameParty": false,
"sourceScheme": "Secure",
"sourcePort": 443
}
]',
                'cookies' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id_ambassadeur' => 29,
                'login' => 'djazia',
                'mdp' => 'abcd',
                'authentification_facebook' => 'Oui',
                'cookies' => NULL,
                'created_at' => '2022-09-15 15:53:09',
                'updated_at' => '2022-09-15 15:53:09',
            ),
            8 => 
            array (
                'id_ambassadeur' => 27,
                'login' => 'harenait.lalachante@gmail.com',
                'mdp' => '123',
                'authentification_facebook' => NULL,
                'cookies' => NULL,
                'created_at' => '2023-01-30 13:30:55',
                'updated_at' => '2023-03-06 11:48:47',
            ),
        ));
        
        
    }
}