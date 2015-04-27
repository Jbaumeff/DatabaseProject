<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/30/15
 * Time: 5:03 PM
 */

class Collaborators extends Table {
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "Collaborators");
    }

    public function getConfirmedProjectsForUserid($userid) {
        $sql =<<<SQL
SELECT * FROM $this->tableName
WHERE idUser=? AND confirmed=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($userid, true));
        return $statement->fetchAll();
    }
}