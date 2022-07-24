import Alpine from 'alpinejs'
import Api from "../api/api";
import Toast from "../components/toast";
import TaskDataInterface from "../interfaces/taskDataInterface";
import {AxiosResponse} from "axios";
import ApiAnswerInterface from "../interfaces/apiAnswerInterface";

const _ = require("lodash");

window.Alpine = Alpine;


Alpine.data("taskslist", () => ({
    items: <TaskDataInterface[]>[],
    isLoad: <boolean>true,

    newTask: <TaskDataInterface>{
        task_text: ""
    },

    updateTaskState: <TaskDataInterface> {},
    updateTaskIndex: <number>0,

    init() : void {
        Api.get().then((response: AxiosResponse<ApiAnswerInterface>) => {
            this.isLoad = false;

            if (!response.data.status) return Toast.showToast("Error loading tasks!");

            this.items = response.data.data;
        })
    },

    deleteTask(id: number) : void {
        Api.delete(id).then((response) => {
            if (!response.data.status) return Toast.showToast("Error deleting task!")

            _.remove(this.items, (n)=>{
                return n.id === id
            });
        });

    },

    saveTask() : void {
        if (this.newTask.task_name.length > 0) {
            let newTask = new FormData();
            newTask.append("task_name", this.newTask.task_name);
            newTask.append("task_text", this.newTask.task_text);

            Api.add(newTask).then((response)=>{
                if (!response.data.status) return Toast.showToast("Error add new task!")

                let copyTask = <TaskDataInterface>{
                    id: response.data.data.id,
                    task_name: this.newTask.task_name,
                    task_text: this.newTask.task_text,
                    is_done: 0
                }

                this.items.push(copyTask);
            });
        }
    },

    changeStatus(id: number, index: number) : void {
        let currentTask = this.items[index];
        let status = Number(!currentTask.is_done);

        let statusData = new FormData();
        statusData.append("status", status.toString());

        Api.setStatus(statusData, id).then((response)=>{
            if (!response.data.status) return Toast.showToast("Error changing status!");

            currentTask.is_done = status;
        });
    },

    updateTask(id: number, index: number) : void {
        let currentTask = this.items[index];

        this.updateTaskState = {
            id: currentTask.id,
            task_name: currentTask.task_name,
            task_text: currentTask.task_text,
            is_done: currentTask.is_done,
        };

        this.updateTaskIndex = index;
    },

    updateTaskSave(id: number, index: number) : void {
        if (this.updateTaskState.task_name.length > 0) {
            let updatedData = new FormData();
            updatedData.append("task_name", this.updateTaskState.task_name);
            updatedData.append("task_text", this.updateTaskState.task_text);
            updatedData.append("is_done", this.updateTaskState.is_done.toString());

            Api.update(updatedData, id).then((response) => {
                if (!response.data.status) return Toast.showToast("Error updating task!");

                this.items[index] = this.updateTaskState;
            });
        }
    }
}))

Alpine.start();