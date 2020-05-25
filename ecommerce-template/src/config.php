<?php
// Turn on/off error reporting
error_reporting(-1);

// Start session
session_start();

define('ROOT_PATH', '..' . __DIR__ . '/'); // path to 'root'
define('SRC_PATH',  __DIR__ . '/'); // path to 'src/'
define('IMG_PATH', '../public/img/'); // path to public images
define('PARTS_PATH','../public/parts/'); // path to parts
define('STYLES_PATH','../public/styles/'); // path to styling

// Include functions and classes

