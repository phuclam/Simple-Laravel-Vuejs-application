# Set up project

To set up this project, after cloned this repository please do following these steps in below:

1. Copy `.env.example` to create the `.env` file. Update your variables in `.env` accordingly with your web server.
2. Directories within the `storage`, `public/uploads` and the `bootstrap/cache` directories should be writable by your web server.
3. Open Terminal and run `composer install`
4. run `php artisan migrate`
5. run `php artisan db:seed`
6. run `php artisan passport:install --force`
7. `npm install` #Install JS dependencies
8. `npm run watch` 

#Admin Dashboard
`<BASE_URL>/admin`

#Default Credentials
1. Admin account: 
    
    `admin@admin.com` / `secret`
        
    