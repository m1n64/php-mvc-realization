<?php
namespace App\Controllers;


use App\Core\Controller\AbstractController;

class NotFoundController extends AbstractController
{

    public function index(): void
    {
        $this->view->generate("404");
    }
}