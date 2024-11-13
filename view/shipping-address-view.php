<?php require_once '../partials/_header.php'; ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <main>
        <!--Appel de ma variable réponse (soit ok soit pas ok en fonction de la situation -->
        <h2> <?php echo $reponse ?></h2>

        <!-- Appel du getter getId pour pouvoir l'afficher sur mon navigateur-->
        <p>Commande numéro : <?php echo $order->getId()?></p>

        <!--Appel de mon getter getAddress pour l'afficher sur mon navigateur -->
        <p> Votre adresse de livraison: <?php echo $order->getAddress(); ?> </p>

        <!-- Création de mon formulaire d'adresse de livraison pour le client avec le bouton submit-->
        <form method="post">
            <label for="shippingAddress">Votre adresse de livraison</label>
            <input type="text" name="shippingAddress"/>

            <button type="submit">Valider votre adresse</button>
        </form>

    </main>


</body>
</html>

<?php  require_once '../partials/_footer.php'; ?>