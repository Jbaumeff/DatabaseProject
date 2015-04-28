<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/30/15
 * Time: 5:03 PM
 */

class Documents extends Table {
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "Document");
    }

    public function getDocumentsWithProjectId($projectId) {
        $sql =<<<SQL
SELECT * FROM $this->tableName
WHERE idProject=? AND parentVersionNumber is NULL
ORDER BY documentName, versionNumber
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($projectId));
        return $statement->fetchAll();
    }

    public function getDocumentsWithVersionAndProjectId($versionId, $projectId, $documentName) {
        $sql =<<<SQL
SELECT * FROM $this->tableName
WHERE idProject=? AND parentVersionNumber=? AND parentDocumentName=?
ORDER BY documentName, versionNumber
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($projectId, $versionId, $documentName));
        return $statement->fetchAll();
    }

//    public function getProjectByName($projectName) {
//        $sql =<<<SQL
//SELECT * FROM $this->tableName
//WHERE title=?
//SQL;
//        $statement = $this->pdo()->prepare($sql);
//        $statement->execute(array($projectName));
//        return $statement->fetchAll()[0];
//    }

    public function doesDocumentExist($documentName, $projectId) {
        $sql =<<<SQL
SELECT * FROM $this->tableName
WHERE documentName=? AND idProject=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($documentName, $projectId));
        return count($statement->fetchAll()) > 0;
    }

//    public function insertProject($projectName, $creator) {
//        $sql =<<<SQL
//INSERT INTO $this->tableName (title, creator)
//VALUES (?,?)
//SQL;
//        $statement = $this->pdo()->prepare($sql);
//        $statement->execute(array($projectName, $creator));
//    }


}