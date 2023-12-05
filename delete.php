<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['ISBN'])) {
    include 'config.php';
    $isbn = $_GET['ISBN'];
    $sql = "DELETE FROM books WHERE ISBN = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $isbn);
    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
