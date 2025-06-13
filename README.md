# Mini ERP System (Laravel)

A mini ERP system built with Laravel, Bootstrap (SB Admin), and DomPDF for managing inventory and sales orders.

## 🔧 Features

- ✅ Product Management (CRUD: Name, SKU, Price, Quantity)
- ✅ Sales Orders with multiple products
- ✅ Stock deduction when order is confirmed
- ✅ PDF Invoice Generation
- ✅ Role-based access (Admin & Salesperson)
- ✅ SB Admin Theme for UI
- ✅ Clean MVC + FormRequest Validation

## 👤 Seeded Users

| Role        | Email                  | Password   |
|-------------|------------------------|------------|
| Admin       | admin@example.com      | password   |
| Salesperson | salesperson@example.com| password   |

## 🚀 Installation Steps

```bash
git clone https://github.com/yourname/mini-erp.git
cd mini-erp
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
