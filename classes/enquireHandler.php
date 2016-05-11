<?php


class EnquireHandler
{
    function enquireAll($options = null)
    {

    }

    function enquireFancyBox($options)
    {

        if ($options['enablelightbox'] == 'yes') {
            if ($options['lightboxmode'] == 'fancybox') {
                wp_enqueue_script('fancybox',
                    get_site_url() . '/wp-content/plugins/kodeportfolio/fancybox/jquery.fancybox-1.3.4.pack.js',
                    array('jquery'));
                wp_enqueue_style('fancycss',
                    get_site_url() . '/wp-content/plugins/kodeportfolio/fancybox/jquery.fancybox-1.3.4.css');

                wp_enqueue_script(
                    'gofancybox',
                    get_site_url() . '/wp-content/plugins/kodeportfolio/fancybox/gofancy.js',
                    array('fancybox')
                );

            }
        }


    }

    function enquireAdmin()
    {

        wp_enqueue_script('sideTabs', get_site_url() . '/wp-content/plugins/kodeportfolio/js/common.js');
        wp_enqueue_script('spec', get_site_url() . '/wp-content/plugins/kodeportfolio/js/spec.js');
        wp_enqueue_style('fancycss', get_site_url() . '/wp-content/plugins/kodeportfolio/css/spec.css');
        wp_enqueue_style('admin', get_site_url() . '/wp-content/plugins/kodeportfolio/css/AdminLTE.css');
    }

}