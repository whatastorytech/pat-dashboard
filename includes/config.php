<?php
session_start();
error_reporting(E_ALL);
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','plantatree');

// URLS
define('BASE_URL', 'http://localhost/pat-dashboard/');
define('ADMIN_URL', BASE_URL.'admin/');
// Paths
define('BASE_PATH', 'D:/XAMPP/htdocs/pat-dashboard/'); // __DIR__
define('UPLOAD_PATH', BASE_PATH.'uploads/');

//Miscelinous
define('ROWS_PER_PAGE', '5');