<!DOCTYPE html>
<html>

<head>
    <title>Image Upload to Cloudinary</title>
    <script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
    <style>
        .image-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        .image-item {
            max-width: 100%;
            max-height: 400px;
        }
    </style>
</head>

<body>
    <h1>Image Upload to Cloudinary</h1>

    <!-- Project name form -->
    <form id="project-form">
        <label for="project-name">Project Name:</label>
        <input type="text" id="project-name" required>
        <button type="submit">Submit</button>
    </form>

    <!-- File input element -->
    <input type="file" id="upload-input" style="display: none;">
    <button id="select-button">Select Image</button>
    <button id="upload-button" style="display: none;">Upload Image</button>

    <div class="image-grid" id="image-container"></div>

    <script>
        let uploadedImagesCount = 0;
        let customImageName = ""; // Initialize the customImageName variable

        document.getElementById('select-button').addEventListener('click', function() {
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
                formData.append('upload_preset', 'imageUpload');
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

        document.getElementById('project-form').addEventListener('submit', function(event) {
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
</body>

</html>