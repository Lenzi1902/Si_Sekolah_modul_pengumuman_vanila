1.Clone Repository
  git clone https://github.com/username/nama-repo.git
  cd nama-repo

2.Setup Database
  1.Buat database baru di MySQL
  CREATE DATABASE si_sekolah_pengumuman_vanila;
  2.jalankan query tabel berikut di database si_sekolah_pengumuman_vanila;
  
  CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','guru','siswa') NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  );
  
  
  CREATE TABLE kelas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama_kelas VARCHAR(50) NOT NULL
  );
  
  
  CREATE TABLE siswa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  kelas_id INT NOT NULL,
  nis VARCHAR(20) UNIQUE,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (kelas_id) REFERENCES kelas(id) ON DELETE CASCADE
  );
  
  
  CREATE TABLE pengumuman (
  id INT AUTO_INCREMENT PRIMARY KEY,
  judul VARCHAR(150) NOT NULL,
  isi TEXT NOT NULL,
  target ENUM('semua','guru','siswa','kelas') NOT NULL,
  kelas_id INT NULL,
  created_by INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (kelas_id) REFERENCES kelas(id) ON DELETE SET NULL,
  FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE
  );
  
  
  CREATE TABLE absensi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  siswa_id INT NOT NULL,
  tanggal DATE NOT NULL,
  status ENUM('hadir','izin','sakit','alpha') NOT NULL,
  FOREIGN KEY (siswa_id) REFERENCES siswa(id) ON DELETE CASCADE,
  UNIQUE (siswa_id, tanggal)
  );


3.Jalankan Server Backend
  Masuk ke folder project lalu jalankan:
  php -S localhost:8000 -t public
  Server akan berjalan di:
  http://localhost:8000

4.Testing API Menggunakan Postman
  1.Login
  Endpoint: POST http://localhost:8000/api/login
  Body (JSON):
  {
  "email": "admin@sekolah.com",
  "password": "admin123"
  }

  2.Tambah Pengumuman (POST)
  Endpoint: POST http://localhost:8000/api/pengumuman
  Body (JSON):
  {
  "judul": "Libur Sekolah",
  "isi": "Sekolah libur hari Jumat",
  "target": "kelas",
  "kelas_id": 1,
  "created_by": 1
  }

  3.Ambil Semua Pengumuman (GET)
  Endpoint: GET http://localhost:8000/api/pengumuman

  4.Ambil Pengumuman Berdasarkan Target
  Endpoint: GET http://localhost:8000/api/pengumuman?target=kelas

  5.Ambil Pengumuman Berdasarkan Kelas
  Endpoint:GET http://localhost:8000/api/pengumuman?kelas_id=1

  6.Input Absensi (POST)
  Endpoint:POST http://localhost:8000/api/absensi
  Body (JSON)
  {
  "siswa_id": 1,
  "tanggal": "2026-01-10",
  "status": "hadir"
  }

Catatan
- Pastikan user_id, kelas_id, dan siswa_id sudah ada di database
- Gunakan Content-Type: application/json di Postman
