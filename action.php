<?php
require 'connection/connection.php';

if (isset($_GET['title'])) {
	$title = $_GET['title'];
	if ($title == "add") {
		if (isset($_POST['submit'])) {
			$A = $_POST['isbn'];
			$B = $_POST['title'];
			$C = $_POST['author'];
			$D = $_POST['publish_year'];

			$sql = "insert into books values('$A','$B','$C','$D');";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo '<script>alert("Successfully Added Book")</script>';
				header("Location: index.php?book_inserted");
			} else {
				echo '<script>alert("Error..")</script>';
			}
		}
	} else if ($title == "update") {
		if (isset($_GET['isbn'])) {

			$query = "SELECT * FROM books WHERE ISBN ='{$_GET['isbn']}';";
			$result = mysqli_query($conn, $query);
			if ($result && mysqli_num_rows($result) > 0) {
				$bookDetails = mysqli_fetch_assoc($result);
				$isbnValue = $bookDetails['ISBN'];
				$titleValue = $bookDetails['Title'];
				$authorValue = $bookDetails['Author'];
				$publishYearValue = $bookDetails['Published_Year'];
			}
		}

		if (isset($_POST['submit'])) {
			$A = $_POST['isbn'];
			$B = $_POST['title'];
			$C = $_POST['author'];
			$D = $_POST['publish_year'];

			$sql = "UPDATE books SET Title='$B', Author='$C', Published_Year='$D' WHERE ISBN='$A'";
			$result = mysqli_query($conn, $sql);

			if ($result) {
				echo '<script>alert("Successfully Updated Book")</script>';
				header("Location: index.php?book_updated");
				exit;
			} else {
				echo '<script>alert("Error..")</script>';
			}
		}
	} else if ($title == "delete") {
		if (isset($_GET['isbn'])) {
			$isbn = $_GET['isbn'];

			$sql = "DELETE FROM books WHERE ISBN = '$isbn'";
			$result = mysqli_query($conn, $sql);

			if ($result) {
				echo '<script>alert("Book deleted successfully")</script>';
				header("Location: index.php?book_deleted");
			} else {
				echo '<script>alert("Error while deleting book")</script>';
			}
		}
	} else {
		header("Location: index.php?blocked");
	}
} else {
	header("Location: index.php?invalid");
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="style.css">
</head>

<body>

	<div class="form-center">
		<form method="POST" name="f1" action="action.php?title=<?php echo $title ?>">

			<img src="icons8-book.gif" alt="Book">

			<h2><?php if ($title == "add") echo "Book Entry Form";
				if ($title == "update") echo "Book Update Form"; ?> </h2><br><br>

			<label for="isbn">ISBN </label><br>
			<input type="text" name="isbn" placeholder="ISBN" value="<?php echo isset($isbnValue) ? $isbnValue : ''; ?>"><br>
			<label for="title">Title </label><br>
			<input type="text" name="title" placeholder="Title" value="<?php echo isset($titleValue) ? $titleValue : ''; ?>"><br>
			<label for="author">Author </label><br>
			<input type="text" name="author" placeholder="Author" value="<?php echo isset($authorValue) ? $authorValue : '' ?>"><br>
			<label for="publish_year">Publish Year </label>
			<input type="text" name="publish_year" placeholder="Publish Year" value="<?php echo isset($publishYearValue) ? $publishYearValue : ''; ?>"><br>


			<input type="submit" name="submit" value="<?php echo ucfirst($title); ?>">


		</form>

	</div>




</body>

</html>