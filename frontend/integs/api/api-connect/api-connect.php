<?php

/**
 * External API Configuration
 * Centralized configuration for EscaPinas system integration
 */

// BookStack Base URL
define('BOOKSTACK_BASE_URL', 'http://10.180.181.43:8080');
define('BOOKSTACK_API_PATH', '/BookStack/api');

// EscaPinas API Endpoints
define('BOOKSTACK_API_USERS', BOOKSTACK_BASE_URL . BOOKSTACK_API_PATH . '/users.php');
define('BOOKSTACK_API_VOUCHERS', BOOKSTACK_BASE_URL . BOOKSTACK_API_PATH . '/vouchers.php');


?>