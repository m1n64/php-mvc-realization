export {};

declare global {
    interface Window {
        axios: any;
        _: any;
        Alpine: any;
        Api: any;
    }
}