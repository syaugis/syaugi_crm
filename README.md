# **CRM Application**

Aplikasi CRM sederhana untuk studi kasus divisi penjualan PT. Smart, dikembangkan menggunakan Laravel dan di-deploy pada Heroku dengan JawsDB sebagai database.

---

## **Fitur Utama:**
- **RBAC (Role-Based Access Control):**  
  - Menggunakan **Spatie Permission** untuk manajemen peran dan izin.  
  - Akses halaman dan fitur dibatasi berdasarkan peran dan izin yang dimiliki.
  - Pengguna dengan hak akses **Super Admin**, **Manager**, **Staff**, dan **Sales**
- **Autentikasi dan Otorisasi:** Middleware otomatis untuk peran dan izin.  
- **DataTables Server-Side Rendering:**  
  - Menggunakan **Yajra DataTables** untuk server-side rendering yang efisien dan responsif.  
  - Mendukung pencarian, filter, dan pagination pada tabel data.  
- **Notifikasi Aplikasi:** Notifikasi otomatis untuk aktivitas penting, seperti update status proyek dan approval manager.  
- **Manajemen Produk:** CRUD dan export-import produk layanan internet.  
- **Manajemen Pelanggan dan Proyek:** Hanya menampilkan data yang telah disetujui.  


---

## **Persyaratan Sistem:**
- PHP >= 8.1  
- Composer  
- Node.js & NPM  
- MySQL  
- Heroku CLI  

---

## **Instalasi Lokal:**
1. **Clone repository:**
    ```bash
    git clone https://github.com/syaugis/syaugi_crm.git
    cd syaugi_crm
    ```

2. **Install dependencies:**
    ```bash
    composer install   
    ```

3. **Copy .env file dan konfigurasi:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
   - **Atur konfigurasi database di `.env`:**
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database
    DB_USERNAME=root
    DB_PASSWORD=password_anda
    ```

4. **Migrasi dan Seed Database:**
    ```bash
    php artisan migrate --seed
    ```

5. **Storage Link:**
    ```bash
    php artisan storage:link
    ```

6. **Jalankan Aplikasi:**
    ```bash
    php artisan serve
    ```

---

## **Deployment di Heroku:**
### **1. Persiapan:**
- Pastikan sudah **commit** semua perubahan.
- Login ke Heroku:
    ```bash
    heroku login
    ```

### **2. Buat Aplikasi di Heroku:**
```bash
heroku create nama-aplikasi
```

### **3. Tambahkan JawsDB MySQL:**
```bash
heroku addons:create jawsdb:kitefin --app nama-aplikasi
```

### **4. Tambahkan JawsDB MySQL:**
```bash
heroku config:set APP_KEY=$(php artisan key:generate --show) --app nama-aplikasi
heroku config:set APP_ENV=production --app nama-aplikasi
heroku config:set APP_DEBUG=false --app nama-aplikasi
```

### **5. Setting Database di .env (JawsDB MySQL):**
- Dapatkan URL dari JawsDB:
    ```bash
    heroku config:get JAWSDB_URL --app nama-aplikasi
    ```
- Parse URL menjadi::
    ```bash
    DB_CONNECTION=mysql
    DB_HOST=xxxxxx
    DB_PORT=3306
    DB_DATABASE=xxxxxx
    DB_USERNAME=xxxxxx
    DB_PASSWORD=xxxxxx
    ```

### **6. Deploy ke Heroku:**
```bash
git push heroku main
```

### **7. Migrasi dan Seed di Heroku:**
```bash
heroku run php artisan migrate --seed --app nama-aplikasi
```

### **8. Set Storage Link di Heroku:**
```bash
heroku run php artisan storage:link --app nama-aplikasi
```

---
## **Akses Aplikasi:**
- Akun Default untuk Login (Seeder):
  - Email: superadmin@mail.com
  - Email: manager@mail.com
  - Email: staff@mail.com
  - Email: sales@mail.com
  - Password: crm12345

