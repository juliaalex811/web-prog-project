<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="container">
        <h1>Library Catalog</h1>
        <a href="create.php">Add New Book</a>
        <table>
            <tr><th>ISBN</th><th>Book Name</th><th>Author</th><th>Availability</th><th>Actions</th></tr>
            <?php
            include 'config.php';
            $sql = "SELECT ISBN, book_name, author, availability FROM books";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>{$row['ISBN']}</td><td>{$row['book_name']}</td><td>{$row['author']}</td><td>" . ($row['availability'] ? 'Available' : 'Unavailable') . "</td>";
                    echo "<td><a href='update.php?ISBN={$row['ISBN']}'>Update</a> | <a href='delete.php?ISBN={$row['ISBN']}' onclick='return confirmDelete()'>Delete</a></td></tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No books found</td></tr>";
            }
            $conn->close();
            ?>
        </table>
    </div>
</body>
</html>
