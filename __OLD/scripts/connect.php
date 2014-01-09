<?php

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=remera', 'root', 'root');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

?>