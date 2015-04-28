<?php
/**
 * Created by PhpStorm.
 * User: JeffBaum
 * Date: 3/17/15
 * Time: 12:53 AM
 */

class ProjectView {
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
     * @return HTML for all the users friends
     */
    public function displayCreateNewProject($userid, $error) {
        return <<<HTML
<div class="options">
<h2>Create a new project</h2>
<form action="post/create-project-post.php?$userid" method="POST">
<p id="error">$error</p><br>
<label for="name">Project Name</label>
<input type="text" id="name" name="name">
<input type="submit" value="Create">
</form>
</div>
HTML;
    }

    /**
     * @return HTML for all the users friends
     */
    public function displayProjects() {
        $userId = $this->user->getIdUser();
        $collabs = $this->collaborators->getConfirmedProjectsForUserid($userId);
        $html = '';

        if(count($collabs) === 0) {
            return "<div class=\"sighting\"><h2>No Projects</h2></div>";
        }
//        return "<div class=\"sighting\"><h2>$userId</h2></div>";
        foreach($collabs as $collab) {
            $html .= "<div class=\"sighting\">";
            $projectId = $collab['idProject'];
            $project = $this->projects->getProjectById($projectId);
            $title = $project[0]['title'];

            $role = "Collabarator: ";
            if($project[0]['creator'] == $userId) {
                $role = "Owner: ";
            }
            $created = $project[0]['created'];

            $html .=<<<HTML
<h2>$role<a href="project.php?id=$projectId">$title</a></h2>
<p class="time">Last Modified - $created</p>
HTML;
            $html .= "</div>";
        }

        return $html;
    }

    private $projects;
    private $collaborators;
    private $users;
    private $friends;
    private $user;
}