<?php

class CustomPortfolioPostType
{
    public function init()
    {

        $options = get_option('KitPortfolio_settings');
        $slug = $options['cuslug'];
        $name = $options['cunume'];
        if ($options['custom_post_type'] == "yes") {
            register_post_type($slug,
                array(
                    'labels' => array(
                        'name' => '' . $name . 's',
                        'singular_name' => '' . $name . '',
                        'add_new' => 'Add New',
                        'add_new_item' => 'Add New ' . $name . '',
                        'edit' => 'Edit',
                        'edit_item' => 'Edit ' . $name . '',
                        'new_item' => 'New ' . $name . '',
                        'view' => 'View',
                        'view_item' => 'View ' . $name . '',
                        'search_items' => 'Search ' . $name . 's',
                        'not_found' => 'No ' . $name . 's found',
                        'not_found_in_trash' => 'No ' . $name . 's found in Trash',
                        'parent' => 'Parent ' . $name . ''
                    ),
                    'rewrite' => array('slug' => $slug, 'with_front' => false),
                    'public' => true,
                    'capability_type' => 'post',
                    'hierarchical' => false,
                    'menu_position' => 15,
                    'supports' => array('title', 'editor', 'comments', 'thumbnail', 'custom-fields'),
                    'taxonomies' => array('category'),
                    'menu_icon' => plugins_url('images/image.png', __FILE__),
                    'has_archive' => true
                )
            );
            flush_rewrite_rules();
            add_action('add_meta_boxes', array($this, 'add_events_metaboxes'));
            add_action('save_post', array($this, 'wpt_save_events_meta'), 1, 2);
        }
    }

}