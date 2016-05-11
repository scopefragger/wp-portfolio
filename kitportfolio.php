<?php

/*
Plugin Name: Kit Portfolio
Description:
Version: 2.1.1
Author: Mark A Jones
Author Email: Mark@kitkode.co.uk
License:

  Copyright 2016 Mark A Jones

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


            if (file_exists(__DIR__ . '/classes/adminHandler.php')) {
                include(__DIR__ . '/classes/adminHandler.php');
                $admin = new AdminHandler();
            }




        } else {
            wp_enqueue_style('fancycss',
                get_site_url() . '/wp-content/plugins/kodeportfolio/css/hover.css');


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
