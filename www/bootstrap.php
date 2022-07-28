<?php

// a bootstrap file is like a little factory builder

$config = require "config.php";

require "database/Connexion.php";
require "database/QueryBuilder.php";
require "functions.php";

return $query = new QueryBuilder(
    Connexion::make($config["database"])
);