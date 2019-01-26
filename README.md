# CRUD App
![Studnote](https://github.com/IgorBabko/studnote/blob/development/public/img/banner.png)

# Installation

    git clone git@github.com:IgorBabko/studnote.git

Switch to the repo folder
    cd crud
    composer install
    cp .env.example .env
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
    npm install
    npm run dev
