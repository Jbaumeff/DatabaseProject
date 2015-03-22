<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/3/15
 * Time: 12:44 PM
 */

class Format {
    // Used for global functions such as the navagation bar
    public static function displayNavigationBar() {
        $html =<<<HTML
<header>
    <div>
        <a href="profile.php">Profile</a>
        <a href="projects.php">Projects</a>
        <a href="./post/logout-post.php">Logout</a>
    </div>
</header>
HTML;
        return $html;
    }
}
