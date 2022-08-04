<?php

// a bootstrap file is like a little factory builder

$config = require 'config.php';

require 'core/Router.php';
require 'core/database/Connexion.php';
require 'core/database/QueryBuilder.php';
require 'functions.php';

return $query = new QueryBuilder(
    Connexion::make($config["database"])
);