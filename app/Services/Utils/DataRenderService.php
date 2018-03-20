<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 19.3.18
 * Time: 22:32
 */

namespace App\Services\Utils;


class DataRenderService
{
    public function render($fields)
    {

        $data = '';

        foreach ($fields as $field) {
            $data .=
                '<div class="row">' .
                    '<div class="col-md-20">' .
                        '<label>' . $field['label'] . '</label>' .
                    '</div>' .
                    '<div class="col-md-40">' .
                        $field['value'] .
                    '</div>' .
                '</div>';
        }


        return $data;
    }
}