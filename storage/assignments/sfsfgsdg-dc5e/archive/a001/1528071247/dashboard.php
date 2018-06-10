<?php

return [

    'account-settings' => [
        'heading' => 'Account setting',
        'form'    => [
            'submit' => 'Submit',
            '1'      => [
                'heading' => 'New email address',
                'email'   => 'New email'
            ],
            '2'      => [
                'heading'  => 'Reset password',
                'password' => [
                    'old'       => 'Current password',
                    'new'       => 'New password',
                    'new-again' => 'Confirm password'
                ]
            ],
            '3'      => [
                'heading'    => 'Join our mailing list.',
                'newsletter' => 'We would love to send you occasional news about our exclusive offers and the latest info from CrowdAgency. You can unsubscribe any time.',
                'more'       => 'Find out more'
            ]
        ]
    ],

    'layout' => [
        'alert'      => [
            '1' => 'Your details are currently being inspected. You will be contacted soon.',
            '2' => 'You need to <a href="#" class="register-2">complete your registration</a> before you can start investing.'
        ],
        'details'    => [
            'resources' => [
                'available' => 'Available funds',
                'recharge'  => 'Add funds',
                'withdraw'  => 'Withdraw funds'
            ]
        ],
        'navigation' => [
            'show' => 'Zobrazit navigaci',
        ],
        'menu'       => [
            'portfolio'          => 'Your Investment Portfolio',
            'investment-details' => 'Your details',
            'account-history'    => 'Account history',
            'documents'          => 'Investment documents',
            'knowledge-center'   => 'Knowledge center',
            'tax-documents'      => 'Tax statements'
        ],
        'contact'    => [
            'heading' => 'Need assistance?',
            'texts'   => [
                '1' => 'Email us: <a href="mailto:ask@crowdagency.cz">ask@crowdagency.cz</a>',
                '2' => 'Call us: <b>+420 123 456 789</b>',
                '3' => '9:00 - 17:00, Monday - Friday'
            ]
        ]
    ],

    'index' => [
        'heading'    => 'Your account',
        'subheading' => 'Check how are your investments preforming.',
        'windows'    => [
            '1' => [
                'desc' => 'Investments made'
            ],
            '2' => [
                'desc' => 'Currently Invested'
            ],
            '3' => [
                'desc' => 'Totally Invested'
            ],
            '4' => [
                'desc' => 'Income Recieved'
            ]
        ]
    ],

    'investment-docs' => [
        'heading' => 'Investment documents',
    ],

    'tax-docs' => [
        'heading' => 'Tax statements',
    ],

    'knowledge-center' => [
        'heading' => 'Knowledge center',
    ],

    'account-history' => [
        'heading' => 'Account history',
        'table'   => [
            'date'        => 'Date',
            'transaction' => 'Transaction Description',
            'amount'      => 'Amount',
            'balance'     => 'Balance',
            'deposit'     => 'Funds added'
        ]
    ],

    'investment-portfolio' => [
        'heading' => 'Your portfolio',
        'nav'     => [
            '1' => 'Open investment',
            '2' => 'Pending investment',
            '3' => 'Closed investment',
        ],
        'table'   => [
            'name'            => 'Project name',
            'amount'          => 'Invested funds',
            'interest-income' => 'Interest yield',
            'capital-income'  => 'Capital yield'
        ]
    ],

    'investment-details' => [
        'layout'            => [
            'heading'      => 'My details',
            'member-since' => 'Member since'
        ],
        'navigation'        => [
            'personal'     => 'Personal Info',
            'contact'      => 'Contact Info',
            'credentials'  => 'Personal docuemnts',
            'banking-info' => 'Bank account details'
        ],
        'sms-control'       => [
            'heading' => 'SMS Verification',
            'no-way'  => 'Fill in all the information first please',
            'text'    => [
                '1' => 'A verification code was send to the phone number :phone',
                '2' => 'Please insert the verification code and submit your details to our inspection.'
            ],
            'form'    => [
                'code'         => [
                    '1'    => 'Verification code',
                    '2'    => 'Please insert your verification code.',
                    'new'  => 'New code',
                    'sent' => 'New code was sent'
                ],
                'notification' => 'Your details were successfully send to the CrowdAgency team and are currently being inspected. You will be contacted soon.',
                'submit'       => 'Submit'
            ]
        ],
        'save-and-continue' => 'Save changes and move to the next step',
        'save'              => 'Save changes',
        'finish'            => 'Complete your registration',
        'personal'          => [
            'name'        => 'First Name',
            'surname'     => 'Last Name',
            'phone'       => 'Phone number',
            'birthdate'   => 'Date of birth',
            'sex'         => [
                'label'   => 'Sex',
                'options' => [
                    'default' => 'Choose',
                    'male'    => 'Male',
                    'female'  => 'Female'
                ]
            ],
            'id'          => 'Date of birth',
            'birthplace'  => [
                'label'   => 'Place of birth',
                'options' => [
                    'default' => 'Choose your country'
                ]
            ],
            'citizenship' => [
                'label'   => 'Citizenship',
                'options' => [
                    'default' => 'Choose your country'
                ]
            ],
            'completed'   => [
                'text' => [
                    '1' => 'To change these details plaese contact the CrowdAgency team.',
                    '2' => 'Change your bank account'
                ]
            ],
            'pending'     => 'Your details are currently being inspected. You will be contacted soon.'
        ],

        'contact' => [
            'phone'     => 'Phone number',
            'address'   => [
                'home'           => 'Permanent residence',
                'correspondence' => 'Contact address',
                'same'           => 'The same as permanent',
                'street'         => 'Street',
                'number'         => 'Number',
                'city'           => 'City',
                'zip'            => 'ZIP code',
                'state'          => [
                    'label'   => 'Country',
                    'options' => [
                        'default' => 'Choose your country'
                    ]
                ]
            ],
            'completed' => [
                'text' => [
                    '1' => 'To change these details plaese contact the CrowdAgency team.',
                    '2' => 'Change your bank account'
                ]
            ],
            'pending'   => 'Your details are currently being inspected. You will be contacted soon.'
        ],

        'credentials' => [
            'files'     => [
                '1'     => 'Document #1',
                '2'     => 'Document #2',
                'front' => 'Front side',
                'back'  => 'Back side'
            ],
            'text'      => [
                '1' => 'Please upload the scans in a high quality PDF or JPG format',
                '2' => 'We ask you to upload these documents to verify your identy and meet our regulatory requirements. 
                        To proof your identiy you can provide us with your ID, driving licence or passport. 
                         <a href="{{ action(\'UserController@knowledge\') }}" target="_blank" rel="noopener">Find out more how your personal information is protected.</a>'
            ],
            'completed' => [
                'text' => [
                    '1' => 'To change these details plaese contact the CrowdAgency team.',
                    '2' => 'Change your bank account'
                ]
            ],
            'pending'   => 'Your details are currently being inspected. You will be contacted soon.'
        ],

        'banking-info' => [
            'prefix'         => 'Prefix',
            'bank-code'      => 'Routing number',
            'account-number' => 'Bank account number',
            'file'           => [
                '1' => 'Please upload a printscreen of the preview of your bank account.',
                '2' => 'Bank account statement'
            ],
            'confirmation'   => 'I confirm I am the owner of this bank account.',
            'printscreen'    => [
                '1' => 'Printscreen serves for your identification and is required to meet our regulatory requirements. 
                        For your identification is sufficient to upload a part of your bank account statement, where the bank
                        account number and your name is visible. We definitely do not need the history and balance of your bank account.',
                '2' => 'Find out more'
            ],
            'residence'      => [
                'label'   => 'Tax residency',
                'options' => [
                    'default' => 'Choose your country'
                ]
            ],
            'completed'      => [
                'heading' => 'Your bank account number',
                'text'    => [
                    '1' => 'To change these details plaese contact the CrowdAgency team.',
                    '2' => 'Change your bank account'
                ]
            ],
            'pending'        => 'Your details are currently being inspected. You will be contacted soon.'
        ]

    ]

];
