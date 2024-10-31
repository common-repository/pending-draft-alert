<?php
if (!class_exists('RKB_WP_Plugin')){
    abstract class RKB_WP_Plugin{
        public function __construct()
        {
            register_activation_hook(__FILE__, array($this, 'activation'));
            register_deactivation_hook(__FILE__, array($this, 'deactivation'));
        }

        public function activation()
        {
            
        }

        public function deactivation()
        {
            
        }
    }
}