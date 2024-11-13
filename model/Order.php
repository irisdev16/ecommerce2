<?php

// je créé une class  Order
class Order
{

    //j'assigne à la classe une propriété "id"
    private $id;
    //j'assigne à la classe une propriété "customerName"
    private $customerName;
    //j'assigne à la classe une propriété "status"
    private $status = "cart";
    //j'assigne à la classe une propriété "totalPrice"
    private $totalPrice = 0;
    //j'assigne à la classe une propriété "products"
    private $products = [];
    //j'assigne à la classe une propriété "shippingAdress"
    private $shippingAddress;



    // je créé une méthode construct :
    //le constructeur est une méthode "magique" car elle est appelé automatiquement quand l'instance de classe est créé
    // j'initie avec this qui fait référence à l'instance de classe actuel, je donne un nom à ma variable qui ici est le même
    //que la propriété de ma méthode et de ma classe, j'appelle la propriété
    // idem pour this ensuite, je dis que la propriété id aura un identifiant unique
    public function __construct($customerName){

        if(mb_strlen($customerName) < 3){
            throw new Exception("Veuillez entrer un nom correct");
        }


            $this->customerName = $customerName;
            $this->id = uniqid();

    }


    //je créé une méthode (fonction) "addProduct" qui permet l'ajout d'un produit
    // le $this n'a de sens qu'à l'intérieur de ma class, il fait référence à l'instance de classe actuel c'est-à-dire a Order1,
    // Order2, etccc.  donc à l'instance de classe actuel issu de la class.
    public function addProduct()
    {
        //condition : si le status de la commande est "cart" (donc produits dans le panier)
        if ($this->status = "cart") {
            //alors ajouter dans le tableau de produits "pringles" (en supposant qu'il n'y ai que des pringles à vendre)
            $this->products[] = "pringles";
            //et alors le prix de la commande augmente de 3 (sous entendu 3 euros par paquet de pringles)
            $this->totalPrice += 3;
        }
    }

    //je créé une méthode "removeProduct" qui permet de supprimer un produit dans une commande en cours
    public function removeProduct()
    {
        //si le statut de ma commande est "cart" et donc en cours
        if ($this->status = "cart") {
            //et si mon tableau n'est pas vide
            if (!empty($this->products)) {
                //alors je supprime le dernier élément de mon tableau de produits
                array_pop($this->products);
                //et alors je diminue le prix de 3 puisqu'un paquet de pringles vaut 3 euros
                $this->totalPrice -= 3;
            } else {
                throw new Exception("Attention, il n'y a pas de produits dans votre panier");
            }
        }
    }

    //je créé une méthode "setShippingAddress" qui permet d'établir une adresse de livraison
    // si le statut est "cart"
    //alors la propriété privéé enoncé en haut private $shippingAddress prend l'adresse passé en paramètre de ma méthode
    //et alors le statut passe a "shippingAdressSet"
    //sinon, j'ai un message d'exception qui indique une erreur
    public function setShippingAddress($shippingAddress)
    {
        if ($this->status === "cart"){
            $this->shippingAddress = $shippingAddress;
            $this->status = "shippingAddressSet";
        } else {
            throw new Exception("Adresse non modifiable");
        }
    }


    //je créé une méthode "pay" qui permet de payer la commande
    public function pay()
    {
        //condition : si le statut de la commande est "cart"
        if ($this->status === "shippingAddressSet" && !empty($this->products)) {
            //le passer a "paid"
            $this->status = "paid";
        } else {
            throw new Exception("Vous ne pouvez pas payer, merci de rentrer votre adresse d'abord.");
        }
    }


    //je créé une méthode "envoi de la commande"
    public function ship()
    {
        //condition : si la commande est payée
        if ($this->status == "paid") {
            // alors je peux indiquer que la commande est envoyée
            $this->status = "send";
        } else {
            throw new Exception("La commande ne peut pas être expédiée, elle n'est pas encore payée.");

        }
    }


    //ci dessous plusieurs méthode getter qui me permette de récupérer des propriétés privées en haut et de les appeler
    // dans mes views
    public function getId(){
        return $this->id;
    }

    public function getProducts(){
        return $this->products;
    }

    public function getTotalPrice(){
        return $this->totalPrice;
    }
    public function date(){
        date_default_timezone_set('UTC');
    }

    public function getDate(){
        return date('l jS \of F Y h:i:s A');
    }

    public function getAddress(){
        return $this->shippingAddress;
    }

}