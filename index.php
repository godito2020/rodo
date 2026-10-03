<?php

/**
 * Entry point for localhost/rodo environment
 */
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? ''
);

// If already inside public, require public/index.php
require_once __DIR__ . '/public/index.php';
