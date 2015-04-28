<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/16/15
 * Time: 10:05 PM
 */

$login = true;
require '../lib/site.inc.php';

$id = "";
$collaborator = new Collaborators($site);
if(isset($_GET['id']) && isset($_GET['name'])) {
    $collaborator->deleteRequest($_GET['name'], $_GET['id']);
    header("location: ../index.php");
}else {
    header("location: ../index.php");
}




?>