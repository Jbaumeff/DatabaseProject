<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 4/27/15
 * Time: 6:45 PM
 */

$login = true;
require '../lib/site.inc.php';

$error = '';
$projectId = '';
if(isset($_POST['name'])) {
    $documentName = $_POST['name'];
    $projectId = $_POST['projectId'];

    if($documentName == '') {
        $error = "Document name was empty";
        header("location: ../project.php?error=$error&id=$projectId");
        exit;
    }

    $documents = new Documents($site);
    if($documents->doesProjectExist($projectName, $projectId)) {
        $error = "Document name already exists";
        header("location: ../project.php?error=$error&id=$projectId");
        exit;
    }

//    $userId = $user->getIdUser();
//    $projects->insertProject($projectName, $userId);
//    $project = $projects->getProjectByName($projectName);
//
//    $collabs = new Collaborators($site);
//
//    $collabs->insertNewCollaborator($userId, $project['idProject'], 1);

}
header("location: ../project.php?id=$projectId");