<?php

class loader
{
    function publicLoader()
    {
        wp_enqueue_style('masonCSS', get_site_url() . '/wp-content/plugins/kodeportfolio/css/kodeportfolio-public.css');
    }

    function adminLoader()
    {
        return true;
    }
}


?>