<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/26/15
 * Time: 5:16 PM
 */

class SearchController {
//    private $sightsTable;
    private $usersTable;
    private $pdo;

    public function __construct(Site $site) {
//        $sights = new Sights($site);
        $users = new Users($site);
//        $this->sightsTable = $sights->getTableName();
        $this->usersTable = $users->getTableName();
        $this->pdo = $users->pdo();
    }

    public function getSearchResults($searchFor) {
        $sql =<<<SQL
SELECT iduser, fullname, '1' AS ID
FROM $this->usersTable
WHERE iduser LIKE ?
SQL;

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array("%$searchFor%"));
        return $stmt->fetchAll();
    }

    public function getInterestResults($searchFor) {
        $sql =<<<SQL
SELECT DISTINCT iduser
FROM Interests
WHERE Interest LIKE ?
SQL;

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array("%$searchFor%"));
        return $stmt->fetchAll();
    }
}