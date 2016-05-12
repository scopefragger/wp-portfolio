<?php


class AdminHandler
{

    public function __construct()
    {

        /**
         * Include the plugin updater
         */
        if (file_exists(__DIR__ . '/plugin-updates/plugin-update-checker.php')) {
            include(__DIR__ . '/plugin-updates/plugin-update-checker.php');
            $ExampleUpdateChecker = \PucFactory::buildUpdateChecker(
                'http://portfolio.bmkdigital.co.uk/portfolio.json',
                __FILE__
            );
        }


        /**
         * Include the admin page
         */
        if (file_exists(__DIR__ . '/../admin/admin.php')) {
            include_once(__DIR__ . '/../admin/admin.php');
        }


        /**
         * Include the admin Page Class Loader
         */
        if (file_exists(__DIR__ . '/../wsg.php')) {
            include_once(__DIR__ . '/../wsg.php');
        }


        /**
         * Enquire the bits we need for the admin pages
         */
        require_once(__DIR__ . '/enquireHandler.php');
        $enquireHandler = new EnquireHandler();
        $enquireHandler->enquireAdmin();

    }

}