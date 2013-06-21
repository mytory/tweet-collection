<?php
/**
 * User: mytory
 * Date: 13. 6. 22.
 * Time: 오전 4:44
 */
$args = array(
    'post_type' => 'tweet',
    'posts_per_page' => 20,
);
$wp_query = new WP_Query($args);
printr($wp_query->posts);