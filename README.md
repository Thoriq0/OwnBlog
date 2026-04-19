# OwnBlog

**OwnBlog** adalah platform blog pribadi berbasis **Laravel 12 + Livewire 3** dengan pendekatan CMS ringan.  
Konten utama artikel disimpan sebagai file **Markdown (`.md`)**, sementara database dipakai untuk metadata seperti judul, slug, kategori, status, excerpt, views, dan lokasi banner.

Project ini dibangun untuk workflow yang simple:
- admin bisa nulis dan edit artikel dengan preview Markdown
- guest bisa baca konten dengan tampilan yang nyaman
- branding blog bisa diatur dari panel admin tanpa ubah kode manual

---

## Ringkasan Fitur

Fitur yang sudah ada saat ini:

- login admin
- CRUD konten blog
- editor Markdown dengan preview real-time
- toolbar Markdown: heading, bold, italic, quote, list, table, code, dan link
- konten artikel disimpan sebagai file `.md` di storage
- upload dan kompres banner
- excerpt dan path banner disimpan di database untuk listing yang lebih ringan
- guest search
- guest `load more` + skeleton loading
- lazy loading image untuk kartu artikel
- top posts berdasarkan views
- dark / light mode untuk guest dan admin
- admin settings untuk account dan base settings
- brand settings untuk nama blog, logo, dan 3 link footer connect
- seeder demo untuk akun admin dan konten awal

---

## Tech Stack

### Backend

| Package | Fungsi |
| --- | --- |
| `laravel/framework` | Core framework |
| `livewire/livewire` | Komponen interaktif untuk guest dan admin |
| `intervention/image` | Resize / kompres gambar banner dan branding |
| `mews/purifier` | Sanitasi HTML / Markdown |

### Frontend

| Package | Fungsi |
| --- | --- |
| `tailwindcss` | Utility-first CSS |
| `@tailwindcss/typography` | Styling konten artikel |
| `flowbite` | Komponen UI tambahan |
| `alpinejs` | Interaksi ringan di sisi client |
| `marked` | Render Markdown ke HTML untuk preview |
| `dompurify` | Sanitasi hasil render preview |
| `vite` | Bundler frontend |

---

## Cara Install

### 1. Clone repository

```bash
git clone https://github.com/Thoriq0/OwnBlog.git
cd OwnBlog
```

### 2. Install dependency

```bash
composer install
npm install
```

### 3. Siapkan environment

```bash
cp .env.example .env
php artisan key:generate
```

Default contoh database di project ini:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ownblog
DB_USERNAME=root
DB_PASSWORD=
```

Kalau nama database mau dibedakan, tinggal sesuaikan di `.env`.

### 4. Buat storage link

```bash
php artisan storage:link
```

### 5. Jalankan migration dan seeder

```bash
php artisan migrate --seed
```

Seeder akan membuat:
- 1 akun admin
- 20 konten demo
- file Markdown untuk setiap konten
- excerpt demo
- banner demo untuk kebutuhan tampilan guest

Credential admin default:

```text
Email    : admin@admin.com
Password : password
```

### 6. Jalankan project

Cara paling praktis:

```bash
composer run dev
```

Command ini akan menjalankan:
- `php artisan serve`
- `php artisan queue:listen`
- `php artisan pail`
- `npm run dev`

Kalau mau manual:

```bash
php artisan serve
npm run dev
```

App akan jalan di:

```text
http://127.0.0.1:8000
```

---

## Route Penting

- guest home: `GET /`
- list posts: `GET /posts`
- about page: `GET /about`
- detail post: `GET /post/read-{slug}`
- category page: `GET /{category}/post`
- login admin: `GET /login`
- dashboard admin: `GET /dashboard`
- content list admin: `GET /your-text`
- new content admin: `GET /new-text`
- settings admin: `GET /settings`

---

## Struktur Penyimpanan Konten

### Database

Database menyimpan metadata seperti:

- `title`
- `slug`
- `category`
- `tags`
- `status`
- `views`
- `content_path`
- `excerpt`
- `banner_path`

### Storage

Markdown artikel disimpan di:

```text
storage/app/contents/{slug}/content.md
```

Banner, avatar, dan aset branding publik disimpan di:

```text
storage/app/public/...
```

Contoh banner artikel:

```text
storage/app/public/contents/{slug}/banner.{ext}
```

Pendekatan ini bikin body artikel tetap fleksibel karena isi utama tidak ditaruh langsung di kolom database.

---

## Branding dan Settings

Panel admin sekarang punya halaman `Settings` dengan dua tab:

### Account Settings

- ganti avatar admin
- ganti nama user
- ganti email login
- ganti password

### Base Settings

- ganti site title
- ganti logo / icon blog
- atur maksimal 3 link footer connect

Perubahan base settings dipakai langsung ke:
- navbar guest
- footer guest
- login page
- branding navbar admin

---

## Performa Guest

Beberapa optimasi yang sudah dipakai:

- listing guest hanya mengambil field metadata yang dibutuhkan
- excerpt disimpan di database supaya list page tidak perlu render full Markdown
- banner path disimpan di database
- image card memakai lazy loading
- halaman guest pakai `load more` daripada pagination standar
- skeleton loading untuk search dan load more

Untuk skala awal sampai menengah, pendekatan ini sudah jauh lebih aman dibanding selalu memuat full content di listing.

---

## Testing

Jalankan test dengan:

```bash
php artisan test
```

Saat ini sudah ada test untuk:
- basic app response
- admin settings update
- validasi settings dan redirect tab

---

## Catatan Setup Tambahan

- Pastikan ekstensi PHP dan dependency image processing aktif kalau mau upload banner / logo.
- Karena session dan cache default memakai driver database, pastikan migration sudah dijalankan sebelum login.
- Setelah mengubah file env atau config penting, aman untuk jalankan:

```bash
php artisan optimize:clear
```

---

## Roadmap Kecil

Yang masih bisa dilanjutkan:

- tag dan kategori dinamis
- media manager yang lebih rapi
- installer setup yang lebih simpel
- test coverage yang lebih luas untuk flow content dan guest page

---

## Preview

### Home
![Home](./preview/home.png)

### Page
![Page](./preview/page.png)

### Admin Dashboard
![Admin Dashboard](./preview/adminDashboard.png)

### Content List
![Content List](./preview/contentList.png)

### Content Form
![Content Form](./preview/contentForm.png)
