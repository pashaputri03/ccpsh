# Gunakan image PHP 8.1 dengan Apache
FROM php:8.1-apache

# Install ekstensi yang diperlukan (misalnya, MySQLi, PDO, dan lainnya)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Aktifkan mod_rewrite untuk Apache (jika dibutuhkan)
RUN a2enmod rewrite

# Salin file aplikasi PHP ke dalam folder yang benar di dalam container
COPY . /var/www/html

# Pastikan izin yang benar untuk semua file di dalam folder aplikasi
RUN chmod -R 755 /var/www/html

# Atur hak akses agar Apache dapat menulis ke folder tertentu
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 untuk Apache
EXPOSE 80
