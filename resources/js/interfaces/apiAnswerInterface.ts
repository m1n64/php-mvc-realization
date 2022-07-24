import TaskDataInterface from "./taskDataInterface";

export default interface ApiAnswerInterface {
    status: boolean,
    message: string,
    data: TaskDataInterface[]
}