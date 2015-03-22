<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/19/15
 * Time: 12:35 AM
 */

class SightController {
    private $name;
    private $description;
    private $createdOn;
    private $userId;
    private $sights;

    public function __construct(Site $site, $name, $description, $createdOn, $userId) {
        $this->sights = new Sights($site);
        $this->name = $name;
        $this->description = $description;
        $this->createdOn = $createdOn;
        $this->userId = $userId;
    }

    public function insertNewSight() {
        $this->sights->insertNewSight($this->name, $this->description, $this->createdOn, $this->userId);
    }
}

?>