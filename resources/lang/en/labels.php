<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all'     => 'All',
        'yes'     => 'Yes',
        'no'      => 'No',
        'copyright' => 'Copyright',
        'custom'  => 'Custom',
        'actions' => 'Actions',
        'active'  => 'Active',
        'buttons' => [
            'save'   => 'Save',
            'update' => 'Update',
        ],
        'hide'              => 'Hide',
        'inactive'          => 'Inactive',
        'none'              => 'None',
        'show'              => 'Show',
        'toggle_navigation' => 'Toggle Navigation',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create'     => 'Create Role',
                'edit'       => 'Edit Role',
                'management' => 'Role Management',

                'table' => [
                    'number_of_users' => 'Number of Users',
                    'permissions'     => 'Permissions',
                    'role'            => 'Role',
                    'sort'            => 'Sort',
                    'total'           => 'role total|roles total',
                ],
            ],
            'wallet' => [
                'create'     => 'Create Wallet',
                'edit'       => 'Edit Wallet',
                'management' => 'Wallet Management',

                'table' => [
                    'public_key'        => 'Wallet Public Key',
                    'private_key'        => 'Wallet Private Key',
                    'address'           => 'Wallet Address',
                    'coin'              => 'Coin Name',
                    'sort'              => 'Sort',
                    'total'             => 'Wallet total|Wallet total',
                ],
            ],
            'blogs' => [
                'create'     => 'Create Blog',
                'edit'       => 'Edit Blog',
                'management' => 'Blog Management',

                'table' => [
                    'blog_heading'        => 'Blog Heading',
                    'blog_sub_heading'        => 'Blog Sub Heading',
                    'blog_text'           => 'Blog Text',
                   
                ],
            ],
            'affiliates' => [
                'create'     => 'Create Affiliate',
                'edit'       => 'Edit Affiliate',
                'management' => 'Affiliate Management',

                'table' => [
                    'affiliate_percentage'        => 'Affiliate Amount',
                    'amount_symbol'        => 'Affiliate Symbol',
                    'minimum_amount'        => 'Affiliate Minimum Amount To Get Paid'
                ],
            ],
            'pages' => [
                'create'     => 'Create Page',
                'edit'       => 'Edit Page',
                'management' => 'Page Management',

                'table' => [
                    'name'        => 'Page Name',
                    'slug'           => 'Page Slug',
                    'total'             => 'Page total|Page total',
                ],
            ],
            'funds' => [
                'create'     => 'Create Fund',
                'edit'       => 'Edit Fund',
                'management' => 'Funds Transfer Management',

                'table' => [
                    'date'              => 'Date',
                    'from_address'      => 'From Address',
                    'to_address'        => 'To Address',
                    'status'            => 'Status',
                    'balance'           => 'Balance',
                    'coin'              => 'Coin',
                    'total'             => 'Page total|Page total',
                ],
            ],
            'stats' => [
                'create'     => 'Create Page',
                'edit'       => 'Page Wallet',
                'management' => 'Site Statistics Management',

                'table' => [
                    'name'        => 'Page Name',
                    'slug'           => 'Page Slug',
                    'total'             => 'Page total|Page total',
                ],
            ],
            'payments' => [
                'create'     => 'Create Payment',
                'edit'       => 'Edit Payment',
                'management' => 'Payment Management',

                'table' => [
                    'name'        => 'Payment Method name',
                    'description'           => 'Payment Method description'
                ],
            ],
            'settings' => [
                'create'     => 'Create Settings',
                'edit'       => 'Edit Settings',
                'management' => 'Settings Management',

                'table' => [
                    'name'        => 'Name',
                    'meta_key'           => 'Meta Key Name',
                    'meta_value'              => 'Value',
                    'sort'              => 'Sort',
                    'total'             => 'Wallet total|Wallet total',
                ],
            ],
            'localcoins' => [
                'create'     => 'Create Localcoin',
                'edit'       => 'Edit Localcoin',
                'management' => 'Localcoins Management',

                'table' => [
                    'name'        => 'Name',
                    'short_name'           => 'Short Name',
                    'creator_percentage'              => 'Creator Percentage',
                    'taker_percentage'              => 'Taker Percentage',
	                'unit_name'=>'Unit Name',
	                'unit_value'=>'Unit Value',
                    'total'             => 'Exchange Rate total|Exchange Rate total',
                ],
            ],
            'rewards' => [
                'create'     => 'Create Reward',
                'edit'       => 'Reward Localcoin',
                'management' => 'Rewards Management',

                'table' => [
                    'name'        => 'Name',
                    'short_name'           => 'Short Name',
                    'creator_percentage'              => 'Creator Percentage',
                    'taker_percentage'              => 'Taker Percentage',
                    'unit_name'=>'Unit Name',
                    'unit_value'=>'Unit Value',
                    'total'             => 'Exchange Rate total|Exchange Rate total',
                ],
            ],
            'exchange' => [
                'create'     => 'Create Exchange Rate',
                'edit'       => 'Edit Exchange Rate',
                'management' => 'Exchange Rate Management',

                'table' => [
                    'api_name'        => 'Api Name',
                    'token_code'           => 'Token Code',
                    'currency'              => 'Currency',
                ],
            ],
            'dispute' => [
                'create'     => 'Create Dispute',
                'edit'       => 'Edit Dispute',
                'management' => 'Dispute Management',

                'table' => [
                    'name'        => 'Group Name',
                    
                ],
            ],
            'users' => [
                'active'              => 'Active Users',
                'all_permissions'     => 'All Permissions',
                'change_password'     => 'Change Password',
                'change_password_for' => 'Change Password for :user',
                'create'              => 'Create User',
                'deactivated'         => 'Deactivated Users',
                'deleted'             => 'Deleted Users',
                'edit'                => 'Edit User',
                'management'          => 'User Management',
                'no_permissions'      => 'No Permissions',
                'no_roles'            => 'No Roles to set.',
                'permissions'         => 'Permissions',
                'gender'                    => 'Gender',
                'table' => [
                    'confirmed'      => 'Confirmed',
                    'created'        => 'Created',
                    'email'          => 'E-mail',
                    'username'          => 'User Name',
                    'id'             => 'ID',
                    'last_updated'   => 'Last Updated',
                    'name'           => 'Name',
                    'first_name'     => 'First Name',
                    'last_name'      => 'Last Name',
                    'gender'                    => 'Gender',
                    'no_deactivated' => 'No Deactivated Users',
                    'no_deleted'     => 'No Deleted Users',
                    'other_permissions' => 'Other Permissions',
                    'permissions' => 'Permissions',
                    'roles'          => 'Roles',
                    'social' => 'Social',
                    'total'          => 'user total|users total',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Overview',
                        'history'  => 'History',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar'       => 'Avatar',
                            'confirmed'    => 'Confirmed',
                            'created_at'   => 'Created At',
                            'deleted_at'   => 'Deleted At',
                            'email'        => 'E-mail',
                            'last_updated' => 'Last Updated',
                            'name'         => 'Name',
                            'first_name'   => 'First Name',
                            'last_name'    => 'Last Name',
                            'status'       => 'Status',
                        ],
                    ],
                ],

                'view' => 'View User',
            ],
        ],
    ],

    'frontend' => [

        'auth' => [
            'login_box_title'    => 'Login',
            'login_button'       => 'Login',
            'login_with'         => 'Login with :social_media',
            'register_box_title' => 'Register',
            'register_button'    => 'GENERATE KEYS & SIGN UP',
            'remember_me'        => 'Remember Me',
        ],

        'contact' => [
            'box_title' => 'Contact Us',
            'button' => 'Send Information',
        ],

        'passwords' => [
            'expired_password_box_title' => 'Your password has expired.',
            'forgot_password'                 => 'Forgot Your Password?',
            'reset_password_box_title'        => 'Reset Password',
            'reset_password_button'           => 'Reset Password',
            'update_password_button'           => 'Update Password',
            'send_password_reset_link_button' => 'Send Password Reset Link',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Change Password',
            ],

            'profile' => [
                'avatar'             => 'Avatar',
                'created_at'         => 'Created At',
                'edit_information'   => 'Edit Information',
                'email'              => 'E-mail',
                'last_updated'       => 'Last Updated',
                'name'               => 'Name',
                'first_name'         => 'First Name',
                'last_name'          => 'Last Name',
                'update_information' => 'Update Information',
            ],
        ],

    ],
];
