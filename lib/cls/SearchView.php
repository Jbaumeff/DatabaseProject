<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/23/15
 * Time: 6:30 PM
 */

class SearchView {
    public function __construct() {

    }

    public function presentSearchResults($searchResults) {
        $count = 0;
        $searchDisplay = '';
        foreach($searchResults as $row) {
            $searchDisplay .= "<div class=\"sighting\">";
            $i = $row['iduser'];
            if($row['ID'] === '1') {
                $name = $row['fullname'];
                $searchDisplay .= "<h2><a href=\"profile.php?i=$i\">$name</a></h2>";
            }
            $count = $count + 1;
            $searchDisplay .= "</div>";
        }
        if($count === 0) {
            $searchDisplay = "<div class=\"sighting\"><h2>None</h2></div>";
        }

        return $searchDisplay;

    }
}