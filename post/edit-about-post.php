<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/16/15
 * Time: 10:05 PM
 */

$login = true;
require '../lib/site.inc.php';

$users = new Users($site);

if(isset($_POST['fullName'])) {
    $users->updateUserFullName($user->getIdUser(), $_POST['fullName']);
} else if(isset($_POST['email'])) {
    if(strpos($_POST['email'], "@")) {
        $users->updateUserEmail($user->getIdUser(), $_POST['email']);
    } else {
        // Email doesn't contain '@'
    }
} else if(isset($_POST['birthYear'])) {
    if(is_int($_POST['birthYear'] && $_POST['birthYear'] >= 1000 && $_POST['birthYear'] < 10000)) {
        $users->updateUserBirthYear($user->getIdUser(), $_POST['birthYear']);
    } else {
        // Birth year is not an int and not four digits long
    }
} else if(isset($_POST['city'])) {
    $users->updateUserCity($user->getIdUser(), $_POST['city']);
} else if(isset($_POST['state'])) {
    $users->updateUserState($user->getIdUser(), $_POST['state']);
} else if(isset($_POST['low']) || isset($_POST['medium']) || isset($_POST['high'])) {
    if(isset($_POST['low'])) {
        $users->updateUserPrivacy($user->getIdUser(), $_POST['low']);
    } else if(isset($_POST['medium'])) {
        $users->updateUserPrivacy($user->getIdUser(), $_POST['medium']);
    } else if(isset($_POST['high'])) {
        $users->updateUserPrivacy($user->getIdUser(), $_POST['high']);
    }
}

// Refresh the session user
$_SESSION['user'] = $users->get($user->getIdUser());
header("location: ../profile.php");

?>