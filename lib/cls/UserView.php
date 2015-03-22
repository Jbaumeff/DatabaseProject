<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/17/15
 * Time: 12:53 AM
 */

class UserView {
    /**
     * Constructor
     * @param $site The site we are a member of
     * @param $request The $_REQUEST array
     */
    public function __construct(Site $site, User $user=null, $request) {
        $users = new Users($site);
        $this->sights = new Sights($site);


        if(isset($request['i']) && !is_null($users->get($request['i']))) {
            $this->user = $users->get($request['i']);
        } else {
            $this->user = $user;
        }
    }

    /**
     * @return Get the name of the user
     */
    public function getName()
    {
        return $this->user->getName();
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return HTML for the Stats block
     */
    public function presentStats() {
        return '';
    }

    /**
     * @return HTML for all of the sights
     */
    public function presentSights() {
        $userSights = $this->sights->getSightsForUser($this->user->getId());

        if(count($userSights) === 0) {
            return;
        }

        $html =<<<HTML
HTML;

        foreach($userSights as $sight) {
            $id = $sight->getId();
            $name = $sight->getName();
            $html .=<<<HTML
<p><a href="sight.php?i=$id">$name</a></p>
HTML;
        }

        return <<<HTML
<div class="options">
<h2>SIGHTS</h2>
$html
</div>
HTML;
    }

    /**
     * @return HTML for all of the sights
     */
    public function presentSightings() {

    }

    private $sights;
    private $user;
}