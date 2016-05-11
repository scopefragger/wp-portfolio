<?php


class EnquireHandler
{
    function enquireAll($options = null)
    {

        $this->enquireHoverCss();
        $this->enquireFancyBox($options);

    }

    function enquireFancyBox($options)
    {

        if ($options['enablelightbox'] == 'yes') {
            if ($options['lightboxmode'] == 'fancybox') {
                wp_enqueue_script('fancybox',
                    get_site_url() . '/wp-content/plugins/KitPortfolio/fancybox/jquery.fancybox-1.3.4.pack.js',
                    array('jquery'));
                wp_enqueue_style('fancycss',
                    get_site_url() . '/wp-content/plugins/KitPortfolio/fancybox/jquery.fancybox-1.3.4.css');

                wp_enqueue_script(
                    'gofancybox',
                    get_site_url() . '/wp-content/plugins/KitPortfolio/fancybox/gofancy.js',
                    array('fancybox')
                );

            }
        }


    }

    function enquireAdmin()
    {

        wp_enqueue_script('sideTabs', get_site_url() . '/wp-content/plugins/KitPortfolio/js/common.js');
        wp_enqueue_script('spec', get_site_url() . '/wp-content/plugins/KitPortfolio/js/spec.js');
        wp_enqueue_style('fancycss', get_site_url() . '/wp-content/plugins/KitPortfolio/css/spec.css');
        wp_enqueue_style('admin', get_site_url() . '/wp-content/plugins/KitPortfolio/css/AdminLTE.css');
    }

    function enquireHoverCss(){
        wp_enqueue_style('fancycss',
            get_site_url() . '/wp-content/plugins/KitPortfolio/css/hover.css');

    }

}