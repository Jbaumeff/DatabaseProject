<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/3/15
 * Time: 12:44 PM
 */

// Used for global functions such as the navagation bar
function displayNavigationBar() {
    $html =<<<HTML
<header>
    <div>
        <a href="login.php">Login</a>
        <a href="login.php?o">Logout</a>
        <a href="create-user.php">Create User</a>
        <a href="create-user.php?d">Delete User</a>
        <a href="projects.php">Projects</a>
    </div>
</header>
HTML;
    return $html;
}