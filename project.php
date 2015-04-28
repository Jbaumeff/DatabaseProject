<?php
require 'lib/site.inc.php';

$view = new DocumentsView($site, $user, $_REQUEST);


$creator = $view->getCreator();
$title = $view->getTitle();
$id = $view->getId();

$error = '';
if(isset($_REQUEST['error'])) {
    $error = $_REQUEST['error'];
}

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link href="mystyle.css" rel="stylesheet" type="text/css">
    <?php echo "<title>$title</title>"; ?>
</head>
<body>
<?php
echo Format::displayNavigationBar();
?>

<div class="main">
    <div class="left">
        <?php
        //Add a new document here
        echo $view->displayCreateNewDocument($user->getIdUser(), $error);

        //Display collaborators here
        echo $view->displayCollaborators($_REQUEST['id']);

        //Display denied collaborators here
        //if($creator == $user->getIdUser()) {
            echo $view->displayDeniedCollaborators($_REQUEST['id']);
        //}
        echo $view->displayCollaborators($id);
        ?>
    </div>


    <div class="right">
        <?php
            echo "<h1>$title</h1>";
        if($creator == $user->getIdUser()){
            echo "<p>Owner - $creator  </p>";
            echo "<p><a href=\"./post/logout-post.php\">Delete</a></p>";
        }else{
            echo "<p>Owner - $creator</p>";
            echo "<p><a href=\"./post/logout-post.php\">Leave Project</a></p>";
        }
        //if($creator == $user->getIdUser()) {
            echo $view->displayAddCollaborators($creator,$id);
        //}
            //echo $view->displayDocuments();
        ?>
    </div>
</div>


</body>
</html>