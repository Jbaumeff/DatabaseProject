<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/16/15
 * Time: 10:30 PM
 */

class Sights extends Table{
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "sight");
    }

    /**
     * Get a sight by id
     * @param $id The sight by ID
     * @returns Sight object if successful, null otherwise.
     */
    public function get($id) {
        $sql =<<<SQL
SELECT * from $this->tableName
where id=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new Sight($statement->fetch(PDO::FETCH_ASSOC));
    }

    /**
     * Get all sights for a given user
     * @param $id The user ID
     * @returns An array of Sight objects
     */
    public function getSightsForUser($id) {
        $sql =<<<SQL
SELECT * from $this->tableName
where userid=?
order by name
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($id));

        $result = array();  // Empty initial array
        foreach($statement as $row) {
            $result[] = new Sight($row);
        }

        return $result;
    }

    /**
     * Insert a new sight into the database
     */
    public function insertNewSight($name, $description, $createdOn, $userId) {
        $sql =<<<SQL
INSERT INTO $this->tableName (name, description, created, userid)
VALUES (?, ?, ?, ?)
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($name, $description, $createdOn, $userId));
    }

    /**
     * Insert a new sight into the database
     */
    public function deleteSight($sightId) {
        $sql =<<<SQL
DELETE FROM $this->tableName
WHERE id=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($sightId));
    }
}

?>