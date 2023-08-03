<!DOCTYPE html>
<html>

<head>
    <title>Project Upload</title>
    <!-- Add the Cloudinary Upload Widget and Image Gallery Widget scripts -->
    <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/5031sidsawvxog354epcaqhsm8kali8rjvzmibzwxkf8tijd/tinymce/5/tinymce.min.js"></script>

    <style>
        body {
            background-color: #fbfbfb;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .page-container {
            width: 1000px;
            margin: 0 auto;
            background-color: white;
        }

        .help-button-container {
            text-align: center;
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .help-button {
            color: black !important;
            font-size: 16px;
            text-decoration: none;
            background-color: #f6f6f6;
            border: 1px solid lightgray;
            border-radius: 20px;
            padding: 12px;
        }

        .help-button:hover {
            background-color: lightgray;
        }

        #videoContainer,
        #ASLvideoContainer {
            margin-top: 30px;
            width: 560px;
            height: 315px;
            border: 2px dashed #ddd;
        }

        textarea {
            height: 400px;
            resize: none;
            font-family: Arial, sans-serif;
            width: 700px;
        }

        .gallery-container {
            /* text-align: center; */
            margin-top: 20px;
            width: 900px;

            /* Center the images horizontally */
        }

        .flex-item {
            display: inline-block;
            /* Display images inline */
            width: 150px;
            /* Set a fixed width for each image */
            height: 100px;
            /* Set a fixed height for each image */
            cursor: pointer;
            /* Remove max-width and overflow */
            border: 2px solid #ddd;
            border-radius: 5px;
            margin: 5px;
            /* Add some margin between images for spacing */
            object-fit: cover;
        }

        .flex-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .selected {
            border-color: #1434a4;
        }

        .bottom-image-container {
            margin: auto;
            /* margin-top: 20px; */
            width: 750px;
            height: 550px;
            border: 2px dashed #ddd;
            position: relative;
        }

        .bottom-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .grid-wrapper {
            display: grid;
            justify-content: center;
            flex-wrap: wrap;
        }

        .alt-container {
            width: 810px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .alt-input-container {
            display: flex;
            align-items: center;
            flex-direction: column;
            margin-bottom: -22px;

        }

        .alt-input-container label {
            display: none;
        }

        .alt-container input {
            width: 390px;
            font-size: 14px !important;
            padding: 12px 0 12px 6px !important;
            margin-bottom: 10px;
        }

        .image-caption {
            text-align: center;
            font-size: 16px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        #imageContainer {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        /*               */

        .container {
            border: 1px solid lightgray;
            border-radius: 5px;
            display: flex;
            align-items: center;
            flex-direction: column;
            padding: 40px 0;
        }

        label,
        input {
            display: block;
            font-size: 20px;
        }

        label {
            /* font-weight: bolder; */
            padding-bottom: 15px;
            font-weight: bold;
        }

        .bold-label {
            font-weight: bold;
        }

        .space {
            height: 30px;
            background-color: #fbfbfb;
        }

        .text-input,
        #accessibility,
        #hackathon {
            width: 700px;
        }

        input[type="text"],
        input[type="number"],
        input[type="submit"],
        #accessibility,
        #hackathon,
        textarea {
            font-size: 16px;
            padding: 12px 0 12px 12px;
            border: 1px solid #bababa;
            border-radius: 5px;
        }

        ::placeholder {
            font-style: italic;
        }

        .flex-container {
            display: flex;
            justify-content: space-between;
            width: 700px;
            padding-bottom: 15px;
        }

        .supplies-left {
            width: 76%;
        }

        .supplies-right {
            width: 8%;
        }

        .skills-left {
            width: 60%;
        }

        .skills-right {
            width: 24%;
        }

        .removeSkill,
        .removeSupply,
        .removeTag {
            width: 10%;
            font-size: 14px;
        }

        #addSupply,
        #addSkill,
        #addTag,
        input[type="button"],
        input[type="submit"] {
            font-size: 16px;
            padding: 12px 10px;
        }

        button,
        input[type="button"],
        input[type="submit"] {
            background-color: #1434a4;
            border-style: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }

        button:hover,
        input[type="button"]:hover,
        input[type="submit"]:hover {
            background-color: #202a44;
        }

        .tag-input {
            width: 87%;
        }

        .submit-container {
            display: flex;
            justify-content: center;
            background-color: #fbfbfb;
        }

        input[type="submit"] {
            width: 200px;
        }

        .white-container {
            border: 1px solid lightgray;
            border-radius: 5px;
            display: flex;
            align-items: center;
            flex-direction: column;
            padding: 40px 0;
            background-color: white;
        }

        .video-container {
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .white-space {
            height: 80px;
            background-color: white;
        }
    </style>
</head>

<body>

    <?php include 'head.php'; ?>

    <div class="space"></div>

    <div class="page-container">
        <div class="container">

            <label class="bold-label">Upload Images</label>
            <form id="imageUploadForm">
                <input type="hidden" name="title" value="<?php echo htmlspecialchars($_POST["title"]); ?>">
                <input type="button" value="Upload Image" id="uploadButton" />
            </form>

            <div class="grid-wrapper">
                <div class="gallery-container" id="imageContainer"></div>
            </div>

            <div class="help-button-container">
                <button class="help-button" onclick="window.open('https://www.w3.org/WAI/tutorials/images/informative/', '_blank')">Image Descriptions Help</button>
            </div>

            <form id="projectForm" action="project-submitted" method="post">
                <!-- <form id="altForm" action="project-submitted" method="post"> -->
                <div class="alt-container" class="alt-container">
                    <div class="alt-input-container">
                        <label for="alt1" class="alt-label">Image #1 Name</label>
                        <input type="text" name="alt1" id="alt1" alt="Image 1 Name" placeholder="Image #1 Description" autocomplete="off" required><br>
                    </div>
                    <div class="alt-input-container">
                        <label for="alt2" class="alt-label">Image #2 Name</label>
                        <input type="text" name="alt2" id="alt2" alt="Image 2 Name" placeholder="Image #2 Description" autocomplete="off"><br>
                    </div>
                    <div class="alt-input-container">
                        <label for="alt3" class="alt-label">Image #3 Name</label>
                        <input type="text" name="alt3" id="alt3" alt="Image 3 Name" placeholder="Image #3 Description" autocomplete="off"><br>
                    </div>
                    <div class="alt-input-container">
                        <label for="alt4" class="alt-label">Image #4 Name</label>
                        <input type="text" name="alt4" id="alt4" alt="Image 4 Name" placeholder="Image #4 Description" autocomplete="off"><br>
                    </div>
                    <div class="alt-input-container">
                        <label for="alt5" class="alt-label">Image #5 Name</label>
                        <input type="text" name="alt5" id="alt5" alt="Image 5 Name" placeholder="Image #5 Description" autocomplete="off"><br>
                    </div>
                    <div class="alt-input-container">
                        <label for="alt6" class="alt-label">Image #6 Name</label>
                        <input type="text" name="alt6" id="alt6" alt="Image 6 Name" placeholder="Image #6 Description" autocomplete="off"><br>
                    </div>
                    <div class="alt-input-container">
                        <label for="alt7" class="alt-label">Image #7 Name</label>
                        <input type="text" name="alt7" id="alt7" alt="Image 7 Name" placeholder="Image #7 Description" autocomplete="off"><br>
                    </div>
                    <div class="alt-input-container">
                        <label for="alt8" class="alt-label">Image #8 Name</label>
                        <input type="text" name="alt8" id="alt8" alt="Image 8 Name" placeholder="Image #8 Description" autocomplete="off"><br>
                    </div>
                    <div class="alt-input-container">
                        <label for="alt9" class="alt-label">Image #9 Name</label>
                        <input type="text" name="alt9" id="alt9" alt="Image 9 Name" placeholder="Image #9 Description" autocomplete="off"><br>
                    </div>
                    <div class="alt-input-container">
                        <label for="alt10" class="alt-label">Image #10 Name</label>
                        <input type="text" name="alt10" id="alt10" alt="Image 10 Name" placeholder="Image #10 Description" autocomplete="off"><br>
                    </div>
                </div>

                <!-- </form> -->

                <div class="grid-wrapper">
                    <div class="bottom-image-container">
                        <img id="mainImage" src="" class="bottom-image" alt="Selected Image" />
                    </div>
                </div>

        </div>

        <div class="space"></div>

        <!-- <form id="projectForm" action="project-submitted" method="post"> -->

        <!--UPLOAD VIDEO-->
        <div class="white-container">

            <div class="video-container">
                <label for="video">Upload Video</label>
                <input class="text-input" type="text" name="video" id="videoLinkInput" autocomplete="off" placeholder="Paste your YouTube video link here" />
                <div id="videoContainer"></div>
            </div>

            <div class="white-space"></div>

            <!--UPLOAD ASL CAPTIONING VIDEO-->

            <div class="video-container">
                <label for="ASLvideo">Upload ASL Captioning for Video</label>
                <input class="text-input" type="text" name="ASLvideo" id="ASLvideoLinkInput" autocomplete="off" placeholder="Paste your YouTube video link with ASL Captioning here" />
                <div id="ASLvideoContainer"></div>
            </div>

            <div class="white-space"></div>

            <!--TRANSCRIPT-->
            <div class="video-container">
                <label for="transcript">Transcript of Video</label>
                <textarea type="text" name="transcript" id="transcript" autocomplete="off" placeholder="Paste the transcript of your video here"></textarea>
            </div>

            <div class="white-space"></div>

            <!--ACCESSIBILITY-->

            <div class="video-container">
                <label for="accessibility" class="bold-label">Accessibility Level of Video</label>
                <select name="accessibility" id="accessibility" required>
                </select>
            </div>

        </div>

        <div class="space"></div>

        <!--DESCRIPTION-->

        <div class="container">
            <label for="description" class="bold-label">Description</label>
            <textarea name="description" id="description" required placeholder="What did you make, and why?"></textarea>
        </div>

        <div class="space"></div>

        <!--SUPPLIES-->

        <div id="suppliesContainer" class="container">
            <label for="supplies" class="bold-label">Supplies</label>
            <div class="flex-container">
                <input type="text" name="supplyName[]" required list="suppliesList" autocomplete="off" class="supplies-left" placeholder="What did you use to make the project? Include the quantity" />
                <input type="number" name="supplyQty[]" required min="1" class="supplies-right" placeholder="Qty" />
                <button type="button" class="removeSupply">Remove</button>
            </div>
            <button type="button" id="addSupply">Add More Supplies</button>
        </div>
        <datalist id="suppliesList"></datalist>

        <div class="space"></div>

        <!--SKILLS-->

        <div id="skillsContainer" class="container">
            <label for="skills" class="bold-label">Skills</label>
            <div class="flex-container">
                <input type="text" name="skillName[]" required list="skillsList" autocomplete="off" class="skills-left" placeholder="What skills do you need? Include the skill level" />
                <input type="text" name="skillLevel[]" required list="skillLevelList" autocomplete="off" class="skills-right" placeholder="Skill Level" />
                <button type="button" class="removeSkill">Remove</button>
            </div>
            <button type="button" id="addSkill">Add More Skills</button>
        </div>
        <datalist id="skillsList"></datalist>
        <datalist id="skillLevelList">
            <option value="Beginner">
            <option value="Intermediate">
            <option value="Advanced">
        </datalist>

        <div class="space"></div>

        <!--TAGS-->

        <div id="tagsContainer" class="container">
            <label for="tags" class="bold-label">Tags</label>
            <div class="flex-container">
                <input type="text" name="tagName[]" required list="tagsList" autocomplete="off" class="tag-input" placeholder="Set a tag for your project" />
                <button type="button" class="removeTag">Remove</button>
            </div>
            <button type="button" id="addTag">Add More Tags</button>
        </div>
        <datalist id="tagsList"></datalist>

        <div class="space"></div>

        <!--HACKATHON TAGS-->

        <div class="container">
            <label for="hackathon" class="bold-label">Hackathon</label>
            <select name="hackathon" id="hackathon" required>
            </select>
        </div>


        <div class="space"></div>

        <input type="hidden" name="title" value="<?php echo $_POST['title']; ?>" />
        <div class="submit-container">
            <input type="submit" value="Submit" />
        </div>
        </form>
    </div>

    <div class="space"></div>

    <script>
        function submitBothForms() {
            // Get references to the forms
            const altForm = document.getElementById('altForm');
            const projectForm = document.getElementById('projectForm');

            // Submit both forms
            altForm.submit();
            projectForm.submit();
        }
    </script>

    <!-- ADDING AND REMOVING ITEMS JAVASCRIPT -->

    <script>
        $(document).ready(function() {
            // Function to handle adding more supplies
            $("#addSupply").click(function() {
                var newSupply = `
                <div class="flex-container">
                    <input type="text" name="supplyName[]" required list="suppliesList" autocomplete="off" class="supplies-left" placeholder="What did you use to make the project? Include the quantity" />
                    <input type="number" name="supplyQty[]" required min="1" class="supplies-right" placeholder="Qty" />
                    <button type="button" class="removeSupply">Remove</button>
                </div>
      `;

                // Append the new supply fields above the "Add More Supplies" button
                $("#addSupply").before(newSupply);
            });

            // Function to handle removing supplies
            $("#suppliesContainer").on("click", ".removeSupply", function() {
                $(this).parent().remove();
            });

            // Function to handle adding more supplies
            $("#addSkill").click(function() {
                var newSkill = `
                <div class="flex-container">
                    <input type="text" name="skillName[]" required list="skillsList" autocomplete="off" class="skills-left" placeholder="What skills do you need? Include the skill level" />
                    <input type="text" name="skillLevel[]" required list="skillLevelList" autocomplete="off" class="skills-right" placeholder="Skill Level" />
                    <button type="button" class="removeSkill">Remove</button>
                </div>
            `;
                // Append the new skill fields above the "Add More Skills" button
                $("#addSkill").before(newSkill);
            });

            // Function to handle removing skills
            $("#skillsContainer").on("click", ".removeSkill", function() {
                $(this).parent().remove();
            });

            // Function to handle adding more tags
            $("#addTag").click(function() {
                var newTag = `
                <div class="flex-container">
                    <input type="text" name="tagName[]" required list="tagsList" autocomplete="off" class="tag-input" placeholder="Set a tag for your project" />
                    <button type="button" class="removeTag">Remove</button>
                </div>
            `;

                // Append the new tag fields above the "Add More Tags" button
                $("#addTag").before(newTag);
            });

            // Function to handle removing tags
            $("#tagsContainer").on("click", ".removeTag", function() {
                $(this).parent().remove();
            });


        });
    </script>

    <!-- POPULATING DATALIST FROM SQL JAVASCRIPT/PHP -->

    <script>
        $(document).ready(function() {
            // Function to populate a datalist with options
            function populateDatalist(listId, data) {
                var datalist = $('#' + listId);
                datalist.empty(); // Clear existing options

                // Append new options to the datalist
                data.forEach(function(option) {
                    datalist.append('<option value="' + option + '">');
                });
            }

            // Data fetched from the PHP code
            var optionsData = <?php
                                // Replace the following variables with your database credentials
                                $host = "mysql-user.eecs.tufts.edu";
                                $username = "a2makerspace";
                                $password = "3tF5ucTgufmW5Z";
                                $database = "a2makerspace";

                                // Create a database connection
                                $conn = new mysqli($host, $username, $password, $database);

                                // Check connection
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // Function to fetch data from the specified table and column
                                function fetchData($conn, $table_name, $column_name)
                                {
                                    $query = "SELECT $column_name FROM $table_name";
                                    $result = $conn->query($query);

                                    $data = array();
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $data[] = $row[$column_name];
                                        }
                                    }

                                    return $data;
                                }

                                // Fetch data from each table and column
                                $categoryData = fetchData($conn, 'categories', 'name');
                                $descriptionData = fetchData($conn, 'description', 'name');
                                $suppliesData = fetchData($conn, 'supplies', 'name');
                                $skillsData = fetchData($conn, 'skills', 'name');
                                $tagsData = fetchData($conn, 'tags', 'name');
                                $accessibilityData = fetchData($conn, 'accessibility', 'name');

                                // Close the database connection
                                $conn->close();

                                // Combine the data into an associative array
                                $data = array(
                                    'category' => $categoryData,
                                    'description' => $descriptionData,
                                    'supplies' => $suppliesData,
                                    'skills' => $skillsData,
                                    'tags' => $tagsData,
                                    'accessibility' => $accessibilityData,
                                );

                                echo json_encode($data);
                                ?>;

            // Populate the datalists with the fetched data
            populateDatalist('categoryList', optionsData.category);
            populateDatalist('descriptionList', optionsData.description);
            populateDatalist('suppliesList', optionsData.supplies);
            populateDatalist('skillsList', optionsData.skills);
            populateDatalist('tagsList', optionsData.tags);
            populateDatalist('accessibilityList', optionsData.accessibility);
        });
    </script>

    <script>
        // Function to populate the select element with options
        function populateAccessibilitySelect(selectElement, options) {
            // Clear existing options
            selectElement.innerHTML = "";

            // Create the placeholder option
            const placeholderOption = document.createElement("option");
            placeholderOption.value = ""; // Empty value
            placeholderOption.textContent = "Select Accessibility Level"; // Placeholder text
            placeholderOption.disabled = true; // Disable the placeholder option, so it can't be selected
            placeholderOption.selected = true; // Make the placeholder option selected by default
            selectElement.appendChild(placeholderOption);

            // Append new options to the select element
            options.forEach(function(option) {
                const optionElement = document.createElement("option");
                optionElement.value = option;
                optionElement.textContent = option;
                selectElement.appendChild(optionElement);
            });
        }

        // Function to fetch the accessibility data from the PHP script and populate the select element
        function populateAccessibilityDropdown() {
            // Fetch the data from the PHP script
            <?php
            // Replace the following variables with your database credentials
            $host = "mysql-user.eecs.tufts.edu";
            $username = "a2makerspace";
            $password = "3tF5ucTgufmW5Z";
            $database = "a2makerspace";

            // Create a database connection
            $conn = new mysqli($host, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch data from the "accessibility" table
            $query = "SELECT name FROM accessibility";
            $result = $conn->query($query);

            $data = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row["name"];
                }
            }

            // Close the database connection
            $conn->close();

            // Pass the data to JavaScript as a JSON object
            echo "var accessibilityOptions = " . json_encode($data) . ";";
            ?>

            // Get the select element
            const accessibilitySelect = document.getElementById("accessibility");

            // Populate the select element with the fetched options
            populateAccessibilitySelect(accessibilitySelect, accessibilityOptions);
        }

        // Call the function to populate the accessibility dropdown when the page loads
        document.addEventListener("DOMContentLoaded", populateAccessibilityDropdown);
    </script>

    <script>
        function populateHackathonSelect(selectElement, options) {
            // Clear existing options
            selectElement.innerHTML = "";

            // Create the placeholder option
            const placeholderOption = document.createElement("option");
            placeholderOption.value = "";
            placeholderOption.textContent = "Was this project part of a hackathon?";
            placeholderOption.disabled = true;
            placeholderOption.selected = true;
            selectElement.appendChild(placeholderOption);

            // Append new options to the select element
            options.forEach(function(option) {
                const optionElement = document.createElement("option");
                optionElement.value = option;
                optionElement.textContent = option;
                selectElement.appendChild(optionElement);
            });
        }
        // Function to fetch the hackathon data from the PHP script and populate the select element
        function populateHackathonDropdown() {
            // Fetch the data from the PHP script
            <?php
            // Replace the following variables with your database credentials
            $host = "mysql-user.eecs.tufts.edu";
            $username = "a2makerspace";
            $password = "3tF5ucTgufmW5Z";
            $database = "a2makerspace";

            // Create a database connection
            $conn = new mysqli($host, $username, $password, $database);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch data from the "hackathon" table
            $query = "SELECT name FROM hackathons";
            $result = $conn->query($query);

            $data = array();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row["name"];
                }
            }

            // Close the database connection
            $conn->close();

            // Pass the data to JavaScript as a JSON object
            echo "var hackathonOptions = " . json_encode($data) . ";";
            ?>

            // Get the select element
            const hackathonSelect = document.getElementById("hackathon");

            // Populate the select element with the fetched options
            populateHackathonSelect(hackathonSelect, hackathonOptions);
        }

        // Call the function to populate the accessibility dropdown when the page loads
        document.addEventListener("DOMContentLoaded", populateHackathonDropdown);
    </script>

    <!-- VIDEO UPLOAD JAVASCRIPT -->

    <script>
        // Function to extract the video ID from the YouTube link
        function getVideoID(link) {
            const regex = /(?:\?v=|\/embed\/|\.be\/)([a-zA-Z0-9_-]+)/;
            const match = link.match(regex);
            return match ? match[1] : null;
        }

        // Function to generate the embedded YouTube video URL
        function generateEmbeddedURL(videoID) {
            return `https://www.youtube.com/embed/${videoID}`;
        }

        // Function to update the embedded video when the input field changes
        function updateEmbeddedVideo() {
            const inputField = document.getElementById("videoLinkInput");
            const videoContainer = document.getElementById("videoContainer");
            const videoLink = inputField.value;
            const videoID = getVideoID(videoLink);

            if (videoID) {
                const embeddedURL = generateEmbeddedURL(videoID);
                videoContainer.innerHTML = `<iframe width="560" height="315" src="${embeddedURL}" frameborder="0" allowfullscreen></iframe>`;
            } else {
                videoContainer.innerHTML = ""; // Clear the container if no valid video link is provided
            }
        }

        // Listen for input changes and call the updateEmbeddedVideo function
        document.getElementById("videoLinkInput").addEventListener("input", updateEmbeddedVideo);
    </script>

    <!--ASL VIDEO UPLOAD JAVASCRIPT-->

    <script>
        // Function to extract the video ID from the YouTube link
        function getVideoID(link) {
            const regex = /(?:\?v=|\/embed\/|\.be\/)([a-zA-Z0-9_-]+)/;
            const match = link.match(regex);
            return match ? match[1] : null;
        }

        // Function to generate the embedded YouTube video URL
        function generateEmbeddedURL(videoID) {
            return `https://www.youtube.com/embed/${videoID}`;
        }

        // Function to update the embedded video when the input field changes
        function updateEmbeddedVideo() {
            const inputField = document.getElementById("ASLvideoLinkInput");
            const videoContainer = document.getElementById("ASLvideoContainer");
            const videoLink = inputField.value;
            const videoID = getVideoID(videoLink);

            if (videoID) {
                const embeddedURL = generateEmbeddedURL(videoID);
                videoContainer.innerHTML = `<iframe width="560" height="315" src="${embeddedURL}" frameborder="0" allowfullscreen></iframe>`;
            } else {
                videoContainer.innerHTML = ""; // Clear the container if no valid video link is provided
            }
        }

        // Listen for input changes and call the updateEmbeddedVideo function
        document.getElementById("ASLvideoLinkInput").addEventListener("input", updateEmbeddedVideo);
    </script>

    <!-- IMAGE UPLOAD JAVASCRIPT -->

    <script>
        var cloudName = "dlca9mehs"; // Replace with your Cloudinary cloud name
        var apiKey = "675384967533139"; // Replace with your Cloudinary API key
        var apiSecret = "Grt4uiHCsdFN4FJGkTLzIuT_3iA"; // Replace with your Cloudinary API secret

        var projectTitle = "<?php echo isset($_POST['title']) ? $_POST['title'] : ''; ?>";
        projectTitleFormatted = projectTitle.replace(/ /g, '-');
        var folderName = "project-images/" + projectTitleFormatted;

        var data = new FormData();
        data.append("name", folderName);

        var uploadedImages = []; // To store the URLs of uploaded images
        var maxImages = 10; // Maximum allowed images
        var imageCount = 0; // Global variable to track the image count

        // Function to display the uploaded image
        function displayImage(imageURL) {
            const imageContainer = document.getElementById("imageContainer");

            // Create a container for the image and its caption
            const imageWrapper = document.createElement("div");
            imageWrapper.classList.add("image-wrapper");

            // Increment the image count and create the caption element
            imageCount++;
            const caption = document.createElement("div");
            caption.textContent = "Image #" + imageCount;
            caption.classList.add("image-caption");

            // Create the image element
            const imageElement = document.createElement("img");
            imageElement.src = imageURL;
            imageElement.alt = "Uploaded Image";
            imageElement.classList.add("flex-item", "selected");

            // Append the caption and image to the container
            imageWrapper.appendChild(caption);
            imageWrapper.appendChild(imageElement);

            // Append the container to the imageContainer
            imageContainer.appendChild(imageWrapper);
        }

        // Cloudinary Upload Widget configuration
        document.getElementById("uploadButton").addEventListener("click", function() {
            if (uploadedImages.length >= maxImages) {
                alert("You can only upload up to " + maxImages + " images.");
                return;
            }

            var uploadPreset = "imageUpload";
            cloudinary.openUploadWidget({
                cloudName: cloudName,
                uploadPreset: uploadPreset,
                folder: folderName,
                resourceType: "image",
                multiple: false,
                clientAllowedFormats: ["png", "jpeg", "jpg", "gif"],
                maxFileSize: 10 * 1024 * 1024, // 10MB
                cropping: false,
            }, function(error, result) {
                if (!error && result && result.event === "success") {
                    const imageURL = result.info.secure_url;
                    uploadedImages.push(imageURL);
                    displayImage(imageURL);
                    createImageGallery();
                }
            });
        });

        // Display the first uploaded image automatically if available
        if (uploadedImages.length > 0) {
            displayImage(uploadedImages[0]);
            createImageGallery();
        }

        // Create the Cloudinary Image Gallery Widget
        function createImageGallery() {
            var imageGallery = cloudinary.galleryWidget({
                container: "#imageContainer",
                cloudName: cloudName,
                mediaAssets: uploadedImages,
                carousel: {
                    autoPlay: true,
                },
                transformation: {
                    width: 150, // Set the width to 150 pixels for displayed images
                    crop: "fit",
                },
            });
            imageGallery.render();
        }

        // Function to handle selecting an image
        function selectImage(imageElement) {
            const allImages = document.querySelectorAll(".flex-item");

            for (let i = 0; i < allImages.length; i++) {
                if (allImages[i] === imageElement) {
                    imageElement.classList.add("selected");
                    document.getElementById("mainImage").src = imageElement.src;
                } else {
                    allImages[i].classList.remove("selected");
                }
            }
        }

        // Event listener to switch the selected image when clicked
        document.getElementById("imageContainer").addEventListener("click", function(event) {
            const targetImage = event.target;
            if (targetImage.tagName === "IMG") {
                selectImage(targetImage);
            }
        });

        // Event listener to enable arrow key navigation (left/right)
        document.addEventListener("keydown", function(event) {
            const selectedImage = document.querySelector(".selected");
            if (!selectedImage) return;

            const allImages = document.querySelectorAll(".flex-item");
            const currentIndex = Array.from(allImages).indexOf(selectedImage);
            let newIndex;

            if (event.key === "ArrowLeft") {
                newIndex = (currentIndex === 0) ? allImages.length - 1 : currentIndex - 1;
            } else if (event.key === "ArrowRight") {
                newIndex = (currentIndex === allImages.length - 1) ? 0 : currentIndex + 1;
            }

            selectImage(allImages[newIndex]);
        });
    </script>

</body>

</html>