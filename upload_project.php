

<!DOCTYPE html>

<!-- WORKING -->

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Project</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <style>
        .ui-autocomplete-loading {
            background: white url('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/images/ui-anim_basic_16x16.gif') right center no-repeat;
        }
    </style>
</head>

<body>
    <?php
    // Establish a database connection
    $host = 'localhost';
    $username = 'uwaerk2zmgkkn';
    $password = 'xgzg0am1i0lu';
    $database = 'dbu5gngwqyyak3';

    $conn = new mysqli($host, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve categories from the database
    $categories = array();
    $query = "SELECT name FROM categories";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = $row['name'];
        }
    }

    // Retrieve supplies from the database
    $supplies = array();
    $query = "SELECT name FROM supplies";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $supplies[] = $row['name'];
        }
    }

    // Retrieve skills from the database
    $skills = array();
    $query = "SELECT name FROM skills";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $skills[] = $row['name'];
        }
    }

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the input values from the form
        $projectTitle = $_POST['project-title'];
        $category = $_POST['category'];
        $introduction = $_POST['intro-input'];

        // Prepare and execute the database query
        $stmt = $conn->prepare("INSERT INTO projects (filename, title, category, introduction) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $filename, $projectTitle, $category, $introduction);

        // Set the filename to an empty value since it's not provided in the HTML code
        $filename = "";

        // Execute the query
        if ($stmt->execute()) {
            // Retrieve the last inserted project ID
            $projectId = $conn->insert_id;

            // Insert the supplies into the respective columns
            $supplies = $_POST['supplies'];
            $supplyQtys = $_POST['quantity'];

            // Validate the number of supplies
            if (count($supplies) > 5) {
                echo "<h3>Error: Maximum 5 supplies allowed.</h3>";
            } else {
                for ($i = 0; $i < count($supplies); $i++) {
                    $supplyNameCol = "supplyName" . ($i + 1);
                    $supplyQtyCol = "supplyQty" . ($i + 1);
                    $supplyName = $supplies[$i];
                    $supplyQty = $supplyQtys[$i];

                    $stmt = $conn->prepare("UPDATE projects SET $supplyNameCol = ?, $supplyQtyCol = ? WHERE id = ?");
                    $stmt->bind_param("ssi", $supplyName, $supplyQty, $projectId);
                    $stmt->execute();
                }
            }

            // Insert the skills into the respective columns
            $skills = $_POST['skills'];
            $skillLevels = $_POST['skill-level'];

            // Validate the number of skills
            if (count($skills) > 5) {
                echo "<h3>Error: Maximum 5 skills allowed.</h3>";
            } else {
                for ($i = 0; $i < count($skills); $i++) {
                    $skillNameCol = "skillName" . ($i + 1);
                    $skillLevelCol = "skillLevel" . ($i + 1);
                    $skillName = $skills[$i];
                    $skillLevel = $skillLevels[$i];

                    $stmt = $conn->prepare("UPDATE projects SET $skillNameCol = ?, $skillLevelCol = ? WHERE id = ?");
                    $stmt->bind_param("ssi", $skillName, $skillLevel, $projectId);
                    $stmt->execute();
                }
            }

            echo "<h3>Data inserted successfully!</h3>";

            // Create a directory for the project images
            $projectImagesDir = "project_images/" . $projectTitle;
            if (!is_dir($projectImagesDir)) {
                mkdir($projectImagesDir, 0777, true);
            }

            // Process the uploaded images
            $uploadedImages = $_FILES['project-images'];
            $numImages = count($uploadedImages['name']);
            for ($i = 0; $i < $numImages; $i++) {
                $imageName = $uploadedImages['name'][$i];
                $imageTmpName = $uploadedImages['tmp_name'][$i];
                $imagePath = $projectImagesDir . "/" . $imageName;
                move_uploaded_file($imageTmpName, $imagePath);
            }
        } else {
            echo "<h3>Failed to insert data into the database.</h3>";
        }

        // Close the statement
        $stmt->close();
    }
    ?>


    <h1>Upload Project</h1>

    <form method="POST" action="" enctype="multipart/form-data">

        <h2>Upload Images</h2>
        <input type="file" name="project-images[]" id="project-images" multiple accept="image/*">

        <h2>Project Details</h2>
        <label for="project-title">Project Title:</label>
        <input type="text" id="project-title" name="project-title" required>
        <br>
        <label for="category">Category:</label>
        <select name="category" id="category" required>
            <?php
            foreach ($categories as $category) {
                echo "<option value='" . $category . "'>" . $category . "</option>";
            }
            ?>
        </select>

        <h2>Introduction</h2>
        <label for="intro-input">Introduction:</label>
        <textarea id="intro-input" name="intro-input" required></textarea>

        <h2>Supplies and Tools</h2>
        <div id="supplies-container">
            <div class="supply-row">
                <input type="text" class="supplies-input" name="supplies[]" placeholder="Enter supplies and tools" required>
                <input type="number" class="quantity-input" name="quantity[]" placeholder="Qty" required>
                <button type="button" class="remove-button">Remove</button>
            </div>
        </div>
        <button type="button" id="add-supply-button">Add Supply</button>

        <h2>Skills Needed</h2>
        <div id="skills-container">
            <div class="skill-row">
                <input type="text" class="skills-input" name="skills[]" placeholder="Enter skills" required>
                <input type="text" class="skill-level-input" name="skill-level[]" placeholder="Skill Level" required>
                <button type="button" class="remove-button">Remove</button>
            </div>
        </div>
        <button type="button" id="add-skill-button">Add Skill</button>

        <br>
        <input type="submit" value="Submit">
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        // Autocomplete for supplies input field
        $(function() {
            $(".supplies-input").autocomplete({
                source: <?php echo json_encode($supplies); ?>,
                minLength: 1
            });
        });

        // Autocomplete for skills input field
        $(function() {
            $(".skills-input").autocomplete({
                source: <?php echo json_encode($skills); ?>,
                minLength: 1
            });
        });

        // Autocomplete for skill level input field
        $(function() {
            $(".skill-level-input").autocomplete({
                source: <?php echo json_encode($skillLevels); ?>,
                minLength: 1
            });
        });

        // Function to handle adding and removing supply rows
        document.getElementById("add-supply-button").addEventListener("click", function() {
            var supplyContainer = document.getElementById("supplies-container");
            var supplyRow = document.createElement("div");
            supplyRow.classList.add("supply-row");

            var suppliesInput = document.createElement("input");
            suppliesInput.type = "text";
            suppliesInput.classList.add("supplies-input");
            suppliesInput.name = "supplies[]";
            suppliesInput.placeholder = "Enter supplies and tools";
            suppliesInput.required = true;

            var quantityInput = document.createElement("input");
            quantityInput.type = "number";
            quantityInput.classList.add("quantity-input");
            quantityInput.name = "quantity[]";
            quantityInput.placeholder = "Qty";
            quantityInput.required = true;

            var removeButton = document.createElement("button");
            removeButton.type = "button";
            removeButton.classList.add("remove-button");
            removeButton.textContent = "Remove";
            removeButton.addEventListener("click", function() {
                supplyContainer.removeChild(supplyRow);
            });

            supplyRow.appendChild(suppliesInput);
            supplyRow.appendChild(quantityInput);
            supplyRow.appendChild(removeButton);
            supplyContainer.appendChild(supplyRow);
        });

        // Function to handle adding and removing skill rows
        document.getElementById("add-skill-button").addEventListener("click", function() {
            var skillContainer = document.getElementById("skills-container");
            var skillRow = document.createElement("div");
            skillRow.classList.add("skill-row");

            var skillsInput = document.createElement("input");
            skillsInput.type = "text";
            skillsInput.classList.add("skills-input");
            skillsInput.name = "skills[]";
            skillsInput.placeholder = "Enter skills";
            skillsInput.required = true;

            var skillLevelInput = document.createElement("input");
            skillLevelInput.type = "text";
            skillLevelInput.classList.add("skill-level-input");
            skillLevelInput.name = "skill-level[]";
            skillLevelInput.placeholder = "Skill Level";
            skillLevelInput.required = true;

            var removeButton = document.createElement("button");
            removeButton.type = "button";
            removeButton.classList.add("remove-button");
            removeButton.textContent = "Remove";
            removeButton.addEventListener("click", function() {
                skillContainer.removeChild(skillRow);
            });

            skillRow.appendChild(skillsInput);
            skillRow.appendChild(skillLevelInput);
            skillRow.appendChild(removeButton);
            skillContainer.appendChild(skillRow);
        });
    </script>
</body>

</html>