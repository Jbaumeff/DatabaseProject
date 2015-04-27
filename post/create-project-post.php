<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 4/27/15
 * Time: 6:45 PM
 */

$login = true;
require '../lib/site.inc.php';

$error = '';

if(isset($_POST['name'])) {
    if($_POST['name'] == '') {
        $error = "Project name was empty";
        header("location: ../projects.php?error=$error");
        exit;
    }




}
header("location: ../projects.php");