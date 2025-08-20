# ERD Sistem Permohonan JDN

## 1. Gambaran Umum

Entity Relationship Diagram (ERD) untuk Sistem Permohonan Jabatan Daftar Negara (JDN) yang mengelola permohonan permit kerja, visa kerja, permit tinggal, dan sistem helpdesk untuk support pengguna.

## 2. Diagram ERD

```mermaid
erDiagram
    USERS ||--o{ PERMOHONAN : "membuat"
    USERS ||--o{ HELPDESK_TICKETS : "membuat"
    USERS ||--o{ HELPDESK_REPLIES : "membalas"
    PERMOHONAN ||--o{ PERMOHONAN_DOKUMEN : "memiliki"
    PERMOHONAN ||--o{ PERMOHONAN_STATUS_LOG : "memiliki"
    HELPDESK_TICKETS ||--o{ HELPDESK_REPLIES : "memiliki"
    HELPDESK_TICKETS ||--o{ HELPDESK_ATTACHMENTS : "memiliki"
    USERS ||--o{ PASSWORD_RESET_TOKENS : "memiliki"
    USERS ||--o{ SESSIONS : "memiliki"

    USERS {
        bigint id PK
        string name
        string email UK
        timestamp email_verified_at
        string password
        enum role "pemohon, admin"
        string phone
        text alamat
        string ic_passport
        enum status "aktif, tidak_aktif"
        string remember_token
        timestamp created_at
        timestamp updated_at
    }

    PERMOHONAN {
        bigint id PK
        bigint user_id FK
        string no_permohonan UK
        enum jenis_permohonan "permit_kerja, visa_kerja, permit_tinggal, lain_lain"
        date tarikh_diperlukan
        text tujuan
        string nama_syarikat
        string jawatan
        text alamat_syarikat
        text catatan
        enum status "draft, dihantar, dalam_proses, lulus, ditolak, selesai"
        bigint processed_by FK
        text catatan_admin
        date tarikh_keputusan
        timestamp created_at
        timestamp updated_at
    }

    PERMOHONAN_DOKUMEN {
        bigint id PK
        bigint permohonan_id FK
        string nama_dokumen
        string nama_fail_asal
        string nama_fail_sistem
        string mime_type
        bigint saiz_fail
        string path_fail
        enum status "aktif, dipadam"
        timestamp created_at
        timestamp updated_at
    }

    PERMOHONAN_STATUS_LOG {
        bigint id PK
        bigint permohonan_id FK
        enum status_lama "draft, dihantar, dalam_proses, lulus, ditolak, selesai"
        enum status_baru "draft, dihantar, dalam_proses, lulus, ditolak, selesai"
        bigint changed_by FK
        text catatan
        timestamp created_at
    }

    HELPDESK_TICKETS {
        bigint id PK
        bigint user_id FK
        string ticket_number UK
        enum kategori "teknikal, permohonan, dokumen, akaun, lain"
        enum keutamaan "rendah, sederhana, tinggi, kritikal"
        string subjek
        text penerangan
        text langkah_diambil
        enum status "baru, terbuka, dalam_proses, menunggu_respons, selesai, ditutup"
        bigint assigned_to FK
        timestamp last_reply_at
        timestamp resolved_at
        timestamp created_at
        timestamp updated_at
    }

    HELPDESK_REPLIES {
        bigint id PK
        bigint ticket_id FK
        bigint user_id FK
        text mesej
        boolean is_internal
        enum reply_type "user, admin, system"
        timestamp created_at
        timestamp updated_at
    }

    HELPDESK_ATTACHMENTS {
        bigint id PK
        bigint ticket_id FK
        string nama_fail_asal
        string nama_fail_sistem
        string mime_type
        bigint saiz_fail
        string path_fail
        timestamp created_at
    }

    PASSWORD_RESET_TOKENS {
        string email PK
        string token
        timestamp created_at
    }

    SESSIONS {
        string id PK
        bigint user_id FK
        string ip_address
        text user_agent
        longtext payload
        integer last_activity
    }

    SYSTEM_SETTINGS {
        bigint id PK
        string key UK
        text value
        string description
        enum type "string, integer, boolean, json"
        timestamp created_at
        timestamp updated_at
    }

    NOTIFICATIONS {
        bigint id PK
        bigint user_id FK
        string title
        text message
        enum type "info, success, warning, error"
        json data
        boolean is_read
        timestamp read_at
        timestamp created_at
        timestamp updated_at
    }
```

## 3. Deskripsi Entitas

### 3.1 USERS

Menyimpan data pengguna sistem (pemohon dan admin)

* **Role**: pemohon (pengguna biasa), admin (administrator sistem)

* **Status**: aktif (dapat menggunakan sistem), tidak\_aktif (diblokir)

### 3.2 PERMOHONAN

Menyimpan data permohonan yang diajukan oleh pemohon

* **Jenis Permohonan**: permit\_kerja, visa\_kerja, permit\_tinggal, lain\_lain

* **Status**: draft (belum dihantar), dihantar (sudah disubmit), dalam\_proses (sedang diproses admin), lulus (disetujui), ditolak (tidak disetujui), selesai (proses selesai)

* **No Permohonan**: nomor unik yang digenerate otomatis

### 3.3 PERMOHONAN\_DOKUMEN

Menyimpan file dokumen pendukung permohonan

* Mendukung multiple file upload per permohonan

* Menyimpan metadata file (nama asli, nama sistem, ukuran, path)

### 3.4 PERMOHONAN\_STATUS\_LOG

Menyimpan riwayat perubahan status permohonan untuk audit trail

* Mencatat siapa yang mengubah status dan kapan

* Menyimpan catatan alasan perubahan status

### 3.5 HELPDESK\_TICKETS

Menyimpan tiket support dari pengguna

* **Kategori**: teknikal, permohonan, dokumen, akaun, lain

* **Keutamaan**: rendah, sederhana, tinggi, kritikal

* **Status**: baru, terbuka, dalam\_proses, menunggu\_respons, selesai, ditutup

### 3.6 HELPDESK\_REPLIES

Menyimpan balasan/komunikasi dalam tiket helpdesk

* **Reply Type**: user (dari pengguna), admin (dari admin), system (otomatis)

* **Is Internal**: untuk catatan internal admin yang tidak terlihat user

### 3.7 HELPDESK\_ATTACHMENTS

Menyimpan file lampiran dalam tiket helpdesk

* Mendukung multiple file attachment per tiket

### 3.8 NOTIFICATIONS

Sistem notifikasi untuk pengguna

* **Type**: info, success, warning, error

* **Data**: JSON field untuk data tambahan notifikasi

### 3.9 SYSTEM\_SETTINGS

Konfigurasi sistem yang dapat diubah melalui admin panel

* **Type**: string, integer, boolean, json untuk validasi tipe data

## 4. Relasi Utama

### 4.1 User ke Permohonan (1:N)

* Satu user dapat membuat banyak permohonan

* Setiap permohonan dimiliki oleh satu user

### 4.2 User ke Helpdesk Tickets (1:N)

* Satu user dapat membuat banyak tiket helpdesk

* Admin dapat di-assign ke banyak tiket

### 4.3 Permohonan ke Dokumen (1:N)

* Satu permohonan dapat memiliki banyak dokumen pendukung

* Setiap dokumen terkait dengan satu permohonan

### 4.4 Helpdesk Tickets ke Replies (1:N)

* Satu tiket dapat memiliki banyak balasan

* Setiap balasan terkait dengan satu tiket

### 4.5 Permohonan ke Status Log (1:N)

* Satu permohonan memiliki banyak log perubahan status

* Setiap log terkait dengan satu permohonan

## 5. Indeks dan Constraint

### 5.1 Primary Keys

* Semua tabel menggunakan `id` sebagai primary key dengan tipe `bigint`

* Tabel `password_reset_tokens` menggunakan `email` sebagai primary key

* Tabel `sessions` menggunakan `id` string sebagai primary key

### 5.2 Unique Constraints

* `users.email` - email harus unik

* `permohonan.no_permohonan` - nomor permohonan harus unik

* `helpdesk_tickets.ticket_number` - nomor tiket harus unik

* `system_settings.key` - key setting harus unik

### 5.3 Foreign Key Constraints

* `permohonan.user_id` → `users.id`

* `permohonan.processed_by` → `users.id`

* `permohonan_dokumen.permohonan_id` → `permohonan.id`

* `permohonan_status_log.permohonan_id` → `permohonan.id`

* `permohonan_status_log.changed_by` → `users.id`

* `helpdesk_tickets.user_id` → `users.id`

* `helpdesk_tickets.assigned_to` → `users.id`

* `helpdesk_replies.ticket_id` → `helpdesk_tickets.id`

* `helpdesk_replies.user_id` → `users.id`

* `helpdesk_attachments.ticket_id` → `helpdesk_tickets.id`

* `sessions.user_id` → `users.id`

* `notifications.user_id` → `users.id`

### 5.4 Indeks untuk Performance

* `permohonan.status` - untuk filter berdasarkan status

* `permohonan.jenis_permohonan` - untuk filter berdasarkan jenis

* `permohonan.created_at` - untuk sorting berdasarkan tanggal

* `helpdesk_tickets.status` - untuk filter berdasarkan status tiket

* `helpdesk_tickets.kategori` - untuk filter berdasarkan kategori

* `helpdesk_tickets.keutamaan` - untuk filter berdasarkan prioritas

* `notifications.user_id, is_read` - untuk notifikasi pengguna

* `sessions.last_activity` - untuk cleanup session

## 6. Catatan Implementasi

### 6.1 Soft Delete

* Tabel `permohonan` dan `helpdesk_tickets` sebaiknya menggunakan soft delete

* Tambahkan kolom `deleted_at` untuk audit trail

### 6.2 File Storage

* File dokumen dan attachment disimpan di storage Laravel

* Path file disimpan relatif terhadap storage directory

* Implementasikan file cleanup untuk file yang tidak terpakai

### 6.3 Security

* Password di-hash menggunakan bcrypt

* File upload harus divalidasi tipe dan ukurannya

* Implementasikan rate limiting untuk API endpoints

### 6.4 Performance

* Gunakan eager loading untuk relasi yang sering diakses

* Implementasikan caching untuk data yang jarang berubah

* Pertimbangkan pagination untuk list data yang besar

### 6.5 Audit Trail

* Semua perubahan penting harus dicatat di log

* Gunakan Laravel's model events untuk otomatis logging

* Simpan IP address dan user agent untuk security audit

