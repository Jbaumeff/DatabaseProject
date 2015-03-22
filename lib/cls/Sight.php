<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/16/15
 * Time: 10:30 PM
 */

class Sight {
    private $id;        ///< ID for this sight in the sight table
    private $name;      ///< Who we saw
    private $description;     ///< Description of the sight
    private $created;    ///< When the sight was created
    private $userid;    ///< User-supplied ID

    /**
     * Constructor
     * @param $row Row from the sight table in the database
     */
    public function __construct($row) {
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->description = $row['description'];
        $this->userid = $row['userid'];
        $this->created = strtotime($row['created']);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getCreated()
    {
        return $this->created;
    }


    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->userid;
    }

}


?>