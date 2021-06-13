<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulaire 2</title>


</head>
<body>

    <a href="formulaire3.php">Accès form3</a><br>
    <a href="formulaire4.php">Accès form4</a><br>
    <hr>
    <h1>Formulaire 2</h1>
    

    <form method="post" action="formulaire3.php">
    <!-- Les traitements de ce formulaire se feront sur le fichier formulaire3.php car nous l'avons précisé dans l'attribut action="" de la balise <form> -->

        <label for="pseudo">Pseudo *</label><br>
        <input type="text" name="pseudo" id="pseudo"><br><br>

        <label for="email">Email *</label><br>
        <input type="text" name="email" id="email"><br><br>

        <input type="submit" value="Envoyer">

    </form><br><br>


    <form method="post" action="formulaire4.php">

    <label for="adresse">Adresse *</label><br>
        <input type="text" name="adresse" id="adresse"><br><br>
    
        <label for="codePostale">Code Postale *</label><br>
        <input type="text" name="codePostale" id="codePostale"><br><br>

        <label for="ville">Ville *</label><br>
        <input type="text" name="ville" id="ville"><br><br>

        <input type="submit" value="Envoyer">
    
    </form>
</body>
</html>