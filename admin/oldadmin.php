<?php
add_action('admin_menu', 'KodePortfolio_add_admin_menu');
add_action('admin_init', 'KodePortfolio_settings_init');


function KodePortfolio_add_admin_menu()
{

    add_menu_page('KodePortfolio', 'KodePortfolio', 'manage_options', 'kodeportfolio', 'kodeportfolio_options_page');

}


function KodePortfolio_settings_init()
{

    register_setting('pluginPage', 'KodePortfolio_settings');


}


function KodePortfolio_options_page()
{
    $options = get_option('KodePortfolio_settings');
    ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" >

    <form action='options.php' method='post' >
        <h2 >KodePortfolio</h2 >


        <h3>Custom Post Type</h3>

        <div class="col-md-12" >
            <div class="col-md-4" >
                <b>Use Custom Post type</b>
            </div >
            <div class="col-md-4" >
                <select name='KodePortfolio_settings[custom_post_type]' class="form-control" >
                    <option ><?php echo $options['custom_post_type']; ?></option >
                    <option >Yes</option >
                    <option >No</option >
                </select >
            </div >

            <div class="col-md-4" >
                Enable a custom post type to read from for the portfolio plugin
            </div >
        </div >


        <div class="col-md-12" >
            <div class="col-md-4" >
                <b>Post Type Slug</b>
            </div >
            <div class="col-md-4" >
                <?php if($options['cuslug']==""){$options['cuslug']="portfolio";} ?>
                <input name='KodePortfolio_settings[cuslug]' class="form-control" value="<?php echo $options['cuslug']; ?>">
            </div >

            <div class="col-md-4" >
                Used In the backend and URLs ,  No spaces Allowed
            </div >
        </div >

        <div class="col-md-12" >
            <div class="col-md-4" >
                <b>Post Type Name</b>
            </div >
            <div class="col-md-4" >
                <?php if($options['cunume']==""){$options['cunume']="portfolio";} ?>
                <input name='KodePortfolio_settings[cunume]' class="form-control" value="<?php echo $options['cunume']; ?>">
            </div >

            <div class="col-md-4" >
                Used Pritty much every where else
            </div >
        </div >

        <h3>Global</h3>

        <div class="col-md-12" >
            <div class="col-md-4" >
                <b>Portfolio Type</b>
            </div >
            <div class="col-md-4" >
                <select name='KodePortfolio_settings[portfolio_type]' class="form-control" >
                    <option ><?php echo $options['portfolio_type']; ?></option >
                    <option >Masonry</option >
                    <option >Isotop</option >
                    <option >Package</option >
                </select >
            </div >

            <div class="col-md-4" >
            </div >
        </div >


        <div class="col-md-12" >
            <div class="col-md-4" >
                <b>Number of rows</b>
            </div >
            <div class="col-md-4" >
                <select name='KodePortfolio_settings[cols_count]' class="form-control" >
                    <option ><?php echo $options['cols_count']; ?></option >
                    <option >1</option >
                    <option >2</option >
                    <option >3</option >
                    <option >4</option >
                </select >
            </div >

            <div class="col-md-4" >
            </div >
        </div >



        <h3>Tiles</h3>

        <div class="col-md-12" >
            <div class="col-md-4" >
                <b>Background Colour</b>
            </div >
            <div class="col-md-4" >
                <input name='KodePortfolio_settings[background_col]' class="form-control" value="<?php echo $options['background_col']; ?>">
            </div >

            <div class="col-md-4" >
                Hex Colour Code,  Defaults to Blue
            </div >
        </div >

        <div class="col-md-12" >
            <div class="col-md-4" >
                <b>Border Colour</b>
            </div >
            <div class="col-md-4" >
                <input name='KodePortfolio_settings[tile_border_col]' class="form-control" value="<?php echo $options['tile_border_col']; ?>">
            </div >

            <div class="col-md-4" >
                Hex Colour Code,  Defaults to White
            </div >
        </div >

        <div class="col-md-12" >
            <div class="col-md-4" >
                <b>Border Size</b>
            </div >
            <div class="col-md-4" >
                <input name='KodePortfolio_settings[tile_border_size]' class="form-control" value="<?php echo $options['tile_border_size']; ?>">
            </div >

            <div class="col-md-4" >
                Size in PX,  Defaults to 5px
            </div >
        </div >



        <p>The shortcode for this plugin is <b>[kodeportfolio]</b></p>


        <?php
        settings_fields('pluginPage');
        do_settings_sections('pluginPage');

        ?>
    </form >
<?php

}

?>