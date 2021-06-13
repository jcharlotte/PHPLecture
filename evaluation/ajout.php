<?php require_once "inc/header.php"; ?>
<?php 

if( !empty( $_POST) ){
    //debug( $_POST );

    $ajout_annonce = $pdo->prepare(" INSERT INTO advert( title, description, postal_code, city, type, price )
                    VALUES( :title, :description, :postal_code, :city, :type, :price )
                    ");

        $ajout_annonce->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
        $ajout_annonce->bindParam(':description', $_POST['description'], PDO::PARAM_STR);
        $ajout_annonce->bindParam(':postal_code', $_POST['postal_code'], PDO::PARAM_INT);
        $ajout_annonce->bindParam(':city', $_POST['city'], PDO::PARAM_STR);
        $ajout_annonce->bindParam(':type', $_POST['type'], PDO::PARAM_STR);
        $ajout_annonce->bindParam(':price', $_POST['price'], PDO::PARAM_INT);

    $ajout_annonce->execute();
}


?>


<h1>Ajouter une annonce</h1>

<?= $content ?>

<form method="post">

<label>Choississez :</label>
<input type="radio" name="type" value="vente"> Vente
<input type="radio" name="type" value="location"> Location<br><br>

<input type="text" name="title" placeholder="Titre de votre annonce"><br><br>

<input type="text" name="city" placeholder="Ville"><br><br>

<input type="text" name="postal_code" placeholder="Code Postal"><br><br>

<input type="text" name="price" placeholder="Prix"><br><br>

<textarea name="description" cols="50" rows="10" placeholder="Veuillez décrire votre bien..." style="resize: none"></textarea><br><br>

<input type="submit" value="Ajouter" class="btn btn-secondary">

</form>
<?php require_once "inc/footer.php"; ?>