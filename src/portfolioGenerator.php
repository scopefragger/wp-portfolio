<?php

class PortfolioGenerator
{
    public $listOfCat = [];
    public $options = [];

    function __construct($options)
    {

        $this->setOptions($options);


    }

    function packageUpMason($content, $cat, $id, $image, $idthis, $static)
    {
        $output = "";
        $options = $this->getOptions();
        $tilecss = "" . $options['tile_animationOnHover'];
        if ($options['headers'] == "yes") {
            $headerColour = $options['header_colour'];
            $fontSize = $options['header_size'];
            $savedoptions = get_option('KitPortfolio_settings');
            $header = "<h2 style='color:" . $headerColour . "; font-size:" . $fontSize . "px; '>" . get_the_title($idthis) . "</h2>";

            $postUrl = "";
            $overide = get_post_meta($idthis, "_overide", true);;
            if (!empty($overide)) {
                $postUrl = $overide;
            } else {
                $postUrl = get_permalink($idthis);
            }
            if ($options['headerlinks'] == "yes") {
                $header = "<a href='" . $postUrl . "'>" . $header . "</a>";
            }

        } else {
            $header = "";
        }


        if ($options['readmore'] == "yes") {
            $readmore_colour = $options['readmore_colour'];
            $readmore_size = $options['readmore_size'];
            $readmore_location = $options['readmore_float'];
            $readmore_text = $options['readmore_text'];
            $readmore = "<span class='readmore'><a style=' width: 100%; float:left; text-align: " . $readmore_location . ";  color:" . $readmore_colour . "; font-size:" . $readmore_size . "px; ' href='" . get_permalink($idthis) . "'>" . $options['readmore_prefix'] . $readmore_text . $options['readmore_sufix'] . "</a></span>";
        } else {
            $readmore = "";
        }


        $imageonly = $options['imageonly'];
        $youtube = $options['youtubethumbnails'];
        $youtubePriority = $options['youtubepriorty'];
        $textblocks = $options['textblocks'];

        $lightboxClass = "";

        if ($options['enablelightbox'] == 'yes') {
            if ($options['lightboxmode'] == 'fancybox') {
                $lightboxClass = "fancybox";

            }
        }

        if (
            $youtube == "yes"
        ) {
            $yourubekey = get_post_meta($idthis, "_youtube", true);
        }
        if ($id != 0) {
            $sizeClass = $this->sizeClass($static);
        } else {
            $sizeClass = 'grid-item';
        }


        $pre = "";
        $post = "";

        if ($options['enablelightbox'] == 'yes') {
            if ($options['lightboxmode'] == 'fancybox') {
                if (empty($yourubekey)) {


                    $pre = "<a rel='lightbox'  class='" . $lightboxClass . "'href='" . $image . "'>";


                } else {
                    $pre = "<a title='' class='" . $lightboxClass . "' href='http://img.youtube.com/vi/" . $yourubekey . "/hqdefault.jpg'>";
                }
                $post = "</a>";
            }
        } else {
            $postUrl = "";
            $overide = get_post_meta($idthis, "_overide", true);
            if (!empty($overide)) {
                $pre = "<a href='" . $overide . "'>";
                $post = "</a>";
            } else {
                $overide = get_permalink($idthis);
                $pre = "<a href='" . $overide . "'>";
                $post = "</a>";
            }

        }

        if ($options['fullwidth'] = "yes") {
            $imagesize = "width:100% !important;";
        } else {
            $imagesize = "";
        }

        if (empty($yourubekey)) {
            if (empty($image) && $imageonly == "no") {

                if ($textblocks == "yes") {
                    $output .= '<div class="grid-item ' . $sizeClass . ' ' . $cat->slug . '">' . $header . "" . $content . $readmore . '</div>';
                }
            } else {
                if (!empty($image)) {
                    if ($options['fbshares'] == "yes") {
                        if (empty($options['fbshare_img'])) {
                            $fbimg = 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xfp1/v/t1.0-1/p160x160/1377580_10152203108461729_809245696_n.png?oh=cb163ef855f9307c77b6ad913dfe01b0&oe=563A937D&__gda__=1450852360_4c2d866fa58e7d514e25565bd2a6a978';
                        } else {
                            $fbimg = $options['fbshare_img'];
                        }
                        $facebookShare = '<a class="facebookshare" style="position: relative; top: -25px; height:0; float:left;" href="https://www.facebook.com/sharer/sharer.php?u=' . $image . '"><img style="width:25px;" src="' . $fbimg . '"></a>';
                    }

                    $tsize = $options['thumbnailsize'];
                    if (empty($tsize)) {
                        $tsize = "thumbnail";
                    }
                    $idthumb = get_post_thumbnail_id($idthis);
                    if ($tsize == "custom") {
                        $width = $options['customwidth'];
                        $height = $options['customheight'];
                        $tsize = [$width, $height];
                    }
                    $thumb = wp_get_attachment_image_src($idthumb, $tsize);

                    if (empty($facebookShare)) {
                        $facebookShare = "";
                    }

                    if (!empty($cat->slug)) {
                        $catslug = $cat->slug;
                    } else {
                        $catslug = "";
                    }

                    if ($options['headerloc'] == "top") {
                        $output .= '<div class="grid-item ' . $sizeClass . ' ' . $catslug . '">' . $header . "" . $pre . '<img style="' . $imagesize . '" class="hvr-' . $tilecss . '"  src="' . $thumb[0] . '">' . $post . $readmore . $facebookShare . '</div>';
                    } else {
                        $output .= '<div class="grid-item ' . $sizeClass . ' ' . $catslug . '">' . $pre . '<img style="' . $imagesize . '" class="hvr-' . $tilecss . '"  src="' . $thumb[0] . '">' . $header . $post . $readmore . $facebookShare . '</div>';

                    }

                }
            }
        } else {
            if ($options['headerloc'] == "top") {
                $output .= '<div class="grid-item ' . $sizeClass . ' ' . $cat->slug . '">' . $header . "" . $pre . '<img class="hvr-' . $tilecss . '" style="' . $imagesize . '" src="http://img.youtube.com/vi/' . $yourubekey . '/hqdefault.jpg">' . $post . $readmore . '</div>';
            } else {
                $output .= '<div class="grid-item ' . $sizeClass . ' ' . $cat->slug . '">' . $pre . '<img class="hvr-' . $tilecss . '" style="' . $imagesize . '" src="http://img.youtube.com/vi/' . $yourubekey . '/hqdefault.jpg">' . $header . $post . $readmore . '</div>';
            }

        }

        return $output;
    }


    /**
     * //TODO: DEPREACHIATE THIS FUNCTION AS ITS OVERCOMPLICATED AND NOT USED
     * @param $static
     * @return string
     */
    function sizeClass($static)
    {


        $options = $this->getOptions();
        if (!empty($options['random_size'])) {
            $random_size = $options['random_size'];


            if ($random_size == "yes") {
                if ($static == false) {
                    $rand = rand(5, 25);
                    if ($rand <= 5) {
                        $class = "grid-item--width2";
                    } elseif ($rand > 5 && $rand <= 10) {
                        $class = "grid-item--width3";
                    } elseif ($rand > 10) {
                        $class = "grid-item";
                    }
                } else {
                    $class = "grid-item";
                }
            } else {
                $class = "grid-item";
            }
        } else {
            $class = "grid-item";
        }

        return $class;
    }

    function buildJS($options)
    {

        include('jSGenerator.php');
        $js = new JsGenerator;
        $output = $js->init($options);
        return $output;
    }

    function buildCss($static = false)
    {

        include('CssGenerator.php');
        $css = new CssGenerator;
        $output = $css->build();
        return $output;
    }

    function buildPre()
    {
        $output = "";
        $output .= '<div class="gridPortfolio">';
        return $output;

    }

    function buildPost()
    {
        $output = "";
        $output .= '</div>';
        $output .= '</div>';
        return $output;

    }

    function getSettings()
    {

        /*
         * Lets PreBuff a few Defaults
         */

        $cols = 4;
        $rows = 4;
        $max = 20;

        $settings = [
            'cols' => $cols,
            'rows' => $cols,
            'max' => $cols
        ];

        return $settings;
    }

    function fetchPosts($parentCat)
    {
        $options = $this->getOptions();
        if ($options['custom_post_type'] == "yes") {
            $postyype = $options['cuslug'];
        } else {
            $postyype = 'post';
        }

        if (!empty($parentCat)) {
            $parent = $parentCat;
        } else {
            $parent = 0;
        }

        $args = array(
            'posts_per_page' => 50,
            'offset' => 0,
            'category' => $parent,
            'orderby' => 'date',
            'order' => 'DESC',
            'post_type' => $postyype,
            'post_mime_type' => '',
            'author' => '',
            'post_status' => 'publish',
            'suppress_filters' => true
        );
        return $posts_array = get_posts($args);

    }

    function HandlePosts($static = false, $parentCat)
    {

        $output = "";
        $posts = $this->fetchPosts($parentCat);
        $postsClean = [];
        foreach ($posts as $p) {
            $cat = wp_get_post_categories($p->ID);
            if (!empty($cat[0])) {
                $cat = get_category($cat[0]);
            } else {
                $cat = get_category(0);
            }

            if (!empty($cat->slug)) {
                $catslug = $cat->slug;
            } else {
                $catslug = 0;
            }
            $this->setListOfCat($catslug);
            $p->catCore =
            $postsClean[] = $p;

        }


        if ($static == false) {
            $output .= $this->listAllCats();
        }
        $i = 0;
        foreach ($postsClean as $pc) {

            $cat = wp_get_post_categories($pc->ID);
            if (!empty($cat[0])) {
                $cat = get_category($cat[0]);
            } else {
                $cat = get_category(0);
            }
            $image = wp_get_attachment_url(get_post_thumbnail_id($pc->ID));
            $output .= $this->packageUpMason($pc->post_content, $cat, $i, $image, $pc->ID, $static);
            $i++;
        }
        return $output;
    }


    function listAllCats()
    {
        $options = $this->getOptions();
        if ($options['catmenu'] == "yes" || $options['catmenuoveride'] == "1") {

            $output = "";
            $cats = $this->getListOfCat();
            $output .= "<div class='KitPortfolioOuterCat'>";
            $output .= "<ul class='KitPortfolioCat'>";

            /*
             * Hide output if overidden
             */

            if ($options['catshow'] != "no") {
                $output .= "<button  class='btn btn-primary'  onclick='reJigAll()'>All</button>";
            }
            $cats = array_unique($cats, SORT_REGULAR);
            $x = 0;
            foreach ($cats as $c) {

                if ($x <= 25) {

                    if (!empty($c) && ($c) != ".") {

                        /*
                         * Hide output if overidden
                         */

                        if ($options['catshow'] != "no") {
                            $output .= "<button class='btn btn-primary' onclick='reJig(\".$c\");'>" . $c . "</button>";
                        }
                    }
                }
                $x++;
            }
            $output .= "</ul>";
            $output .= "</div>";
            $output .= $this->buildPre();
            return $output;
        } else {
            return "";
        }

    }


    public
    function getListOfCat()
    {
        return $this->listOfCat;
    }

    /**
     * @param array $listOfCat
     */
    public
    function setListOfCat($listOfCat)
    {
        $this->listOfCat[] = $listOfCat;
    }

    /**
     * @return array
     */
    public
    function getOptions()
    {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public
    function setOptions($options)
    {
        $this->options = $options;
    }
}


