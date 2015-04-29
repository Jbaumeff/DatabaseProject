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
$docName = '';
$version = '';

if(isset($_POST['userid']) && isset($_POST['version']) && isset($_POST['docName']) && isset($_POST['projectid']) && isset($_POST['comment']) ){

    $id = $_POST['projectid'];
    $docName = $_POST['docName'];
    $version = $_POST['version'];

    $comments->addComment($_POST['docName'],$_POST['version'],$_POST['projectid'],$_POST['userid'], $_POST['comment']);
}

header("location: ../document.php?documentName=$docName&projectId=$id&version=$version");