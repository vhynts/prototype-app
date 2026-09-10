# Frontend & Dark Mode Theming

Aplikasi ini menggunakan **Tailwind CSS v4** dengan engine styling modern dan **Alpine.js 3.x** untuk interaktivitas reaktif tanpa overhead framework SPA berat.

---

## 🎨 Palet Warna Presisi (Exact Dark Mode Palette)

Semua komponen Dark Mode dikonfigurasi secara presisi di [`resources/css/app.css`](file:///c:/laragon/www/prototype-app/resources/css/app.css) dengan palet standar berikut:

| Token / Elemen | Warna Hex | Deskripsi Penggunaan |
| :--- | :--- | :--- |
| **Canvas / Background** | `#101010` (`bg-slate-950`) | Latar belakang utama halaman aplikasi |
| **Card / Surface** | `#161616` (`bg-slate-900`) | Latar belakang card, tabel, dropdown container |
| **Sub-surface / Inputs** | `#1F1F1F` (`bg-slate-800`) | Input fields, baris hover, container item sekunder |
| **Borders** | `#262626` (`border-slate-800`) | Garis pembatas panel, card border, divider |
| **Inner Borders** | `#2D2D2D` (`border-slate-700`) | Garis pembatas input field, sub-komponen |
| **Primary Accent** | `#007ACC` (`indigo-600`) | Tombol aksi utama, active link, progress indicator |
| **Accent Hover** | `#0062A3` (`indigo-700`) | Efek hover pada tombol aksi utama |
| **Foreground Text** | `#CCCCCC` | Warna teks utama body |
| **Muted Text** | `#888888` / `#94A3B8` | Label sekunder, placeholder input, teks bantuan |

---

## ⚡ Pencegahan FOUC (Flash of Unstyled Content)

Untuk mencegah efek kedipan putih (*flash*) saat halaman dimuat dalam kondisi Dark Mode aktif, script sinkron ditempatkan langsung di dalam tag `<head>` pada layout utama sebelum stylesheet CSS dirender:

```html
<script>
    (function() {
        const saved = localStorage.getItem('theme');
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        if (saved === 'dark' || (!saved && prefersDark)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    })();
</script>
```

---

## 🌓 Logika Penggantian Tema (Theme Switching)

### 1. Dashboard Layout (`layouts/dashboard.blade.php`)
Menyediakan dropdown switch 3 mode di header kanan atas:
- **Light**: Memaksa tema terang (`localStorage.setItem('theme', 'light')`).
- **Dark**: Memaksa tema gelap (`localStorage.setItem('theme', 'dark')`).
- **System**: Mengikuti preferensi OS (`localStorage.removeItem('theme')` atau `setItem('theme', 'system')`) dan otomatis mendengarkan perubahan OS via `window.matchMedia('(prefers-color-scheme: dark)')`.

### 2. Auth Pages (`login`, `register`, `forgot-password`)
- Tidak menampilkan tombol toggle manual agar tampilan login tetap bersih dan fokus.
- Secara otomatis mengikuti preferensi sistem OS pengguna.
- Jika pengguna sebelumnya sudah pernah login dan memilih preferensi tema (misal Light Mode), sistem akan menghormati nilai yang ada di `localStorage`.

---

## 🧩 Pola Komponen Interaktif (Alpine.js)

### 1. Matriks Checkbox (Check All & Check Group)
Digunakan pada form Roles Create & Edit (`roles/create.blade.php` & `roles/edit.blade.php`):

```javascript
x-data="{
    submitting: false,
    selected: {{ json_encode(old('permissions', $rolePermissions ?? [])) }},
    allPermissions: {{ json_encode($permissions->pluck('name')) }},
    groupPermissions: {{ json_encode($groupedPermissions->map->pluck('name')) }},
    toggleAll(checked) {
        this.selected = checked ? [...this.allPermissions] : [];
    },
    toggleGroup(groupName, checked) {
        let perms = this.groupPermissions[groupName] || [];
        if(checked) {
            perms.forEach(p => {
                if(!this.selected.includes(p)) this.selected.push(p);
            });
        } else {
            this.selected = this.selected.filter(p => !perms.includes(p));
        }
    },
    isGroupChecked(groupName) {
        let perms = this.groupPermissions[groupName];
        if(!perms || perms.length === 0) return false;
        return perms.every(p => this.selected.includes(p));
    }
}"
```

### 2. Notifikasi & Alerts (Dark Mode Polished)
- **Error Alert**: Menggunakan latar transparan bernuansa gelap `dark:bg-red-950/30`, border `dark:border-red-900/50`, dan teks `dark:text-red-300`.
- **Success Toast**: Menggunakan latar `dark:bg-emerald-950/40`, border `dark:border-emerald-900/50`, dan teks `dark:text-emerald-300`.
- **Button Hover**: Hindari efek bayangan putih berlebih (`shadow-indigo-200`) di dark mode dengan selalu menambahkan `dark:shadow-none`.

### 3. Password Visibility Toggle (Show/Hide)
Pola Alpine.js untuk kontrol mata pada input password:
```html
<div class="relative" x-data="{ show: false }">
    <input :type="show ? 'text' : 'password'" class="...">
    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 ...">
        <svg x-show="!show" ...></svg>
        <svg x-show="show" style="display: none;" ...></svg>
    </button>
</div>
```

---

## 🚫 Halaman Error Kustom (Custom Error Pages)

Seluruh template error berlokasi di [`resources/views/errors/`](file:///c:/laragon/www/prototype-app/resources/views/errors/) dan mewarisi layout `layouts.app`:

| Kode Error | File Blade | Nuansa Ikon / Warna | Pesan & Tindakan |
| :--- | :--- | :--- | :--- |
| **403 Forbidden** | `403.blade.php` | Amber (`amber-500`) | Gembok / Perisai. Menjelaskan izin tidak cukup, tombol kembali & dashboard. |
| **404 Not Found** | `404.blade.php` | Indigo (`indigo-500`) | Wajah sedih / Halaman hilang. Navigasi kembali ke beranda. |
| **419 Expired** | `419.blade.php` | Blue (`blue-500`) | Jam / Sesi habis. Tombol muat ulang (*reload*) atau login ulang. |
| **500 Server Error** | `500.blade.php` | Red (`red-500`) | Peringatan teknis server. Tombol coba lagi & dashboard. |
| **503 Maintenance** | `503.blade.php` | Amber (`amber-500`) | Pemeliharaan sistem saat `php artisan down`. |

