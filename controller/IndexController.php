
<?php require_once ('../model/Order.php')?>

<?php

class IndexController
{

    public function index()
    {
        $reponse = null;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (key_exists('customerName', $_POST)) {

                try {
                    $order = new Order($_POST['customerName']);
                    $reponse = 'Votre commande a bien été créé';
                } catch (Exception $exception) {
                    $reponse = $exception->getMessage();
                }
            }
        }


        require_once '../view/index-view.php';

    }
}





