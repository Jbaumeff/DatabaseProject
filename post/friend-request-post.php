<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/16/15
 * Time: 10:05 PM
 */

$login = true;
require '../lib/site.inc.php';

$friends = new Friends($site);
if(isset($_POST['requestee']) && isset($_POST['requester'])) {
    $friends->createFriendRequest($_POST['requester'], $_POST['requestee']);
    $requestee = $_POST['requestee'];
    header("location: ../profile.php?i=$requestee");
} else if(isset($_POST['deleter']) && isset($_POST['deletee'])) {
    $friends->deleteFriendRequest($_POST['deleter'], $_POST['deletee']);
    $requestee = $_POST['deletee'];
    header("location: ../profile.php?i=$requestee");
} else if(isset($_POST['sender']) && isset($_POST['accepter'])) {
    $friends->acceptRequest($_POST['sender'], $_POST['accepter']);
   // $accepter = $_POST['accepter'];
    header("location: ../index.php");
} else if(isset($_POST['senderd']) && isset($_POST['accepterd'])) {
    $friends->deleteFriendRequest($_POST['sender'], $_POST['accepter']);
    header("location: ../index.php");
} else {
    header("location: ../profile.php");
}




?>