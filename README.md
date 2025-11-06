# 🛠️ Mini eCommerce Backend (Laravel 12 API)

This is the backend API for the **Mini eCommerce Product Listing** project — built with **Laravel 12**, following clean architecture principles (Service + Repository + Resource layers).

---

## ⚙️ Tech Stack

-   Laravel 12 (PHP 8.3)
-   MySQL / SQLite
-   RESTful API (JSON)
-   Repository & Service pattern
-   DB transactions for safe writes
-   Seeders for sample data (5 categories, 15 products)

---

## 🚀 Features

| Feature        | Description                              |
| -------------- | ---------------------------------------- |
| Product list   | Paginated API endpoint with filters      |
| Create product | Validated API endpoint using FormRequest |
| Delete product | Safe deletion with transaction rollback  |
| Categories     | API endpoint for category listing        |
| Seeder         | Populates DB with demo data              |

---

## 📂 Project Structure

```
app/
├── DTOs/
│   └── ProductData.php
├── Http/
│   ├── Controllers/
│   │   ├── Api/
│   │   │   └── V1/
│   │   │       ├── CategoryController.php
│   │   │       └── ProductController.php
│   │   └── Controller.php        # base controller
│   ├── Requests/
│   │   └── ProductStoreRequest.php
│   └── Resources/
│       ├── CategoryResource.php
│       └── ProductResource.php
├── Models/
│   ├── Category.php
│   ├── Product.php
│   └── User.php
├── Providers/
│   ├── AppServiceProvider.php
│   └── ProductServiceProvider.php
├── Repositories/
│   ├── EloquentProductRepository.php
│   └── ProductRepositoryInterface.php
├── Services/
│   ├── ProductService.php
│   └── ProductServiceInterface.php
└── Traits/
    └── ApiResponseTrait.php

database/
├── factories/
├── migrations/
└── seeders/
    ├── DatabaseSeeder.php
    └── ProductSeeder.php

routes/
└── api.php

```

---

## 🧩 API Endpoints

| Method   | Endpoint                | Description                                                     |
| -------- | ----------------------- | --------------------------------------------------------------- |
| `GET`    | `/api/v1/products`      | List all products (supports `q`, `category_id`, `stock_status`) |
| `POST`   | `/api/v1/products`      | Create new product                                              |
| `DELETE` | `/api/v1/products/{id}` | Delete product                                                  |
| `GET`    | `/api/v1/categories`    | List categories                                                 |

---

## 🧠 Architecture Highlights

-   **Dependency Injection** for clean code and testability
-   **DB::transaction()** for atomic operations
-   **FormRequest** for validation
-   **Resources** for consistent JSON responses
-   **SOLID principles** for maintainable structure

---

## ⚡ Installation

```bash
git clone <repo-url>
cd backend-laravel
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve
```
