<?php
require 'lib/site.inc.php';

$view = new UserView($site, $user, $_REQUEST);

$searchDisplay = '';
if(isset($_POST['search'])  && $_POST['search'] !== '' && isset($_POST['name'])) {
	$searchController = new SearchController($site);
	$searchResults = $searchController->getSearchResults($_POST['search']);
	$searchView = new SearchView();
	$searchDisplay = $searchView->presentSearchResults($searchResults);
} else if(isset($_POST['search'])  && $_POST['search'] !== '' && isset($_POST['interest'])) {
    $searchController = new SearchController($site);
    $searchResults = $searchController->getInterestResults($_POST['search']);
    $searchView = new SearchView();
    $searchDisplay = $searchView->presentSearchResults($searchResults);
} else {
    $searchController = new SearchController($site);
    $searchResults = $searchController->getSearchResults($_POST['search']);
    $searchView = new SearchView();
    $searchDisplay = $searchView->presentSearchResults($searchResults);
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Search Results</title>
	<link href="mystyle.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php echo Format::displayNavigationBar(); ?>


<!-- Main body of page -->
<div class="main">
	<!-- Left side items -->
	<div class="left">
		<?php
		echo $view->presentPendingFriends($user->getIdUser());
		echo $view->presentAcceptedFriends($user->getIdUser());
		?>
	</div>

	<div class="right document" style="margin-bottom: 1em;">
		<?php
			if(isset($_POST['interest'])) {
				echo "<h2>Searched by interests</h2>";
			} else {
				echo "<h2>Searched by name</h2>";
			}
		?>
	</div>
	<!-- Right side items -->
	<div class="right">
		<?php
			echo $searchDisplay;
		?>
	</div>

</div>

</body>
</html>
