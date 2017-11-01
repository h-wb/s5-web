<?php
define( 'DB_NAME', 'l3ufr' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', '' );
define( 'DB_HOST', 'localhost' );
define( 'DB_TABLE', 'recette' );

try
{
    $objPDO = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASSWORD);
}
catch(Exception $exception)
{
	die($exception->getMessage());
}

?>