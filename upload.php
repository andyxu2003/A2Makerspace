<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Project</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/5031sidsawvxog354epcaqhsm8kali8rjvzmibzwxkf8tijd/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'advlist autolink lists link image charmap print preview',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link',
        });
    </script>
    <style>
        .ui-autocomplete-loading {
            background: white url('https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/images/ui-anim_basic_16x16.gif') right center no-repeat;
        }

        .page-container {
            margin: 0 25%;
        }

        .upload-header {
            background-color: #f6f6f6;
            color: black;
            padding: 20px 0;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .upload-header-container {
            max-width: 100%;
            margin: 0 auto;
            display: flex;
            justify-content: center;
        }

        .upload-header-container nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-between;
        }

        .upload-header-container nav ul li {
            margin-left: 450px;
        }

        .upload-header-container nav ul li:first-child {
            margin-left: 0;
        }

        .upload-header-container nav ul li a {
            color: black;
            text-decoration: none;
            font-size: 20px;
            font-weight: bold;
        }

        .upload-header-container nav ul li a:hover {
            text-decoration: underline;
        }

        #title-counter,
        #intro-counter {
            text-align: right;
        }

        .submit-button {
            font-size: 20px;
            background-color: #f6f6f6;
            border-style: none;
            cursor: pointer;
            font-weight: bolder;
            padding-top: 3px;
        }

        .submit-button:hover {
            background-color: #f6f6f6;
            text-decoration: underline;
        }

        .title {
            font-size: 36px;
            text-align: center;
            font-weight: bolder;
        }

        .subtitle {
            font-size: 24px;
            color: #1434a4;
            margin-bottom: 30px;
            text-align: center;
        }

        .upload-image-container {
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .upload-image-box {
            border: 2px dashed lightgray;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 100%;
            height: 400px;
        }

        .upload-image-box div {
            font-size: 24px;
            text-align: center;
            margin-top: -20px;
        }

        .upload-button-container {
            padding-top: 40px;
        }

        input[type="file"] {
            display: none;
        }

        .title-button,
        .upload-button {
            border-style: none;
            border-radius: 5px;
            padding: 12px 24px;
            background-color: #1434a4;
            color: white;
            font-size: 18px;
            cursor: pointer;
        }

        .title-button-container {
            margin-top: 15px;
        }

        .browse-button-label:hover {
            background-color: #202a44;
        }

        .select-button {
            border-radius: 5px;
        }

        .upload-image-container label {
            margin-bottom: 25px;
        }

        .upload-image-container,
        .title-container,
        .category-container {
            margin-top: 60px;
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .upload-image-container label,
        .title-container label,
        .title-container input .category-container label,
        .category-contaner select,
        .intro-container label,
        .intro-container textarea {
            display: block;
        }

        .upload-image-container label,
        .title-container label,
        .category-container label,
        .intro-container label {
            font-size: 26px;
            font-weight: bolder;
        }

        .title-container input,
        .category-container select {
            width: 100%;
            height: 40px;
            margin-top: 20px;
            font-size: 18px;
        }

        .intro-container label {
            text-align: center;
            margin-top: 60px;
        }

        #intro-subtitle {}

        .intro-container textarea {
            height: 500px;
        }
    </style>
</head>

<body>
    <?php
    // Establish a database connection
    $host = "mysql-user.eecs.tufts.edu";
    $username = "a2makerspace";
    $password = "3tF5ucTgufmW5Z";
    $database = "a2makerspace";

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
        $projectTitle = $_POST['project-name'];
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

            $msg = "<div>Data inserted successfully!</div>";

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
            $msg = "<h3>Failed to insert data into the database.</h3>";
        }

        // Close the statement
        $stmt->close();
    }
    ?>

    <?php
    include('head.php');
    ?>

    <form method="POST" action="" enctype="multipart/form-data">

        <div class="upload-header">
            <div class="upload-header-container">
                <nav>
                    <ul>
                        <li><a href="#">
                                < Go Back</a>
                        </li>
                        <li><a href="#"> ? Help </a></li>
                        <li>
                            <!-- <input class="submit-button" type="submit" value="Submit"> -->
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="page-container">

            <!-- Project name form -->

            <!-- <form id="project-title-form">
                <label for="project-title">Project Title</label>
                <input type="text" id="project-name" name="project-name" maxlength="50" required>
                <button type="submit">Submit</button>
            </form> -->

            <div class="title-container">
                <form id="project-title-form">
                    <label for="project-title">Project Title</label>
                    <input type="text" id="project-name" name="project-name" maxlength="50" required>
                    <div class="title-button-container">
                        <button type="submit" class="title-button">Submit</button>
                    </div>
                </form>
            </div>
            <div id="title-counter"></div>

            <!-- File input element -->
            <!-- <input type="file" id="upload-input" style="display: none;">
            <button id="select-button">Select Image</button>
            <button id="upload-button" style="display: none;">Upload Image</button> -->

            <div class="upload-image-container">
                <label for="image-upload">Upload Images</label>
                <div class="subtitle">What images best showcases your project?</div>
                <div class="upload-image-box">
                    <div>Upload an image below</div>
                    <div class="upload-button-container">
                        <input type="file" id="upload-input" style="display: none;">
                        <button id="select-button" class="upload-button">Select Image</button>
                    </div>
                </div>
            </div>

            <div class="image-grid" id="image-container"></div>

            <script>
                let uploadedImagesCount = 0;
                let customImageName = ""; // Initialize the customImageName variable

                document.getElementById('select-button').addEventListener('click', function(event) {
                    event.stopPropagation(); // Prevent the click event from propagating to other elements
                    // Trigger the file input element when the "Select Image" button is clicked
                    document.getElementById('upload-input').click();
                });

                document.getElementById('upload-input').addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    if (file) {
                        const imageName = customImageName + (uploadedImagesCount > 0 ? uploadedImagesCount + 1 : '');
                        const folderName = 'project-images'; // Folder name in Cloudinary
                        const formData = new FormData();
                        formData.append('file', file);
                        formData.append('upload_preset', 'your_image_upload_preset'); // Replace 'your_image_upload_preset' with your actual upload preset
                        formData.append('public_id', `${folderName}/${imageName}`); // Set the public_id with folder name and image name

                        // Upload the file to Cloudinary using fetch API
                        fetch('https://api.cloudinary.com/v1_1/dlca9mehs/image/upload', {
                                method: 'POST',
                                body: formData
                            })
                            .then(response => response.json())
                            .then(result => {
                                // Handle the successful upload
                                uploadedImagesCount++;
                                displayImage(result.public_id);
                            })
                            .catch(error => {
                                // Handle errors (if any)
                                console.log('Error uploading image:', error);
                            });
                    }
                });

                document.getElementById('project-title-form').addEventListener('submit', function(event) {
                    event.preventDefault();
                    const projectName = document.getElementById('project-name').value.trim();
                    if (projectName !== "") {
                        customImageName = projectName.replace(/\s+/g, '-'); // Update the customImageName with the project name
                        // Update the URL with the project name
                        const newUrl = window.location.origin + window.location.pathname + '?project=' + encodeURIComponent(customImageName);
                        window.history.replaceState({}, document.title, newUrl);
                    }
                });

                function displayImage(publicId) {
                    const imageContainer = document.getElementById('image-container');
                    const imageItem = document.createElement('div');
                    imageItem.className = 'image-item';

                    // Construct the Cloudinary URL for displaying the image
                    const imageUrl = `https://res.cloudinary.com/dlca9mehs/image/upload/${publicId}.jpg`;
                    imageItem.innerHTML = `<img src="${imageUrl}" alt="Uploaded Image" style="max-width: 100%; max-height: 400px;" />`;
                    imageContainer.appendChild(imageItem);

                    // Check if the grid is full (2 by 2)
                    if (imageContainer.children.length >= 4) {
                        // Hide the "Select Image" button and show the "Upload Image" button
                        document.getElementById('select-button').style.display = 'none';
                        document.getElementById('upload-button').style.display = 'block';
                    }
                }

                // Retrieve and set the project name from the URL
                const urlParams = new URLSearchParams(window.location.search);
                const projectNameParam = urlParams.get('project');
                if (projectNameParam) {
                    customImageName = projectNameParam;
                    document.getElementById('project-name').value = projectNameParam.replace(/-/g, ' ');
                }
            </script>

            <!--Old Image Upload-->

            <!-- <div class="upload-image-container">
                <label for="image-upload">Upload Images</label>
                <div class="subtitle">What images best showcases your project?</div>
                <div>Upload an image below</div>
                <div class="browse-button-container">
                    <label for="project-images" class="browse-button-label">
                        Upload image
                    </label>
                    <input class="browse-button" type="file" name="project-images[]" id="project-images" multiple accept="image/*">
                </div>
            </div> -->

            <!-- Project Title -->

            <!-- <div class="title-container">
                <label for="project-title">Project Title</label>
                <input type="text" id="project-title" name="project-title" maxlength="50" required>
            </div>
            <div id="title-counter"></div> -->

            <br>
            <div class="category-container">
                <label for="category">Category</label>
                <select name="category" id="category" required>
                    <?php
                    foreach ($categories as $category) {
                        echo "<option value='" . $category . "'>" . $category . "</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Introduction -->
            <div class="intro-container">
                <label for="intro-input">Introduction</label><br>
                <div class="subtitle" id="intro-subtitle">What did you make and why?</div>
                <textarea id="intro-input" name="intro-input" maxlength="1000"></textarea>
            </div>

            <!-- Supplies -->

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
    </form>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        const messageEle = document.getElementById('project-name');
        const counterEle = document.getElementById('title-counter');

        messageEle.addEventListener('input', function(e) {
            const target = e.target;

            // Get the `maxlength` attribute
            const maxLength = target.getAttribute('maxlength');

            // Count the current number of characters
            const currentLength = target.value.length;

            counterEle.innerHTML = `${currentLength}/${maxLength}`;
        });

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