<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 4/27/15
 * Time: 6:45 PM
 */

require '../lib/site.inc.php';

$comments = new Comments($site);

$id = '';

$name = $user->getIdUser();
if(isset($_POST['projectid'])){
    $id = $_POST['id'];
}

if(isset($_POST['submit']) && isset($_POST['userid']) && isset($_POST['version']) && isset($_POST['docName']) && isset($_POST['projectid']) && isset($_POST['comment']) ){
    //$documents->saveDocument($_POST['version'], $id, $_POST['docName'], $name, $_POST['doc']);
    $comments->addComment($_POST['docName'],$_POST['version'],$_POST['projectid'],$_POST['userid'], $_POST['text']);
}

header("location: ../document.php?id=$id");