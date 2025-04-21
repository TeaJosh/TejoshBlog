<?php
// Get the base URL dynamically
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$script_name = dirname($_SERVER['SCRIPT_NAME']);
$base_url = $protocol . "://" . $host . $script_name;

// If needed, trim trailing slashes
$base_url = rtrim($base_url, "/");

// Absolute paths
$absolute_path = __DIR__;
$public_url = $base_url . "/public";
$includes_path = $absolute_path . "/includes";
$images_url = $base_url . "/images";
$js_url = $base_url . "/js";
$css_url = $base_url . "/css";
$labs_url = $base_url . "/labs";

// Flag to indicate this is included from root
$included_from_root = true;

// Include the public index file
include(__DIR__ . "/public/index.php");
?>
