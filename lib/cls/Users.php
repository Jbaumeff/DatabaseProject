<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/16/15
 * Time: 3:09 PM
 */

/**
 * Manage users in our system.
 */
class Users extends Table {

    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "User");
    }

    /**
     * Test for a valid login.
     * @param $user User id or email
     * @param $password Password credential
     * @returns User object if successful, null otherwise.
     */
    public function login($user, $password) {
        $sql =<<<SQL
SELECT * from $this->tableName
where (idUser=? or emailAddress=?) and pword=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($user, $user, $password));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new User($statement->fetch(PDO::FETCH_ASSOC));
    }

    /**
     * Add a new user to the table
     * @returns User object if successful, null otherwise.
     */
    public function addUser($idUser, $fullName, $emailAddress, $birthYear, $hometownCity, $hometownState, $pword, $privacy) {
        //Create a new user and add them to the database
        $sql =<<<SQL
INSERT INTO $this->tableName (idUser, fullName, emailAddress, birthYear, hometownCity, hometownState, pword, privacy)
VALUES(?,?,?,?,?,?,?,?)
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($idUser, $fullName, $emailAddress, $birthYear, $hometownCity, $hometownState,$pword,$privacy));

        return $this->login($idUser, $pword);
    }

    /**
     * Get a user based on the id
     * @param $id ID of the user
     * @returns User object if successful, null otherwise.
     */
    public function get($id) {
        $sql =<<<SQL
SELECT * from $this->tableName
where idUser=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new User($statement->fetch(PDO::FETCH_ASSOC));
    }


    //Maybe move to an Interest class at some point
    /**
     * Add the interests for a user
     * @param id The user's id
     * @param $interests The user's interests
     * @returns User object if successful, null otherwise.
     */
    public function insertInterests($id, $interests){
        $interest = explode(',', $interests);

        foreach($interest as $like){
            $sql =<<<SQL
INSERT INTO Interests (Interest, idUser)
VALUE(?,?)
SQL;
            $pdo = $this->pdo();
            $statement = $pdo->prepare($sql);

            $statement->execute(array($like, $id));
        }
}








    /********************************* Update Info ************************************************/

    // Update user fullname
    public function updateUserFullName($id, $newName) {
        $sql =<<<SQL
UPDATE $this->tableName
SET fullName=?
where idUser=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($newName, $id));
    }

    // Update user Id
    public function updateUserId($id, $newId) {
        $user = $this->get($id);
        if(!is_null($user)) {
            return false;
        }
        $sql =<<<SQL
UPDATE $this->tableName
SET idUser=?
where idUser=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($newId, $id));
        return true;
    }

    // Update email
    public function updateUserEmail($id, $newEmail) {
        $sql =<<<SQL
UPDATE $this->tableName
SET emailAddress=?
where idUser=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($newEmail, $id));
    }

    // Update birthYear
    public function updateUserBirthYear($id, $new) {
        $sql =<<<SQL
UPDATE $this->tableName
SET birthYear=?
where idUser=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($new, $id));
    }

    // Update hometownCity
    public function updateUserCity($id, $new) {
        $sql =<<<SQL
UPDATE $this->tableName
SET hometownCity=?
where idUser=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($new, $id));
    }

    // Update hometownState
    public function updateUserState($id, $new) {
        $sql =<<<SQL
UPDATE $this->tableName
SET hometownState=?
where idUser=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($new, $id));
    }

    // Update birthYear
    public function updateUserPrivacy($id, $new) {
        $sql =<<<SQL
UPDATE $this->tableName
SET privacy=?
where idUser=?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($new, $id));
    }
}

?>