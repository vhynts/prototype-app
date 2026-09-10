# Sistem Otorisasi (RBAC) & Autentikasi

Aplikasi ini menggunakan sistem **Role-Based Access Control (RBAC)** berbasis package `spatie/laravel-permission` yang telah dikustomisasi secara mendalam agar mendukung pengelompokan (*grouping*) dan deskripsi fungsional untuk setiap hak akses.

---

## 🔐 Model Custom Permission

Alih-alih menggunakan model default bawaan Spatie, aplikasi ini menggunakan model kustom:
👉 [`Modules\RBAC\Models\Permission`](file:///c:/laragon/www/prototype-app/Modules/RBAC/app/Models/Permission.php)

Model ini meng-extend `Spatie\Permission\Models\Permission` dengan atribut tambahan:
```php
namespace Modules\RBAC\Models;

use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    protected $fillable = [
        'name',
        'guard_name',
        'group',         // Nama modul/kelompok permission (misal: 'Users', 'Roles')
        'description',   // Keterangan detail fungsionalitas hak akses
    ];
}
```

### Konfigurasi Global
Model custom ini didaftarkan di `config/permission.php`:
```php
'models' => [
    'permission' => \Modules\RBAC\Models\Permission::class,
    'role' => \Spatie\Permission\Models\Role::class,
],
```

---

## 🛑 Aturan Penting Grouping: HINDARI String Splitting

> [!CAUTION]
> **DILARANG KERAS** menggunakan manipulasi string seperti `explode('-', $permission->name)` untuk mengelompokkan permission di Blade atau Controller.

**Alasan:**
Nama permission dapat bervariasi (contoh: `manage-roles`, `view-active-deals`, `export-monthly-kpi`). Memotong string menghasilkan data kelompok yang inkonsisten, tidak akurat, dan merusak UI matriks hak akses.

### Pola Grouping yang Benar:
Gunakan nilai kolom database `group` secara langsung:

```php
// Di Controller atau Blade
$groupedPermissions = $permissions->groupBy(fn($p) => $p->group ?? 'Others');
```

---

## 👥 Struktur Roles & Permissions Default

Berdasarkan seeder utama [`Modules\RBAC\Database\Seeders\RBACSeeder.php`](file:///c:/laragon/www/prototype-app/Modules/RBAC/database/seeders/RBACSeeder.php):

### 1. Default Roles
- **`super-admin`**: Memiliki akses tertinggi ke seluruh fitur aplikasi. Tidak dapat dihapus dari sistem.
- **`admin`**: Memiliki akses manajemen operasional (Users, Roles, Permissions).
- **`user`**: Pengguna standar dengan akses melihat dashboard umum.

### 2. Matriks Permissions Bawaan

| Group | Permission Name | Deskripsi |
| :--- | :--- | :--- |
| **Users** | `view-users` | View users list and profiles |
| **Users** | `create-users` | Create new users in the system |
| **Users** | `edit-users` | Update existing user details and roles |
| **Users** | `delete-users` | Delete users from the system |
| **Roles** | `manage-roles` | View, create, update, and delete system roles |
| **Permissions** | `manage-permissions` | View system permission lists and configurations |

---

---

## ⚡ Super Admin Gate Bypass (`Gate::before`)

Agar pemilik sistem (`super-admin`) tidak pernah terkunci dari fitur apapun bahkan saat permission baru dibuat dan belum sempat di-assign di database, didaftarkan aturan bypass global di [`RBACServiceProvider.php`](file:///c:/laragon/www/prototype-app/Modules/RBAC/app/Providers/RBACServiceProvider.php):

```php
use Illuminate\Support\Facades\Gate;

Gate::before(function ($user, string $ability) {
    return $user->hasRole('super-admin') ? true : null;
});
```
- Jika pengguna memiliki role `super-admin`, Gate akan langsung mengembalikan `true` (bypass).
- Jika pengguna bukan `super-admin`, Gate mengembalikan `null` sehingga pengecekan berlanjut ke permission spesifik pengguna di database.

---

## 🛡️ Pengamanan Rute Berbasis Granular Permissions

Untuk memastikan fleksibilitas peran non-admin (misal: *Staff HR* yang hanya boleh melihat user tanpa boleh menambah/menghapus), rute dilindungi oleh middleware permission spesifik, bukan sekadar nama role:

### 1. Modul User (`Modules/User/routes/web.php`):
```php
Route::get('users', [UserController::class, 'index'])->middleware('permission:view-users|manage-users')->name('users.index');
Route::get('users/create', [UserController::class, 'create'])->middleware('permission:create-users|manage-users')->name('users.create');
Route::post('users', [UserController::class, 'store'])->middleware('permission:create-users|manage-users')->name('users.store');
Route::get('users/{user}', [UserController::class, 'show'])->middleware('permission:view-users|manage-users')->name('users.show');
Route::get('users/{user}/edit', [UserController::class, 'edit'])->middleware('permission:edit-users|manage-users')->name('users.edit');
Route::match(['put', 'patch'], 'users/{user}', [UserController::class, 'update'])->middleware('permission:edit-users|manage-users')->name('users.update');
Route::delete('users/{user}', [UserController::class, 'destroy'])->middleware('permission:delete-users|manage-users')->name('users.destroy');
```

### 2. Modul RBAC (`Modules/RBAC/routes/web.php`):
Rute role dan permission dilindungi oleh granular permissions:
`view-roles|manage-roles`, `create-roles|manage-roles`, `edit-roles|manage-roles`, `delete-roles|manage-roles`, dan `view-permissions|manage-permissions`.

---

## 🎨 Otorisasi di Blade View

Gunakan directive `@canany` untuk tombol dan menu agar serasi dengan sistem granular:

```blade
{{-- Tombol Tambah --}}
@canany(['create-users', 'manage-users'])
    <a href="{{ route('admin.users.create') }}">Add New User</a>
@endcanany

{{-- Tombol Aksi Tabel --}}
@canany(['edit-users', 'manage-users'])
    <a href="{{ route('admin.users.edit', $user) }}">Edit</a>
@endcanany

@canany(['delete-users', 'manage-users'])
    <button type="button">Delete</button>
@endcanany

{{-- Menu Sidebar Dinamis --}}
@canany(['view-users', 'manage-users'])
    <a href="{{ route('admin.users.index') }}">Users</a>
@endcanany
```

---

## 📝 Cara Menambahkan Permission Baru

Saat membuat modul baru (misal: `Product`), tambahkan permission baru di seeder atau migrasi modul Anda:

```php
use Modules\RBAC\Models\Permission;

Permission::updateOrCreate(
    ['name' => 'create-products', 'guard_name' => 'web'],
    ['group' => 'Products', 'description' => 'Create new product listings and catalog items']
);
```
Dengan mengisi kolom `group` dan `description`, permission baru akan otomatis muncul rapi di matriks checkbox form Create & Edit Role pada UI admin tanpa perlu mengubah kode Blade.
