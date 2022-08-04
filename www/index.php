<?php

echo "hello";

require "core/bootstrap.php";

##$query =


$router = new Router;

require 'routes.php';

$router->direct($_SERVER['PHP_SELF']);

dd($_SERVER['REQUEST_URI']);
dd($router->direct($_SERVER['REQUEST_URI']));



