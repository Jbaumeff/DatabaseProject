<?php
require 'lib/site.inc.php';

$view = new UserView($site, $user, $_REQUEST);

$senderId;
$accepterId;
if(isset($_GET['sender']) && isset($_GET['accepter'])) {
	$senderId = $_GET['sender'];
	$accepterId = $_GET['accepter'];
} else {
	header("location: index.php");
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Accept Request</title>
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

	<!-- Right side items -->
	<div class="right">
		<p>Do you want to accept the request?</p>
		<form method="post" action="post/friend-request-post.php">
			<input type="hidden" id="sender" name="sender" value=<?php echo $senderId; ?>>
			<input type="hidden" id="accepter" name="accepter" value=<?php echo $accepterId; ?>>
			<input type="submit" id="accept" name="accept" value="Accept">
		</form>
		<form method="post" action="post/friend-request-post.php">
			<input type="hidden" id="senderd" name="senderd" value=<?php echo $senderId; ?>>
			<input type="hidden" id="accepterd" name="accepterd" value=<?php echo $accepterId; ?>>
			<input type="submit" id="deny" name="deny" value="Deny">
		</form>
	</div>

</div>

</body>
</html>
