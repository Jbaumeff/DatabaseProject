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

    public function isUserOwnerOfDocument($userid, $versionId, $projectId, $documentName) {
        $sql =<<<SQL
SELECT * FROM $this->tableName
WHERE idProject=? AND versionNumber=? AND documentName=? AND creator=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($projectId, $versionId, $documentName, $userid));
        return count($statement->fetchAll()) > 0;
    }

    public function deleteDocumentWithVersion($projectId, $documentName, $versionNumber) {
        $sql =<<<SQL
DELETE FROM $this->tableName
WHERE idProject=? AND versionNumber=? AND documentName=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($projectId, $versionNumber, $documentName));
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

    public function getOwnerOfDocument($projectId, $documentName, $versionNumber) {
        $sql =<<<SQL
SELECT * FROM $this->tableName
WHERE idProject=? AND versionNumber=? AND documentName=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($projectId, $versionNumber, $documentName));
        $rows = $statement->fetchAll();
        return $rows[0]['creator'];
    }


    public function saveDocument($parentVersion, $projectId, $docName, $user, $content){
        $sql =<<<SQL
SELECT MAX(versionNumber) FROM $this->tableName
WHERE idProject=? and documentName=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($projectId,$docName));

        $nextVersion = 1;
        $pProjectId = null;
        $pDocName = null;
        $pParentVersion = null;


        if($statement->rowCount() > 0){
            $num = $statement->fetchAll();
            $number = intval($num[0]['versionNumber']);
            $nextVersion = $number + 1;
            $pProjectId = $projectId;
            $pDocName = $docName;
            $pParentVersion = $parentVersion;

            $sql =<<<SQL
INSERT INTO $this->tableName (idProject,documentName, versionNumber, fileContent,creator, parentIdProject,parentDocumentName, parentVersionNumber)
VALUES(?,?,?,?,?,?,?,?)
SQL;
            $statement = $this->pdo()->prepare($sql);
            $statement->execute(array($projectId,$docName, $nextVersion, $content, $user, $pProjectId,$pDocName, $pParentVersion));
        }else{
            $sql =<<<SQL
INSERT INTO $this->tableName (idProject,documentName, versionNumber, fileContent,creator)
VALUES(?,?,?,?,?)
SQL;
            $statement = $this->pdo()->prepare($sql);
            $statement->execute(array($projectId, $docName, $nextVersion, $content, $user));
        }
    }

    public function getDocumentContent($version, $projectId, $docName){
        $sql =<<<SQL
SELECT * FROM $this->tableName
WHERE idProject=? and documentName=? and versionNumber=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($projectId,$docName, $version));
        return $statement->fetchAll()[0];
    }
}