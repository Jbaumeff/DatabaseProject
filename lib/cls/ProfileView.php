<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/17/15
 * Time: 12:53 AM
 */

class ProfileView {
    /**
     * Constructor
     * @param $site The site we are a member of
     * @param $request The $_REQUEST array
     */
    public function __construct(Site $site, User $user=null, $request) {
        $this->users = new Users($site);
        $this->sights = new Sights($site);
        $this->friends = new Friends($site);


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
     * @return HTML for about info
     */
    public function presentAbout($userid) {
        $fullName = $this->user->getFullName();
        $idUser = $this->user->getIdUser();
        $emailAddress = $this->user->getEmailAddress();
        $birthYear = $this->user->getBirthYear();
        $hometownCity = $this->user->getHometownCity();
        $hometownState = $this->user->getHometownState();
        $edit = '';
        if($this->user->getIdUser() === $userid) {
            $edit = "- <form method=\"post\" action=\"profile.php\"><input type=\"submit\" id=\"edit\" name=\"edit\" value=\"Edit\"></form></a>";
        } else if(count($this->friends->get($userid, $this->user->getIdUser())) == 0){
            $requestee = $this->user->getIdUser();
            $edit = "- <form method=\"post\" action=\"post/friend-request-post.php\"><input type=\"submit\" id=\"send\" name=\"send\" value=\"Send Friend Request\"><input type=\"hidden\" id=\"requester\" name=\"requester\" value=\"$userid\"><input type=\"hidden\" id=\"requestee\" name=\"requestee\" value=\"$requestee\"></form></a>";
        } else if($this->friends->getRequestStatus($userid, $this->user->getIdUser())) {
            $requestee = $this->user->getIdUser();
            $edit = "- <form method=\"post\" action=\"post/friend-request-post.php\"><input type=\"submit\" id=\"send\" name=\"send\" value=\"Remove Friend\"><input type=\"hidden\" id=\"deleter\" name=\"deleter\" value=\"$userid\"><input type=\"hidden\" id=\"deletee\" name=\"deletee\" value=\"$requestee\"></form></a>";
        } else {
            $edit = "- Friend Request Sent";
        }

        return <<<HTML
<div class="profile">
    <h1>About $edit</h1>
    <p>$fullName</p>
    <p>$idUser</p>
    <p>Email: $emailAddress</p>
    <p>Born in $birthYear</p>
    <p>From $hometownCity, $hometownState</p>
</div>
HTML;
    }

    /**
     * @return HTML for editable about info
     */
    public function presentEditableAbout() {
        $fullName = $this->user->getFullName();
        $idUser = $this->user->getIdUser();
        $emailAddress = $this->user->getEmailAddress();
        $birthYear = $this->user->getBirthYear();
        $hometownCity = $this->user->getHometownCity();
        $hometownState = $this->user->getHometownState();
        $privacy = $this->user->getPrivacy();
        return <<<HTML
<div class="profile">
    <h1>About</h1>
    <p>Full Name</p>
    <form method="post" action="post/edit-about-post.php"><input type="text" id="fullName" name="fullName" value="$fullName"><input type="submit" id="save" name="save" value="Save"></form>
    <p>Email</p>
    <form method="post" action="post/edit-about-post.php"><input type="text" id="email" name="email" value="$emailAddress"><input type="submit" id="save" name="save" value="Save"></form>
    <p>Birth Year</p>
    <form method="post" action="post/edit-about-post.php"><input type="text" id="birthYear" name="birthYear" value="$birthYear"><input type="submit" id="save" name="save" value="Save"></form>
    <p>Hometown City</p>
    <form method="post" action="post/edit-about-post.php"><input type="text" id="city" name="city" value="$hometownCity"><input type="submit" id="save" name="save" value="Save"></form>
    <p>Hometown State</p>
    <form method="post" action="post/edit-about-post.php"><input type="text" id="state" name="state" value="$hometownState"><input type="submit" id="save" name="save" value="Save"></form>
    <p>Privacy Level Is Currently - $privacy</p>
    <form method="post" action="post/edit-about-post.php"><input type="submit" id="low" name="low" value="Low"></form>
    <form method="post" action="post/edit-about-post.php"><input type="submit" id="medium" name="medium" value="Medium"></form>
    <form method="post" action="post/edit-about-post.php"><input type="submit" id="high" name="high" value="High"></form>
</div>
HTML;
    }

    /**
     * @return HTML for all the users friends
     */
    public function presentAcceptedFriends() {
        $friends = $this->friends->getAcceptedFriendsForUserId($this->user->getIdUser());

        $html = '';

        if(count($friends) === 0) {
            $html = "<p>None</p>";
        }

        foreach($friends as $friend) {
            $user = $this->users->get($friend['idUser1']);
            $id = $user->getIdUser();
            $name = $user->getFullName();
            $html .=<<<HTML
<p><a href="profile.php?i=$id">$name</a></p>
HTML;
        }

        return <<<HTML
<div class="options">
<h2>Friends</h2>
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

    private $users;
    private $sights;
    private $friends;
    private $user;
}