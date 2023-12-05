<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book Availability</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Update Book Availability</h1>
        <?php
        include 'config.php';
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['ISBN'])) {
            $isbn = $_GET['ISBN'];
            $sql = "SELECT book_name, availability FROM books WHERE ISBN = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $isbn);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $availability = $row['availability'] ? "checked" : "";
                echo "<form action='update.php' method='post'>";
                echo "<label for='isbn'>ISBN:</label>";
                echo "<input type='text' id='isbn' name='isbn' value='{$isbn}' readonly><br>";
                echo "<label for='book_name'>Book Name:</label>";
                echo "<input type='text' id='book_name' value='{$row['book_name']}' readonly><br>";
                echo "<label for='availability'>Available:</label>";
                echo "<input type='checkbox' id='availability' name='availability' {$availability}><br>";
                echo "<input type='submit' value='Update'>";
                echo "</form>";
            } else {
                echo "Book not found.";
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $isbn = $_POST['isbn'];
            $availability = isset($_POST['availability']) ? 1 : 0;

            $sql = "UPDATE books SET availability = ? WHERE ISBN = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $availability, $isbn);
            if ($stmt->execute()) {
                echo "Book updated successfully. <a href='index.php'>View Books</a>";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
