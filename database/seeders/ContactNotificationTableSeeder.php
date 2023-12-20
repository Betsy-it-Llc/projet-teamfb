<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContactNotificationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::connection('mysql2')->table('contact_notification')->delete();
        
        \DB::connection('mysql2')->table('contact_notification')->insert(array (
            0 => 
            array (
                'id_notification' => 27,
                'date_creation' => '2023-04-14 00:00:00',
                'id_contact' => 112,
            ),
            1 => 
            array (
                'id_notification' => 34,
                'date_creation' => '2023-05-04 00:00:00',
                'id_contact' => 130,
            ),
            2 => 
            array (
                'id_notification' => 282,
                'date_creation' => '2023-06-10 00:00:00',
                'id_contact' => 149,
            ),
            3 => 
            array (
                'id_notification' => 400,
                'date_creation' => '2023-02-19 18:06:00',
                'id_contact' => 170,
            ),
            4 => 
            array (
                'id_notification' => 401,
                'date_creation' => '2022-12-26 20:09:00',
                'id_contact' => 175,
            ),
            5 => 
            array (
                'id_notification' => 402,
                'date_creation' => '2022-12-21 07:19:00',
                'id_contact' => 176,
            ),
            6 => 
            array (
                'id_notification' => 403,
                'date_creation' => '2022-12-20 16:38:00',
                'id_contact' => 177,
            ),
            7 => 
            array (
                'id_notification' => 404,
                'date_creation' => '2022-12-17 09:55:00',
                'id_contact' => 178,
            ),
            8 => 
            array (
                'id_notification' => 405,
                'date_creation' => '2022-12-15 19:29:00',
                'id_contact' => 179,
            ),
            9 => 
            array (
                'id_notification' => 406,
                'date_creation' => '2022-12-13 15:20:00',
                'id_contact' => 180,
            ),
            10 => 
            array (
                'id_notification' => 407,
                'date_creation' => '2022-12-09 10:39:00',
                'id_contact' => 181,
            ),
            11 => 
            array (
                'id_notification' => 408,
                'date_creation' => '2022-12-09 10:31:00',
                'id_contact' => 182,
            ),
            12 => 
            array (
                'id_notification' => 409,
                'date_creation' => '2022-12-09 10:11:00',
                'id_contact' => 183,
            ),
            13 => 
            array (
                'id_notification' => 410,
                'date_creation' => '2022-12-09 09:38:00',
                'id_contact' => 184,
            ),
            14 => 
            array (
                'id_notification' => 411,
                'date_creation' => '2022-11-26 11:01:00',
                'id_contact' => 185,
            ),
            15 => 
            array (
                'id_notification' => 412,
                'date_creation' => '2022-11-25 16:42:00',
                'id_contact' => 186,
            ),
            16 => 
            array (
                'id_notification' => 413,
                'date_creation' => '2022-11-20 01:37:00',
                'id_contact' => 187,
            ),
            17 => 
            array (
                'id_notification' => 414,
                'date_creation' => '2022-11-05 09:55:00',
                'id_contact' => 188,
            ),
            18 => 
            array (
                'id_notification' => 415,
                'date_creation' => '2022-10-24 18:03:00',
                'id_contact' => 189,
            ),
            19 => 
            array (
                'id_notification' => 416,
                'date_creation' => '2022-10-20 08:23:00',
                'id_contact' => 190,
            ),
            20 => 
            array (
                'id_notification' => 417,
                'date_creation' => '2022-10-17 06:48:00',
                'id_contact' => 191,
            ),
            21 => 
            array (
                'id_notification' => 418,
                'date_creation' => '2022-10-07 22:19:00',
                'id_contact' => 192,
            ),
            22 => 
            array (
                'id_notification' => 419,
                'date_creation' => '2022-10-07 22:10:00',
                'id_contact' => 193,
            ),
            23 => 
            array (
                'id_notification' => 420,
                'date_creation' => '2022-09-28 12:59:00',
                'id_contact' => 194,
            ),
            24 => 
            array (
                'id_notification' => 421,
                'date_creation' => '2022-09-22 17:13:00',
                'id_contact' => 195,
            ),
            25 => 
            array (
                'id_notification' => 422,
                'date_creation' => '2022-09-17 13:07:00',
                'id_contact' => 196,
            ),
            26 => 
            array (
                'id_notification' => 423,
                'date_creation' => '2022-09-10 13:51:00',
                'id_contact' => 197,
            ),
            27 => 
            array (
                'id_notification' => 424,
                'date_creation' => '2022-08-18 12:43:00',
                'id_contact' => 198,
            ),
            28 => 
            array (
                'id_notification' => 425,
                'date_creation' => '2022-07-15 13:56:00',
                'id_contact' => 199,
            ),
            29 => 
            array (
                'id_notification' => 426,
                'date_creation' => '2022-07-08 08:23:00',
                'id_contact' => 200,
            ),
            30 => 
            array (
                'id_notification' => 427,
                'date_creation' => '2022-06-10 11:02:00',
                'id_contact' => 201,
            ),
            31 => 
            array (
                'id_notification' => 428,
                'date_creation' => '2022-06-02 13:20:00',
                'id_contact' => 202,
            ),
            32 => 
            array (
                'id_notification' => 429,
                'date_creation' => '2022-05-27 11:38:00',
                'id_contact' => 203,
            ),
            33 => 
            array (
                'id_notification' => 430,
                'date_creation' => '2022-05-24 18:44:00',
                'id_contact' => 204,
            ),
            34 => 
            array (
                'id_notification' => 431,
                'date_creation' => '2022-05-24 18:39:00',
                'id_contact' => 205,
            ),
            35 => 
            array (
                'id_notification' => 432,
                'date_creation' => '2022-05-24 18:29:00',
                'id_contact' => 206,
            ),
            36 => 
            array (
                'id_notification' => 433,
                'date_creation' => '2022-05-21 08:55:00',
                'id_contact' => 207,
            ),
            37 => 
            array (
                'id_notification' => 434,
                'date_creation' => '2022-05-18 08:57:00',
                'id_contact' => 208,
            ),
            38 => 
            array (
                'id_notification' => 435,
                'date_creation' => '2022-05-10 08:53:00',
                'id_contact' => 209,
            ),
            39 => 
            array (
                'id_notification' => 436,
                'date_creation' => '2022-04-30 06:50:00',
                'id_contact' => 210,
            ),
            40 => 
            array (
                'id_notification' => 437,
                'date_creation' => '2022-03-23 21:35:00',
                'id_contact' => 211,
            ),
            41 => 
            array (
                'id_notification' => 438,
                'date_creation' => '2022-03-23 08:10:00',
                'id_contact' => 212,
            ),
            42 => 
            array (
                'id_notification' => 439,
                'date_creation' => '2022-03-22 18:23:00',
                'id_contact' => 213,
            ),
            43 => 
            array (
                'id_notification' => 440,
                'date_creation' => '2022-03-01 11:32:00',
                'id_contact' => 214,
            ),
            44 => 
            array (
                'id_notification' => 441,
                'date_creation' => '2022-02-17 15:44:00',
                'id_contact' => 215,
            ),
            45 => 
            array (
                'id_notification' => 442,
                'date_creation' => '2022-02-10 19:30:00',
                'id_contact' => 216,
            ),
            46 => 
            array (
                'id_notification' => 443,
                'date_creation' => '2022-02-02 19:30:00',
                'id_contact' => 217,
            ),
            47 => 
            array (
                'id_notification' => 444,
                'date_creation' => '2022-01-29 09:06:00',
                'id_contact' => 218,
            ),
            48 => 
            array (
                'id_notification' => 445,
                'date_creation' => '2022-01-24 09:30:00',
                'id_contact' => 219,
            ),
            49 => 
            array (
                'id_notification' => 446,
                'date_creation' => '2022-01-19 11:46:00',
                'id_contact' => 220,
            ),
            50 => 
            array (
                'id_notification' => 447,
                'date_creation' => '2022-01-13 17:04:00',
                'id_contact' => 221,
            ),
            51 => 
            array (
                'id_notification' => 448,
                'date_creation' => '2021-12-21 21:12:00',
                'id_contact' => 222,
            ),
            52 => 
            array (
                'id_notification' => 449,
                'date_creation' => '2021-12-21 21:09:00',
                'id_contact' => 223,
            ),
            53 => 
            array (
                'id_notification' => 450,
                'date_creation' => '2021-12-21 20:24:00',
                'id_contact' => 224,
            ),
            54 => 
            array (
                'id_notification' => 451,
                'date_creation' => '2021-12-18 08:27:00',
                'id_contact' => 225,
            ),
            55 => 
            array (
                'id_notification' => 452,
                'date_creation' => '2021-12-17 14:50:00',
                'id_contact' => 226,
            ),
            56 => 
            array (
                'id_notification' => 453,
                'date_creation' => '2021-12-15 20:46:00',
                'id_contact' => 227,
            ),
            57 => 
            array (
                'id_notification' => 454,
                'date_creation' => '2021-12-02 10:14:00',
                'id_contact' => 228,
            ),
            58 => 
            array (
                'id_notification' => 455,
                'date_creation' => '2021-11-18 07:34:00',
                'id_contact' => 229,
            ),
            59 => 
            array (
                'id_notification' => 456,
                'date_creation' => '2021-11-07 08:22:00',
                'id_contact' => 230,
            ),
            60 => 
            array (
                'id_notification' => 457,
                'date_creation' => '2021-10-29 08:03:00',
                'id_contact' => 231,
            ),
            61 => 
            array (
                'id_notification' => 458,
                'date_creation' => '2021-10-21 12:06:00',
                'id_contact' => 232,
            ),
            62 => 
            array (
                'id_notification' => 459,
                'date_creation' => '2021-10-16 12:02:00',
                'id_contact' => 233,
            ),
            63 => 
            array (
                'id_notification' => 460,
                'date_creation' => '2021-10-14 13:05:00',
                'id_contact' => 234,
            ),
            64 => 
            array (
                'id_notification' => 461,
                'date_creation' => '2021-10-10 14:41:00',
                'id_contact' => 235,
            ),
            65 => 
            array (
                'id_notification' => 462,
                'date_creation' => '2021-10-07 06:23:00',
                'id_contact' => 236,
            ),
            66 => 
            array (
                'id_notification' => 463,
                'date_creation' => '2021-08-13 15:59:00',
                'id_contact' => 237,
            ),
            67 => 
            array (
                'id_notification' => 464,
                'date_creation' => '2021-08-05 10:22:00',
                'id_contact' => 238,
            ),
            68 => 
            array (
                'id_notification' => 465,
                'date_creation' => '2021-08-05 07:16:00',
                'id_contact' => 239,
            ),
            69 => 
            array (
                'id_notification' => 466,
                'date_creation' => '2021-07-01 14:03:00',
                'id_contact' => 240,
            ),
            70 => 
            array (
                'id_notification' => 467,
                'date_creation' => '2021-06-12 10:56:00',
                'id_contact' => 241,
            ),
            71 => 
            array (
                'id_notification' => 468,
                'date_creation' => '2021-06-05 09:59:00',
                'id_contact' => 242,
            ),
            72 => 
            array (
                'id_notification' => 469,
                'date_creation' => '2021-06-05 09:29:00',
                'id_contact' => 243,
            ),
            73 => 
            array (
                'id_notification' => 470,
                'date_creation' => '2021-06-04 10:30:00',
                'id_contact' => 244,
            ),
            74 => 
            array (
                'id_notification' => 471,
                'date_creation' => '2021-05-26 17:40:00',
                'id_contact' => 245,
            ),
            75 => 
            array (
                'id_notification' => 472,
                'date_creation' => '2021-03-31 13:11:00',
                'id_contact' => 246,
            ),
            76 => 
            array (
                'id_notification' => 473,
                'date_creation' => '2021-03-21 20:19:00',
                'id_contact' => 247,
            ),
            77 => 
            array (
                'id_notification' => 474,
                'date_creation' => '2021-03-09 11:16:00',
                'id_contact' => 248,
            ),
            78 => 
            array (
                'id_notification' => 475,
                'date_creation' => '2021-02-15 07:32:00',
                'id_contact' => 249,
            ),
            79 => 
            array (
                'id_notification' => 476,
                'date_creation' => '2021-01-27 20:54:00',
                'id_contact' => 250,
            ),
            80 => 
            array (
                'id_notification' => 477,
                'date_creation' => '2021-01-21 15:51:00',
                'id_contact' => 251,
            ),
            81 => 
            array (
                'id_notification' => 478,
                'date_creation' => '2020-12-12 07:53:00',
                'id_contact' => 252,
            ),
            82 => 
            array (
                'id_notification' => 479,
                'date_creation' => '2020-12-12 07:50:00',
                'id_contact' => 253,
            ),
            83 => 
            array (
                'id_notification' => 480,
                'date_creation' => '2020-12-11 09:30:00',
                'id_contact' => 254,
            ),
            84 => 
            array (
                'id_notification' => 481,
                'date_creation' => '2020-12-08 11:21:00',
                'id_contact' => 255,
            ),
            85 => 
            array (
                'id_notification' => 482,
                'date_creation' => '2020-12-08 10:12:00',
                'id_contact' => 256,
            ),
            86 => 
            array (
                'id_notification' => 483,
                'date_creation' => '2020-12-07 10:29:00',
                'id_contact' => 257,
            ),
            87 => 
            array (
                'id_notification' => 484,
                'date_creation' => '2020-12-05 09:33:00',
                'id_contact' => 258,
            ),
            88 => 
            array (
                'id_notification' => 485,
                'date_creation' => '2020-12-04 06:06:00',
                'id_contact' => 259,
            ),
            89 => 
            array (
                'id_notification' => 486,
                'date_creation' => '2020-12-03 14:04:00',
                'id_contact' => 260,
            ),
            90 => 
            array (
                'id_notification' => 487,
                'date_creation' => '2020-11-25 17:56:00',
                'id_contact' => 261,
            ),
            91 => 
            array (
                'id_notification' => 488,
                'date_creation' => '2020-10-31 15:34:00',
                'id_contact' => 262,
            ),
            92 => 
            array (
                'id_notification' => 489,
                'date_creation' => '2020-09-17 12:46:00',
                'id_contact' => 263,
            ),
            93 => 
            array (
                'id_notification' => 490,
                'date_creation' => '2020-09-08 16:55:00',
                'id_contact' => 264,
            ),
            94 => 
            array (
                'id_notification' => 491,
                'date_creation' => '2020-08-27 17:42:00',
                'id_contact' => 265,
            ),
            95 => 
            array (
                'id_notification' => 492,
                'date_creation' => '2020-08-11 06:25:00',
                'id_contact' => 266,
            ),
            96 => 
            array (
                'id_notification' => 493,
                'date_creation' => '2020-08-01 08:53:00',
                'id_contact' => 267,
            ),
            97 => 
            array (
                'id_notification' => 494,
                'date_creation' => '2020-07-21 18:47:00',
                'id_contact' => 268,
            ),
            98 => 
            array (
                'id_notification' => 495,
                'date_creation' => '2020-07-09 18:16:00',
                'id_contact' => 269,
            ),
            99 => 
            array (
                'id_notification' => 496,
                'date_creation' => '2020-07-08 08:10:00',
                'id_contact' => 270,
            ),
            100 => 
            array (
                'id_notification' => 497,
                'date_creation' => '2020-07-07 16:51:00',
                'id_contact' => 271,
            ),
            101 => 
            array (
                'id_notification' => 498,
                'date_creation' => '2020-03-01 19:57:00',
                'id_contact' => 272,
            ),
            102 => 
            array (
                'id_notification' => 499,
                'date_creation' => '2020-02-18 06:24:00',
                'id_contact' => 273,
            ),
            103 => 
            array (
                'id_notification' => 500,
                'date_creation' => '2020-02-12 12:42:00',
                'id_contact' => 274,
            ),
            104 => 
            array (
                'id_notification' => 501,
                'date_creation' => '2020-01-20 16:32:00',
                'id_contact' => 275,
            ),
            105 => 
            array (
                'id_notification' => 502,
                'date_creation' => '2019-12-23 14:57:00',
                'id_contact' => 276,
            ),
            106 => 
            array (
                'id_notification' => 503,
                'date_creation' => '2019-12-17 18:16:00',
                'id_contact' => 277,
            ),
            107 => 
            array (
                'id_notification' => 504,
                'date_creation' => '2019-12-16 12:28:00',
                'id_contact' => 278,
            ),
            108 => 
            array (
                'id_notification' => 505,
                'date_creation' => '2019-12-16 08:28:00',
                'id_contact' => 279,
            ),
            109 => 
            array (
                'id_notification' => 506,
                'date_creation' => '2019-12-05 08:28:00',
                'id_contact' => 280,
            ),
            110 => 
            array (
                'id_notification' => 507,
                'date_creation' => '2019-11-27 18:48:00',
                'id_contact' => 281,
            ),
            111 => 
            array (
                'id_notification' => 508,
                'date_creation' => '2019-11-20 07:20:00',
                'id_contact' => 282,
            ),
            112 => 
            array (
                'id_notification' => 509,
                'date_creation' => '2019-11-18 10:21:00',
                'id_contact' => 283,
            ),
            113 => 
            array (
                'id_notification' => 510,
                'date_creation' => '2019-11-04 15:41:00',
                'id_contact' => 284,
            ),
            114 => 
            array (
                'id_notification' => 511,
                'date_creation' => '2019-08-30 16:19:00',
                'id_contact' => 285,
            ),
            115 => 
            array (
                'id_notification' => 512,
                'date_creation' => '2019-07-23 16:21:00',
                'id_contact' => 286,
            ),
            116 => 
            array (
                'id_notification' => 513,
                'date_creation' => '2019-06-20 20:58:00',
                'id_contact' => 287,
            ),
            117 => 
            array (
                'id_notification' => 514,
                'date_creation' => '2019-04-23 10:23:00',
                'id_contact' => 288,
            ),
            118 => 
            array (
                'id_notification' => 515,
                'date_creation' => '2019-04-22 16:38:00',
                'id_contact' => 289,
            ),
            119 => 
            array (
                'id_notification' => 516,
                'date_creation' => '2019-04-21 10:07:00',
                'id_contact' => 290,
            ),
            120 => 
            array (
                'id_notification' => 517,
                'date_creation' => '2019-04-21 09:15:00',
                'id_contact' => 291,
            ),
            121 => 
            array (
                'id_notification' => 1075,
                'date_creation' => '2023-01-09 14:26:00',
                'id_contact' => 44,
            ),
            122 => 
            array (
                'id_notification' => 1076,
                'date_creation' => '2023-01-26 15:20:00',
                'id_contact' => 55,
            ),
            123 => 
            array (
                'id_notification' => 1077,
                'date_creation' => '2023-02-14 18:52:00',
                'id_contact' => 78,
            ),
            124 => 
            array (
                'id_notification' => 1078,
                'date_creation' => '2023-02-14 19:15:00',
                'id_contact' => 79,
            ),
            125 => 
            array (
                'id_notification' => 1079,
                'date_creation' => '2023-02-22 19:40:00',
                'id_contact' => 105,
            ),
            126 => 
            array (
                'id_notification' => 1080,
                'date_creation' => '2023-02-22 19:40:00',
                'id_contact' => 106,
            ),
            127 => 
            array (
                'id_notification' => 1081,
                'date_creation' => '2023-03-16 14:20:00',
                'id_contact' => 108,
            ),
            128 => 
            array (
                'id_notification' => 1082,
                'date_creation' => '2023-03-21 17:46:00',
                'id_contact' => 109,
            ),
            129 => 
            array (
                'id_notification' => 1083,
                'date_creation' => '2023-04-03 21:17:00',
                'id_contact' => 110,
            ),
            130 => 
            array (
                'id_notification' => 1084,
                'date_creation' => '2023-04-19 08:29:00',
                'id_contact' => 122,
            ),
            131 => 
            array (
                'id_notification' => 1085,
                'date_creation' => '2023-04-19 08:29:00',
                'id_contact' => 123,
            ),
            132 => 
            array (
                'id_notification' => 1086,
                'date_creation' => '2022-12-22 15:57:00',
                'id_contact' => 136,
            ),
            133 => 
            array (
                'id_notification' => 1087,
                'date_creation' => '2023-02-22 15:57:00',
                'id_contact' => 137,
            ),
            134 => 
            array (
                'id_notification' => 1088,
                'date_creation' => '2023-05-06 07:59:00',
                'id_contact' => 138,
            ),
            135 => 
            array (
                'id_notification' => 1089,
                'date_creation' => '2023-05-12 14:21:00',
                'id_contact' => 139,
            ),
            136 => 
            array (
                'id_notification' => 1090,
                'date_creation' => '2023-05-16 09:29:00',
                'id_contact' => 140,
            ),
            137 => 
            array (
                'id_notification' => 1091,
                'date_creation' => '2023-05-25 19:41:00',
                'id_contact' => 141,
            ),
            138 => 
            array (
                'id_notification' => 1092,
                'date_creation' => '2023-05-22 16:19:00',
                'id_contact' => 142,
            ),
            139 => 
            array (
                'id_notification' => 1093,
                'date_creation' => '2023-05-24 19:48:00',
                'id_contact' => 143,
            ),
            140 => 
            array (
                'id_notification' => 1094,
                'date_creation' => '2023-05-27 07:55:00',
                'id_contact' => 144,
            ),
            141 => 
            array (
                'id_notification' => 1095,
                'date_creation' => '2023-05-30 09:41:00',
                'id_contact' => 145,
            ),
            142 => 
            array (
                'id_notification' => 1096,
                'date_creation' => '2023-05-30 11:02:00',
                'id_contact' => 146,
            ),
            143 => 
            array (
                'id_notification' => 1097,
                'date_creation' => '2023-03-22 15:57:00',
                'id_contact' => 147,
            ),
            144 => 
            array (
                'id_notification' => 1098,
                'date_creation' => '2023-06-09 09:36:00',
                'id_contact' => 148,
            ),
            145 => 
            array (
                'id_notification' => 1099,
                'date_creation' => '2023-06-19 13:04:00',
                'id_contact' => 150,
            ),
            146 => 
            array (
                'id_notification' => 1100,
                'date_creation' => '2023-06-20 09:07:00',
                'id_contact' => 151,
            ),
            147 => 
            array (
                'id_notification' => 1101,
                'date_creation' => '2023-06-21 10:36:00',
                'id_contact' => 152,
            ),
            148 => 
            array (
                'id_notification' => 1102,
                'date_creation' => '2023-06-29 11:07:52',
                'id_contact' => 155,
            ),
            149 => 
            array (
                'id_notification' => 1103,
                'date_creation' => '2023-06-30 20:13:24',
                'id_contact' => 156,
            ),
            150 => 
            array (
                'id_notification' => 1104,
                'date_creation' => '2023-07-06 22:15:00',
                'id_contact' => 157,
            ),
            151 => 
            array (
                'id_notification' => 1105,
                'date_creation' => '2023-07-07 21:00:00',
                'id_contact' => 292,
            ),
            152 => 
            array (
                'id_notification' => 1106,
                'date_creation' => '2023-07-22 17:41:49',
                'id_contact' => 293,
            ),
            153 => 
            array (
                'id_notification' => 1172,
                'date_creation' => '0000-00-00 00:00:00',
                'id_contact' => 302,
            ),
            154 => 
            array (
                'id_notification' => 1173,
                'date_creation' => '0000-00-00 00:00:00',
                'id_contact' => 303,
            ),
            155 => 
            array (
                'id_notification' => 1174,
                'date_creation' => '2023-08-08 11:05:00',
                'id_contact' => 304,
            ),
            156 => 
            array (
                'id_notification' => 1186,
                'date_creation' => '2023-08-09 11:22:00',
                'id_contact' => 305,
            ),
        ));
        
        
    }
}