<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/16/15
 * Time: 3:23 PM
 */

class User {

    private $idUser;        ///< ID for this user in the user table
    private $fullName;    ///< User-supplied ID
    private $emailAddress;      ///< What we call you by
    private $birthYear;     ///< Email address
    private $hometownCity;    ///< When we joined the site
    private $hometownState;
    private $privacy;

    /**
     * Constructor
     * @param $row Row from the user table in the database
     */
    public function __construct($row) {
        $this->idUser = $row['idUser'];
        $this->fullName = $row['fullName'];
        $this->emailAddress = $row['emailAddress'];
        $this->birthYear = $row['birthYear'];
        $this->hometownCity = $row['hometownCity'];
        $this->hometownState = $row['hometownState'];
        $this->privacy = $row['privacy'];
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @return mixed
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @return mixed
     */
    public function getBirthYear()
    {
        return $this->birthYear;
    }

    /**
     * @return mixed
     */
    public function getHometownCity()
    {
        return $this->hometownCity;
    }

    /**
     * @return mixed
     */
    public function getHometownState()
    {
        return $this->hometownState;
    }

    /**
     * @return mixed
     */
    public function getPrivacy()
    {
        return $this->privacy;
    }


}

?>