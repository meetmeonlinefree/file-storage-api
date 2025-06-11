# 📁 Laravel API для хранения файлов с привязкой к клиентам

## 📌 Описание проекта
API-сервис на Laravel для загрузки, хранения, получения файлов, с привязкой к клиентскому поддомену (client_code) и типу данных.

## 🚀 Установка проекта
`git clone https://github.com/meetmeonlinefree/file-storage-api.git`<br/>
`cd file-storage-api`<br/>
`composer install`<br/>
`cp .env.example .env`<br/>
`php artisan key:generate`<br/>
`php artisan migrate`<br/>


## 🚀 Функции API


### ✅ 1. Загрузка обычного файла
**POST** `/api/upload/file`

**URL:**
```http
POST [http://localhost/file-storage-api/public/api/upload/file]
