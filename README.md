## Roganovich Roman

Это открытое WEB приложение для огранизации работы небольшого предприятия:

###Цель разработки:
 - Закрепить навыки работы с фреймворком Laravel
 - Получить опыт работы с JS фреймворком VUE
 - Разобратся с тонкостями настройки API
 - Внедрить консольные команды в web проeкт
 - Внедрить локализация в проект

### Возможности приложения
 - Разграничение прав доступа в админке по маршрутам
 - Создание вложенных статей
 - Создание товаров
 - Создание точех хранение и реализации товара с отображение на карте
 - Загрузка прайсов и остатков
 - Поиск товаров
 - Работа с корзиной
 - Заказ товара с выбором точки самовывоза из точки

###Бэк 
Laravel

###Фронт клиентской части
Laravel + Bootstrap

###Фронт админской части
Laravel + Bootstrap + VUE

###Консольные команды

####Перенос локализации
php artisan command:CreateLocale
Переносит файлы локализации из /locale/ru/*php в файлик ru.json для фронта на VUE

####Права доступа
php artisan command:CreatePermissions
Сканирует файл маршрутизации и записывает в базу возможные rout для создания прав доступа

### MySQL
 - Поднять сервер БД и указать данные подключения в .env
 - host.docker.internal
 - php artisan db:create создаем схему в базе данных
 - php artisan db:clear удаляем схему в базе данных
 - php artisan db:seed генератор фейковых данных

##Запуск контейнера
 - docker-compose build --no-cache
 - docker-compose up -d
 - docker ps
 - docker exec -it  larave-vue_fpm_1 bash
 - php artisan key:generate
 - php artisan config:cache
 - php artisan migrate
 - php artisan db:seed
 - localhost:8098 

