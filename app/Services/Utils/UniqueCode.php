<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 28.3.2018
 * Time: 0:01
 */

namespace App\Services\Utils;


class UniqueCode
{

    public function unique($model, $normalized){
        $count = 0;
        do {
            $code = $normalized .'-'. $this->generate(4);
            $count++;
        } while ($model::where('code', $code)->count() > 0);

        return $code;
    }


    public function generate($length){
        // uniqid gives 13 chars, but you could adjust it to your needs.
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($length / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $length);
    }
}