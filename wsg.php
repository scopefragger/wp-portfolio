<?php


/*
 *
 * Developer    : Mark Anthony Jones
 * Email        : mark@arcade247.co.uk
 * GitHub       : https://github.com/scopefragger
 *
 */


class wsg
{


    /**
     *
     */
    function __construct()
    {


    }

    /**
     * @param $args
     *
     * @return string
     */
    function buildSettings($args)
    {

        $output = "";
        $output .= $this->loopInput($args['options'], $args['config']['optionsname'], $args['config']);
        $output = $this->innerWrapper($output, $args['config']['class']['innerwrapper']);
        $output = $this->outerWrapper($output, $args['config']['class']['outerwraper']);
        return $output;

    }

    /**
     * @param $name
     * @param $class
     * @param $coreName
     *
     * @return string
     */
    function constructTextInput($name, $class, $coreName)
    {

        $options = get_option('KitPortfolio_settings');
        $output = "";
        $output .= "<input type='text' class='' value='" . $options[$name] . "' name='" . $coreName . "[" . $name . "]'>";
        return $output;


    }


    /**
     * @param $name
     * @param $class
     * @param $corename
     *
     * @return string
     */
    function constructHiddenInput($name, $class, $corename)
    {

        $options = get_option('KitPortfolio_settings');
        $output = "";
        $output .= "<input type='hidden' class='' value='" . $options[$name] . "' name='" . $corename . "[" . $name . "]' >";
        return $output;


    }


    /**
     * @param $name
     * @param $class
     * @param $corename
     *
     * @return string
     */
    function constructColourInput($name, $class, $corename)
    {

        $options = get_option('KitPortfolio_settings');
        $output = "";
        $output .= "<input type='text' class='colourPicker' value='" . $options[$name] . "' name='" . $corename . "[" . $name . "]' >";
        return $output;


    }

    /**
     * @param $options
     * @param $input
     *
     * @return string
     */
    function generateTabs($options, $input)
    {

        /*
         * Depregated 23/12/15
         * @by: Mark A Jones
         */

        $output = '';
        // $output .= '<div id="tabs"><ul>';
        // $i = 0;
        // foreach ($options as $key => $t) {
        //     $flatColor = $this->fetchFlat($i);
        //     $output .= '<li style="background:' . $flatColor . '; " ><a style="color:white;" href="#' . $key . '">' . $key . '</a></li>';
        //    $i++;
        //}
        // $output .= '</ul>';

        $output .= $input;
        return $output;

    }

    /**
     * @param $options
     * @param $coreName
     * @param $config
     *
     * @return string
     */
    function loopInput($options, $coreName, $config)
    {
        $tabsEnabled = $config['tabs'];
        $output = '';
        $i = 0;
        foreach ($options as $key => $t) {

            $i++;
            $colorBlock = $this->fetchFlat($i);
            if ($tabsEnabled == 'true') {
                $output .= '<div style="padding: 20px; color: white; background:' . $colorBlock . ';" id="' . $key . '">';
            }

            foreach ($t as $o) {


                if ($o['type'] == 'text') {

                    $row = $this->constructTextInput($o['name'], $o['class'], $coreName);
                    $output .= $this->wrapper($o['name'], $o['class'], $row, $o['label'], $o['tooltip']);

                } else {
                    if ($o['type'] == 'hidden') {

                        $row = $this->constructHiddenInput($o['name'], $o['class'], $coreName);
                        $output .= $this->wrapper($o['name'], $o['class'], $row, $o['label'], $o['tooltip']);

                    } else {
                        if ($o['type'] == 'header') {

                            $row = $this->constructHeader($o['class'], $o['text']);
                            $output .= $this->wrapper($o['name'], $o['class'], $row, $o['label'], $o['tooltip']);

                        } else {
                            if ($o['type'] == 'select') {

                                $row = $this->constructSelectInput($o['class'], $o['name'], $o['options'], $coreName);
                                $output .= $this->wrapper($o['name'], $o['class'], $row, $o['label'], $o['tooltip']);

                            } else {
                                if ($o['type'] == 'colour') {

                                    $row = $this->constructColourInput($o['name'], $o['class'], $coreName);
                                    $output .= $this->wrapper($o['name'], $o['class'], $row, $o['label'],
                                        $o['tooltip']);

                                } else {
                                    if ($o['type'] == 'number') {

                                        $row = $this->constructNumberInput($o['class'], $o['name'], $coreName);
                                        $output .= $this->wrapper($o['name'], $o['class'], $row, $o['label'],
                                            $o['tooltip']);

                                    } else {
                                        if ($o['type'] == 'html') {

                                            $row = $this->constructHTMLInput($o['class'], $o['text']);
                                            $output .= $this->wrapper($o['name'], $o['class'], $row, $o['tooltip']);

                                        } else {
                                            if ($o['type'] == 'bignumber') {

                                                $row = $this->constructNumberBigInput($o['class'], $o['name'],
                                                    $coreName);
                                                $output .= $this->wrapper($o['name'], $o['class'], $row, $o['label'],
                                                    $o['tooltip']);

                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

            }

            if ($tabsEnabled == 'true') {
                $output .= '</div>';
            }
        }

        if ($tabsEnabled == 'true') {
            $output = $this->generateTabs($options, $output, $config['tabs']);
        }
        return $output;

    }

    /**
     * @param        $name
     * @param        $class
     * @param        $row
     * @param        $label
     * @param string $toolip
     *
     * @return string
     */
    function wrapper($name, $class, $row, $label, $toolip = '')
    {
        $output = '';
        $output .= "<div style='clear: both; padding: 10px;' class='' name='' id=''>";
        $output .= "<label class='" . $class . "'  for='" . $name . "'>" . $label . "</label>";
        $output .= $row;
        if (!empty($toolip)) {
            $output .= '<a href="#" data-toggle="tooltip" title="' . $toolip . '">[?]</a>';
        }
        $output .= '</div>';

        return $output;
    }

    /**
     * @param $class
     * @param $name
     * @param $options
     * @param $corename
     *
     * @return string
     */
    function constructSelectInput($class, $name, $options, $corename)
    {

        $savedoptions = get_option('KitPortfolio_settings');
        $selectedOption = $savedoptions[$name];
        $output = "";
        $output .= "<select class='" . $class . "' value=''  name='" . $corename . "[" . $name . "]' >";
        foreach ($options as $o) {

            if ($selectedOption != $o['value']) {
                $output .= "<option>" . $o['value'] . "</option>";
            } else {
                $output .= "<option selected='selected'>" . $o['value'] . "</option>";
            }
        }
        $output .= "</select>";
        return $output;

    }

    /**
     * @param $class
     * @param $name
     * @param $corename
     *
     * @return string
     */
    function constructNumberInput($class, $name, $corename)
    {

        $savedoptions = get_option('KitPortfolio_settings');
        $selectedOption = $savedoptions[$name];
        $output = "";
        $output .= "<select class='" . $class . "' value=''  name='" . $corename . "[" . $name . "]' >";
        $i = 0;
        while ($i <= 150) {

            if ($selectedOption != $i) {
                $output .= "<option>" . $i . "</option>";
            } else {
                $output .= "<option selected='selected'>" . $i . "</option>";
            }

            $i++;
        }
        $output .= "</select>";
        return $output;

    }


    function constructNumberBigInput($class, $name, $corename)
    {

        $savedoptions = get_option('KitPortfolio_settings');
        $selectedOption = $savedoptions[$name];
        $output = "";
        $output .= "<select class='" . $class . "' value=''  name='" . $corename . "[" . $name . "]' >";
        $i = 0;
        while ($i <= 1000) {

            if ($selectedOption != $i) {
                $output .= "<option>" . $i . "</option>";
            } else {
                $output .= "<option selected='selected'>" . $i . "</option>";
            }

            $i++;
        }
        $output .= "</select>";
        return $output;

    }

    /**
     * @param $class
     * @param $text
     *
     * @return string
     */
    function constructHeader($class, $text)
    {

        $outer = '';
        $outer = "<h2 class='" . $class . "' name='' id=''>" . $text . "</h2>";
        return $outer;

    }

    /**
     * @param $class
     * @param $text
     *
     * @return string
     */
    function constructHTMLInput($class, $text)
    {

        $outer = '';
        $outer .= "<p class='" . $class . "' name='' id=''>" . $text . "</p>";
        return $outer;

    }

    /**
     * @param $row
     * @param $class
     *
     * @return string
     */
    function innerWrapper($row, $class)
    {

        $outer = '';
        $outer = "<div class='" . $class . "' name='' id=''>" . $row . "</div>";
        return $outer;

    }


    /**
     * @param $row
     * @param $class
     *
     * @return string
     */
    function outerWrapper($row, $class)
    {

        $outer = '';
        $outer = "<div class='" . $class . "' name='' id=''>" . $row . "</div>";
        return $outer;

    }

    /**
     *
     */
    function cleanUp()
    {


    }

    /**
     *
     */
    function output()
    {


    }

    /**
     * @param $id
     *
     * @return mixed
     */
    function fetchFlat($id)
    {

        if ($id >= 20) {
            $id = $id - 19;
        }

        $flat = [
            "#00C0EF",
            "#00A65A",
            "#F39C12",
            "#DD4B39",
            "#00C0EF",
            "#00A65A",
            "#F39C12",
            "#DD4B39",
            "#00C0EF",
            "#00A65A",
            "#F39C12",
            "#DD4B39",
            "#00C0EF",
            "#00A65A",
            "#F39C12",
            "#DD4B39",
            "#00C0EF",
            "#00A65A",
            "#F39C12",
            "#DD4B39",
            "#00C0EF",
            "#00A65A",
            "#F39C12",
            "#DD4B39",
            "#00C0EF",
            "#00A65A",
            "#F39C12",
            "#DD4B39",
            "#00C0EF",
            "#00A65A",
            "#F39C12",
            "#DD4B39",
        ];
        return $flat[$id];

    }

}