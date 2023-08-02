<!DOCTYPE html>
<html>

<head>
    <title>Project Title</title>
</head>
<style>
    body {
        background-color: #fbfbfb;
    }

    .project-title-container {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        margin: auto;
        width: 50%;
        padding: 50px 30px 70px 30px;
        margin-top: 10%;
        background-color: white;
        border: 1px solid lightgray;
        border-radius: 5px;
    }

    .center-container {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
    }

    #title label,
    #title input {
        display: block;

    }

    #title label {
        text-align: center;
        font-size: 32px;
        font-weight: bold;
        padding-bottom: 20px;
    }

    #title input[type="text"] {
        width: 500px;
        font-size: 18px;
        border: 1px solid lightgray;
        border-radius: 5px;
        padding: 18px 5px;
        margin-bottom: 20px;
        background-color: #f6f6f6;
    }

    #title input[type="submit"] {
        width: 510px;
        border-style: none;
        border-radius: 5px;
        font-size: 18px;
        padding: 15px 0;
        background-color: #1434a4;
        color: white;
        cursor: pointer;
    }

    #title input[type="submit"]:hover {
        background-color: #202a44;
    }

    .help-button {
        text-align: center;
        font-size: 20px;
        margin-top: 30px;
    }
</style>

<body>
    <?php include('head.php'); ?>

    <div class="project-title-container">
        <form id="title" action="project-upload.php" method="post">
            <div class="center-container">
                <label for="title">Project Title</label>
                <input type="text" id="title" name="title" placeholder="Enter Project Title" required>
                <input type="submit" value="Set Project Title">
            </div>
        </form>
        <div class="help-button">Need Help?</div>
    </div>

</body>

</html>