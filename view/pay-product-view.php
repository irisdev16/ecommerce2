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



    <p> Commande numéro : <?php echo $order->getId(); ?> </p>
    <p>Prix payé : <?php echo $order->getTotalPrice();?> euros</p>

    <p><?php echo $reponse ?></p>


</main>

</body>
</html>
















<?php  require_once '../partials/_footer.php'; ?>
