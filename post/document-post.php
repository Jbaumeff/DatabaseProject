<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 4/27/15
 * Time: 6:45 PM
 */

require '../lib/site.inc.php';

$documents = new Documents($site);

$id = '';

$name = $user->getIdUser();
if(isset($_POST['id'])){
    $id = $_POST['id'];
}

if(isset($_POST['save']) && isset($_POST['doc']) && isset($_POST['version']) && isset($_POST['docName']) ){
    $documents->saveDocument($_POST['version'], $id, $_POST['docName'], $name, $_POST['doc']);
    //header("location: ../project.php?id=$id");
}elseif(isset($_POST['discard'])){
    //header("location: ../project.php?id=$id");
}

header("location: ../project.php?id=$id");