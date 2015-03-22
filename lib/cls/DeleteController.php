<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/19/15
 * Time: 12:39 PM
 */

class DeleteController {
    private $sightId;
    private $sights;

    public function __construct(Site $site, $sightId) {
        $this->sights = new Sights($site);
        $this->sightId = $sightId;
    }

    public function deleteSight() {
        $this->sights->deleteSight($this->sightId);
    }
}