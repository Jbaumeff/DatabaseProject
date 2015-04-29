<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/30/15
 * Time: 5:03 PM
 */

class Comments extends Table {
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "Comments");
    }

    public function addComment($document, $version, $projectId, $user, $text){
        $sql =<<<SQL
INSERT INTO $this->tableName ()
VALUES(?,?,?,?,?)
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($projectId, $version,$document));
    }

    public function getComments($document, $version, $projectId){
        $sql =<<<SQL
SELECT * FROM $this->tableName
WHERE idProject=? AND versionNumber=? and documentName=?
ORDER BY timestamp
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($projectId, $version,$document));
        return $statement->fetchAll();
    }

}