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
if(isset($_POST['requestee']) && isset($_POST['requester'])) {
    $collaborator->createRequest($_POST['requestee'], $_POST['requester']);
    $requestee = $_POST['requestee'];
    //$id = $_GET['id'];
    $id = $_POST['requester'];
    header("location: ../project.php?id=$id");

} else if(isset($_POST['sender']) && isset($_POST['accepter'])) {
    $id=$_POST['sender'];
    $collaborator->acceptRequest($_POST['accepter'], $_POST['sender']);
    //$accepter = $_POST['accepter'];

    header("location: ../project.php?id=$id");

} else if(isset($_POST['senderd']) && isset($_POST['accepterd'])) {
    $id=$_POST['sender'];
    $collaborator->rejectRequest($_POST['accepterd'], $_POST['senderd']);

    header("location: ../index.php");

} else {
header("location: ../index.php");
}




?>