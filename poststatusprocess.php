<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html"; charset="utf-8" />
    <title>Task 3 - Process Post Status Page</title>
</head>
<div class="content">
    <body>
        <h1>Status Posting System</h1>
        <?php
            // Check if the required fields are present and valid
            if (!isset($_POST['statuscode']) || !preg_match('/^S\d{4}$/', $_POST['statuscode'])) 
            {
                // Set error message if status code is missing or invalid
                $error_message = "Wrong format! The status code must start with an “S” followed by four digits, like “S0001”.";
            } 
            elseif (!isset($_POST['status']) || !preg_match('/^[A-Za-z0-9 ,.!?]+$/', $_POST['status'])) 
            {
                // Set error message if status is missing or invalid
                $error_message = "Your status is in a wrong format! The status can only contain alphanumericals and spaces, comma, period, exclamation point and question mark and cannot be blank!";
            } 
            elseif (!isset($_POST['date']) || !DateTime::createFromFormat('d/m/Y', $_POST['date'])->format('Y-m-d')) 
            {
                // Set error message if date is missing or invalid
                $error_message = "Invalid date format! The date you submitted was: " . $_POST['date'];
            } 
            else 
            {
                // Include database connection settings
                require_once("../../conf/settings.php");

                // Create new database connection
                $conn = new mysqli($host, $user, $password, $dbname);

                // Check if the table exists, if not create the table
                if (!$conn->query("DESCRIBE assign1")) 
                {
                    $sql = "CREATE TABLE assign1 (
                        statuscode VARCHAR(30) NOT NULL,
                        status TEXT NOT NULL,
                        share VARCHAR(20) NOT NULL,
                        date DATE NOT NULL,
                        allowlike TINYINT(1) NOT NULL DEFAULT '0',
                        allowcomments TINYINT(1) NOT NULL DEFAULT '0',
                        allowshare TINYINT(1) NOT NULL DEFAULT '0',
                        PRIMARY KEY (statuscode)
                    )";

                    // If table creation fails, output error message and stop execution
                    if (!$conn->query($sql)) 
                    {
                        die("Table creation failed: " . $conn->error);
                    }
                }
                // If database connection fails, output error message and stop execution
                if ($conn->connect_error)
                {
                    die("Connection failed: " . $conn->connect_error);
                }   

                // Check if the status code already exists in the table
                $statuscode = $_POST['statuscode'];
                $result = $conn->query("SELECT * FROM assign1 WHERE statuscode = '$statuscode'");
                if ($result->num_rows > 0) 
                {
                    // Check if the status code already exists in the table
                    $error_message = "The status code already exists. Please try another one!";
                } 
                else 
                {
                    // Insert the data into the table
                    $status = $_POST['status'];
                    $share = $_POST['share'];
                    $date = DateTime::createFromFormat('d/m/Y', $_POST['date'])->format('Y-m-d');
                    $allowlike = isset($_POST['permission']) && in_array('Allow Like', $_POST['permission']) ? 1 : 0;
                    $allowcomments = isset($_POST['permission']) && in_array('Allow Comments', $_POST['permission']) ? 1 : 0;
                    $allowshare = isset($_POST['permission']) && in_array('Allow Share', $_POST['permission']) ? 1 : 0;
                    
                    $sql = "INSERT INTO assign1 (statuscode, status, share, date, allowlike, allowcomments, allowshare)
                            VALUES ('$statuscode', '$status', '$share', '$date', $allowlike, $allowcomments, $allowshare)";

                    if ($conn->query($sql)) 
                    {
                        $success_message = "Congratulations! The status has been posted!";
                    } else 
                    {
                        $error_message = "Error: " . $sql . "<br>" . $conn->error;
                    }
                }

                // Close the database connection
                $conn->close();
            }
        ?>
        <!-- Use isset function to check if one of the variables is triggered  -->
        <?php if (isset($error_message)) : ?>
            <p>Error: <?php echo $error_message; ?></p>
        <?php endif; ?>

        <?php if (isset($success_message)) : ?>
            <p>Success: <?php echo $success_message; ?></p>
        <?php endif; ?>
        <!-- Defines a CSS style for a hyperlink that has a href attribute of "about.html".   -->
        <style>
        a[href="about.html"]
        {
          float: right;
        }
        /* lines contain several hyperlinks for navigating to different pages */
      </style>
        <br>
        <p>
        <a href="poststatusform.php"
          >Post a new status</a
        >
        <a href="about.html"
          >About the assignment</a
        >
      </p>
      <p>
        <a
          href="searchstatusform.html"
          >Search status</a
        >
      </p>
	    <a href="index.html">Return to Home Page</a>
    </body>
</div>
</html>