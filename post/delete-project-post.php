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
$projects = new Projects($site);
if(isset($_GET['id']) AND isset($_GET['creator'])) {
    $projects->deleteProjectById($_GET['id'],$_GET['creator']);
}
header("location: ../index.php");
?>