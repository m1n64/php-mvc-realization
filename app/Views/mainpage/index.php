<section x-data="taskslist" id="tasksList">
    <div class="card">
        <div class="card-body">
            <div class="form-outline margin-top-10px">
                <input type="text" class="form-control" id="taskName" x-model="newTask.task_name"/>
                <label class="form-label" for="taskName">Task Name</label>
            </div>

            <div class="form-outline margin-top-10px">
                <textarea class="form-control" id="taskText" rows="4" x-model="newTask.task_text"></textarea>
                <label class="form-label" for="taskText">Task Text</label>
            </div>

            <div class="form-outline margin-top-10px">
                <button @click="saveTask()" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>

    <div class="card margin-top-10px">
        <div class="card-body">
            <template x-if="isLoad">
                <div id="mainPreloader">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </template>

            <template x-if="items.length === 0">
                <div class="text-center padding-10px">
                    <i class="fas fa-question-circle fa-3x padding-10px"></i>
                    <h4>You don't have a tasks...</h4>
                </div>
            </template>

            <ul class="list-group list-group-light">
                <template x-for="(task, i) in items" :key="i">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <template x-if="task.is_done">
                            <span class="task-done-icon"><i class="fa-solid fa-circle-check"></i></span>
                        </template>
                        <div class="ms-2 me-auto" :class="task.is_done ? 'task-done' : ''">
                            <div class="fw-bold" x-text="task.task_name"></div>
                            <div x-text="task.task_text"></div>
                        </div>
                        <span class="form-check margin-right-10px">
                            <input @change="changeStatus(task.id, i)" :checked="task.is_done === 1" class="form-check-input" :id="'isDone'+task.id" type="checkbox" value="" />
                            <label class="form-check-label" :for="'isDone'+task.id">Task is done?</label>
                        </span>
                        <span @click="updateTask(task.id, i)" class="badge badge-light rounded-pill badge-button" data-mdb-toggle="modal" data-mdb-target="#editModal">
                            <i class="fas fa-edit"></i>
                        </span>
                        <span @click="deleteTask(task.id)" class="badge badge-light rounded-pill badge-button">
                            <i class="fas fa-trash"></i>
                        </span>
                    </li>
                </template>
            </ul>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModelLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModelLabel">Edit task</h5>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3 margin-top-10px">
                        <label class="form-label" for="updateTaskName">Task Name</label>
                        <input type="text" class="form-control" id="updateTaskName" x-model="updateTaskState.task_name"/>
                    </div>

                    <div class="mb-3 margin-top-10px">
                        <label class="form-label" for="updateTaskText">Task Text</label>
                        <textarea class="form-control" id="updateTaskText" rows="4" x-model="updateTaskState.task_text"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-mdb-dismiss="modal">Close</button>
                    <button @click="updateTaskSave(updateTaskState.id, updateTaskIndex)" type="button" class="btn btn-primary" data-mdb-dismiss="modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>
</section>
