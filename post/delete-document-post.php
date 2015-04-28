<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/16/15
 * Time: 10:05 PM
 */

$login = true;
require '../lib/site.inc.php';


$documents = new Documents($site);
if(isset($_POST['id'])) {
    $id = $_POST['id'];
    $projectId = $_POST['projectId'];
    $docName = $_POST['documentName'];
    $version = $_POST['version'];

    $documents->deleteDocumentWithVersion($projectId, $docName, $version);
//    echo "ProjectId: " . $projectId . " DocName: " . $docName . " Version: " . $version;
    header("location: ../project.php?id=$id");
    exit;
}
header("location: ../index.php");
?>