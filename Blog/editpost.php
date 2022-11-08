<?php

// Require deze files.
require('config/db.php');
require('config/config.php');

// Check voor een submit
if (isset($_POST['submit'])) {
    // Neem form data zodat we die hier kunnen gebruiken
    $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $body = mysqli_real_escape_string($conn, $_POST['body']);
    $author = mysqli_real_escape_string($conn, $_POST['author']);

    // De querry gaat de post tabel updaten/veranderen en de vorige gegevens vervangen door de nieuw ingevoerde gegevens.
    $query = "UPDATE tbl_post SET
        title='$title',
        author='$author',
        body='$body'
        WHERE id = {$update_id}";

    if (mysqli_query($conn, $query)) {
        header('Location: ' . ROOT_URL . ''); // Redirect de pagina naar de main page
    } else {
        echo 'ERROR: ' . mysqli_error($conn); // Wordt uitgevoerd wanneer er een error is, het zal ook de error displayen.
    }
}

// get ID
$id = mysqli_real_escape_string($conn, $_GET['id']);

// Maakt de SQL query
$query = 'SELECT * FROM tbl_post WHERE id=' . $id;

// Neemt resultaat
$result = mysqli_query($conn, $query);

// Ophalen van data (fetch)
$post = mysqli_fetch_assoc($result);

// Het resultaat vrij maken
mysqli_free_result($result);

// Sluiten van de database connectie
mysqli_close($conn);

?>

<?php include('inc/header.php'); ?>
<!-- Includeerd de header.php pagina -->
<div class="container">
    <br>
    <h1>Add Post</h1>
    <br>
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        <!-- In deze form wordt de post bewerkt. Dit is bijna hetzelfde als een post schrijven maar nu zijn de waardes al ingevult en moet je ze gewoon veranderen als je dat wilt. -->
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo $post['title']; ?>">
        </div>
        <div class="form-group">
            <label>Author</label>
            <input type="text" name="author" class="form-control" value="<?php echo $post['author']; ?>">
        </div>
        <div class="form-group">
            <label>Body</label>
            <textarea name="body" class="form-control"><?php echo $post['body']; ?>"</textarea>
        </div>
        <br>
        <input type="hidden" name="update_id" value="<?php echo $post['id']; ?>">
        <input type="submit" name="submit" value="submit" class="btn btn-primary">
    </form>
</div>
<!-- Includeerd de footer.php pagina -->
<?php include('inc/footer.php'); ?>