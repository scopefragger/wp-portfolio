<?php

/**
 * @Author      Mark Anthony Jones
 * @Email       Mark@bmkdigital.co.uk
 * @Tel         (0)151 601 4021
 * @Date        09/12/15
 * @Time        13:16
 * @File        CssGenerator.php
 * @Company     BMKDigital
 * @Version     1.0.0
 * @Notes       ...
 */
class CssGenerator
{

    function build()
    {

        /*
         * Start Ouput Stream
         */

        $output = "";

        /*
         * Get The Options
         */

        $options = get_option('KodePortfolio_settings');

        /*
         * Set Options to variables
         */

        $background = $options['background_col'];
        $borderSize = $options['tile_border_size'];
        $borderCol = $options['tile_border_col'];
        $marginButtons = $options['spaceuptop'];
        $padding = $options['tile_padding'];


        /*
         * Some emergency Fallbacks
         */

        if ($background == "") {
            $background = "fff";
        }
        if ($borderCol == "") {
            $borderCol = "fff";
        }
        if ($borderSize == "") {
            $borderSize = "5";
        }

        /*
         * Array To Use for constructing the CSS
         */

        $rows = [
            [0, 460, 100],
            [460, 968, 50],
            [968, 1200, 25],
            [1200, 1600, 20],
            [1600, 6000, 16.6]
        ];

        /*
         * Build the CSS based on the Screen Sizes
         */
        $output .= "<style>";
        $output .= $this->buildGenericCss($background, $borderSize, $borderCol, $padding, $marginButtons);
        $output .= $this->loopRowArray($rows);
        $output .= "</style>";
        return $output;

    }


    function loopRowArray($rows){

        $output = "";

        foreach ($rows as $row) {

            $output .= $this->buildRowHandler($row[0],$row[1],$row[2]);

        }

        return $output;

    }

    /**
     * @param $background
     * @param $borderSize
     * @param $borderCol
     * @param $padding
     * @param $marginButtons
     *
     * @return string
     */
    function buildGenericCss($background, $borderSize, $borderCol, $padding, $marginButtons)
    {

        $output = "";
        $output .= ".grid-item {";
      //  $output .= " background: " . $background . " ;";
        $output .= " box-sizing: " . "border-box" . " ;";
        $output .= " border: " . $borderSize . "px " . $borderCol . " solid;";
        $output .= " padding:" . $padding . "px;";
        $output .= " float:" . "left" . ";";
        $output .= "}";
        $output .= ".gridPortfolio {";
        $output .= "  margin-top: " . $marginButtons . "px !important;";
        $output .= "}";

        return $output;

    }

    /**
     * @param $min
     * @param $max
     * @param $width
     *
     * @return string
     */
    function buildRowHandler($min, $max, $width)
    {

        $output = "";
        $output .= $this->generateMinMaxLine($min, $max);
        $output .= ".grid-item {";
        $output .= $this->generateWidth($width);
        $output .= "}";
        $output .= "}
        ";
        return $output;



    }

    /**
     * @param $min
     * @param $max
     *
     * @return string
     */
    function generateMinMaxLine($min, $max)
    {
        $min = $min - 1;
        return "@media screen and (min-width: " . $min . "px) and (max-width: " . $max . "px) {
        ";
    }

    /**
     * @param $width
     *
     * @return string
     */
    function generateWidth($width)
    {

        return "width: " . $width . "%;";

    }
}