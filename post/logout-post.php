<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/16/15
 * Time: 10:10 PM
 */

$login = false;
require '../lib/site.inc.php';

unset($_SESSION['user']);
header("location: ../");

?>