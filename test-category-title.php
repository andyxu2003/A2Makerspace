<!DOCTYPE html>
<html>
<head>
    <title>Enter Category and Introduction</title>
</head>
<body>
    <h2>Enter Category and Introduction</h2>
    <form action="test-upload-data.php" method="post">
        <label for="category">Category:</label>
        <input type="text" name="category" id="category" required>
        <br>
        <label for="introduction">Introduction:</label>
        <textarea name="introduction" id="introduction" required></textarea>
        <br>
        <input type="hidden" name="title" value="<?php echo $_POST['title']; ?>">
        <input type="submit" value="Submit">
    </form>
</body>
</html>
