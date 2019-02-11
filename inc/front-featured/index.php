<?php
/**
 * Gothamish Front Featured Content functions.
 *
 * @package Gothamish
 */

// Load Front Featured posts module.
require_once GOTHAM_PATH . '/inc/front-featured/featured-posts.php';

// Load Front Featured Category Feeds module.
require_once GOTHAM_PATH . '/inc/front-featured/featured-categories-feed.php';

// Load Front Featued Content cache reset hook.
require_once GOTHAM_PATH . '/inc/front-featured/delete-front-featured-cache.php';
