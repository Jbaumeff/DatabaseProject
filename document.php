<?php
require 'lib/site.inc.php';

$view = new DocumentView($site, $user, $_REQUEST);

$title = $view->getDocName();
$version = $view->getVersion();
$id = $view->getProjectId();
$content = $view->getContent();

$userName = $user->getIdUser();

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
    <?php echo "<title>Document</title>"; ?>
</head>
<body>
<?php
echo Format::displayNavigationBar();
?>



<div class="main">
    <div class="left">
        <?php
        echo $view->presentPendingFriends($user->getIdUser());
        echo $view->presentAcceptedFriends($user->getIdUser());
        echo $view->presentPendingCollabs($user->getIdUser());
        ?>
    </div>


    <div class="right document">
        <form method="post" action="./post/document-post.php">
            <p><?php echo $title; ?></p>
            <p>&nbsp;</p>
            <p>
                <input type="submit" value="Save Document" name="save" id="save">
                <input type="hidden" id="id" name="id" value=<?php echo $id; ?>>
                <input type="hidden" id="version" name="version" value=<?php echo $version; ?>>
                <input type="hidden" id="docName" name="docName" value="<?php echo $title; ?>">
                <input type="submit" value="Discard Changes" name="discard" id="discard">
            </p>
            <p>&nbsp;</p>
            <p><textarea rows="40" cols="78" name="doc" id="doc"><?php echo $content; ?>
            </textarea></p>
        </form>
        <?php
//            echo "<h1>$title</h1>";
//        if($creator == $user->getIdUser()){
//            echo "<p>Owner - $creator  </p>";
//            echo "<p><a href=\"./post/delete-project-post.php?id=$id&creator=$creator\">Delete</a></p>";
//        }else{
//            echo "<p>Owner - $creator</p>";
//            echo "<p><a href=\"./post/leave-project-post.php?id=$id&name=$userName\">Leave Project</a></p>";
//        }
//        if($creator == $user->getIdUser()) {
//            echo $view->displayAddCollaborators($creator,$id);
//        }
            //echo $view->displayDocuments();
        ?>
    </div>
</div>


</body>
</html>