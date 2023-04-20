<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html"; charset="utf-8" />
    <title>Task 2 - Post Status Page</title>
</head>
<body>
	<h1>Status Posting System</h1>
	<!-- This is a form that will be submitted to "poststatusprocess.php" when the "Post" button is clicked. -->
	<form action="poststatusprocess.php" method="POST">
		<label for="statuscode">Status Code:</label>
		<!-- This is a text input field for the status code. The pattern attribute is used to enforce the format of the status code. -->
		<input type="text" id="statuscode" name="statuscode" pattern="S[0-9]{4}" required>
		<br><br>
        <!-- pattern attribute is used to enforce the format of the status code -->
		
		<label for="status">Status:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
		<!-- This is a text input field for the status. The pattern attribute is used to enforce the allowed characters in the status. -->
		<input type="text" id="status" name="status" pattern="[A-Za-z0-9 ,.!?]+" required>
		<br><br>
        <!-- pattern attribute is used to enforce the allowed characters in the status -->

		<label>Share:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
		<!-- These are radio buttons for the sharing options (Public, Friends, Only Me). -->
		<label for="public"><input type="radio" id="public" name="share" value="Public" checked> Public</label>
		<label for="friends"><input type="radio" id="friends" name="share" value="Friends"> Friends</label>
		<label for="onlyme"><input type="radio" id="onlyme" name="share" value="Only Me"> Only Me</label>
		<br><br>

		<label for="date">Date: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
		<!-- This is a text input field for the date. The value attribute is used to set the current server date as the default value, and the pattern attribute is used to enforce the format of the date. -->
		<input type="text" id="date" name="date" value="<?php echo date('d/m/Y'); ?>" pattern="\d{2}/\d{2}/\d{4}" required>
		<br><br>
        <!-- value attribute is used to set the current server date as the default value -->
		<!-- pattern attribute is used to enforce the format of the date -->

		<label>Permission:</label>
		<!-- These are checkboxes for the permission options (Allow Like, Allow Comments, Allow Share). -->
		<label for="allowlike"><input type="checkbox" id="allowlike" name="permission[]" value="Allow Like"> Allow Like</label>
		<label for="allowcomments"><input type="checkbox" id="allowcomments" name="permission[]" value="Allow Comments"> Allow Comments</label>
		<label for="allowshare"><input type="checkbox" id="allowshare" name="permission[]" value="Allow Share"> Allow Share</label>
		<br><br>

		<!-- This is the submit button for the form. -->
		<button type="submit" value="post">Post</button>
	</form>
    <br>
	<style>
		/* This is a CSS code to style the hyperlink to "about.html" */
        a[href="about.html"]
        {
          float: right;
        }
      </style>
		<p>
		<!-- These are hyperlinks to "searchstatusform.html" and "about.html". -->
        <a href="searchstatusform.html"
          >Search a new status</a>
        <a href="about.html"
          >About the assignment</a
        >
      </p>
      <p>
		<!-- These are hyperlinks to "index.html". -->
      <a href="index.html">Return to Home page</a>
    </p>
</body>
</html>