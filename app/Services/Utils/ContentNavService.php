<?php
/**
 * Created by PhpStorm.
 * User: slavo
 * Date: 18.3.2018
 * Time: 23:31
 */

namespace App\Services\Utils;


class ContentNavService
{
    public function render($config){
        $nav = '<div id="content-navigation"' . (isset($config['left']) ? '' : ' class="content-nav-right"') . '">';

        if(isset($config['left'])){
            $nav .= '<ul class="nav nav-tabs">';

            foreach($config['left'] as $link){
                if(isset($link['params'])){
                    $action = action($link['action'], $link['params']);
                }else{
                    $action = action($link['action']);
                }

                $nav .=
                    '<li role="presentation">'.
                        '<a href="' . $action . '" class="btn' . ((isset($link['modal']) && $link['modal']) ? ' btn-modal':'') .  '">'.
                            $link['label'].
                        '</a>'.
                    '</li>';

            }

            $nav .= '</ul>';
        }

        if(isset($config['right'])){
            $nav .= '<ul class="nav nav-tabs">';

            foreach($config['right'] as $link){

                if(isset($link['action'])){
                    if(isset($link['params'])){
                        $action = action($link['action'], $link['params']);
                    }else{
                        $action = action($link['action']);
                    }
                }

                $nav .=
                    '<li role="presentation">'.
                        '<a href="' . (isset($action) ? $action : '#' ) . '" ' . (isset($link['id']) ? 'id="'. $link['id'] .'"' : '').' class="btn' . ((isset($link['modal']) && $link['modal']) ? ' btn-modal':'') .  '">'.
                            $link['label'].
                        '</a>'.
                    '</li>';

            }

            $nav .= '</ul>';
        }


        $nav .= '</div>';

        return $nav;
    }

    public function submit($config){

        $nav =
            '<div id="content-navigation" class="content-nav-right">' .
                '<ul class="nav nav-tabs">' .
                    '<li class="active" role="presentation">' .
                        '<button class="btn btn-submit" type="submit">' . $config['label'] . '</button>' .
                    '</li>' .
                '</ul>' .
            '</div>';

        return $nav;
    }
}