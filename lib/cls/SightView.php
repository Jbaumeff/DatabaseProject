<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/16/15
 * Time: 10:44 PM
 */

/**
 * Class SightView View class for a sight
 */
class SightView {
    /**
     * Constructor
     * @param $site The site we are a member of
     * @param $request The $_REQUEST array
     */
    public function __construct(Site $site, $request) {
        $sights = new Sights($site);
        $users = new Users($site);

        if(!isset($request['i'])) {
            header("location: ./");

        } else {
            $this->sight = $sights->get($request['i']);
            if(!is_null($this->sight)) {
                $this->user = $users->get($this->sight->getUserid());
            } else {
                header("location: ./");
            }
        }
    }

    /**
     * @return Get the name of the sight
     */
    public function getName() {
        return $this->sight->getName();
    }

    /**
     * @return Description of the sight
     */
    public function getDescription() {
        return $this->sight->getDescription();
    }

    /**
     * @return HTML for the Super Sighter block
     */
    public function presentSuper() {
//        $users = new Users($this->sight->getId())
        $id = $this->user->getId();
        $name = $this->user->getName();
        $created = date("n-d-Y", $this->sight->getCreated());

        return <<<HTML
<div class="options">
    <h2>SUPER SIGHTER</h2>
    <p><a href="./?i=$id">$name</a></p>
    <p>Since $created</p>
</div>
HTML;

    }

    /**
     * @return Sight
     */
    public function getSight()
    {
        return $this->sight;
    }

    /**
     * @return HTML for the Stats block
     */
    public function presentStats() {
        return '';
    }

    /**
     * @return HTML for all of the sightings
     */
    public function presentSightings() {
        return '';
    }

    /**
     * @return HTML for all deleting the sight
     */
    public function presentSightDelete($sightId) {
        return <<<HTML
<div class="options">
    <h2><a href="./post/delete-sight-post.php?sightId=$sightId">DELETE</a></h2>
</div>
HTML;
    }

    private $sight;
}

?>