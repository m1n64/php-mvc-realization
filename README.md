### MVC Realization on PHP

**How to startup:**
1. `composer install`
2. `npm install`
3. create you database in mysql (db name - *todolist*)
4. `cp .env.example .env` (or copy)
5. config database credits in *.env* file
6. `php database/migration/todolist_table.php` 
   (*or* `mysql -u root -ppassword todolist < database/migration/todolist_table.sql`)
7. `npx mix`
8. reload your web-server (or `php -S localhost:8000`)

**Description:**

This is test project as part of my PHP course. And the course is in my telegram channel - [@fromidiottojunior](https://t.me/fromidiottojunior)

*(I will add a link to the combined course later.)*
