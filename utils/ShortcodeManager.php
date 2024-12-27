<?php

namespace Utils;

class ShortcodeManager
{
    public static function init()
    {
        add_shortcode('depreciation_calculator', [__CLASS__, 'renderDepreciationCalculator']);
    }

    public static function renderDepreciationCalculator()
    {
        ob_start();
        include plugin_dir_path(__FILE__) . '../views/DepreciationCalculatorForm.php';
        return ob_get_clean();
    }
}
