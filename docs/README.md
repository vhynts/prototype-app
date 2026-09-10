# Prototype App — Modular Laravel Starter Kit

Selamat datang di dokumentasi resmi **Prototype App**, sebuah Modern Starter Kit berbasis Laravel 12 (PHP 8.3+) yang dirancang dengan arsitektur **Modular Monolith** (`nwidart/laravel-modules`), sistem otorisasi tingkat lanjut **Spatie RBAC** (Role-Based Access Control) dengan kustomisasi kolom `group` & `description`, serta antarmuka modern yang mendukung **Dark Mode** penuh menggunakan **Tailwind CSS v4** dan **Alpine.js**.

---

## 📑 Daftar Isi Dokumentasi

Dokumentasi ini dirancang khusus untuk mempermudah developer dan **AI Coding Agent** (Antigravity, Claude Code, Cursor, Copilot, dll.) dalam memahami, mengembangkan, dan memelihara aplikasi ini:

1. [**Arsitektur & Konvensi Modular** (`docs/ARCHITECTURE.md`)](ARCHITECTURE.md)  
   Panduan lengkap struktur folder modular, `composer-merge-plugin`, service providers, routing, dan integrasi antar-modul.
2. [**Sistem Auth & RBAC** (`docs/RBAC_AND_AUTH.md`)](RBAC_AND_AUTH.md)  
   Detail implementasi autentikasi, model `Permission` kustom (`group` & `description`), roles, seeder, middleware, dan Blade directives.
3. [**Frontend & Dark Mode Theming** (`docs/FRONTEND_AND_THEME.md`)](FRONTEND_AND_THEME.md)  
   Spesifikasi Tailwind CSS v4, palet warna Dark Mode persis (Dark Canvas `#101010`, Accent `#007ACC`), script pencegah FOUC, dan pola komponen Alpine.js.
4. [**Panduan Khusus AI Coding Agent** (`docs/AI_GUIDELINES.md`)](AI_GUIDELINES.md)  
   Aturan penting, do's and don'ts, resep pembuatan modul baru, dan checklist verifikasi saat AI melakukan perubahan kode.

---

## 🚀 Ringkasan Tech Stack

| Layer | Teknologi & Versi | Keterangan |
| :--- | :--- | :--- |
| **Backend Framework** | Laravel 12.x / PHP 8.3+ | `declare(strict_types=1)`, Modern FormRequests & Attributes |
| **Arsitektur** | `nwidart/laravel-modules` | Modular Monolith independen per fitur (`Modules/*`) |
| **Database** | MySQL 8.0 / SQLite | Didukung Docker Compose & Laragon |
| **Otorisasi / RBAC** | `spatie/laravel-permission` ^8.3 | Custom model `Permission` (`group`, `description`) |
| **Frontend Styling** | Tailwind CSS v4 | `@custom-variant dark`, CSS Theme Variables |
| **Interaktivitas UI** | Alpine.js 3.x | Dropdowns, modal teleport, toggle check-all, toast |
| **Asset Bundler** | Vite v8.1.5 | Custom `vite-module-loader.js` untuk aset antar-modul |
| **Containerization** | Docker & Docker Compose | Nginx, PHP-FPM, MySQL 8 |

---

## 📂 Struktur Direktori Utama

```text
prototype-app/
├── Modules/                     # Direktori Modul Independen (Modular Monolith)
│   ├── Auth/                    # Modul Autentikasi (Login, Register, Password Reset)
│   ├── Dashboard/               # Modul Dashboard (Statistik, KPI, Charts, Ringkasan)
│   ├── RBAC/                    # Modul Roles & Permissions (Manajemen Hak Akses)
│   └── User/                    # Modul Pengguna (CRUD User, Role Assignment, Profil & Password)
├── app/                         # Kernel global aplikasi Laravel
├── config/                      # Konfigurasi aplikasi & Spatie permission
├── database/                    # Migrasi & seeder global
├── docker/                      # Konfigurasi container Nginx & PHP
├── docs/                        # Dokumentasi teknis lengkap & panduan AI
├── resources/
│   ├── css/app.css              # Setup Tailwind v4 & variabel Dark Mode
│   ├── js/app.js                # Setup Alpine.js & script frontend
│   └── views/
│       ├── errors/              # Custom Dark Mode Error Pages (403, 404, 419, 500, 503)
│       └── layouts/             # Master layout: dashboard.blade.php & app.blade.php
├── routes/                      # Route global (fallback, redirect, console)
├── tests/                       # Automated Feature & Unit Tests (100% Pass)
├── vite-module-loader.js        # Helper bundling aset antar-modul untuk Vite
└── vite.config.js               # Konfigurasi Vite bundler
```

---

## ⚡ Quick Start / Local Setup

```bash
# 1. Clone repository & install dependencies
composer install
npm install

# 2. Setup environment file
cp .env.example .env
php artisan key:generate

# 3. Setup database & jalankan migrasi beserta seeders
php artisan migrate --seed

# 4. Build assets frontend
npm run build
# Atau untuk live reload saat development:
npm run dev

# 5. Jalankan server lokal
php artisan serve
```

Akun default setelah seeder (`RBACSeeder.php`):
- **Super Admin**: `superadmin@example.com` / `password`
- **Admin**: `admin@example.com` / `password`
- **User**: `user@example.com` / `password`
