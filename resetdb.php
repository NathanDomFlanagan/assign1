<?php
    // Step 1: Establish a database connection
    require_once("../../conf/settings.php");

    $conn = new mysqli($host, $user, $password, $dbname);

    if (!$conn) 
    {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Step 2: Drop the status table
    $sql = "DELETE FROM assign1";
    if (mysqli_query($conn, $sql)) 
    {
        $message = "Database table reset successful";
    } else 
    {
        $message = "Error resetting database table: " . mysqli_error($conn);
    }

    // Step 3: Close the database connection
    mysqli_close($conn);

    // Step 4: Display the message
    echo $message;
?>
    <!-- lines contain several hyperlinks for navigating to different pages  -->
    <style>
        a[href="about.html"]
        {
          float: right;
        }
      </style>
    <!-- lines contain several hyperlinks for navigating to different pages  -->
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
      <p>
      <a href="index.html">Return to Home page</a>
    </p>