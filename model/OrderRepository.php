<?php

require_once '../model/Order.php';
class OrderRepository
{
// permet de sauvegarder une commande en session
// Order devant le $order s'appelle du typage, ici on indique a l'instance de classe $order qu'elle vient de la classe Order
// le ": void" précise qu'il n'y aura aucun retour
    public function persistOrder(Order $order) : void {
        session_start();
        $_SESSION["order"] = $order;
    }
// permet de récupérer une commande en session
//cette fonction retourne une instance de classe order de la classe Order
//on indique donc dans la première ligne que le retour doit s'inspirer de la classe Order et pas autre chose
    public function findOrder() : Order{
        session_start();
        return $_SESSION["order"];
    }
}