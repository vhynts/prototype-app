# Panduan Khusus AI Coding Agent (AI Guidelines)

Dokumen ini berisi aturan wajib, konvensi, dan checklist yang **HARUS dipatuhi oleh setiap AI Coding Assistant** (Antigravity, Claude Code, Cursor, Copilot, dll.) saat membaca, memodifikasi, atau menambahkan kode ke dalam repository **Prototype App**.

---

## ⚡ 10 Aturan Emas (Golden Rules)

1. **Gunakan Model Kustom Permission:**  
   Jangan mengimpor langsung `Spatie\Permission\Models\Permission`. Selalu gunakan:
   ```php
   use Modules\RBAC\Models\Permission;
   ```
   Karena model ini memiliki atribut `$fillable` untuk `group` dan `description`.

2. **DILARANG KERAS Memotong String Permission:**  
   Jangan pernah menggunakan `explode('-', $permission->name)` untuk mengelompokkan permission. Selalu gunakan kolom `group` dari database:
   ```php
   $groupedPermissions = $permissions->groupBy(fn($p) => $p->group ?? 'Others');
   ```

3. **Gunakan Model User dari Modul:**  
   Model User tidak berada di `App\Models\User`, melainkan di:
   ```php
   use Modules\User\Models\User;
   ```

4. **Wajib Mendukung Dark Mode Penuh:**  
   Setiap kali membuat atau mengubah file Blade view, pastikan **SEMUA elemen UI memiliki pasangan class `dark:`** yang sesuai dengan palet resmi:
   - Background canvas: `bg-slate-50 dark:bg-slate-950`
   - Container card/surface: `bg-white dark:bg-slate-900`
   - Input / sub-surface: `bg-slate-50 dark:bg-slate-800/70`
   - Border: `border-slate-100 dark:border-slate-800`
   - Text primer: `text-slate-900 dark:text-white`
   - Text sekunder: `text-slate-500 dark:text-slate-400`

5. **Hindari Efek Hover Silau di Dark Mode:**  
   Pada tombol aksi berlatar `bg-indigo-600`, sertakan `dark:shadow-none` agar tidak menimbulkan bayangan putih silau saat di-hover.

6. **Ketik Ketat PHP (Strict Types):**  
   Selalu awali setiap file PHP baru dengan:
   ```php
   <?php

   declare(strict_types=1);
   ```

7. **Validasi Menggunakan FormRequest:**  
   Hindari menulis aturan validasi inline di dalam Controller untuk alur store/update. Buat file `FormRequest` terpisah di dalam `Modules/<ModuleName>/app/Http/Requests/`.

8. **Otorisasi Berbasis Granular Permissions:**  
   Prioritaskan otorisasi menggunakan nama permission spesifik (contoh: `@canany(['edit-users', 'manage-users'])` atau middleware `permission:create-users|manage-users`) daripada mengecek role secara kaku. Jangan membuat pengecekan manual `if ($user->hasRole('super-admin'))` karena sudah ditangani otomatis oleh `Gate::before`.

9. **Pertahankan Anti-FOUC Script:**  
   Jangan menghapus atau memindahkan script inline anti-FOUC yang ada di `<head>` file `resources/views/layouts/dashboard.blade.php` dan `app.blade.php`.

10. **Verifikasi Setelah Perubahan (Wajib Jalankan Tests):**  
    Setelah melakukan perubahan kode:
    - Jalankan `php artisan test` untuk memastikan semua feature tests lulus.
    - Jalankan `php artisan optimize:clear` jika mengedit view, config, atau route.
    - Jalankan `npm run build` jika mengedit styling Tailwind atau JavaScript.

---

## 📋 Resep: Cara Menambahkan Fitur / Modul Baru

Ketika diminta membuat modul baru (misalnya modul `Inventory`):

1. **Generate Modul:**
   ```bash
   php artisan module:make Inventory
   ```
2. **Periksa Service Provider:**
   Pastikan `Modules/Inventory/app/Providers/InventoryServiceProvider.php` mendaftarkan views (`inventory`), routes (`web.php`), dan migrasi jika diperlukan.
3. **Tambahkan Permissions ke Seeder:**
   Buka `Modules/RBAC/database/seeders/RBACSeeder.php` dan daftarkan permission baru:
   ```php
   Permission::updateOrCreate(
       ['name' => 'view-inventory', 'guard_name' => 'web'],
       ['group' => 'Inventory', 'description' => 'View inventory stock and logs']
   );
   ```
4. **Buat Views:**
   Selalu gunakan layout utama:
   ```blade
   @extends('layouts.dashboard')

   @section('title', 'Inventory Management')

   @section('content')
       {{-- Konten dengan class dark: lengkap --}}
   @endsection
   ```
5. **Tambahkan Navigasi di Sidebar:**
   Buka `resources/views/layouts/dashboard.blade.php` dan tambahkan menu navigasi yang dilindungi `@can('view-inventory')`.
