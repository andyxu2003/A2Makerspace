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
            <tr onclick="window.location.href = 'projects-forum.php';">
                <td>Projects</td>
                <td>10</td>
            </tr>
            <tr onclick="window.location.href = 'hackathons-forum.php';">
                <td>Hackathons</td>
                <td>5</td>
            </tr>
            <tr onclick="window.location.href = 'ideas-forum.php';">
                <td>Ideas</td>
                <td>15</td>
            </tr>
        </table>
    </div>

</body>

</html>