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

if(isset($_POST['userName']) && isset($_POST['password']) && isset($_POST['fullName'])  && isset($_POST['email'])  && isset($_POST['city']) && isset($_POST['dob']) && isset($_POST['state'])  && isset($_POST['interests']) && isset($_POST['privacy'])) {

    //User doesnt already exist
    if($users->get($_POST['userName'])){
        header("location: ./new-post.php?error=1");
        exit;
    }


    $email= $_POST['email'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];

    //Email contains an @
    $pos = strpos($email, "@");
    if($pos === false)
    {
        header("location: ./new-post.php?error=2");
        exit;
    }

//    //Dob is a 4-digit int
    if(!is_int($dob) && !(strlen((string)$dob)==4)){
        header("location: ../newuser.php?error=3");
        exit;
    }

    //Password is 8 character or longer
    if(strlen($password)<8){
        header("location: ./new-post.php?error=4");
        exit;
    }

    $user = $users->addUser($_POST['userName'], $_POST['fullName'], $_POST['email'], $_POST['dob'], $_POST['city'], $_POST['state'], $_POST['password'], $_POST['privacy']);
    if($user !== null) {
        $_SESSION['user'] = $user;
        header("location: ../index.php");
        exit;
    }

    //ADD FUNCTION TO FIX
    //$user->insertInterests($_POST['interests']);
}else{
    header("location: ../newuser.php?error=0");
    exit;
}

header("location: ../");

?>