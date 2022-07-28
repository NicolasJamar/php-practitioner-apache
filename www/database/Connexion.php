<?php

class Connexion
{
    public static function make($config) {
        try {

            // We create a new instance of the class PDO
            return new PDO(
                $config['HOST'].";dbname=".$config['DB'].";port=".$config['PORT'],
                $config['LOGIN'],
                $config['PASSWORD'],
                $config['OPTIONS']
            );

        } catch(Exception $e) {
            // We instantiate an Exception object in $e so we can use methods within this object to display errors nicely
            die($e->getMessage());
        }
    }
}




