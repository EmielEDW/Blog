<?php

// Require deze files.
require('config/db.php');
require('config/config.php');

// Check voor een submit
if (isset($_POST['submit'])) {
    // Neem form data zodat we die hier kunnen gebruiken
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);

    $query = "INSERT INTO tbl_post(title, author, body) VALUES('$title', '$author', '$body')";
    // Deze querry INSERT data in de tbl_post tabel, die data is de titel, auteur en het bericht. Die krigjt hij door te kijken naar welke data is ingegeven in de form.

    if (mysqli_query($conn, $query)) {
        header('Location: ' . ROOT_URL . ''); // Redirect de pagina naar de main page
    } else {
        echo 'ERROR: ' . mysqli_error($conn); // Wordt uitgevoerd wanneer er een error is, het zal ook de error displayen.
    }
}
?>

<?php include('inc/header.php'); ?>
<!-- Includeerd de header.php pagina -->
<div class="container">
    <br>
    <h1>Add Post</h1>
    <br>
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        <!-- form voor het maken van een nieuwe post. Deze posts zal wanneer submitted samen met de andere posts gedisplayed worden. -->
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label>Author</label>
            <input type="text" name="author" class="form-control">
        </div>
        <div class="form-group">
            <label>Body</label>
            <textarea name="body" class="form-control"></textarea>
        </div>
        <br>
        <input type="submit" name="submit" value="submit" class="btn btn-primary">
    </form>
</div>
<!-- Includeerd de footer.php pagina -->
<?php include('inc/footer.php'); ?>