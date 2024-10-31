<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__.'/libs/RKB_WP_Settings.php';

if ( class_exists( 'RKB_WP_Settings' ) ) {

    $settings = new RKB_WP_Settings('wppda_settings',"Pending Draft Alert");
    $basicSection= 'wppda_setting_basic';

    // Section: Basic Settings.
    $settings->add_section(
        array(
            'id'    => $basicSection,
            'title' => __( 'Basic Settings', 'WPPDA' ),
        )
    );

    // Field: Select.
    $settings->add_field(
        $basicSection,
        array(
            'id'      => 'recurrence',
            'type'    => 'select',
            'name'    => __( 'Recurrence', 'WPPDA' ),
            'desc'    => __( 'How Frequently do you want the notifications to be sent', 'WPPDA' ),
            'options' => array(
                'daily' => 'Daily',
                'weekly'  => 'Weekly',
                'monthly'  => 'Monthly',
            ),
        )
    );

}