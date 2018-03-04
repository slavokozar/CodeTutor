<?php
/**
 * Created by PhpStorm.
 * User: Lukas Figura
 * Date: 11.02.16
 * Time: 15:37
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'phone'                 => 'Položka :attribute môže obsahovať číslice, medzery a znak plus.',
    'accepted'              => 'Položka :attribute musí byť akceptovaná.',
    'active_url'            => 'Položka :attribute nie je validné URL.',
    'after'                 => 'Položka :attribute musí byť dátum po :date.',
    'alpha'                 => 'Položka :attribute môže obsahovať iba písmená.',
    'alpha_dash'            => 'Položka :attribute môže obsahovať písmená, číslice a pomlčky.',
    'alpha_num_space'       => 'Položka :attribute môže obsahovať písmená, číslice a medzery.',
    'alpha_num_space_enter' => 'Položka :attribute môže obsahovať písmená, číslice, medzery a nový riadok.',
    'alpha_num'             => 'Položka :attribute môže obsahovať písmená a číslice.',
    'array'                 => 'Položka :attribute musí byť pole.',
    'before'                => 'Položka :attribute musí byť dátum pred :date.',
    'between'               => [
        'numeric' => 'Položka :attribute musí byť číslo medzi :min a :max.',
        'file'    => 'Súbor v položke :attribute musí mať veľkosť medzi :min a :max kB.',
        'string'  => 'Položka :attribute musí obsahovať minimálne :min a maximálne :max znakov.',
        'array'   => 'Položka :attribute musí obsahovať minimálne :min a maximálne :max prvkov v poli.',
    ],
    'boolean'               => 'Položka :attribute musí byť áno alebo nie.',
    'confirmed'             => 'Položka :attribute sa nezhoduje.',
    'date'                  => 'Položka :attribute nie je validný formát dátumu.',
    'date_format'           => 'Položka :attribute nesúhlasí s formátom dátumu "dd.mm.yyyy".',
    'different'             => 'Položky :attribute a :other musia byť rôzne.',
    'digits'                => 'Položka :attribute musí byť číslo s :digits číslicami.',
    'digits_between'        => 'Položka :attribute musí obsahovať minimálne :min a maximálne :max číslic.',
    'email'                 => 'Položka :attribute musí byť validná emailová adresa.',
    'exists'                => 'Vybraná položka :attribute je neplatná.',
    'filled'                => 'Položka :attribute je povinná.',
    'image'                 => 'Položka :attribute musí byť obrázok.',
    'in'                    => 'Vybraná položka :attribute je neplatná.',
    'integer'               => 'Položka :attribute musí byť celočíselná.',
    'ip'                    => 'Položka :attribute musí byť validná IP adresa.',
    'json'                  => 'Položka :attribute musí byť validný JSON.',
    'max'                   => [
        'numeric' => 'Položka :attribute nemôže byť vačšie číslo ako :max.',
        'file'    => 'Súbor v položke :attribute nemôže byť vačší ako :max kB.',
        'string'  => 'Položka :attribute nemôže obsahovat viac ako :max znakov.',
        'array'   => 'Položka :attribute nemôže obsahovať viac ako :max prvkov v poli.',
    ],
    'mimes'                 => 'Položka :attribute súbor typu: :values.',
    'min'                   => [
        'numeric' => 'Položka :attribute nemôže byť menšie číslo ako :min.',
        'file'    => 'Súbor v položke :attribute nemôže byť menší ako :min kB.',
        'string'  => 'Položka :attribute nemôže obsahovat menej ako :min znakov.',
        'array'   => 'Položka :attribute nemôže obsahovať menej ako :min prvkov v poli.',
    ],
    'not_in'                => 'Vybraná položka :attribute je neplatná.',
    'numeric'               => 'Položka :attribute musí byť číslo.',
    'regex'                 => 'Položka :attribute má neplatný formát.',
    'required'              => 'Táto položka je povinná.',
    'required_if'           => 'Položka :attribute je povinná ak :other je :value.',
    'required_with'         => 'Položka :attribute je povinná ak existuje :values.',
    'required_with_all'     => 'Položka :attribute je povinná ak existujú :values.',
    'required_without'      => 'Položka :attribute je povinná ak neexistuje :values.',
    'required_without_all'  => 'Položka :attribute je povinná ak neexistujú :values.',
    'same'                  => 'Položka :attribute a :other musia byť rovnaké.',
    'size'                  => [
        'numeric' => 'Položka :attribute musí mať :size číslic.',
        'file'    => 'Položka :attribute musí mať veľkosť :size kB.',
        'string'  => 'Položka :attribute musí obsahovať :size znakov.',
        'array'   => 'Položka :attribute musí obsahovať :size prvkov v poli.',
    ],
    'string'                => 'Položka :attribute musí byť reťazec znakov.',
    'timezone'              => 'Položka :attribute musí byť platná časová zóna.',
    'unique'                => 'Zadaná položka :attribute už existuje v našich záznamoch.',
    'url'                   => 'Položka :attribute musí byť validné URL.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'email'          => [
            'unique' => 'Zadaný email je už v systéme registrovaný.'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'message'        => 'správa',
        'start_date'     => 'dátum začiatku',
        'start_time'     => 'čas začiatku',
        'end_date'       => 'dátum konca',
        'end_time'       => 'čas konca',
        'price_start'    => 'počiatočná cena',
        'price_step'     => 'minimálne prihodenie',
        'description'    => 'popis',
        'paymentMethods' => 'platobné metódy',
        'category'       => 'kategória',

        'profile'            => 'používateľ',
        'name'            => 'meno',
        'surname'         => 'priezvisko',
        'news'            => 'novinky',
        'rules'           => 'podmienky',
        'email'           => 'email',
        'phone'           => 'telefón',
        'postal'          => 'PSČ',
        'psc'             => 'PSČ',
        'address'         => 'adresa',
        'street'          => 'adresa',
        'city'            => 'mesto',
        'state'           => 'štát',
        'password'        => 'heslo',
        'fax'             => 'fax',
        'title'           => 'nadpis',
        'info'            => 'popis',
        'nutrition'       => 'nutričné hodnoty',
        'code_product'    => 'kód produktu',
        'recipes'         => 'recepty',
        'deliveryName'    => 'dodacie meno',
        'deliverySurname' => 'dodacie priezvisko',
        'deliveryAddress' => 'dodacia adresa',
        'deliveryPsc'     => 'dodacie PSČ',
        'deliveryCity'    => 'dodacie mesto',
        'deliveryState'   => 'dodací štát',
        'ico'             => 'IČO',
        'dic'             => 'DIČ',
        'company'         => 'názov firmy',
        'icdph'           => 'IČ DPH',

        'currency' => 'mena',
        'username' => 'užívateľské meno',

        'address_name' => 'názov adresy',
        'address_info' => 'poznámka k adrese',

        'name_register'     => 'meno v registrácii',
        'surname_register'  => 'priezivsko v registrácii',
        'email_register'    => 'email v registrácii',
        'phone_register'    => 'telefón v registrácii',
        'password_register' => 'heslo v registrácii',

        'name_none'    => 'meno vo formulári bez registrácie',
        'surname_none' => 'priezivsko vo formulári bez registrácie',
        'email_none'   => 'email vo formulári bez registrácie',
        'phone_none'   => 'telefón vo formulári bez registrácie',

        "delivery_name"    => "meno v dodacej adrese",
        "delivery_surname" => "priezvisko v dodacej adrese",
        "delivery_street"  => "adresa dodania",
        "delivery_city"    => "mesto dodania",
        "delivery_state"   => "štát dodanie",
        "delivery_psc"     => "psč dodanie",
        "delivery_company" => "spoločnosť pre dodanie",
        "delivery_ico"     => "ičo spoločnosti pre dodanie",
        "delivery_dic"     => "dič spoločnosti pre dodanie",
        "delivery_icdph"   => "ič dph spoločnosti pre dodanie",
        "facture_street"   => "fakturačná adresa",
        "facture_city"     => "mesto fakturácie",
        "facture_state"    => "štát fakturácie",
        "facture_psc"      => "psč fakturácie",
        "facture_company"  => "spoločnosť pre fakturáciu",
        "facture_ico"      => "ičo pre fakturáciu",
        "facture_dic"      => "dič pre fakturáciu",
        "facture_icdph"    => "ič dph pre fakturáciu",
    ],

    'messages' => [
        'facebook' => [
            'not_correct' => 'Zadaný facebook profil nie je správny.',
            'url'         => 'Adresa na Váš facebook profil musí byť platná url.',
        ],
        'linkedin' => [
            'not_correct' => 'Zadaný LinkedIn profil nie je správny.',
            'url'         => 'Adresa na Váš facebook profil musí byť platná url.',
        ],
        'twitter'  => [
            'not_correct' => 'Zadaný twitter profil nie je správny.',
            'url'         => 'Adresa na Váš facebook profil musí byť platná url.',
        ],
        'myspace'  => [
            'not_correct' => 'Zadaný MySpace profil nie je správny.',
            'url'         => 'Adresa na Váš facebook profil musí byť platná url.',
        ],
        'bids'     => [
            'regex'               => 'Hodnota prihodenia musí byť číslo.',
            'required'            => 'Hodnota prihodenia je povinná.',
            'auction_not_started' => 'Bohužial aukcia ešte nezačala.',
            'min_price'           => 'Hodnota prihodenia musí byť aspoň',
        ],
        'category' => [
            'required' => 'Názov kategórie musí byť zadaný.',
            'exist'    => 'Kategória s týmto názvom už existuje.'
        ],
        'auctions' => [
            'correct_dates' => 'Dátum konca aukcie musí byť väčší ako dátum začiatku.',
        ],
        'password' => [
            'old_not_correct'         => 'Staré heslo nie je správne.',
            'admin_pass_least_prefix' => 'Administrátori musia mať heslo s najmenšou silou hesla:',
        ]
    ]
];