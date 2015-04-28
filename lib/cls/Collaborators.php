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

    //List of projects you collaborate on with a given user
    public function getCollaborators($userid1, $userid2){
        $sql =<<<SQL
SELECT * FROM $this->tableName A, $this->tableName B
WHERE A.idUser = ? AND B.idUser=? AND A.idUser <> B.idUser  AND A.confirmed =1 and B.confirmed = 1 and A.idProject = B.idProject
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($userid1, $userid2));

        if($statement->rowCount() > 0){
            return true;
        }

        return false;
    }

    //All collaborators that collaborate on a given project
    public function getAllCollaborators($id){
        $sql =<<<SQL
SELECT * FROM $this->tableName
WHERE confirmed=1 AND idProject=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($id));

        if($statement->rowCount() > 0){
            return $statement->fetchAll();
        }

        return null;
    }

    //All collaborators that collaborate on a given project
    public function getDeniedCollaborators($id){
        $sql =<<<SQL
SELECT * FROM $this->tableName
WHERE confirmed=2 AND idProject=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($id));

        if($statement->rowCount() > 0){
            return $statement->fetchAll();
        }

        return null;
    }

    public function insertNewCollaborator($userId, $projectId, $confirmed = 0) {
        $sql =<<<SQL
INSERT INTO $this->tableName (idUser, idProject, confirmed)
VALUES (?,?,?)
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($userId, $projectId, $confirmed));
    }


    public function deleteRequest($idUser, $id) {
        $sql =<<<SQL
DELETE FROM $this->tableName
WHERE idUser=? AND idProject=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($idUser, $id));
    }

    public function createRequest($idUser, $id)  {
        $sql =<<<SQL
INSERT INTO $this->tableName (idUser, idProject, confirmed)
VALUES (?,?,?)
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($idUser, $id, 0));
    }

    public function acceptRequest($idUser, $id) {
        $sql =<<<SQL
UPDATE $this->tableName
SET confirmed=?
where idUser=? AND idProject=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array(1,$idUser, $id));
    }

    public function rejectRequest($idUser, $id) {
        $sql =<<<SQL
UPDATE $this->tableName
SET confirmed=?
where idUser=? AND idProject=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array(2,$idUser, $id));
    }

    public function getPendingCollabsForUserId($id) {
        $sql =<<<SQL
SELECT * FROM $this->tableName
WHERE idUser=? AND confirmed=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($id, 0));
        return $statement->fetchAll();
    }
}