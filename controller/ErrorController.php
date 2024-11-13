<?php
//permet de typer le langage, c'est-à-dire de respecter le typage, si string; si float
declare(strict_types=1);

class ErrorController
{

    public function notFound() : void {


        require_once '../view/error-controller-view.php';

    }

}

