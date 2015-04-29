<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/17/15
 * Time: 12:53 AM
 */

class DocumentView {
    /**
     * Constructor
     * @param $site The site we are a member of
     * @param $request The $_REQUEST array
     */
    public function __construct(Site $site, User $user=null, $request) {
        $this->users = new Users($site);
        $this->friends = new Friends($site);
        $this->collaborators = new Collaborators($site);
        $this->projects = new Projects($site);
        $this->comments = new Comments($site);

        $documents = new Documents($site);

        $this->user = $user;
        $this->docName = $request['documentName'];
        $this->projectId =$request['projectId'];
        $this->version = $request['version'];

        $document = $documents->getDocumentContent($this->version,$this->projectId,$this->docName);

        $this->content= $document['fileContent'];
    }

    /**
     * @return Get the name of the user
     */
    public function getName()
    {
        return $this->user->getName();
    }

    public function getDocName()
    {
        return $this->docName;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getProjectId()
    {
        return $this->projectId;
    }

    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return $this->user;
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

    public function addComment($document, $version, $projectId, $user){
        //return $this->comments->addComment($document, $version, $projectId, $user);
        $html = <<<HTML
<div class="sighting">
<h2> Add a Comment</h2>
<form method="post" action="./post/comment-post.php">
<input type="text" id="comment" name="comment">
<input type="hidden" id="userid" name="userid" value="$user">
<input type="hidden" id="projectid" name="projectid" value="$projectId">
<input type="hidden" id="docName" name="docName" value="$document">
<input type="hidden" id="version" name="version" value="$version">
<input type="submit" name="submit" value="Submit">
</form>
</div>
HTML;

        return $html;
    }

    public function displayComments($document, $version, $projectId){
        return $this->comments->displayComments($document, $version, $projectId);
    }


    private $projects;
    private $collaborators;
    private $users;
    private $friends;
    private $user;

    private $projectId;
    private $docName;
    private $version;
    private $content;
    private $comments;
}