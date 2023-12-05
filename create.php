<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add New Book</h1>
        <form action="create.php" method="post">
            <input type="text" id="isbn" name="isbn" placeholder="ISBN" required><br>
            <input type="text" id="book_name" name="book_name" placeholder="Book Name" required><br>
            <input type="text" id="author" name="author" placeholder="Author" required><br>
            <input type="submit" value="Add Book">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include 'config.php';
            $isbn = $_POST['isbn'];
            $book_name = $_POST['book_name'];
            $author = $_POST['author'];

            $sql = "INSERT INTO books (ISBN, book_name, author, availability) VALUES (?, ?, ?, 1)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $isbn, $book_name, $author);
            if ($stmt->execute()) {
                echo "<p>New book added successfully. <a href='index.php'>View Books</a></p>";
            } else {
                echo "<p>Error: " . $stmt->error . "</p>";
            }
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
