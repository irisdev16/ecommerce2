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

    <h1>Faites votre commande</h1>

    <?php if ($reponse) { ?>

        <h1> <?php echo $reponse; ?> </h1>

    <?php } ?>

    <form method="POST">
        <label>Votre nom</label>
        <input type="text" name="customerName"/>

        <button type="submit">Créér une commande</button>
    </form>
</main>

</body>
</html>


