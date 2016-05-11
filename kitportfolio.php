<?php

/*
Plugin Name: Kode Portfolio
Plugin URI: http://kodedigital.co.uk
Description:
Version: 2.1.1
Author: Mark A Jones
Author Email: mark@bmkdigital.co.uk
License:

  Copyright 2011 Mark A Jones (mark@bmkdigital.co.uk)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

class Kitportfolio
{

    public function init()
    {

        if (function_exists('get_option')) {
            $options = get_option('KodePortfolio_settings');
        } else {
        }

        $this->fetch();
        $loader = new loader();
        $loader->publicLoader();
        $short = new Short();
        $short->publicShortCode();

        add_action('init', array($this, 'createPostTypeX'));

        if (is_admin()) {
            if (file_exists(__DIR__ . '/plugin-updates/plugin-update-checker.php')) {
                include(__DIR__ . '/plugin-updates/plugin-update-checker.php');
                $ExampleUpdateChecker = \PucFactory::buildUpdateChecker(
                    'http://portfolio.bmkdigital.co.uk/portfolio.json',
                    __FILE__
                );
            }
            if (file_exists(__DIR__ . '/admin/admin.php')) {
                include_once(__DIR__ . '/admin/admin.php');
            }

            if (file_exists(__DIR__ . '/wsg.php')) {
                include_once(__DIR__ . '/wsg.php');
            }

            if ($options['jquery'] == "yes") {
                wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-1.11.3.min.js');
            }
            if ($options['jqueryui'] == "yes") {
                wp_enqueue_script('jqueryui', 'http://code.jquery.com/ui/1.9.1/jquery-ui.js', array('jquery'));
            }
            wp_enqueue_script('sideTabs', get_site_url() . '/wp-content/plugins/kodeportfolio/js/common.js');
            wp_enqueue_script('spec', get_site_url() . '/wp-content/plugins/kodeportfolio/js/spec.js');
            wp_enqueue_style('fancycss', get_site_url() . '/wp-content/plugins/kodeportfolio/css/spec.css');
            wp_enqueue_style('admin', get_site_url() . '/wp-content/plugins/kodeportfolio/css/AdminLTE.css');


        } else {
            wp_enqueue_style('fancycss',
                get_site_url() . '/wp-content/plugins/kodeportfolio/css/hover.css');


        }


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



    function add_events_metaboxes()
    {
        $options = get_option('KodePortfolio_settings');
        $slug = $options['cuslug'];
        add_meta_box('wpt_events_location', 'Youtube Video ID', array($this, 'wpt_events_location'), $slug, 'side',
            'default');
        add_meta_box('wpt_over_ide', 'Override URL', array($this, 'wpt_over_ide'), $slug, 'side',
            'default');


    }


    function wpt_events_location()
    {


        global $post;

        echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
        $youtube = get_post_meta($post->ID, '_youtube', true);
        echo '<input type="text" name="_youtube" value="' . $youtube . '" class="widefat" />';


    }

    function wpt_over_ide()
    {


        global $post;

        echo '<input type="hidden" name="eventmeta_noncenameoveride" id="eventmeta_noncenameoveride" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
        $youtube = get_post_meta($post->ID, '_overide', true);
        echo '<input type="text" name="_overide" value="' . $youtube . '" class="widefat" />';


    }

    function wpt_save_events_meta($post_id, $post)
    {

        if (!wp_verify_nonce($_POST['eventmeta_noncename'], plugin_basename(__FILE__))) {
            return $post->ID;
        }
        if (!current_user_can('edit_post', $post->ID)) {
            return $post->ID;
        }
        $events_meta['_youtube'] = $_POST['_youtube'];
        foreach ($events_meta as $key => $value) {
            if ($post->post_type == 'revision') {
                return;
            }
            $value = implode(',', (array)$value);
            if (get_post_meta($post->ID, $key, false)) {
                update_post_meta($post->ID, $key, $value);
            } else {
                add_post_meta($post->ID, $key, $value);
            }
            if (!$value) {
                delete_post_meta($post->ID, $key);
            }
        }


        if (!wp_verify_nonce($_POST['eventmeta_noncenameoveride'], plugin_basename(__FILE__))) {
            return $post->ID;
        }
        if (!current_user_can('edit_post', $post->ID)) {
            return $post->ID;
        }
        $overide['_overide'] = $_POST['_overide'];
        foreach ($overide as $key => $value) {
            if ($post->post_type == 'revision') {
                return;
            }
            $value = implode(',', (array)$value);
            if (get_post_meta($post->ID, $key, false)) {
                update_post_meta($post->ID, $key, $value);
            } else {
                add_post_meta($post->ID, $key, $value);
            }
            if (!$value) {
                delete_post_meta($post->ID, $key);
            }
        }

    }


    /**
     * @param $error
     */
    function fetch($error)
    {
        if (file_exists(__DIR__ . '/src/loader.php')) {
            include(__DIR__ . '/src/loader.php');
        } else {
            $error->writeToLog('/src/loader.php Missing and could not be loaded');
        }

        if (file_exists(__DIR__ . '/src/Short.php')) {
            include(__DIR__ . '/src/Short.php');
        } else {
            if (file_exists(__DIR__ . '/src/short.php')) {
                include(__DIR__ . '/src/short.php');
            } else {
                $error->writeToLog('/src/Short.php Missing and could not be loaded');
            }
        }

    }


    /**
     * @return int
     */
    public function getCols()
    {
        return $this->cols;
    }

    /**
     * @param int $cols
     */
    public function setCols($cols)
    {
        $this->cols = $cols;
    }

}

$KodePortfolio = new Kitportfolio();
add_action('plugins_loaded', array($KodePortfolio, 'init'));

?>
