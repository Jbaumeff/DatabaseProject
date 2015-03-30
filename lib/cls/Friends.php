<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/30/15
 * Time: 5:03 PM
 */

class Friends extends Table {
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "Friends");
    }

    // idUser1 = requester
    // idUser2 = requestee
    public function get($idUser1,$idUser2) {
        $sql =<<<SQL
SELECT * FROM $this->tableName
WHERE idUser1=? AND idUser2=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($idUser1, $idUser2));
        return $statement->fetchAll();
    }

    public function getRequestStatus($idUser1,$idUser2) {
        $sql =<<<SQL
SELECT * FROM $this->tableName
WHERE idUser1=? AND idUser2=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($idUser1, $idUser2));
        $all = $statement->fetchAll();
        foreach($all as $row) {
            if($row['confirmed'] == 1) {
                return true;
            }
        }
        return false;
    }

    public function getAcceptedFriendsForUserId($id) {
        $sql =<<<SQL
SELECT * FROM $this->tableName
WHERE (idUser1=? OR idUser2=?) AND confirmed=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($id, $id, 1));
        return $statement->fetchAll();
    }

    public function getPendingFriendsForUserId($id) {
        $sql =<<<SQL
SELECT * FROM $this->tableName
WHERE idUser2=? AND confirmed=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($id, 0));
        return $statement->fetchAll();
    }

    public function deleteFriendRequest($idUser1, $idUser2) {
        $sql =<<<SQL
DELETE FROM $this->tableName
WHERE idUser1=? AND idUser2=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($idUser1, $idUser2));
    }

    public function createFriendRequest($idUser1, $idUser2)  {
        $sql =<<<SQL
INSERT INTO $this->tableName (idUser1, idUser2, confirmed)
VALUES (?,?,?)
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($idUser1, $idUser2, 0));
    }

    public function acceptRequest($idUser1, $idUser2) {
            $sql =<<<SQL
UPDATE $this->tableName
SET confirmed=?
where idUser1=? AND idUser2=?
SQL;
            $statement = $this->pdo()->prepare($sql);
            $statement->execute(array(1,$idUser1, $idUser2));
    }
}