<?php
require 'lib/site.inc.php';

$view = new UserView($site, $user, $_REQUEST);

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link href="mystyle.css" rel="stylesheet" type="text/css">
    <title>RICHARD IS LAME</title>
</head>
<body>
    <?php
        echo Format::displayNavigationBar();
    ?>

</body>
</html>