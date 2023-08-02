<!-- project_details.php -->

<?php
if (isset($_GET['title'])) {
    $servername = "mysql-user.eecs.tufts.edu";
    $username = "a2makerspace";
    $password = "3tF5ucTgufmW5Z";
    $dbname = "a2makerspace";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $title = $_GET['title'];
    $sql = "SELECT * FROM projects WHERE title = '" . $conn->real_escape_string($title) . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>

        <!DOCTYPE html>
        <html>

        <head>
            <title><?php echo $row["title"]; ?></title>
        </head>
        <style>
            .page-container {
                width: 1100px;
                margin: auto;
            }

            .title-container {
                display: flex;
                align-items: center;
                flex-direction: column;
            }

            .project-title {
                font-size: 32px;
                font-weight: bolder;
                text-align: center;
                margin-top: 60px;
                margin-bottom: 40px;
            }

            .hackathon {
                font-size: 20px;
                margin-bottom: 40px;
            }

            .title {
                font-size: 32px;
                font-weight: bolder;
                margin-top: 50px;
                margin-bottom: 20px;
            }

            h1 {
                font-size: 28px;
            }

            h2 {
                font-size: 22px;
            }

            .video-container {
                text-align: center;
            }

            iframe {
                width: 800px;
                height: 450px;
                border-style: none;
            }

            .buttons-container {
                display: flex;
                justify-content: space-evenly;
                margin: auto;
                width: 800px;
                margin-top: 10px;
                margin-bottom: 50px;
            }

            .video-button {
                width: 325px;
                padding: 10px 0;
                font-size: 16px;
                border: 1px solid lightgray;
                border-radius: 5px;
                background-color: #ededed;
                cursor: pointer;
            }

            .video-button:hover {
                background-color: #C2C2C2;
            }

            hr {
                text-align: center;
                background-color: #e0e0e0;
                height: 1px;
                border: none;
                width: 250px;
                margin-top: 50px;
            }

            .text,
            li {
                font-size: 16px;
                line-height: 1.7;
            }

            .space {
                height: 10px;
            }
        </style>

        <body>
            <?php include 'head.php'; ?>

            <?php
            $title = $row["title"];
            $video = $row["video"];
            $ASLvideo = $row["ASLvideo"];
            $transcript = $row["transcript"];
            $accessibility = $row["accessibility"];
            $description = $row["description"];
            $hackathon = $row["hackathon"];
            ?>

            <div class="page-container">
                <div class="title-container">
                    <div class="project-title"><?php echo $title; ?></div>
                    <div class="hackathon">Created for the <b><?php echo $hackathon; ?></b></div>
                </div>



                <div class="video-container">
                    <iframe src="<?php echo $video; ?>"></iframe>
                    <div class="buttons-container">
                        <button class="video-button" id="transcript-button">View Transcript</button>
                        <button class="video-button" onclick=" window.open('<?php echo $ASLvideo; ?>','_blank')">ASL Captioning</button>
                    </div>
                </div>

                <?php include 'display-images.php'; ?>

                <hr>

                <div class="container">
                    <div class="title">Description</div>
                    <div class="text"><?php echo $description; ?></div>
                </div>

                <div class="space"></div>
                <div class="space"></div>

                <div class="title">Supplies</div>
                <ul>
                    <?php
                    for ($i = 1; $i <= 10; $i++) {
                        $supplyName = "supplyName" . $i;
                        $supplyQty = "supplyQty" . $i;

                        if (!empty($row[$supplyName]) && !empty($row[$supplyQty])) {
                            echo '<li>' . $row[$supplyQty] . 'x ' . $row[$supplyName] . '</li>';
                        }
                    }
                    ?>
                </ul>

                <div class="space"></div>
                <div class="space"></div>

                <div class="title">Tutorials</div>

                <?php include 'project-tutorials.php'; ?>

            </div>




            <script>
                // JavaScript to open the transcript page in a new tab when the "transcript-button" is clicked.
                document.getElementById("transcript-button").addEventListener("click", function() {
                    window.open('transcript.php?title=<?php echo urlencode($title); ?>', '_blank');
                });
            </script>

        </body>

        </html>

<?php
    } else {
        echo "Project not found.";
    }

    $conn->close();
} else {
    echo "No project selected.";
}
?>