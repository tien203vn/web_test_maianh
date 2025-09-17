# Sử dụng image PHP chính thức với các extension cần thiết cho Laravel
FROM php:8.2-fpm

# Cài đặt các extension cần thiết
RUN apt-get update \
    && apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libonig-dev \
        zip \
        git \
        unzip \
        curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring exif pcntl bcmath

# Cài Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Tạo thư mục làm việc
WORKDIR /var/www

# Copy code vào container
COPY . /var/www

# Đảm bảo thư mục storage và bootstrap/cache tồn tại trước khi chown
RUN mkdir -p /var/www/storage /var/www/bootstrap/cache \
    && chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Expose port 9000 và chạy php-fpm
EXPOSE 9000
CMD ["php-fpm"]
