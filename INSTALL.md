# Hướng dẫn cài đặt Japanese Learning App

## Yêu cầu hệ thống

- PHP >= 8.1
- Composer
- MySQL/PostgreSQL
- Node.js & NPM (cho frontend assets)

## Các bước cài đặt

### 1. Cài đặt dependencies

```bash
composer install
npm install
```

### 2. Cấu hình môi trường

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Cấu hình database

Chỉnh sửa file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=japanese_learning
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Chạy migrations và seeders

```bash
php artisan migrate
php artisan db:seed
```

### 5. Build frontend assets

```bash
npm run build
```

### 6. Chạy ứng dụng

```bash
php artisan serve
```

Truy cập ứng dụng tại: `http://localhost:8000`

## Tài khoản mặc định

Sau khi chạy seeder, bạn có thể tạo tài khoản mới thông qua trang đăng ký.

## Troubleshooting

### Lỗi database connection
- Kiểm tra cấu hình database trong file `.env`
- Đảm bảo MySQL/PostgreSQL đang chạy
- Tạo database `japanese_learning` trước khi chạy migrations

### Lỗi permission
```bash
chmod -R 755 storage bootstrap/cache
```

### Lỗi composer
```bash
composer clear-cache
composer install --no-cache
```

## Cấu trúc dự án

```
japanese-learning-app/
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   └── ...
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
├── routes/
└── ...
```

## Tính năng chính

- ✅ Học từ vựng tiếng Nhật
- ✅ Học ngữ pháp cơ bản
- ✅ Bài tập tương tác
- ✅ Theo dõi tiến độ
- ✅ Hệ thống điểm số
- ✅ Giao diện responsive

## Hỗ trợ

Nếu gặp vấn đề, vui lòng tạo issue trên GitHub hoặc liên hệ qua email.
