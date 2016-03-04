<?php

class PortfiloCore
{
    public $listOfCat = [];

    function __construct()
    {

    }

    function init($parentCat, $options)
    {
        $siteUrl = site_url();
        $output = "";
        wp_enqueue_script('iosJS', $siteUrl . '/wp-content/plugins/kodeportfolio/js/iso.js');
        include(__DIR__ . '/portfolioGenerator.php');
        $common = new PortfolioGenerator($options);
        $output .= $common->buildCss();
        $output .= $common->HandlePosts(false, $parentCat);
        $output .= $common->buildPost();
        $common->buildJS($options);

        return $output;
    }


}
