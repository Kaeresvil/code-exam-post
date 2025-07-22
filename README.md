Instruction to run the app

1. Make .env file then copy the .env.example then change the database connection credential base on your DB local
2. In your terminal run composer install
3. Run php artisan key:generate
4. Run php artisan migrate
5. Run php artisan db:seed, and run also the php artisan app:fetch-json-placeholder-data 
6. then run php artisan serve once already serve copy the url provided of your system.
7. In postman past the url provide then add this /core/api/ to access the API.
8. Login using this url /core/api/login then input this credential email: admin@example.com and password: password
9. Once login copy the provided token then paste it to postman authoriztion to access other api 
10. To test the POST use this url /core/api/posts with the token provided during your login.