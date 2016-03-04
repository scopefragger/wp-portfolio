<?php

/**
 * @Author      Mark Anthony Jones
 * @Email       Mark@bmkdigital.co.uk
 * @Tel         (0)151 601 4021
 * @Date        09/12/15
 * @Time        13:16
 * @File        JsGenerator.php
 * @Company     BMKDigital
 * @Version     1.0.0
 * @Notes       ...
 */
class JsGenerator
{


    public $options = [];

    /**
     * Sets Options
     * @param $options
     */
    function init($options)
    {
        $this->setOptions($options);
        add_action('wp_footer', array($this, 'iso_build'), 10, 1);
    }

    /**
     * @return string
     */
    function iso_build()
    {

        $output = "";
        $output = $this->iso_buildArguments();
        $output = $this->iso_buildOnloadCall($output);
        $output = $this->iso_imageLoaded($output);
        $output = $this->iso_buildItemSelector($output);
        $output .= $this->other_rejig();
        $output = $this->iso_ScriptTags($output);
        echo $output;

    }

    /**
     * @return string
     */
    function iso_buildArguments()
    {

        $options = $this->getOptions();


        $args = "";
        if (!empty($options['iso_itemSelector'])) {
            $args .= $this->iso_setItemSelector($options['iso_itemSelector']);
        } else {
            $args .= $this->iso_setItemSelector('grid-item');
        }
        if (!empty($options['iso_layoutMode'])) {
            $args .= $this->iso_setLayoutMode($options['iso_layoutMode']);
        } else {
            $args .= $this->iso_setLayoutMode('fitColumns');
        }
        if (!empty($options['iso_resizable'])) {
            $args .= $this->iso_resizable($options['iso_resizable']);
        } else {
            $args .= $this->iso_resizable(true);
        }
        if (!empty($options['iso_percent'])) {
            $args .= $this->iso_percent($options['iso_percent']);
        } else {
            $args .= $this->iso_percent(true);
        }
        if (!empty($options['iso_isOriginLeft'])) {
            $args .= $this->iso_isOriginLeft($options['iso_isOriginLeft']);
        } else {
            $args .= "";
        }

        if (!empty($options['iso_isOriginTop'])) {
            $args .= $this->iso_isOriginTop($options['iso_isOriginTop']);
        } else {
            $args .= "";
        }
          if (!empty($options['iso_transitionTime'])) {
              $args .= $this->iso_transitionTime($options['iso_transitionTime']);
          } else {
              $args .= "";
          }





        return $args;

    }

    /**
     * Returns the value for resizable,  formatted
     * @param $input
     * @return string
     */
    function  iso_resizable($input)
    {
        $output = "";
        if ($input == "true") {
            $output = ",resizable:true";
        } else {
            $output = ",resizable:false";
        }
        return $output;
    }

    function  iso_transitionTime($input)
    {

        if (!empty($input)) {
            $output = ",transitionDuration:'".$input."s'";
} else{
                 $output = ",transitionDuration:'0.4s'";
        }




        return $output;
    }

    function  iso_percent($input)
    {
        $output = "";
        if ($input == "true") {
            $output = ",percentPosition:true";
        } else {
            $output = ",percentPosition:false";
        }
        return $output;
    }

    function  iso_isOriginLeft($input)
    {
        $output = "";
        if ($input == "true") {
            $output = ",isOriginLeft:true";
        } else {
            $output = ",isOriginLeft:false";
        }
        return $output;
    }

    function  iso_isOriginTop($input)
    {
        $output = "";
        if ($input == "true") {
            $output = ",isOriginTop:true";
        } else {
            $output = ",isOriginTop:false";
        }
        return $output;
    }

    /**
     * Straps the jQuery elements around the args
     * @param $input
     * @return string
     */
    function iso_buildOnloadCall($input)
    {

        $output = "jQuery('.gridPortfolio').isotope({" . $input . "});";
        return $output;
    }

    function iso_imageLoaded($input)
    {

        $options = $this->getOptions();
        if (!empty($options['iso_imageFix'])) {
            if ($options['iso_imageFix'] == true) {
                return $output = "jQuery('.gridPortfolio').imagesLoaded( function() {" . $input . "});";
            }
        }

    }

    /**
     * Adds the On-load stuff to he javascript is provided
     * @param $output
     * @return string
     */
    function iso_buildItemSelector($output)
    {
        $output = "jQuery(document).ready(function () {" . $output . "});";
        return $output;
    }

    function iso_ScriptTags($input)
    {
        return "<script>" . $input . "</script>";
    }

    /**
     * Formats the Item Selector Line
     * @param $input
     * @return string
     */
    function iso_setItemSelector($input)
    {

        return "itemSelector: '." . $input . "',";

    }


    /**
     * @param $input
     * @return string
     */
    function iso_setLayoutMode($input)
    {

        $output = "layoutMode:'" . $input . "'";

        return $output;
    }


    /**
     * Build the Rejig Functions
     * @return string
     */
    function other_rejig()
    {

        $output = "";
        $output .= "function reJigAll() {";
        $output .= "jQuery('.gridPortfolio').isotope({filter: '.grid-item'});";
        $output .= "}";
        $output .= "function reJig(keeper) {";
        $output .= "jQuery('.gridPortfolio').isotope({filter: keeper});";
        $output .= "}";
        return $output;

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



