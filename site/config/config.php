<?php
$config['xsl'] = 1;
$config['charset'] = 'utf-8';
$config['suff'] = '.html';
// Language
$config['muti_language'] = TRUE;
$config['language'] = 'vi';

$config['csrf_protection'] = TRUE; // Hien thi Input trong Form
$config['csrf_name'] = 'token'; // Token Name
$config['csrf_cookie_name'] = 'token'; // Token Name
$config['store_session_table'] = true; // Lưu session trong db
$config['cookie_prefix']    = "";
$config['cookie_domain']    = "";
$config['cookie_path']        = "/";
$config['cookie_secure']    = FALSE;