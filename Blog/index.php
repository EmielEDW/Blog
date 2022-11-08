<!-- 
    Titel: Blog pagina oefening
    Auteur: Emiel De Waele
    Datum: 5/11/2022
 -->

<?php

// Require deze files.
require('config/db.php');
require('config/config.php');

// Maakt de SQL query
$query = 'SELECT * FROM tbl_post ORDER BY created_at DESC'; // Deze SQL querry selecteert alle gegevens van de tabel post en ordert deze vervolgens ook volgens de datum waarop de post gemaakt is.

// Neemt resultaat
$result = mysqli_query($conn, $query);

// Ophalen van data (fetch)
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Het resultaat vrij maken
mysqli_free_result($result);

// Sluiten van de database connectie
mysqli_close($conn);

?>

<?php include('inc/header.php'); ?>
<!-- Includes de header.php code op deze plaats-->
<div class="container">
    <br>
    <h1>Posts</h1>
    <br>
    <?php foreach ($posts as $post) : ?>
        <!-- foreach loop die zich herhaalt voor elke post die er is. In deze foreach wordt er o.a. gezorgd dat de titel, auteur en het bericht
    gedisplayed word op de juiste plaats. -->
        <div class="post-box">
            <!-- div waarin 1 enkele post komt te staan -->
            <br>
            <h3><?php echo $post['title']; ?></h3>
            <small>Created on <?php echo $post['created_at']; ?> by <?php echo $post['author']; ?></small>
            <p><?php echo $post['body']; ?></p>
            <a class="btn btn-outline-primary" href="<?php echo ROOT_URL; ?>post.php?id=<?php echo $post['id']; ?>">Read More</a>
        </div>
        <br>
    <?php endforeach; ?>
</div>
<?php include('inc/footer.php'); ?>
<!-- Includes de footer.php code op deze plaats-->