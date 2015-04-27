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
        $count = 1;
        $searchDisplay = '';
        foreach($searchResults as $row) {
            $searchDisplay .= "<div class=\"sighting\">";
            $i = $row['iduser'];
            if(isset($row['fullname'])){
                $name = $row['fullname'];
                $searchDisplay .= "<h2><a href=\"profile.php?i=$i\">$count: $i - $name </a></h2>";
            }
            else{
                $searchDisplay .= "<h2><a href=\"profile.php?i=$i\">$count: $i </a></h2>";
            }

            $count = $count + 1;
            $searchDisplay .= "</div>";
        }
        if($count === 1) {
            $searchDisplay = "<div class=\"sighting\"><h2>No Matches Found</h2></div>";
        }

        return $searchDisplay;

    }
}