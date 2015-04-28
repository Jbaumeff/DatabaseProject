<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/30/15
 * Time: 5:03 PM
 */

class Projects extends Table {
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "Project");
    }

    public function getProjectById($projectId) {
        $sql =<<<SQL
SELECT * FROM $this->tableName
WHERE idProject=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($projectId));
        return $statement->fetchAll();
    }

    public function getProjectByName($projectName) {
        $sql =<<<SQL
SELECT * FROM $this->tableName
WHERE title=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($projectName));
        return $statement->fetchAll()[0];
    }

    public function doesProjectExist($projectName) {
        $sql =<<<SQL
SELECT * FROM $this->tableName
WHERE title=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($projectName));
        return count($statement->fetchAll()) > 0;
    }

    public function insertProject($projectName, $creator) {
    $sql =<<<SQL
INSERT INTO $this->tableName (title, creator)
VALUES (?,?)
SQL;
    $statement = $this->pdo()->prepare($sql);
    $statement->execute(array($projectName, $creator));
}

    public function deleteProjectById($projectId, $creator) {
        $sql =<<<SQL
DELETE FROM $this->tableName
WHERE idProject=? AND creator=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($projectId, $creator));
    }


}