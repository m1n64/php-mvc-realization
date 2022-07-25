const mix = require("laravel-mix");

mix.ts("resources/js/app.ts", "public/js")
    .ts("resources/js/pages/index.ts", "public/js")
    .ts("resources/js/pages/about.ts", "public/js/about/index.js")
    //Для других роутов будет выглядеть так (localhost:8000/homepage):
    //.ts("resources/js/pages/homepage.ts", "public/js/homepage/index.js")
    //или (localhost:8000/company/about)
    //.ts("resources/js/pages/about.ts", "public/js/company/about/index.js")
    .sass("resources/scss/style.scss", "public/css")