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
        $this->users = new Users($site);
        $this->sights = new Sights($site);
        $this->friends = new Friends($site);
        $this->collaborators = new Collaborators($site);
        $this->projects = new Projects($site);

        if(isset($request['i']) && !is_null($this->users->get($request['i']))) {
            $this->user = $this->users->get($request['i']);
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
     * @return HTML for all the users friends
     */
    public function presentAcceptedFriends($userid) {
        $friends = $this->friends->getAcceptedFriendsForUserId($this->user->getIdUser());
        $html = '';

        if(count($friends) === 0) {
            $html = "<p>None</p>";
        }

        foreach($friends as $friend) {
            $user = $this->users->get($friend['idUser1']);

            if($userid == $this->user->getIdUser()) {
                if($userid == $user->getIdUser()) {
                    $user = $this->users->get($friend['idUser2']);
                }
            } else {
                if($user->getIdUser() != $userid) {
                    $user = $this->users->get($friend['idUser2']);
                }
            }

            $id = $user->getIdUser();
            $name = $user->getFullName();
            $html .=<<<HTML
<p><a href="profile.php?i=$id">$name</a></p>
HTML;
        }
        $title = '';
        if($userid == $this->user->getIdUser()) {
            $title = "Friends";
        } else {
            $name = $this->user->getFullName();
            $title = "$name's Friends";
        }
        return <<<HTML
<div class="options">
<h2>$title</h2>
$html
</div>
HTML;
    }

    /**
     * @return HTML for all the users friends
     */
    public function presentPendingFriends($userid) {
        if($userid != $this->user->getIdUser()) {
            return;
        }

        $friends = $this->friends->getPendingFriendsForUserId($this->user->getIdUser());
        $html = '';

        if(count($friends) === 0) {
            $html = "<p>None</p>";
        }

        foreach($friends as $friend) {
            $user = $this->users->get($friend['idUser1']);
            $id = $user->getIdUser();
            $name = $user->getFullName();
            $html .=<<<HTML
<p><a href="accept-request.php?sender=$id&accepter=$userid">$name</a></p>
HTML;
        }

        return <<<HTML
<div class="options">
<h2>Pending Friends</h2>
$html
</div>
HTML;
    }

    public function presentPendingCollabs($userid) {
        if($userid != $this->user->getIdUser()) {
            return;
        }

        $collabs = $this->collaborators->getPendingCollabsForUserId($this->user->getIdUser());//getPendingFriendsForUserId($this->user->getIdUser());
        $html = '';

        if(count($collabs) === 0) {
            $html = "<p>None</p>";
        }

        foreach($collabs as $collab) {
            $user = $this->users->get($collab['idUser']);
            $id = $user->getIdUser();
            $name = $user->getFullName();
            $pid = $collab['idProject'];
            $project = $this->projects->getProjectById($pid);
            $title = $project[0]['title'];


            $html .=<<<HTML
<p><a href="accept-collab-request.php?sender=$pid&accepter=$userid">$title</a></p>
HTML;
        }

        return <<<HTML
<div class="options">
<h2>Pending Collaborations</h2>
$html
</div>
HTML;
    }

    private $users;
    private $friends;
    private $sights;
    private $user;
    private $collaborators;
    private $projects;
}