<?php

return [
    'url' => 'uzivatelia',

    'labels' => [
        'title' => 'titul',
        'name' => 'meno',
        'surname' => 'priezvisko',
        'email' => 'email',
        'roles' => 'roly',
        'schools' => 'školy',
        'groups' => 'skupiny',
        'birthdate' => 'Dátum narodenia',
        'url' => 'Webová stránka',
        'address' => 'Adresa',
    ],

    'delete' => [
        'heading' => 'Vymazanie užívateľa',
        'message' => 'Naozaj si želáte vymazať užívateľa <strong>:name</strong> ?'
    ],

    'users' => [
        'url' => 'uzivatelia',
        'heading' => 'Užívatelia',
        'link' => 'Užívatelia',
        'create' => 'Vytvorenie užívateľa',
        'no-groups' => 'Tento užívateľ nie je členom žiadnej skupiny.',
        'no-schools' => 'Tento užívateľ nie je členom žiadnej školy.',
        'roles' => [
            'ADMIN' => 'správca',
            'TEACHER' => 'učiteľ',
            '' => 'študent',
        ],
    ],


    'groups' => [
        'url' => 'skupiny',
        'heading' => 'Skupiny',
        'link' => 'Skupiny',
        'create' => 'Vytvorenie skupiny',
        'add' => 'Pridať do skupiny',
        'labels' => [
            'name' => 'názov',
            'school' => 'škola',
            'public' => 'verejná',
            'admins' => 'správcovia',
            'students' => 'študenti',
        ],
        'roles' => [
            'ADMIN' => 'správca',
            '' => 'študent',
        ],
        'delete' => [
            'heading' => 'Vymazanie skupiny',
            'message' => 'Naozaj si želáte vymazať skupinu <strong>:name</strong> ?'
        ],
    ],

    'schools' => [
        'url' => 'skoly',
        'heading' => 'Školy',
        'link' => 'Školy',
        'create' => 'Vytvorenie školy',
        'involved' => 'Zapojené školy',
        'add' => 'Pridať do školy',
        'labels' => [
            'name' => 'názov',
            'address' => 'adresa',
            'url' => 'webová stránka',
            'admins' => 'správcovia',
            'teachers' => 'učitelia',
            'students' => 'študenti',
        ],
        'roles' => [
            'ADMIN' => 'správca',
            'TEACHER' => 'učiteľ',
            '' => 'študent',
        ],
        'delete' => [
            'heading' => 'Vymazanie školy',
            'message' => 'Naozaj si želáte vymazať školu <strong>:name</strong> ?'
        ],
    ],

    'admins' => [
        'url' => 'spravcovia',
        'heading' => 'Správcovia',
        'link' => 'Správcovia'
    ],

    'teachers' => [
        'url' => 'ucitelia',
        'heading' => 'Učitelia',
        'link' => 'Učitelia'
    ],

    'students' => [
        'url' => 'studenti',
        'heading' => 'Študenti',
        'link' => 'Študenti'
    ],
];