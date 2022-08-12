<?php
//You can do this however you want to.

//I would personally make a separate page to view/update/delete a note, then link to that page with each individual note.
//Maybe use a GET parameter there? (ie, link to view.php?id={id})

//Then maybe a form with an action of add.php to add new notes, do the logic there, then spit them back here.
//Or you can point the action here and take care of that in this php block. Up to you.


//Get all notes for the user here.
$notes = [];
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Notes</title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-------------------- LINKS -------------------->
		<!-- Bootstrap framework CDN -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" 
			    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" 
				integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>

		<!-- jQuery CDN -->
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<!-- Custom CSS and JavaScript files -->
		<link rel="stylesheet" href="app.css">
		<script src="app.js"></script>

	</head>
	<body>
		<div class="container">
			<!-- figure it out! -->
			<!-- You'll probably want to foreach over every note the user has. -->
		</div>
	</body>
</html>
