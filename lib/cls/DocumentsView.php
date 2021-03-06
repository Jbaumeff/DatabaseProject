<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/17/15
 * Time: 12:53 AM
 */

class DocumentsView {
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
        $this->documents = new Documents($site);

        $row = $this->projects->getProjectById(strval($request['id']));
        $this->creator = $row[0]['creator'];
        //$this->creator = $row;
        //$this->creator = $request['id'];
        $this->title = $row[0]['title'];
        $this->id = strval($request['id']);

        if(isset($request['id']) && !is_null($this->users->get($request['id']))) {
            $this->user = $this->users->get($request['id']);
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

    public function getCreator(){
        return $this->creator;
    }

    public function getId(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
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
    public function displayCreateNewDocument($userid, $error)
    {
        $id = $this->id;
        return <<<HTML
<div class="options">
<h2>Create a new document</h2>
<form action="post/create-document-post.php?$userid" method="POST">
<p id="error">$error</p>
<label for="name">Document Name</label>
<input type="text" id="name" name="name">
<input type="hidden" id="projectId" name="projectId" value="$id">
<input type="submit" value="Create">
</form>
</div>
HTML;
    }

    /**
     * @return HTML for all the projects collaborators
     */
    public function displayCollaborators($id) {
        $collabs = $this->collaborators->getAllCollaborators($id);
        $html = '';
        $html .= "<h2>Collaborators</h2>";
        foreach($collabs as $collab) {
            $html .= "<div class=\"sighting\">";
            $name = $collab['idUser'];
            $html .=<<<HTML
<h2><a href="profile.php?i=$name">$name</a></h2>
HTML;
            $html .= "</div>";
        }

        return $html;
    }

    public function displayDeniedCollaborators($id) {
        $collabs = $this->collaborators->getDeniedCollaborators($id);

        $html = '';
        $html .= "<h2>Declined Collaborators</h2>";
        if($collabs == null){
            $html .= "<div class=\"sighting\">";
            $html .=<<<HTML
<h2>None</h2>
HTML;
            $html .= "</div>";
            return $html;
        }




        foreach($collabs as $collab) {
            $html .= "<div class=\"sighting\">";
            $name = $collab['idUser'];
            $html .=<<<HTML
<h2><a href="./post/collaborator-remove-post.php?id=$id&name=$name">$name</a></h2>
HTML;
            $html .= "</div>";
        }

        return $html;
    }

    public function displayAddCollaborators($creator, $id) {
        $html = '';
            $html .=<<<HTML

<p>&nbsp;</p>
<h3>Add A Collaborator</h3>
<form action="post/collaborator-request-post.php?id=$id" method="POST">
<label for="requestee">Name</label>
<input type="text" id="requestee" name="requestee">
<input type="hidden" id="requester" name="requester" value="$id">
<input type="submit" value="Invite To Project">
</form>
HTML;
        return $html;
    }

    /**
     * @return HTML for all the projects collaborators
     */
    public function displayDocuments() {
//        $userId = $this->user->getIdUser();
        $projectId = $this->id;
        $documents = $this->documents->getDocumentsWithProjectId($projectId);

        $html = '';

        if(count($documents) === 0) {
            return "<div class=\"sighting\"><h2>No Documents</h2></div>";
        }

        foreach($documents as $document) {
            $html .= "<div class=\"sighting\">";
            $documentName = $document['documentName'];
            $versionNumber = $document['versionNumber'];
            $form = $this->presentDeleteForm($versionNumber, $projectId, $documentName);
            $docCreator = $this->documents->getOwnerOfDocument($projectId, $documentName, $versionNumber);
            if(is_null($docCreator)) {
                $docCreator = '';
            }

            $html .=<<<HTML
<h2>$documentName</h2>
<p class="time"><ol>
<li>
    <a href="document.php?documentName=$documentName&projectId=$projectId&version=$versionNumber">Version $versionNumber</a>&nbsp; Creator: $docCreator $form
</li>
HTML;
            $html = $this->displayChildren($versionNumber, $documentName, $html);
            $html .= "</ol></p></div>";
        }

        return $html;
    }

    public function displayChildren($parentVersion, $parentName, $html) {
        $projectId = $this->id;
        $documents = $this->documents->getDocumentsWithVersionAndProjectId($parentVersion, $projectId, $parentName);
        if(count($documents) == 0) {
            return $html;
        }

        $html .= "<ol>";
        foreach($documents as $document) {
            $documentName = $document['documentName'];
            $versionNumber = $document['versionNumber'];
            $form = $this->presentDeleteForm($versionNumber, $projectId, $documentName);
            $docCreator = $this->documents->getOwnerOfDocument($projectId, $documentName, $versionNumber);
            if(is_null($docCreator)) {
                $docCreator = '';
            }

            $html .=<<<HTML
<li><a href="document.php?documentName=$documentName&projectId=$projectId&version=$versionNumber">Version $versionNumber</a>&nbsp; Creator: $docCreator $form</li>
HTML;
            $html = $this->displayChildren($versionNumber, $documentName, $html);
        }

        $html .= "</ol>";
        return $html;
    }

    private function presentDeleteForm($versionNumber, $projectId, $documentName) {
        $form = '';
        $id = $this->id;
        if($this->documents->isUserOwnerOfDocument($this->user->getIdUser(), $versionNumber, $projectId, $documentName)) {
            $form =<<<HTML
<form class="doc-delete" action="post/delete-document-post.php" method="POST">
<input type="hidden" id="id" name="id" value="$id">
<input type="hidden" id="version" name="version" value="$versionNumber">
<input type="hidden" id="projectId" name="projectId" value="$projectId">
<input type="hidden" id="documentName" name="documentName" value="$documentName">
<input type="submit" name="delete" value="Delete">
</form>
HTML;
        }
        return $form;
    }

    private $projects;
    private $collaborators;
    private $users;
    private $friends;
    private $user;
    private $documents;

    private $creator;
    private $title;
    private $id;
}