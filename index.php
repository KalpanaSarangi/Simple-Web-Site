<?php
require './connection/connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="display-3 text-center mt-5 mb-5">Library Books</div>

        <div><a class="btn btn-success mb-3" href="./action.php?title=add">Add New</a></div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Published Year</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM books;";
                $result = mysqli_query($conn, $query);
                $num = 1;
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo " <tr>";
                        echo "<th>" . $num++ . "</th>";
                        echo "<th scope='row'>" . $row['ISBN'] . "</th>";
                        echo "<td>" . $row['Title'] . "</td>";
                        echo "<td>" . $row['Author'] . "</td>";
                        echo "<td>" . $row['Published_Year'] . "</td>";
                        echo "<td>
                            <a class='btn btn-primary' href=action.php?title=update&isbn=" . $row['ISBN'] . ">Update</a>
                            <a class='btn btn-danger'href=action.php?title=delete&isbn=" . $row['ISBN'] . ">Delete</a>
                        </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>