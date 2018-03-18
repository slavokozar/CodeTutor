<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 18.3.18
 * Time: 0:39
 */

namespace App\Services;


class BreadCrumbService
{
    public function render($links){

        $breadcrumb = '<ol class="breadcrumb">';

        $linksCount = count($links);

        for($i = 0; $i < $linksCount; $i++){
            if($i == ($linksCount - 1)){
                $breadcrumb .= '<li class="active">' . $links[$i]['label'] . '</li>';
            }else if(isset($links[$i]['url'])){
                $breadcrumb .= '<li><a href="' . $links[$i]['url'] . '">' . $links[$i]['label'] . '</a></li>';
            }else if(isset($links[$i]['action'])){
                $breadcrumb .= '<li><a href="' . action($links[$i]['action']) . '">' . $links[$i]['label'] . '</a></li>';
            }else{
                $breadcrumb .= '<li>' . $links[$i]['label'] . '</li>';
            }
        }
        $breadcrumb .= '</ol>';

        return $breadcrumb;
    }
}