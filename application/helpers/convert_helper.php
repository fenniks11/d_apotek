<?php

if (!function_exists('convert_number')) {
    function convert_number($no)
    {
        if (!preg_match('/[^+0-9]/', trim($no))) {
            // cek apakah no hp karakter 1-3 adalah +62
            if (substr(trim($no), 0, 3) == '+62') {
                $hp = trim($no);
            }
            // cek apakah no hp karakter 1 adalah 0
            elseif (substr(trim($no), 0, 1) == '0') {
                $hp = '+62' . substr(trim($no), 1);
            } else {
                $hp = '00000';
            }
        }
        return $hp;
    }
}
