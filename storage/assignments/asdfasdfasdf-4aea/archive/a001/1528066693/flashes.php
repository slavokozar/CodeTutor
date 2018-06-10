<?php

return [

    'Admin\Blog\ArticleController' => [
        'toggleHidden' => [
            'success' => 'Viditelnost článku úspěšně změněna',
        ],
    ],

    'Auth\LoginController' => [
        'sendLoginResponse' => [
            'success' => 'Úspěšné přihlásení',
        ],
        'logout'            => [
            'success' => 'Úspěšné odhlášení',
        ],
    ],

    'UserController' => [
        'postRegistrationControlSubmit' => [
            'success' => 'Váš účet byl úspěšne odeslán na kontrolu administrátorovi.',
            'invalid' => 'Bohužel kód, který se zadal je neplatný.',
        ],
        'confirmEmailChange'            => [
            'error'   => 'Daný link už není platný',
            'success' => 'Úspěšná změna emailu'
        ],
        'changeEmail'                   => [
            'success' => 'Na Váš původní email byl zaslán potvrzovací odkaz'
        ],
        'changePassword'                => [
            'success' => 'Heslo úspěšně změněno'
        ],
        'updateGeneralSettings'         => [
            'success' => 'Nastavení úspěšně změněno'
        ]
    ],

    'Auth\RegisterController' => [
        'confirm' => [
            'success' => 'Úspěšné potvrzení registrace',
            'error'   => 'Daný odkaz už není platný'
        ]
    ]

];
