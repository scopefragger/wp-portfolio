<?php
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