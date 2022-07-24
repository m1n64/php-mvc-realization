<?php


namespace App\Controllers\Api;


use App\Core\Controller\AbstractController;
use App\Core\Validator\Validator;
use App\Core\View\JsonView;
use App\Models\TaskList;

class ToDoListController extends AbstractController
{

    public function __construct()
    {
        parent::__construct();

        $this->model = new TaskList();
        $this->view = new JsonView();
    }

    public function index(): void
    {
        //pass
    }

    public function get(): void
    {
        $tasks = $this->model->getData();

        $this->view->success($tasks);
    }

    public function store(): void
    {
        $data = $this->request->getParams();
        $validated = Validator::validate(
            $data,
            [
                "task_name" => ["required", "string"],
                "task_text" => ["norequired", "string"]
            ]
        );

        if (!$validated) {
            $this->view->error([], "Validation insert error!");
        } else {
            $newId = $this->model->insertData($data);

            $this->view->success(["id"=>$newId], "Data was been inserted!");
        }
    }

    public function update(): void
    {
        $data = $this->request->getParams();
        $id = $this->request->getParam("id");

        $validated = Validator::validate(
            $data,
            [
                "task_name" => ["norequired", "string"],
                "task_text" => ["norequired", "string"],
                "is_done" => ["norequired", "numeric"],
                "id" => ["required", "numeric"]
            ]
        );

        if (!$validated) {
            $this->view->error([], "Validation update error!");
        }
        else {
            unset($data["id"]);

            $this->model->updateData($data, $id);

            $this->view->success([], "Task $id was been updated!");
        }
    }

    public function setStatus() : void
    {
        $status = $this->request->getParam("status");
        $id = $this->request->getParam("id");

        $validated = Validator::validate($status, ["required", "numeric"]);

        if (!$validated) {
            $this->view->error([], "Validation status error!");
        }
        else {
            $this->model->updateData(
                [
                    "is_done" => $status
                ],
                $id
            );

            $this->view->success([], "Task status $id was been updated!");
        }
    }

    public function delete() : void
    {
        $id = $this->request->getParam("id");

        $validated = Validator::validate($id, ["required", "numeric"]);

        if (!$validated) {
            $this->view->error([], "Validation ID error!");
        }
        else {
            $this->model->deleteData($id);

            $this->view->success([], "Task $id was been deleted!");
        }
    }
}