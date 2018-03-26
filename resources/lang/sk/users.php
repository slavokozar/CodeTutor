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
        'message' => 'Naozaj si eláte vymazať užívateľa <strong>:name</strong> ?'
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
        'not-found' => 'Užívateľ s kódom <strong>:code</strong> neexistuje.',
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
        'no-teachers' => 'Táto skupina nemá žiadnych učiteľov.',
        'add-teachers' => 'Pridanie učiteľov do skupiny <strong>:group</strong>.',
        'no-students' => 'Táto skupina nemá žiadnych študentov.',
        'add-students' => 'Pridanie študentov do skupiny <strong>:group</strong>.',
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
        'no-admins' => 'Táto škola nemá žiadnych správcov.',
        'no-teachers' => 'Táto škola nemá žiadnych učiteľov.',
        'no-students' => 'Táto škola nemá žiadnych študentov.',
    ],

    'admins' => [
        'url' => 'spravcovia',
        'heading' => 'Správcovia',
        'link' => 'Správcovia',
        'create' => 'Vytvorenie správcu',
        'edit' => 'Úprava správcu',
        'add' => 'Pridanie správcu'
    ],

    'teachers' => [
        'url' => 'ucitelia',
        'heading' => 'Učitelia',
        'link' => 'Učitelia',
        'create' => 'Vytvorenie učiteľa',
        'edit' => 'Úprava učiteľa',
        'add' => 'Pridanie učiteľa'
    ],

    'students' => [
        'url' => 'studenti',
        'heading' => 'Študenti',
        'link' => 'Študenti',
        'create' => 'Vytvorenie študenta',
        'edit' => 'Úprava študenta',
        'add' => 'Pridanie študenta'
    ],
];