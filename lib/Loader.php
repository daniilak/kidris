<?php
require_once('lib/ExceptionEngine.php');
$exceptionEngine = new ExceptionEngine();

if (version_compare(phpversion(), '5.4.0', '<')) {
    trigger_error('Нужен PHP версии 5.4 и выше');
}

require_once('config.php');


require_once('lib/Controller.php');
