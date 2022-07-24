import axios, {AxiosPromise} from "axios";
import HeadersInterface from "../interfaces/headersInterface";

export default class Api {

    static endpoint: string = "/api/tasks";

    static headersOption: HeadersInterface = {
        headers: {
            'Accept': "application/json",
            'Content-Type': 'application/x-www-form-urlencoded'
        }
    };

    static delete(id: number) : AxiosPromise
    {
        return axios.delete(Api.endpoint+"/delete?id="+id, Api.headersOption);
    }

    static add(data: FormData) : AxiosPromise
    {
        return axios.post(Api.endpoint+"/store", data, Api.headersOption);
    }

    static get() : AxiosPromise
    {
        return axios.get(Api.endpoint+"/get", Api.headersOption);
    }

    static update(data: FormData, id: number) : AxiosPromise
    {
        return axios.post(Api.endpoint+"/update?id="+id, data, Api.headersOption);
    }

    static setStatus(data: FormData, id: number) : AxiosPromise
    {
        return axios.post(Api.endpoint+"/setStatus?id="+id, data, Api.headersOption);
    }
}
