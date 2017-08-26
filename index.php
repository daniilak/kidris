<?php

/**
 * Kidris Engine
 * Инициализация движка
 */
error_reporting (E_ALL);

require_once('lib/Loader.php');
new Controller($_GET);
