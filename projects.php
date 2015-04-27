<?php
require 'lib/site.inc.php';

$view = new ProjectView($site, $user, $_REQUEST);

$fullName = $user->getFullName();
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
    <?php echo "<title>Projects</title>"; ?>
</head>
<body>
<?php
echo Format::displayNavigationBar();
?>

<div class="main">
    <div class="left">
        <?php
            echo $view->displayCreateNewProject($user->getIdUser(), $error);
        ?>
    </div>

    <div class="right">
        <?php
            echo $view->displayProjects();
        ?>
    </div>
</div>


</body>
</html>