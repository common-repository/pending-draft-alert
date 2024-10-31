<?php
if (!defined('ABSPATH')) {
    die();
}

class WP_Pending_Draft_Email
{
    private $pending_posts;

    private function getContent()
    {
        ob_start();
        include __DIR__ . '/email-view.php';
        return ob_get_clean();
    }

    public function sendEmail($post_by_author)
    {
        $subject = "You Have Pending Draft(s)";
        $this->pending_posts = $post_by_author['posts'];
        wp_mail($post_by_author['email'], $subject, $this->getContent(), $this->getHeader());
    }

    private function getHeader()
    {
        $headers = "Content-Type: text/html; charset=UTF-8";
        return $headers;
    }

}