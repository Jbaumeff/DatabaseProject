<?php
require 'lib/site.inc.php';

$view = new UserView($site, $user, $_REQUEST);

$searchDisplay = '';
if(isset($_POST['search'])  && $_POST['search'] !== '') {
	$searchController = new SearchController($site);
	$searchResults = $searchController->getSearchResults($_POST['search']);
	$searchView = new SearchView();
	$searchDisplay = $searchView->presentSearchResults($searchResults);
} else {
	header("location: index.php");
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
		<div class="options">
		<h2>FRIENDS</h2>
		<p><a href="#">Anton Phibes</a></p>
		<p><a href="#">Jennifer</a></p>
		</div>

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
