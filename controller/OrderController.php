
<?php require_once ('../model/Order.php');
require_once('../model/OrderRepository.php');


class OrderController
{

    public function createOrder()
    {
        $reponse = null;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if (key_exists('customerName', $_POST)) {

                try {
                    $order = new Order($_POST['customerName']);

                    //Je stock la commande créée (ici dans la SESSION) en utilisant la classe OrderRepository créé juste avant
                    // je l'instancie (créé une instance de classe de OrderRepository) ici et j'utilise la méthode persist
                    $orderRepository = new OrderRepository();
                    $orderRepository->persistOrder($order);

                    $reponse = 'Votre commande a bien été créé';
                } catch (Exception $exception) {
                    $reponse = $exception->getMessage();
                }
            }
        }


        require_once '../view/create-order-view.php';

    }

    public function addProduct(){
        $reponse = null;

        //J'instancie l'OrderRepository et j'appelle la méthode FindOrder
        //Cela permet de récupérer la commande actuellement en session

        $OrderRepository = new OrderRepository();
        $order = $OrderRepository->findOrder();

        try {
            //J'ajoue un produit à la commande
            $order->addProduct();


            //Je la sauvegarde en BDD
            $OrderRepository->persistOrder($order);
            $reponse = 'produit ajouté';

        } catch (Exception $exception) {
            $reponse = $exception->getMessage();
        }



        require_once '../view/add-product-view.php';



    }
}





