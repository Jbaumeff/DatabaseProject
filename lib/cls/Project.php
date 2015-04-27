<?php

// make new user SQL statements
// INSERT INTO Project(title, creator) VALUES (?, ?); $title, $currentUser
// INSERT INTO Collaborators(idUser, idProject, confirmed) SELECT ?, idProject, 1 FROM Project WHERE title=? AND creator=?; $currentUser, $title, $currentUser

// find all projects w/ current user
// SELECT P.Title FROM Project P, Collaborators C WHERE P.idProject=C.idProject AND C.idUser=?; $currentUser

// find all collaborators for given project
// SELECT idUser FROM Collaborators WHERE idProject=?; $projectID