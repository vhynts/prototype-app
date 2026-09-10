# Arsitektur & Konvensi Modular

Aplikasi ini mengadopsi pendekatan **Modular Monolith** dengan memanfaatkan package `nwidart/laravel-modules`. Tujuan dari arsitektur ini adalah memisahkan domain fitur ke dalam modul-modul independen tanpa kehilangan kesederhanaan deployment aplikasi monolitik tunggal.

---

## 🏗️ Anatomi Sebuah Modul

Setiap modul berlokasi di dalam folder `Modules/<ModuleName>/` dan memiliki struktur internal yang mencerminkan struktur Laravel:

```text
Modules/<ModuleName>/
├── app/
│   ├── Http/
│   │   ├── Controllers/       # Controller khusus modul
│   │   └── Requests/          # FormRequest validation
│   ├── Models/                # Eloquent Model milik modul
│   └── Providers/             # Service Provider modul (<Module>ServiceProvider.php)
├── config/                    # File konfigurasi lokal modul (opsional)
├── database/
│   ├── factories/             # Factory untuk testing / seeding
│   ├── migrations/            # Migrasi database spesifik domain modul
│   └── seeders/               # Database seeder modul
├── resources/
│   ├── assets/                # CSS/JS lokal (jika tidak digabung di global)
│   └── views/                 # Blade templates modul
├── routes/
│   ├── web.php                # Rute web dengan prefix atau middleware modul
│   └── api.php                # Rute API RESTful modul
├── composer.json              # Definisi composer lokal modul
└── module.json                # Metadata & status modul untuk nwidart
```

---

## 📦 Daftar Modul yang Tersedia Saat Ini

1. **`Modules/Auth`**
   - **Tanggung Jawab:** Alur autentikasi pengguna (Login, Register, Forgot Password, Reset Password, Logout).
   - **View Namespace:** `auth::` (contoh: `view('auth::login')`).
   - **Routes:** `routes/web.php` mengelola rute guest & auth (`/login`, `/register`, `/logout`, dll.).

2. **`Modules/Dashboard`**
   - **Tanggung Jawab:** Tampilan beranda setelah login, KPI analytics, kartu performa, dan rute API dashboard (`/api/v1/dashboards`).
   - **View Namespace:** `dashboard::` (contoh: `view('dashboard::index')`).
   - **Layout:** Menggunakan `@extends('layouts.dashboard')`.

3. **`Modules/User`**
   - **Tanggung Jawab:** Manajemen data pengguna dan profil mandiri (`/profile`).
   - **Model Utama:** `Modules\User\Models\User` (menggantikan default `App\Models\User`). Model ini mengimplementasikan `HasRoles` dari Spatie dan `HasUuids` dari Laravel.
   - **Dual-ID Architecture (Security Best Practice):**
     - **Internal Primary Key:** Kolom `id` bertipe `BIGINT UNSIGNED AUTO_INCREMENT` tetap dipertahankan untuk performa maksimal InnoDB B-Tree clustered index dan kompatibilitas tabel pivot Spatie (`model_id`).
     - **Public External Identifier:** Kolom `uuid` bertipe `CHAR(36) UNIQUE` berformat **UUID v7** (time-ordered).
     - **Route Model Binding:** `getRouteKeyName()` mengembalikan `'uuid'`, sehingga semua URL publik (`/admin/users/{user:uuid}/edit`) hanya mengekspos UUID dan kebal dari serangan *IDOR / Object Enumeration*. Mengakses URL dengan ID integer numerik otomatis menghasilkan `404 Not Found`.
   - **Controllers:** `UserController` (`admin.users.*`) dan `ProfileController` (`profile.*`).
   - **View Namespace:** `user::` (contoh: `view('user::users.index')`, `view('user::profile.edit')`).
   - **Routes:** `/profile` (autentikasi umum) dan `/admin/users` (diproteksi permission granular).

4. **`Modules/RBAC`**
   - **Tanggung Jawab:** Manajemen Role-Based Access Control (Role management, Permission matrix, penugasan hak akses).
   - **Model Kustom:** `Modules\RBAC\Models\Permission` (meng-extend Spatie `Permission` dengan dukungan kolom `group` dan `description`).
   - **Gate Bypass:** Mendaftarkan `Gate::before` di `RBACServiceProvider` agar role `super-admin` memiliki izin penuh secara otomatis.
   - **View Namespace:** `rbac::` (contoh: `view('rbac::roles.index')`, `view('rbac::permissions.index')`).
   - **Route Prefix:** `/admin/roles` dan `/admin/permissions` (diproteksi permission granular).

---

## ⚙️ Service Provider & Bootstrapping Modul

Setiap modul didaftarkan melalui Service Provider lokalnya sendiri di `<ModuleName>ServiceProvider.php`. 
Contoh pola implementasi (`Modules/RBAC/app/Providers/RBACServiceProvider.php`):

```php
<?php

namespace Modules\RBAC\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RBACServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // 1. Daftarkan View Namespace
        $this->loadViewsFrom(module_path('RBAC', 'resources/views'), 'rbac');
        
        // 2. Daftarkan Routes
        if (file_exists(module_path('RBAC', 'routes/web.php'))) {
            Route::middleware('web')
                ->group(module_path('RBAC', 'routes/web.php'));
        }

        // 3. Daftarkan Migrasi Lokal (jika ada)
        $this->loadMigrationsFrom(module_path('RBAC', 'database/migrations'));
    }
}
```

Status aktif/tidaknya setiap modul diatur dalam file root `modules_statuses.json`:
```json
{
    "Auth": true,
    "Dashboard": true,
    "RBAC": true,
    "User": true
}
```

---

## 🔗 Manajemen Autoloading (`composer-merge-plugin`)

Untuk memastikan PSR-4 autoloading dan dependensi lokal modul terbaca oleh Composer root, project menggunakan `wikimedia/composer-merge-plugin` yang dikonfigurasi di root `composer.json`:

```json
"extra": {
    "merge-plugin": {
        "include": [
            "Modules/*/composer.json"
        ]
    }
}
```
Setiap kali menambahkan dependensi baru di level modul atau membuat modul baru, jalankan:
```bash
composer dump-autoload
```

---

## 🛠️ Panduan Membuat Modul Baru

Untuk membuat modul baru, gunakan perintah artisan bawaan nwidart:
```bash
php artisan module:make Product
```

Setelah modul ter-generate:
1. Pastikan Service Provider modul terdaftar dan memuat view, route, serta migrasi dengan benar.
2. Buat rute di `Modules/Product/routes/web.php`.
3. Buat views di `Modules/Product/resources/views/` dan pastikan menggunakan `@extends('layouts.dashboard')`.
4. Jika modul memerlukan hak akses tersendiri, daftarkan permission di `Modules/RBAC/database/seeders/RBACSeeder.php` dengan kolom `group` dan `description`.
