<?php

class Short
{

    public $error;

    function __construct($error)
    {

        if (!empty($error)) {
            $this->setError($error);
        }

    }


    /**
     *
     */
    function publicShortCode()
    {
        add_shortcode('kodeportfolio', array(&$this, 'displayPortfolio'));
    }

    /**
     * @param $atts
     */
    function displayPortfolio($atts)
    {
        $options = get_option('KodePortfolio_settings');
        $options = $this->generateCompleateOptions($atts,$options);
        $parentCatagory = $this->generateParentCat($atts);

        if (file_exists(__DIR__ . '/PortfiloCore.php')) {
            include(__DIR__ . '/PortfiloCore.php');
            $portfolio = new PortfiloCore();
            return $portfolioElement = $portfolio->init($parentCatagory,$options);
        }
    }


    /**
     * @return mixed
     */
    function generateCompleateOptions($atts,$options)
    {

        if (!empty($atts['type'])) {
            $options['portfolio_type'] = $atts['type'];
        }

        if (!empty($atts['facebook'])) {
            $options['fbshares'] = $atts['facebook'];
        }

        /*
         * Enabled Overide for category functnality
         */
        if (!empty($atts['catmenuoveride'])) {
            $options['catmenuoveride'] = $atts['catmenuoveride'];
        }

        /*
         * Enabled Overide for category display
         */
        if (!empty($atts['catshow'])) {
            $options['catshow'] = $atts['catshow'];
        }

        return $options;

    }


    /**
     * @param $atts
     *
     * @return mixed
     */
    function generateParentCat($atts)
    {

        if (!empty($atts['parent'])) {
            $parentCat = $atts['parent'];
        }

        if (!empty($parentCat)) {
            return $parentCat;
        }
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param mixed $error
     */
    public function setError($error)
    {
        $this->error = $error;
    }

}


?>