<?php

return [
    "database" => [
        "HOST" => "mysql:host=mysql",
        "DB" => "practitioner", // Enter the DB name
        "PORT" => "3306",
        "LOGIN" => "root",
        "PASSWORD" => "root",
        //We want any issues to throw an exception with details, instead of a silence or a simple warning
        "OPTIONS" => [PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION]
    ]
];