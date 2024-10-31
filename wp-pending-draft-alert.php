<?php
require_once __DIR__ . '/settings.php';
require_once __DIR__ . '/email/email.php';
if (!defined('ABSPATH')) {
    die();
}
/*
Plugin Name: Pending Draft Alert
Description: It notifies the author by email , of any Drafts in Wordpress that they have pending to be published
Version: 1.0
Author: excalabyte
Author URI: https://pariswells.com/blog/
Text Domain: Pending-Draft-Alert
License: GPL2
*/

new class {
    private $cornHookName = "wp-pending-draft-alert-corn";

    public function __construct()
    {
        register_activation_hook(__FILE__, array($this, 'activation'));
        register_deactivation_hook(__FILE__, array($this, 'deactivation'));
        add_filter('cron_schedules', array($this, 'custom_cron_recurrence'));
        add_action($this->cornHookName, array($this, 'cronExecute'));
    }

    public function cronExecute($recurrence)
    {
        $option = get_option('wppda_setting_basic');
        if ($option and isset($option['recurrence'])) {
            $r = $option['recurrence'];
        } else {
            $r = 'daily';
        }
        if ($r == $recurrence) {
            $this->getDrafts();
        }
    }

    public function getDrafts()
    {
        $args = array(
            'post_type' => 'post',
            'post_status' => array('pending', 'draft',),
            'posts_per_page' => -1,
        );
        /** @var [WP_Post] $posts */
        $posts = get_posts($args);
        if (count($posts) >0){
            $post_by_authors=[];
            foreach ($posts as $post) {
                $post_by_authors[$post->post_author]['email']= get_user_by( 'id', $post->post_author )->user_email;
                $post_by_authors[$post->post_author]['posts'][]=array(
                    'id'=>$post->ID,
                    'title'=>$post->post_title,
                    'date'=>$post->post_modified,
                    'edit_link'=>get_bloginfo('url','display').'/wp-admin/post.php?action=edit&post='.$post->ID
                );

            }
            foreach ($post_by_authors as $post_by_author) {
                    $email= new WP_Pending_Draft_Email();
                    $email->sendEmail($post_by_author);
            }
        }

    }

    public function custom_cron_recurrence($schedules)
    {
        $schedules['weekly'] = array(
            'display' => __('Once weekly'),
            'interval' => 86400,
        );
        $schedules['monthly'] = array(
            'display' => __('Once monthly'),
            'interval' => 2635200,
        );
        return $schedules;
    }

    public function activation()
    {
        if (!wp_next_scheduled($this->cornHookName)) {
            wp_schedule_event(time(), 'daily', $this->cornHookName, array('recurrence' => 'daily'));
            wp_schedule_event(time(), 'weekly', $this->cornHookName, array('recurrence' => 'weekly'));
            wp_schedule_event(time(), 'monthly', $this->cornHookName, array('recurrence' => 'monthly'));
        }
    }

    public function deactivation()
    {
        wp_clear_scheduled_hook($this->cornHookName);
    }

};