<!DOCTYPE html>
<html>

<head>
    <title>Project Upload</title>
    <!-- Add the Cloudinary Upload Widget and Image Gallery Widget scripts -->
    <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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

        #videoContainer {
            margin-top: 30px;
            width: 560px;
            height: 315px;
            border: 2px dashed #ddd;
        }

        textarea {
            height: 100px;
            resize: none;
            font-family: Arial, sans-serif;
            width: 700px;
        }

        .gallery-container {
            text-align: center;
            margin-top: 20px;
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
            margin-top: 20px;
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
        }

        .bold-label {
            font-weight: bold;
        }

        .space {
            height: 30px;
            background-color: #fbfbfb;
        }

        .text-input {
            width: 700px;
        }

        input[type="text"],
        input[type="number"],
        input[type="submit"],
        textarea {
            font-size: 16px;
            padding-top: 12px;
            padding-bottom: 12px;
            padding-left: 12px;
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

            <div class="grid-wrapper">
                <div class="bottom-image-container">
                    <img id="mainImage" src="" class="bottom-image" alt="Selected Image" />
                </div>
            </div>
        </div>

        <div class="space"></div>

        <form action="test-upload-data.php" method="post">

            <!--UPLOAD VIDEO-->

            <div class="container">
                <label for="video">Upload Video</label>
                <input class="text-input" type="text" name="video" id="videoLinkInput" required autocomplete="off" placeholder="Paste your YouTube video link here" />
                <div id="videoContainer"></div>
            </div>

            <div class="space"></div>

            <!--UPLOAD ASL CAPTIONING VIDEO-->

            <div class="container">
                <label for="aslVideo">Upload ASL Captioning Video</label>
                <input class="text-input" type="text" name="video" id="videoLinkInput" required autocomplete="off" placeholder="Paste your YouTube video link with ASL Captioning here" />
                <div id="videoContainer"></div>
            </div>

            <div class="space"></div>

            <!--TRANSCRIPT-->
            <div class="container">
                <label for="transcript">Transcript</label>
                <textarea type="text" name="transcript" id="transcript" required autocomplete="off" placeholder="Paste the transcript of your video here"></textarea>
            </div>

            <div class="space"></div>

            <!--CATEGORY-->

            <div class="container">
                <label for="category">Category</label>
                <input class="text-input" type="text" name="category" id="category" required list="categoryList" autocomplete="off" placeholder="Set a category for your project" />
                <datalist id="categoryList"></datalist>
            </div>

            <div class="space"></div>

            <!--INTRODUCTION-->

            <div class="container">
                <label for="introduction" class="bold-label">Introduction</label>
                <input class="text-input" type="text" name="introduction" id="introduction" required list="introductionList" autocomplete="off" placeholder="What did you make, and why?" />
                <datalist id="introductionList"></datalist>
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

            <!--ACCESSIBILITY-->

            <div class="container">
                <label for="accessibility" class="bold-label">Accessibility Level</label>
                <input class="text-input" type="text" name="accessibility" id="accessibility" required list="accessibilityList" autocomplete="off" placeholder="What accessibility level is your project page currently at?" />
                <datalist id="accessibilityList"></datalist>
            </div>

            <div class="space"></div>

            <input type="hidden" name="title" value="<?php echo $_POST['title']; ?>" />
            <div class="submit-container">
                <input type="submit" value="Submit" />
            </div>
        </form>
    </div>

    <div class="space"></div>

    <!-- ADDING AND REMOVING ITEMS JAVASCRIPT -->

    <script>
        $(document).ready(function() {
            // Function to handle adding more supplies
            $("#addSupply").click(function() {
                var newSupply = `
        <div>
            <input type="text" name="supplyName[]" required list="suppliesList" autocomplete="off">
            <input type="number" name="supplyQty[]" required min="1">
            <button type="button" class="removeSupply">Remove</button>
        </div>
        `;
                $("#suppliesContainer").append(newSupply);
            });

            // Function to handle removing supplies
            $("#suppliesContainer").on("click", ".removeSupply", function() {
                $(this).parent().remove();
            });

            // Function to handle adding more skills
            $("#addSkill").click(function() {
                var newSkill = `
        <div>
            <input type="text" name="skillName[]" required list="skillsList" autocomplete="off">
            <input type="text" name="skillLevel[]" required>
            <button type="button" class="removeSkill">Remove</button>
        </div>
        `;
                $("#skillsContainer").append(newSkill);
            });

            // Function to handle removing skills
            $("#skillsContainer").on("click", ".removeSkill", function() {
                $(this).parent().remove();
            });

            // Function to handle adding more tags
            $("#addTag").click(function() {
                var newTag = `
        <div>
            <input type="text" name="tagName[]" required list="tagsList" autocomplete="off">
            <button type="button" class="removeTag">Remove</button>
        </div>
        `;
                $("#tagsContainer").append(newTag);
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
                                $introductionData = fetchData($conn, 'introduction', 'name');
                                $suppliesData = fetchData($conn, 'supplies', 'name');
                                $skillsData = fetchData($conn, 'skills', 'name');
                                $tagsData = fetchData($conn, 'tags', 'name');
                                $accessibilityData = fetchData($conn, 'accessibility', 'name');

                                // Close the database connection
                                $conn->close();

                                // Combine the data into an associative array
                                $data = array(
                                    'category' => $categoryData,
                                    'introduction' => $introductionData,
                                    'supplies' => $suppliesData,
                                    'skills' => $skillsData,
                                    'tags' => $tagsData,
                                    'accessibility' => $accessibilityData,
                                );

                                echo json_encode($data);
                                ?>;

            // Populate the datalists with the fetched data
            populateDatalist('categoryList', optionsData.category);
            populateDatalist('introductionList', optionsData.introduction);
            populateDatalist('suppliesList', optionsData.supplies);
            populateDatalist('skillsList', optionsData.skills);
            populateDatalist('tagsList', optionsData.tags);
            populateDatalist('accessibilityList', optionsData.accessibility);
        });
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

    <!-- IMAGE UPLOAD JAVASCRIPT -->

    <script>
        var cloudName = "dlca9mehs"; // Replace with your Cloudinary cloud name
        var apiKey = "675384967533139"; // Replace with your Cloudinary API key
        var apiSecret = "Grt4uiHCsdFN4FJGkTLzIuT_3iA"; // Replace with your Cloudinary API secret
        var projectTitle = "<?php echo isset($_POST['title']) ? $_POST['title'] : ''; ?>";
        var folderName = "project-images/" + projectTitle;

        var data = new FormData();
        data.append("name", folderName);

        var uploadedImages = []; // To store the URLs of uploaded images
        var maxImages = 5; // Maximum allowed images

        // Function to display the uploaded image
        function displayImage(imageURL) {
            const imageContainer = document.getElementById("imageContainer");
            const imageElement = document.createElement("img");
            imageElement.src = imageURL;
            imageElement.alt = "Uploaded Image";
            imageElement.classList.add("flex-item", "selected");

            imageContainer.appendChild(imageElement);
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

        // Event listener to switch the selected image
        document.getElementById("imageContainer").addEventListener("click", function(event) {
            const targetImage = event.target;
            if (targetImage.tagName === "IMG") {
                const selectedImage = document.querySelector(".selected");
                if (selectedImage) {
                    selectedImage.classList.remove("selected");
                }
                targetImage.classList.add("selected");
                const index = Array.from(targetImage.parentNode.children).indexOf(targetImage);
                if (uploadedImages[index]) {
                    document.getElementById("mainImage").src = uploadedImages[index];
                }
            }
        });

        // Event listener to enable arrow key navigation (left/right)
        document.addEventListener("keydown", function(event) {
            const selectedImage = document.querySelector(".selected");
            if (!selectedImage) return;

            const currentIndex = Array.from(selectedImage.parentNode.children).indexOf(selectedImage);
            let newIndex;
            if (event.key === "ArrowLeft") {
                newIndex = (currentIndex === 0) ? uploadedImages.length - 1 : currentIndex - 1;
            } else if (event.key === "ArrowRight") {
                newIndex = (currentIndex === uploadedImages.length - 1) ? 0 : currentIndex + 1;
            }

            const newSelectedImage = document.querySelectorAll(".flex-item")[newIndex];
            newSelectedImage.focus();
            document.getElementById("mainImage").src = uploadedImages[newIndex];
            newSelectedImage.classList.add("selected");
            selectedImage.classList.remove("selected");
        });
    </script>

</body>

</html>