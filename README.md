# 📰 OwnBlog

**OwnBlog** adalah platform blog pribadi buatan sendiri, dibuat menggunakan **Laravel 12 + Livewire 3**, dan dikombinasikan dengan **TailwindCSS**, **Vite**, serta beberapa package tambahan untuk memperkaya fitur seperti upload gambar, dan text editor.

---

## 🚀 Deskripsi Singkat

OwnBlog dibuat sebagai project pribadi yang berfungsi sebagai **portfolio sekaligus playground** untuk eksplorasi Laravel dan Livewire.  
Tujuan utamanya adalah membangun sistem blog modern dengan fokus pada performa, dan UX.

---

## ⚙️ Tech Stack & Dependencies

### 🧱 Backend (Composer)
| Package | Fungsi |
|----------|--------|
| `laravel/framework` | Core framework |
| `livewire/livewire` | Komponen interaktif tanpa JavaScript manual |
| `intervention/image` | Manipulasi & resize gambar |


### 🎨 Frontend (NPM)
| Package | Fungsi |
|----------|--------|
| `tailwindcss` | CSS framework utility-first |
| `@tailwindcss/typography` | Styling untuk konten artikel |
| `flowbite` | Komponen UI tambahan berbasis Tailwind |
| `quill` | Rich text editor untuk input konten |

---

## 🧩 Fitur yang Sudah Ada

✅ **Autentikasi dasar** (login/logout)  
✅ **CRUD konten blog** dengan Livewire  
✅ **Upload & resize gambar otomatis(Banner)**  
✅ **Editor teks rich (Quill)**  
✅ **Pagination Livewire**  
✅ **Responsive UI dengan Tailwind + Flowbite**  

---

## 🧠 Cara Install Project

### 1️⃣ Clone Repository
```bash
git clone https://github.com/Thoriq0/OwnBlog.git
cd OwnBlog
```

### 2️⃣ Install Dependencies
**Backend:**
```bash
composer install
```
**Frontend:**
```bash
npm install
```

### 3️⃣ Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```
**Lalu sesuaikan konfigurasi database di file .env:**
```bash
DB_CONNECTION=mysql/pgsql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=simpleblog
DB_USERNAME=root
DB_PASSWORD=
```

### 4️⃣ Migration & Seeder
```bash
php artisan migrate --seed
```
Seeder akan otomatis membuat data user, yang bisa di gunakan untuk user login nanti
```bash
'name' => 'Test User',
'email' => 'admin@admin.com',
'password' => 'password',
'role' => 'admin',
```

### 5️⃣ Running Project
**Backend:**
```bash
php artisan serve
```
**Frontend:**
```bash
npm run dev
```
Project akan running di http://127.0.0.1:8000 . bukalah url tersebut di browser
Untuk menambahkan konten, masuk kedalam publihser/admin form dengan http://127.0.0.1:8000/login

**🌟 Coming Soon**
- 🚧 Settings user
- 🚧 Sign up Form
- 🚧 Optimasi Tag
- 🚧 Tag & kategori dinamis
- 🚧 Compress gambar input konten
- 🚧 Easy installer
