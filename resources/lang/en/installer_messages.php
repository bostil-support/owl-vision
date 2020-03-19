<?php

return [

    /**
     *
     * Shared translations.
     *
     */
    'title' => 'Laravel Installer',
    'next' => 'Next Step',
    'back' => 'Previous',
    'finish' => 'Install',
    'forms' => [
        'errorTitle' => 'The Following errors occurred:',
    ],

    /**
     *
     * Home page translations.
     *
     */
    'welcome' => [
        'templateTitle' => 'Welcome',
        'title'   => 'Laravel Installer',
        'message' => 'Easy Installation and Setup.',
        'next'    => 'Check Requirements',
    ],

    /**
     *
     * Requirements page translations.
     *
     */
    'requirements' => [
        'templateTitle' => 'Step 1 | Server Requirements',
        'title' => 'Server Requirements',
        'next'    => 'Check Permissions',
    ],

    /**
     *
     * Permissions page translations.
     *
     */
    'permissions' => [
        'templateTitle' => 'Step 2 | Permissions',
        'title' => 'Permissions',
        'next' => 'Configure Environment',
    ],

    /**
     *
     * Environment page translations.
     *
     */
    'environment' => [
        'templateTitle' => 'Step 3 | Environment Settings',
        'title' => 'Environment Settings',
        'tabs' => [
            'environment' => 'Environment',
            'database' => 'Database',
            'application' => 'Application',
            'admin' => 'Admin',
        ],
        'form' => [
            'name_required' => 'An environment name is required.',
            'app_name_label' => 'App Name',
            'app_name_placeholder' => 'App Name',
            'app_url_label' => 'App Url',
            'app_url_placeholder' => 'App Url',

            'db_connection_label' => 'Database Connection',
            'db_connection_label_mysql' => 'mysql',
            'db_connection_label_sqlite' => 'sqlite',
            'db_connection_label_pgsql' => 'pgsql',
            'db_connection_label_sqlsrv' => 'sqlsrv',
            'db_host_label' => 'Database Host',
            'db_host_placeholder' => 'Database Host',
            'db_port_label' => 'Database Port',
            'db_port_placeholder' => 'Database Port',
            'db_name_label' => 'Database Name',
            'db_name_placeholder' => 'Database Name',
            'db_username_label' => 'Database User Name',
            'db_username_placeholder' => 'Database User Name',
            'db_password_label' => 'Database Password',
            'db_password_placeholder' => 'Database Password',
            'db_sample_data_label' => 'With Sample Data',

            'admin_name' => 'Admin name',
            'admin_email' => 'Admin email',
            'admin_password' => 'Admin password',
            'admin_password_confirmation' => 'Confirm admin password',

            'buttons' => [
                'setup_database' => 'Setup Database',
                'setup_application' => 'Setup Application',
                'setup_admin' => 'Setup Admin',
                'install' => 'Install',
            ],
        ],
        'success' => 'Your .env file settings have been saved.',
        'errors' => 'Unable to save the .env file, Please create it manually.',
    ],

    'install' => 'Install',

    /**
     *
     * Installed Log translations.
     *
     */
    'installed' => [
        'success_log_message' => 'Laravel Installer successfully INSTALLED on ',
    ],

    /**
     *
     * Final page translations.
     *
     */
    'final' => [
        'title' => 'Installation Finished',
        'templateTitle' => 'Installation Finished',
        'finished' => 'Application has been successfully installed.',
        'migration' => 'Migration &amp; Seed Console Output:',
        'console' => 'Application Console Output:',
        'log' => 'Installation Log Entry:',
        'env' => 'Final .env File:',
        'exit' => 'Click here to exit',
    ],

    /**
     *
     * Update specific translations
     *
     */
    'updater' => [
        /**
         *
         * Shared translations.
         *
         */
        'title' => 'Laravel Updater',

        /**
         *
         * Welcome page translations for update feature.
         *
         */
        'welcome' => [
            'title'   => 'Welcome To The Updater',
            'message' => 'Welcome to the update.',
        ],

        /**
         *
         * Welcome page translations for update feature.
         *
         */
        'overview' => [
            'title'   => 'Overview',
            'message' => 'There is 1 update.|There are :number updates.',
            'install_updates' => "Install Updates"
        ],

        /**
         *
         * Final page translations.
         *
         */
        'final' => [
            'title' => 'Finished',
            'finished' => 'Application\'s database has been successfully updated.',
            'exit' => 'Click here to exit',
        ],

        'log' => [
            'success_message' => 'Laravel Installer successfully UPDATED on ',
        ],
    ],
];
