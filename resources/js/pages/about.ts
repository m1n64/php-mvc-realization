import Alpine from 'alpinejs';
import {DateTime} from 'luxon';

Alpine.data("aboutpage", ()=>({
    time: <string> DateTime.local().setLocale('ru').toFormat('d.MM.y tt'),
    seconds: <number> 0,

    init() {
        setInterval(()=>{
            this.time = DateTime.local().setLocale('ru').toFormat('d.MM.y tt');
            this.seconds++;
        }, 1000);
    },
}));

Alpine.start();