<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/16/15
 * Time: 10:05 PM
 */

$login = true;
require '../lib/site.inc.php';

$id = $_GET['id'];
$collaborator = new Collaborators($site);
if(isset($_POST['requestee']) && isset($_POST['requester'])) {
    $collaborator->createRequest($_POST['requestee'], $_POST['requester']);
    $requestee = $_POST['requestee'];

    header("location: ../project.php?id=$id");
}

header("location: ../project.php?id=$id");
//} else if(isset($_POST['sender']) && isset($_POST['accepter'])) {
//    $friends->acceptRequest($_POST['sender'], $_POST['accepter']);
//   // $accepter = $_POST['accepter'];
//    header("location: ../index.php");
//} else if(isset($_POST['senderd']) && isset($_POST['accepterd'])) {
//    $friends->deleteFriendRequest($_POST['sender'], $_POST['accepter']);
//    header("location: ../index.php");
//} else {
//    header("location: ../profile.php");
//}




?>