## Roganovich Roman

Это открытое WEB приложение для организации работы небольшого предприятия:

### Цель разработки:
 - Закрепить навыки работы с фреймворком Laravel
 - Получить опыт работы с JS фреймворком VUE
 - Разобраться с тонкостями настройки API
 - Внедрить консольные команды в web проект
 - Внедрить локализация в проект

### Возможности приложения
 - Разграничение прав доступа в админке по маршрутам
 - Создание вложенных статей
 - Создание товаров
 - Создание точек хранение и реализации товара с отображение на карте
 - Загрузка прайсов и остатков
 - Поиск товаров
 - Работа с корзиной
 - Заказ товара с выбором точки самовывоза из точки

### Бэк 
Laravel

### Фронт клиентской части
Laravel + Bootstrap

### Фронт админской части
Laravel + Bootstrap + VUE

### Консольные команды

#### Перенос локализации
php artisan command:CreateLocale
Переносит файлы локализации из /locale/ru/*php в файлик ru.json для фронта на VUE

#### Права доступа
php artisan command:CreatePermissions
Сканирует файл маршрутизации и записывает в базу возможные rout для создания прав доступа

#### MySQL
 - Поднять сервер БД и указать данные подключения в .env
 - host.docker.internal
 - php artisan db:create создаем схему в базе данных
 - php artisan db:clear удаляем схему в базе данных
 - php artisan db:seed генератор фейковых данных

---
## Скачивание проекта
- cd /your_sites_directory/
- git clone git@github.com:roganovich/Larave-Vue.git
- cd Larave-Vue

## Развертывание сервера
 - docker-compose build --no-cache
 - docker-compose up -d
 - docker exec -it laravel_vue_app bash /var/www/docker/preloader.sh -d

## Работа с приложением
 - Открываем сайт: http://localhost:8098/
 - Вход в панель администратора:
   - http://localhost:8098/admin
   - admin@admin.loc
   - password
