#### TEST MELAMAR KERJA (API SISTEM PEMBAYARAN)
------------
##### 1 KEBUTUHAN :
- LARAGON Latest Version (Sudah Include PHP ^8.1 & MYSQL 8.0.30)
- Atau Install Sendiri-Sendiri Apache, PHP ^8.1 & MYSQL 8.0.30
- GIT Latest Version
- COMPOSER Latest Version
- POSTMAN Latest Version
------------
##### 2 PETUNJUK :
###### 2.1 INSTALL LARAGON 
- Install terlebih dahulu LARAGON
- Setelah Itu Running Packagenya Apache,PHP,MYSQL
- Lalu Masuk Ke Folder C:\laragon\www 
- Buat Folder Baru Untuk Projek Ini
- Kemudian buka cmd/terminal arahkan ke folder diatas
###### 2.2 JALANKAN GIT 
- ketik git init (untuk initialize)
- ketik git remote add origin https://github.com/dimaskumara11/mini-sistem-pembayaran.git (untuk remote reponya)
- ketik git remote -v (untuk check sudah konek belum)
- ketik git pull origin master
- Tunggu sampai semua selesai di download
###### 2.3 RUNNING API 
- lalu ketik composer install
- Setelah selesai, ketik php artisan migrate --seed (untuk migration database) ketik yes jika ada pertanyaan ingin menambahkan database baru
- ketik php artisan serve --port=9000 (port bisa di sesuaikan)
###### 2.4 IMPORT COLLECTION & ENV POSTMAN
- install POSTMAN
- lalu import collection [mini-sistem-pembayaran.postman_collection.json](https://github.com/dimaskumara11/mini-sistem-pembayaran/blob/master/mini-sistem-pembayaran.postman_collection.json "mini-sistem-pembayaran.postman_collection.json")
- import environment [MINI-SISTEM-PEMBAYARAN.postman_environment.json](https://github.com/dimaskumara11/mini-sistem-pembayaran/blob/master/MINI-SISTEM-PEMBAYARAN.postman_environment.json "MINI-SISTEM-PEMBAYARAN.postman_environment.json")
###### 2.5 SEND API
- hasil soal nomor 1 ada di request "Laporan Penjualan", klik lalu send.
- hasil soal nomor 2 ada di request "Pembayaran" & "Cicil Angsuran", pertama jalankan Pembayaran lalu cicil angsuran menggunakan response id dari pembayaran
###### 2.6 PENJELASAN SOAL NOMOR 1
- Di buat 3 tabel untuk menyelesaikan soal nomor 1 : marketing, penjualan dan settings_komisi
- tabel marketing untuk menampung data marketing
- tabel penjualan untuk menampung data penjualan
- tabel settings_komisi untuk menampung settingan komisi, jadi ketika user ingin mengubah settingan komisi cukup update di tabel ini
- penarikan data menggunakan raw query dengan dinamis case komisi yang dibuatkan fungsi yang di ambil dari tabel settings_komisi
###### 2.7 PENJELASAN SOAL NOMOR 2
- Di tambahkan 2 tabel untuk menyelesaikan soal nomor 2 : pembayaran dan pembayaran_kredit
- tabel pembayaran untuk menampung data pembayaran cash ataupun credit
- tabel pembayaran_kredit untuk menampung pembayaran secara menyicil berdasarkan parent id pembayaran (jika cash ini tidak berlaku)
- untuk testingnya, send api "pembayaran/bayar", yang akan menampilkan response id pembayaran yang digunakan untuk melakukan cicilan
- lalu untuk melakukan cicil angsuran, masukan id pembayaran diatas dan tanggal bayar, lalu send api "pembayaran/bayar-cicilan/{id_pembayaran}"
