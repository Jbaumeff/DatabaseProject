<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/16/15
 * Time: 1:00 AM
 */

/**
 * Function to localize our site
 * @param $site The Site object
 */
return function(Site $site) {
    // Set the time zone
    date_default_timezone_set('America/Detroit');

    $site->setEmail('wegschei@cse.msu.edu');
    $site->setRoot('/~wegschei/cse480');
    $site->dbConfigure('mysql:host=mysql-user.cse.msu.edu;dbname=wegschei',
        'wegschei',       // Database user
        'dbase',     // Database password
        '');            // Table prefix
};

?>