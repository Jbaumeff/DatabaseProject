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
        <a href="./">Home</a>
        <a href="profile.php">Profile</a>
        <a href="projects.php">Projects</a>
        <a href="./post/logout-post.php">Logout</a>
        <form method="post" action="search-results.php">
            <input type="search" id="search" name="search"><input type="submit" value="Friends by Name" name="name" id="name">
            <input type="submit" value="Friends by Interests" name="interest" id="interest">
        </form>
    </div>
</header>
HTML;
        return $html;
    }
}
