<?php

return [
    'url' => 'uzivatelia',

    'labels' => [
        'title' => 'Titul',
        'name' => 'Meno',
        'surname' => 'Priezvisko',
        'email' => 'Email',
        'roles' => 'Roly',
        'schools' => 'Školy',
        'group' => 'Skupina',
        'groups' => 'Skupiny',
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
            'TEACHER' => 'učiteľ',
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
        'share' => 'Celá škola'
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
        'add' => 'Pridanie študenta',
        'add-notification' => 'Študent <strong>:name</strong> bol úspešne pridaný do skupiny <strong>:group</strong>.|Študenti <strong>:name</strong> boli úspešne pridaní do skupiny <strong>:group</strong>.',
        'remove' => 'Odobranie študenta',
        'remove-confirm' => 'Naozaj si želáte odobrať užívateľa <strong>:name</strong> zo skupiny <strong>:group</strong> ?',
        'remove-notification' => 'Študent <strong>:name</strong> bol úspešne odobraný zo skupiny <strong>:group</strong>.|Študenti <strong>:name</strong> boli úspešne odobraní zo skupiny <strong>:group</strong>.',
    ],
];