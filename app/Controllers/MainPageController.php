<?php
namespace App\Controllers;


use App\Core\Controller\AbstractController;


class MainPageController extends AbstractController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        $this->view->generate("mainpage.index");
    }
}