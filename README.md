php artisan key:generate# laravel_one_auth



### Installing steps
###1-step: Downloading basic source files
```md
composer require temprodev/laravel-one-auth

```

### 2-step auth commands

```md
composer require laravel/ui --dev
php artisan ui bootstrap --auth
npm install && npm run dev
```

If you have already installed ui and auth, you don't need to run this commands



###3-step: Database

In the users table, you need some columns below:

            string       : username
            string       : firstname
            string       : lastname
            string       : midname
            string       : pinfl
            string       : inn
            string       : passport
            timestamp    : passport_expire_date
            string       : phone
            string       : address

So that, you need to run 

```md
php artisan migrate
```
and package will create those columns for you




###4-step: .env file configuration

```angular2html
ONE_ID_API_URL=
ONE_ID_CLIENT_ID=
ONE_ID_CLIENT_SECRET=
ONE_ID_REDIRECT_URI=
ONE_ID_SCOPE=
```

##Ready to use!


#Basic usage

### Route:

Route name: "one.auth"
Route path: one/auth

###Callback:

Route name: "one.login"
Route path: one/login

####in the .env file, ONE_ID_REDIRECT_URI value must be callback path





