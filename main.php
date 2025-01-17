<?php
/*
Plugin Name: KAPTNN Financial Calculator
Description: A modular plugin for multiple financial calculators integrated with FastAPI Python.
Version: 1.0.2
Author: Elsam Rafi Saputra
*/

if (!defined('ABSPATH')) exit;

require_once plugin_dir_path(__FILE__) . 'utils/EnqueueAssets.php';
require_once plugin_dir_path(__FILE__) . 'utils/ShortcodeManager.php';
require_once plugin_dir_path(__FILE__) . 'controllers/DepreciationCalculatorController.php';
require_once plugin_dir_path(__FILE__) . 'utils/ApiClient.php';

use Utils\EnqueueAssets;
use Utils\ShortcodeManager;

EnqueueAssets::init();
ShortcodeManager::init();

function load_jquery()
{
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'load_jquery');

add_action('wp_ajax_handle_depreciation_calculator', 'handle_depreciation_calculator_request');
add_action('wp_ajax_nopriv_handle_depreciation_calculator', 'handle_depreciation_calculator_request');

function handle_depreciation_calculator_request()
{
    $controller = new \Controllers\DepreciationCalculatorController();

    try {
        $controller::handleRequest($_POST);
    } catch (\Exception $e) {
        wp_send_json_error(['error' => $e->getMessage()]);
    }
}
