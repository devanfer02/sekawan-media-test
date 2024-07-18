<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## Sekawan Media Backend Intern Technical Test


### 🛠️ TechStacks

[![My Skills](https://skillicons.dev/icons?i=php,mysql,laravel,tailwindcss,bootstrap)](https://skillicons.dev)
Stack | Tech | Version | 
--- | --- | --- |
🐘 PHP | PHP | 8.3.9
🛢  Database | MySQL | 5.4 | 
🛠️ Framework | Laravel | 11 |


### 🔍 How to Use the Application

NOTE: you need to configure mysql dependancy

1. Clone this project
```zsh
git clone https://github.com/devanfer02/sekawan-media-test.git #https

git clone git@github.com:devanfer02/sekawan-media-test.git #ssh
```

2. Change directory to project
```zsh 
cd sekawan-media-test
```

3. Install required dependancies
```zsh
composer install
npm install
```

4. Copy the env file
```zsh
cp .env.example .env
```

5. Generate application key and run the migartions
```zsh
php artisan key:generate
php artisan migrate:fresh --seed
```

6. Build tailwindcss in another terminal
```
npm run dev
```

7. Run the application
```
php artisan serve
```

8. Open the application at [http://localhost:8000](http://localhost:8000)
