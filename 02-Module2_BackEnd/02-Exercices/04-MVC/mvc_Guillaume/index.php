<?php
require 'controler/routeur.php';

$r=new Routeur();
$r->routerRequete();

echo 'Current PHP version : ' . phpversion();