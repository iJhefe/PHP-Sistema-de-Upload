<?php

require 'application/vendor/Autoload.php';
require_once "config-global.php";

use vendor\Autoload;

Autoload::register();

Core\System::start();