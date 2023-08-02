<!DOCTYPE html>
<html>

<head>
    <title>Sample Forum</title>
    <style>
        body {
            font-size: 18px;
            font-family: arial, sans-serif;
            background-color: #fbfbfb;
        }

        .page-container {
            width: 60%;
            margin: auto;
        }

        h1 {
            text-align: left;
            margin: 50px 0;
            font-size: 40px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px auto;
        }

        th:first-child {
            text-align: left;
        }

        th,
        td {
            border: none;
            border-bottom: 1px solid lightgray;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr {
            cursor: pointer;
        }

        tr:hover {
            background-color: #ddd;
        }

        td:nth-child(2),
        td:nth-child(3) {
            width: 100px;
        }

        .projects {
            display: left;
        }

        td:first-child {
            text-align: left;
        }
    </style>
</head>

<body>
    <?php include 'head.php'; ?>
    <div class="page-container">
        <h1>Forum</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>Topics</th>
            </tr>
            <?php

            $servername = "mysql-user.eecs.tufts.edu";
            $username = "a2makerspace";
            $password = "3tF5ucTgufmW5Z";
            $dbname = "a2makerspace";

            // Create a connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Step 2: Query the "projects" table to retrieve the "title" column data.
            $sql = "SELECT title FROM projects";
            $result = $conn->query($sql);

            // Step 3: Loop through the SQL results and create HTML rows for each title.
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $title = $row["title"];
                    echo "<tr onclick=\"window.location.href = 'projects-forum.php';\">";
                    echo "<td>" . $title . "</td>";
                    echo "<td>0</td>"; // You can set the number of topics as per your requirement or retrieve it from another SQL column.
                    echo "</tr>";
                }
            }

            $conn->close();
            ?>
        </table>
    </div>
</body>

</html>