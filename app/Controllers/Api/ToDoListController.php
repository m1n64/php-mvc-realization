<?php


namespace App\Controllers\Api;


use App\Core\Controller\AbstractController;
use App\Core\Validator\Validator;
use App\Core\View\JsonView;
use App\Models\TaskList;
use App\Modules\Classes\Custom;

class ToDoListController extends AbstractController
{

    /**
     * @param TaskList $taskList
     * @param JsonView $view
     */
    public function __construct(
        TaskList $taskList,
        JsonView $view,
    )
    {
        parent::__construct();

        $this->model = $taskList;
        $this->view = $view;
    }

    /**
     * @return void
     */
    public function index(): void
    {
        //pass
    }

    /**
     * @return void
     */
    public function get(): void
    {
        $tasks = $this->model->getData();

        $this->view->success($tasks);
    }

    /**
     * @return void
     */
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

    /**
     * @return void
     */
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

    /**
     * @return void
     */
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

    /**
     * @return void
     */
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