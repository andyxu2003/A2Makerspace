<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
      $(function () {
        $("#header").load("header.html");
        $("#footer").load("footer.html");
      });
    </script>

    <title>Tutorials</title>

    <link rel="stylesheet" href="css/header.css" />
    <link rel="stylesheet" href="css/tutorials.css" />
  </head>
<body>

<?php
    include('head.php');
?>
    <?php
    // Database configuration
    $dbHost = "mysql-user.eecs.tufts.edu";
    $dbUsername = "a2makerspace";
    $dbPassword = "3tF5ucTgufmW5Z";
    $dbName = "a2makerspace";

    // Create a database connection
    $connection = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

    // Check if the connection was successful
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch distinct tutorial values from the table
    $tutorialQuery = "SELECT DISTINCT tutorial FROM tutorials";
    $tutorialResult = mysqli_query($connection, $tutorialQuery);

    // Fetch distinct level values from the table
    $levelQuery = "SELECT DISTINCT level FROM tutorials";
    $levelResult = mysqli_query($connection, $levelQuery);

    // Build the SQL query to fetch all the data from the table
    $allQuery = "SELECT tutorial, level, name, video, transcript, asl FROM tutorials";
    $allResult = mysqli_query($connection, $allQuery);
    ?>

    <form class="search" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="tutorial">Select Tutorial:</label>
        <select name="tutorial" id="tutorial">
            <option value="">-- All Tutorials --</option>
            <?php
            while ($tutorialRow = mysqli_fetch_assoc($tutorialResult)) {
                $selected = ($_POST['tutorial'] === $tutorialRow['tutorial']) ? 'selected' : '';
                echo '<option value="' . $tutorialRow['tutorial'] . '" ' . $selected . '>' . $tutorialRow['tutorial'] . '</option>';
            }
            ?>
        </select>

        <br>

        <label for="level">Select Level:</label>
        <select name="level" id="level">
            <option value="">-- All Levels --</option>
            <?php
            while ($levelRow = mysqli_fetch_assoc($levelResult)) {
                $selected = ($_POST['level'] === $levelRow['level']) ? 'selected' : '';
                echo '<option value="' . $levelRow['level'] . '" ' . $selected . '>' . $levelRow['level'] . '</option>';
            }
            ?>
        </select>

        <br>

        <input type="submit" name="search" value="Search">
    </form>

    <?php
    // Check if the form is submitted
    if (isset($_POST['search'])) {
        // Retrieve the selected tutorial and level from the form
        $selectedTutorial = $_POST['tutorial'];
        $selectedLevel = $_POST['level'];

        // Build the SQL query to fetch the data based on the selected values
        $query = "SELECT tutorial, level, name, video, transcript, asl FROM tutorials";
        $whereClause = "";

        // Add the conditions to the query if a tutorial or level is selected
        if (!empty($selectedTutorial) && empty($selectedLevel)) {
            $whereClause = "WHERE tutorial = '$selectedTutorial'";
        } else if (empty($selectedTutorial) && !empty($selectedLevel)) {
            $whereClause = "WHERE level = '$selectedLevel'";
        } else if (!empty($selectedTutorial) && !empty($selectedLevel)) {
            $whereClause = "WHERE tutorial = '$selectedTutorial' AND level = '$selectedLevel'";
        }

        $query .= " $whereClause";
        $result = mysqli_query($connection, $query);

        // Check if any rows are returned
        if (mysqli_num_rows($result) > 0) {
            // Iterate through each row and display the data
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<h2>' . $row['name'] . '</h2>';
                echo '<p>Level: ' . $row['level'] . '</p>';
                echo '<iframe width="560" height="315" src="' . $row['video'] . '" frameborder="0" allowfullscreen></iframe>';
                echo '<p>Transcript: ' . $row['transcript'] . '</p>';
                echo '<p>ASL: ' . $row['asl'] . '</p>';
            }
        } else {
            echo 'No matching records found.';
        }
    } else {
        // Display all the data initially
        if (mysqli_num_rows($allResult) > 0) {
            while ($row = mysqli_fetch_assoc($allResult)) {
                echo '<h2>Tutorial: ' . $row['tutorial'] . '</h2>';
                echo '<p>Level: ' . $row['level'] . '</p>';
                echo '<iframe width="560" height="315" src="' . $row['video'] . '" frameborder="0" allowfullscreen></iframe>';
                echo '<p>Transcript: ' . $row['transcript'] . '</p>';
                echo '<p>ASL: ' . $row['asl'] . '</p>';
            }
        } else {
            echo 'No records found.';
        }
    }
    ?>

    <?php
    // Close the database connection
    mysqli_close($connection);
    ?>
</body>
</html>
