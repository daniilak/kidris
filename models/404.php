<?php

/**
 * Kidris Engine
 * Страница ошибки 404
 */

require_once('lib/TemplateEngine.php');
$template = new TemplateEngine('404_error_page.tpl');
$template->templateCompile();
header("HTTP/1.0 404 Not Found");
$template->templateDisplay();
