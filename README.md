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
```

### ✅ 1. Загрузка обычного файла
**POST** `/api/upload/file`

**URL:**
```http
POST http://localhost/file-storage-api/public/api/upload/file
```

### ✅ 2. Загрузка файла в base64 (POST /api/upload/base64)
**POST** `api/upload/base64`

**URL:**
```http
POST [http://localhost/file-storage-api/public/api/upload/base64]
```

### ✅ 3. Получить файл по file_unique_id (GET /api/file/{code})
**POST** `api/file/abc123`

**URL:**
```http
POST [http://localhost/file-storage-api/public/api/file/abc123]
```

### ✅ 4. Получить файл по ID (GET /api/file/id/{id})
**POST** `/api/file/id/1`

**URL:**
```http
POST [http://localhost/file-storage-api/public/api/file/id/1]
```

### ✅ 5. Получить список файлов клиента (GET /api/files)
**POST** `/api/files?client_code=example_client`

**URL:**
```http
POST [http://localhost/file-storage-api/public/api/files?client_code=example_client]
```

### ✅ 5.1. Получить список файлов клиента (GET /api/files)
**POST** `/api/files?client_code=example_client&type=leads`

**URL:**
```http
POST [http://localhost/file-storage-api/public/api/files?client_code=example_client&type=leads]
