<!DOCTYPE html>
<html>
<head>
	<title>Status Search Results</title>
</head>
<body>
	<header>
		<h1>Status Search Results</h1>
	</header>
	<div class="content">
		<?php
			// check if the search string is empty
			if(empty($_GET['search'])) {
				echo '<p>Error: The search string is empty. Please enter a keyword to search.</p>';
				echo '<p><a href="index.html">Return to Home Page</a> | <a href="searchstatusform.html">Return to Search Status page</a></p>';
			} else {
				$searchString = $_GET['search'];

				// connect to the database
				require_once("../../conf/settings.php");

				$conn = new mysqli($host, $user, $password, $dbname);
				// check if the connection was successful
				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				}

				// search for the status in the table
				$sql = "SELECT * FROM assign1 WHERE status LIKE '%$searchString%'";
				$result = $conn->query($sql);

				// check if any status was found
				if ($result->num_rows == 0) {
					echo '<p>Status not found. Please try a different keyword.</p>';
					echo '<p><a href="index.html">Return to Home Page</a> | <a href="searchstatusform.html">Return to Search Status page</a></p>';
				} else {
					// display the status information
					while($row = $result->fetch_assoc()) {
						echo '<h2>Status Information</h2>';
						echo '<p>Status: '.$row["status"].'</p>';
						echo '<p>Status Code: '.$row["statuscode"].'</p>';
						echo '<p>Share: '.$row["share"].'</p>';
						echo '<p>Date Posted: ' . date("F j, Y", strtotime($row["date"])) . '</p>';
						echo '<p>Permission: ';
						if ($row["allowlike"] == 1) {
							echo "Likes, ";
						}
						if ($row["allowcomments"] == 1) {
							echo "Comments, ";
						}
						if ($row["allowshare"] == 1) {
							echo "Share, ";
						}
						echo "</p>";
						echo '<hr>';
					}
					echo '<p><a href="index.html">Return to Home Page</a> | <a href="searchstatusform.html">Search for another status</a> | <a href="about.html">About the assignment</a>';
				}
				// close the database connection
				$conn->close();
			}
		?>
	</div>
</body>
</html>