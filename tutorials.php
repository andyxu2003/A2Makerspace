<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(function() {
            $("#header").load("header.html");
            $("#footer").load("footer.html");
        });
    </script>

    <title>Tutorials</title>

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
            margin-bottom: 50px;
            font-size: 50px;
        }

        h2 {
            text-align: center;
            font-size: 24px;
            color: #1434a4;
            padding-bottom: 10px;
        }

        .gray-container {
            background-color: #f6f6f6;;
        }

        .search-container {
            margin: auto;
            width: 80%;
        }

        .search {
            margin-bottom: 50px;
            margin-top: 50px;
        }

        .select {
            margin: auto;
        }

        label {
            display: block;
            text-align: left !important;
            font-size: 20px;
            margin-bottom: 12px;
        }

        .search input[type="submit"],
        #tutorial,
        #level {
            font-size: 16px;
            padding: 12px 0 12px 12px;
            border: 1px solid #bababa;
            border-radius: 5px;
            width: 100%;
        }

        #tutorial,
        #level {
            padding-left: 5px;
        }

        .search-button-container {
            display: flex;
            justify-content: center;
        }

        .search-button {
            width: 200px !important;
        }

        .search-button-container>.search-button {
            height: 45px;
            background-color: #545454;
            color: white;
            border: none;
            border-radius: 15px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 30px;
            border-style: none;
            color: white;
        }

        .search-button:hover {
            color: white;
            background-color: black;
        }

        .search-button-container {
            margin-top: 10px;
        }

        .bottom-container {
            margin-top: 50px;
        }

        .tutorials-container {
            flex-grow: 1;
            margin: 30px 10%;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .results {
            margin: 5px 0 30px 10%;
            font-size: 24px;
            margin-bottom: 50px;
            font-weight: bold;
        }

        .video-container {
            position: relative;
            width: 360px;
            margin-bottom: 70px;
        }

        .video-title {
            text-align: center;
            padding-bottom: 20px;
            font-size: 24px;
        }

        .video-container iframe {
            width: 100%;
            height: 214px;
            cursor: pointer;
            border-style: none;
            border-radius: 10px;
        }

        .video-button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .video-button-container button {
            width: 45%;
            height: 45px;
            background-color: black;
            color: white;
            border-style: none;
            border-radius: 15px;
            font-size: 16px;
            cursor: pointer;
        }

        .video-button-container button:hover {
            color: white;
            background-color: #3f3f3f;
        }
    </style>

    <link rel="stylesheet" href="css/header.css" />
    <!-- <link rel="stylesheet" href="css/tutorials.css" /> -->
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
    <div class="gray-container">
        <h1>Tutorials</h1>

        <div class="search-container">
            <form class="search" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="tutorial">What do you want to learn?</label>
                <div class="select">
                    <select name="tutorial" id="tutorial">
                        <option value="">All Tutorials</option>
                        <?php
                        while ($tutorialRow = mysqli_fetch_assoc($tutorialResult)) {
                            $selected = ($_POST['tutorial'] === $tutorialRow['tutorial']) ? 'selected' : '';
                            echo '<option value="' . $tutorialRow['tutorial'] . '" ' . $selected . '>' . $tutorialRow['tutorial'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="space-50px"></div>
                <div class="space-10px"></div>

                <label for="level">What level do you want to learn it at?</label>
                <div class="select">
                    <select name="level" id="level">
                        <option value="">All Levels</option>
                        <?php
                        while ($levelRow = mysqli_fetch_assoc($levelResult)) {
                            $selected = ($_POST['level'] === $levelRow['level']) ? 'selected' : '';
                            echo '<option value="' . $levelRow['level'] . '" ' . $selected . '>' . $levelRow['level'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="search-button-container">
                    <input class="search-button" type="submit" name="search" value="Search">
                </div>
            </form>
        </div>
    </div>

    <div class="bottom-container">
        <div class="results">Tutorial Results:</div>
        <div class="tutorials-container">
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
            ?>
                        <div class="video-container">
                            <div class="video-title"><?php echo $row['name']; ?></div>
                            <iframe src="<?php echo $row['video']; ?>" allowfullscreen></iframe>
                            <div class="video-button-container">
                                <button onclick="window.open('<?php echo $row['transcript']; ?>');">Transcript</button>
                                <button onclick="window.open('<?php echo $row['asl']; ?>');">ASL</button>
                            </div>
                        </div>
                    <?php
                    }
                } else {
                    echo 'No matching records found.';
                }
            } else {
                // Display all the data initially
                if (mysqli_num_rows($allResult) > 0) {
                    while ($row = mysqli_fetch_assoc($allResult)) {
                    ?>
                        <div class="video-container">
                            <div class="video-title"><?php echo $row['name']; ?></div>
                            <iframe src="<?php echo $row['video']; ?>" allowfullscreen></iframe>
                            <div class="video-button-container">
                                <button onclick="window.open('<?php echo $row['transcript']; ?>');">Transcript</button>
                                <button onclick="window.open('<?php echo $row['asl']; ?>');">ASL</button>
                            </div>
                        </div>
            <?php
                    }
                } else {
                    echo 'No records found.';
                }
            }
            ?>
        </div>
    </div>



    <?php
    // Close the database connection
    mysqli_close($connection);
    ?>
</body>

</html>