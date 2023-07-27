                     "Тестовий проект по створенню блога на Laravel"
Реалізовані більшість базових функцій даного фреймворку 
згідно технічного завдання та створена реляційна БД mySQL.

                                    -Установка проекту-
1.Клонування репозиторію:     
git clone https://github.com/Andrewlevvv23/testBlog_Laravel_API.git
cd your-repositories

2.Встановлення залежностей:
composer install

3.Конфігурація файлу .env:
Скопіюйте вміст даного файлу у свій. Перевірте чи правильно працює підключення до БД та міграції.

4.Виконайте міграції баз даних:
php artisan migrate

5.Та запустіть локальний сервер:
php artisan serve

6.Відкрийте браузер та перейдіть по посиланню:
"http://localhost:8000" для доступу до поточного додатку


(Даний додаток використовує API від https://jsonplaceholder.typicode.com/. Для ознайомлення можете перейти по посиланню)
# testBlog_Laravel_API