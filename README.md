# 📁 Laravel API для хранения файлов с привязкой к клиентам

## 📌 Описание проекта
API-сервис на Laravel для загрузки, хранения, получения файлов, с привязкой к клиентскому поддомену (client_code) и типу данных.

## 🚀 Установка API
`git clone https://github.com/yourusername/file-storage-api.git`<br/>
`cd file-storage-api`
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate


## 🚀 Функции API


### ✅ 1. Загрузка обычного файла
**POST** `/api/upload/file`

**URL:**
```http
POST [http://localhost/file-storage-api/public/api/upload/file]
