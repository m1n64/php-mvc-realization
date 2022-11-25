<?php
namespace App\Controllers;


use App\Core\Controller\AbstractController;
use App\Core\Validator\Validator;
use App\Middlewares\GetCountryByIp;
use App\Models\UserIp;

class AboutController extends AbstractController
{

    public function __construct(
        UserIp $userIp
    )
    {
        parent::__construct();
        $this->model = $userIp;
        $this->middleware(GetCountryByIp::class);
    }

    public function index(): void
    {
        $currentIp = $_SERVER["REMOTE_ADDR"];
        $userIp = $this->model->select()
            ->where("ip", $currentIp)
            ->limit(1)
            ->execute()
            ->getArray()[0];

        $this->view->generate("aboutpage.index", ["userIp"=>$userIp]);
    }

    public function saveIp() : void
    {
        $data = $this->request->getParams();
        $id = $this->request->getParam("id");

        $validation = Validator::validate($data, [
            "id" => ["required", "numeric"],
            "country" => ["required", "string"],
            "city" => ["required", "string"]
        ]);

        if ($validation) {
            $this->model->updateData($data, $id);
        }

        $this->response->redirect("about");
    }
}