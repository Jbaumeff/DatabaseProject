<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/16/15
 * Time: 10:00 PM
 */

$login = true;
require '../lib/site.inc.php';

if(isset($_POST['create']) or isset($_POST['New User'])){
    header("location: ../newuser.php");
    exit;
}

if(isset($_POST['userName']) && isset($_POST['password'])) {
    $users = new Users($site);

    $user = $users->login($_POST['userName'], $_POST['password']);
    if($user !== null) {
        $_SESSION['user'] = $user;
        header("location: ../");
        exit;
    }
}

header("location: ../login.php?invalid");

?>