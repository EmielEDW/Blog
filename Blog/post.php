<?php

// Require deze file.
require('config/db.php');
require('config/config.php');

// Check voor een submit
if (isset($_POST['delete'])) {
    // Neem form data zodat we die hier kunnen gebruiken
    $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

    $query = "DELETE FROM tbl_post WHERE id = {$delete_id}"; // Deze querry zal de post met het id dat gelijk is aan het delete_id verwijderen uit de databank.

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
    <a href="<?php echo ROOT_URL; ?>" class="btn-default">Back</a> <!-- Dit is de code voor de back button, op deze manier kan je terugkeren naar het hoofdmenu -->
    <br>
    <a href=""></a>
    <h1><?php echo $post['title']; ?></h1>
    <br>
    <br>
    <small>Created on <?php echo $post['created_at']; ?> by <?php echo $post['author']; ?></small>
    <p><?php echo $post['body']; ?></p>
    <hr>
    <a href="<?php echo ROOT_URL; ?>editpost.php?id=<?php echo $post['id']; ?>" class="btn btn-info">Edit</a>
    <!-- Dit is de code voor de edit button, met deze button wordt je geredirect naar de edit pagina om de geselecteerde post te bewerken. -->
    <br>
    <br>
    <form class="pull-right" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <!-- Hier staat de code voor de delete button, wanneer deze wordt ingedrukt als de sumbit van delete geset worden en zal hij de post verwijderen uit de databank. -->
        <input type="hidden" name="delete_id" value="<?php echo $post['id']; ?>">
        <input type="submit" name="delete" value="delete" class="btn btn-danger">
    </form>
</div>
<!-- Includeerd de footer.php pagina -->
<?php include('inc/footer.php'); ?>