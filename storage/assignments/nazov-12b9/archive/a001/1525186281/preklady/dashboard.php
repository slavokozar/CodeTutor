<?php

return [

    'account-settings' => [
        'heading' => 'Nastavení účtu',
        'form'    => [
            'submit' => 'Změnit',
            '1'      => [
                'heading' => 'Změna emailu',
                'email'   => 'Nový email'
            ],
            '2'      => [
                'heading'  => 'Změna hesla',
                'password' => [
                    'old'       => 'Staré heslo',
                    'new'       => 'Nové heslo',
                    'new-again' => 'Znovu nové heslo'
                ]
            ],
            '3'      => [
                'heading'    => 'Všeobecná nastavení',
                'newsletter' => 'Souhlasím se zasíláním informací o nových příležitostech a newsletter na Platformě CrowdLand.',
                'more'       => 'Zjistěte více'
            ]
        ]
    ],

    'layout' => [
        'alert'      => [
            '1' => 'Vaše údaje byly úspěšně odeslány ke kontrole. Brzy Vás bude kontaktovat člen našeho týmu',
            '2' => 'Musíte <a href="#" class="register-2">dokončit svou registraci</a> předtím než budete moci vložit finanční prostředky a začít investovat'
        ],
        'details'    => [
            'resources' => [
                'available' => 'Dostupné prostředky',
                'recharge'  => 'Doplnit prostředky',
                'withdraw'  => 'Vybrat prostředky'
            ]
        ],
        'navigation' => [
            'show' => 'Zobrazit navigaci',
        ],
        'menu'       => [
            'portfolio'          => 'Investiční portfólio',
            'investment-details' => 'Údaje pro investování',
            'account-history'    => 'Historie účtu',
            'documents'          => 'Investiční dokumenty',
            'knowledge-center'   => 'Knowledge center',
            'tax-documents'      => 'Daňové dokumenty'
        ],
        'contact'    => [
            'heading' => 'Potřebujete pomoci?',
            'texts'   => [
                '1' => 'Napište nám na: <a href="mailto:ask@crowdagency.cz">ask@crowdagency.cz</a>',
                '2' => 'Zavolejte nám na: <b>+420 123 456 789</b>',
                '3' => '9:00 - 17:00, Pondělí - Pátek'
            ]
        ]
    ],

    'index' => [
        'heading'    => 'Váš Účet',
        'subheading' => 'Zkontrolujte jak se Vám Vaše investice zhodnocují',
        'windows'    => [
            '1' => [
                'desc' => 'Uskutečněných Investic'
            ],
            '2' => [
                'desc' => 'Uskutečněných Investic'
            ],
            '3' => [
                'desc' => 'Celkem Investováno'
            ],
            '4' => [
                'desc' => 'Získaný příjem'
            ]
        ]
    ],

    'investment-docs' => [
        'heading' => 'Investiční dokumenty',
    ],

    'tax-docs' => [
        'heading' => 'Daňové dokumenty',
    ],

    'knowledge-center' => [
        'heading' => 'Knowledge center',
    ],

    'account-history' => [
        'heading' => 'Historie účtu',
        'table'   => [
            'date'        => 'Datum',
            'transaction' => 'Popis transakce',
            'amount'      => 'Částka',
            'balance'     => 'Zůstatek',
            'deposit'     => 'Doplnění prostředků - Vklad'
        ]
    ],

    'investment-portfolio' => [
        'heading' => 'Vaše portfolio',
        'nav'     => [
            '1' => 'Otevřené investice',
            '2' => 'Čekajíci investice',
            '3' => 'Uzavřené investice',
        ],
        'table'   => [
            'name'            => 'Název projektu',
            'amount'          => 'Investovaná částka',
            'interest-income' => 'Úrokový výnos',
            'capital-income'  => 'Kapitálový výnos'
        ]
    ],

    'investment-details' => [
        'layout'            => [
            'heading'      => 'Mé údaje a nastavení',
            'member-since' => 'členem od'
        ],
        'navigation'        => [
            'personal'     => 'Osobní údaje',
            'contact'      => 'Kontaktní údaje',
            'credentials'  => 'Osobní doklady',
            'banking-info' => 'Bankovní spojení'
        ],
        'sms-control'       => [
            'heading' => 'Ověření sms',
            'no-way'  => 'Nejdřív vyplňte všechny údaje, prosím.',
            'text'    => [
                '1' => 'Na telefónni číslo :phone Vám byla zaslaná textová správa, která obsahuje potvrzovací kód.',
                '2' => 'Prosím vložte kód do políčka níže a potvrďte odesláni Vašich údajů ke kontrole.'
            ],
            'form'    => [
                'code'         => [
                    '1'    => 'Potvrzovací kód',
                    '2'    => 'Prosím vložte svůj potvrzovací kód.',
                    'new'  => 'Nový kód',
                    'sent' => 'Nový kód byl odeslán'
                ],
                'notification' => 'Vaše ůdaje boli úspěšně zaslané na povtrzení administrátorem. O stavu Vás budeme informovat prostředníctvím emailu.',
                'submit'       => 'Odeslat'
            ]
        ],
        'save-and-continue' => 'Uložit změny a přejít na další krok',
        'save'              => 'Uložit změny',
        'finish'            => 'Dokončit registraci',
        'personal'          => [
            'name'        => 'Jméno',
            'surname'     => 'Příjmení',
            'phone'       => 'Telefonní číslo',
            'birthdate'   => 'Datum narození',
            'sex'         => [
                'label'   => 'Pohlaví',
                'options' => [
                    'default' => 'Vyberte',
                    'male'    => 'Muž',
                    'female'  => 'Žena'
                ]
            ],
            'id'          => 'Rodné číslo',
            'birthplace'  => [
                'label'   => 'Místo narození',
                'options' => [
                    'default' => 'Vyberte zemi'
                ]
            ],
            'citizenship' => [
                'label'   => 'Státní příslušnost',
                'options' => [
                    'default' => 'Vyberte zemi'
                ]
            ],
            'completed'   => [
                'text' => [
                    '1' => 'Pro změnu údajů kontaktujte, prosím, administrátora',
                    '2' => 'Změnit bankovní účet'
                ]
            ],
            'pending'     => 'Čeká se na posouzení registrace administrátorem'
        ],

        'contact' => [
            'phone'     => 'Telefonní číslo',
            'address'   => [
                'home'           => 'Trvalé bydliště',
                'correspondence' => 'Korespondenční adresa',
                'same'           => 'Stejná jako trvalá',
                'street'         => 'Ulice',
                'number'         => 'Číslo',
                'city'           => 'Město',
                'zip'            => 'PSČ',
                'state'          => [
                    'label'   => 'Stát',
                    'options' => [
                        'default' => 'Vyberte zemi'
                    ]
                ]
            ],
            'completed' => [
                'text' => [
                    '1' => 'Pro změnu údajů kontaktujte, prosím, administrátora',
                    '2' => 'Změnit bankovní účet'
                ]
            ],
            'pending'   => 'Čeká se na posouzení registrace administrátorem'
        ],

        'credentials' => [
            'files'     => [
                '1'     => 'Doklad č. 1',
                '2'     => 'Doklad č. 2',
                'front' => 'Přední strana dokladu',
                'back'  => 'Zadní strana dokladu'
            ],
            'text'      => [
                '1' => 'Dokumenty nahrajte prosím ve formátu PDF, či JPG',
                '2' => 'Nahrání dokladů slouží k Vaší identifikaci a je vyžadováno na základě Zákona
                                proti praní špinavých peněz. Jako doklad identifikující Vaši totožnost
                                slouží občanský průkaz, řidičský průkaz či pas. <a href="{{ action(\'UserController@knowledge\') }}" target="_blank" rel="noopener">Zjistěte více
                                    ochraně Vašich údajů</a>'
            ],
            'completed' => [
                'text' => [
                    '1' => 'Pro změnu údajů kontaktujte, prosím, administrátora',
                    '2' => 'Změnit bankovní účet'
                ]
            ],
            'pending'   => 'Čeká se na posouzení registrace administrátorem'
        ],

        'banking-info' => [
            'prefix'         => 'Předčíslí',
            'bank-code'      => 'Kód banky',
            'account-number' => 'Číslo bankovího účtu',
            'file'           => [
                '1' => 'Nahrajte printscreen hlavičky Vašeho bankovního účtu',
                '2' => 'Výpis z účtu'
            ],
            'confirmation'   => 'Potvrzuji, že jsem majitelem výše uvedeného bankovního účtu',
            'printscreen'    => [
                '1' => 'Printscreen slouží k Vaší identifikaci a je vyžadováno na základě Zákona
                                proti praní špinavých peněz. Pro Vaši identifikaci stačí nahrání části
                                výpisu, kde bude viditelné číslo Vašeho bankovního účtu a Vaše jméno.
                                Zůstatek a pohyby nejsou zapotřebí.',
                '2' => 'Zjistěte více'
            ],
            'residence'      => [
                'label'   => 'Daňová rezidence',
                'options' => [
                    'default' => 'Vyberte zemi'
                ]
            ],
            'completed'      => [
                'heading' => 'Číslo Vašeho bankovního účtu',
                'text'    => [
                    '1' => 'Pro změnu údajů kontaktujte, prosím, administrátora',
                    '2' => 'Změnit bankovní účet'
                ]
            ],
            'pending'        => 'Čeká se na posouzení registrace administrátorem'
        ]

    ]

];
