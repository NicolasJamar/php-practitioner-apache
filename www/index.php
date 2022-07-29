<?php

$query = require "core/bootstrap.php";

$router = new Router;

require 'routes.php';

dd($_SERVER);
dd($router->direct($_SERVER['REQUEST_URI']));

$router->direct('about');


