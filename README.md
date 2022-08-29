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

##Запуск контейнера
 - docker-compose build
 - docker-compose up
 - docker ps
 - docker exec -it  vuelaravelcrmloc_fpm_1 bash
 - php artisan db:create 
 - php artisan migrate
 - chmod -R 777 /var/www/storage
 - php artisan db:seed
 - localhost:8098 
 - php artisan db:clear

