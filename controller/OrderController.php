<?php
//permet de typer le langage, c'est-à-dire de respecter le typage, si string; si float
declare(strict_types=1);

require_once ('../model/Order.php');
require_once('../model/OrderRepository.php');
require_once ('../vendor/autoload.php');


class OrderController
{

    public function createOrder() : void{
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

        // je créé la config de twig en lui indiquant le chemin pour accéder aux templates
        $loader = new \Twig\Loader\FilesystemLoader('../view');
        // je charge twig avec la configuration
        // ça me permet d'avoir une variable $twig qui contient une instance
        // de la classe twig
        // et donc pouvoir utiliser les méthodes public que twig crées
        $twig = new \Twig\Environment($loader);

        echo $twig->render('create-order.twig', [
            'message' => $reponse,
        ]);


    }

    public function addProduct() : void {
        $reponse = null;

        //J'instancie l'OrderRepository et j'appelle la méthode FindOrder
        //Cela permet de récupérer la commande actuellement en session

        $orderRepository = new OrderRepository();
        $order = $orderRepository->findOrder();

        try {
            //J'ajoue un produit à la commande
            $order->addProduct();


            //Je la sauvegarde en BDD
            $orderRepository->persistOrder($order);
            $reponse = 'produit ajouté';

        } catch (Exception $exception) {
            $reponse = $exception->getMessage();
        }


        require_once '../view/add-product-view.php';


    }

    public function removeProduct() : void{
        $reponse = null;
        $orderRepository = new OrderRepository();
        $order = $orderRepository->findOrder();

        try {
            $order->removeProduct();

            $orderRepository->persistOrder($order);
            $reponse = 'produit supprimé';

        } catch (Exception $exception) {
            $reponse = $exception->getMessage();
        }

        require_once '../view/remove-product-view.php';

    }

    //je créée une méthode
    public function setShippingAddress() : void {

        //je créé une instance d'OrderRepository pour récupérer une commande existant
        $orderRepository = new OrderRepository();
        $order = $orderRepository->findOrder();

        //j'initie une variable "reponse" qui me permettra d'afficher un message d'erreur si
        // la condition suivante n'est pas remplie
        $reponse = null;


        // je vérifie et récupère les données de la requête post
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            //si la clé shippingAddress existe
            if (key_exists('shippingAddress', $_POST)) {

                //j'essaie de modifier l'adresse de livraison
                try {
                    $order -> setShippingAddress($_POST['shippingAddress']);
                    //si tout est bon, j'envoie le message suivant
                    $reponse = 'Adresse ajoutée';


                //sinon j'envoi mon message d'exception
                } catch (Exception $exception) {
                    $reponse = $exception->getMessage();
                }
            }
        }

        //j'appelle la view de shipping-adress car c'est elle qui sera affichée dans mon navigateur
        require_once '../view/shipping-address-view.php';
    }

    //je créé une méthode pour le paiement de la commande
    public function payOrder() : void {

        //j'initie une variable "reponse" qui me permettra d'afficher un message d'erreur si
        // le try catch suivant ne fonctionne pas
        $reponse = null;

        //je créé une instance d'OrderRepository pour récupérer une commande existante
        $orderRepository = new OrderRepository();
        $order = $orderRepository->findOrder();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            //j'essaie de payer la commande
            try {
                $order->pay();

                $orderRepository->persistOrder($order);
                //si tout est bon, ce message s'affiche
                $reponse = 'Paiement effectué, livraison possible mais pas de suite';

                //sinon mon message d'exception s'affiche
            } catch (Exception $exception) {
                $reponse = $exception->getMessage();
            }
        }

        // j'appelle la vue de pay-product car c'est elle qui sera affichéé dans mon navigateur
        require_once '../view/pay-product-view.php';

    }
}





