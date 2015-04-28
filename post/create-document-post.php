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

if(isset($_POST['name'])) {
    $projectName = $_POST['name'];
    if($projectName == '') {
        $error = "Document name was empty";
        header("location: ../project.php?error=$error");
        exit;
    }

    $projects = new Projects($site);
    if($projects->doesProjectExist($projectName)) {
        $error = "Project name already exists";
        header("location: ../projects.php?error=$error");
        exit;
    }

    $userId = $user->getIdUser();
    $projects->insertProject($projectName, $userId);
    $project = $projects->getProjectByName($projectName);
    $collabs = new Collaborators($site);
    //echo "Userid: " . $userId . " Title: " . $project['title'];
    $collabs->insertNewCollaborator($userId, $project['idProject'], 1);

}
header("location: ../projects.php");