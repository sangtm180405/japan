# Japanese Learning App - Ứng dụng học tiếng Nhật

Ứng dụng web học tiếng Nhật cơ bản được xây dựng bằng Laravel, cung cấp các tính năng học từ vựng, ngữ pháp và bài tập tương tác.

## 🌟 Tính năng chính

- **Học từ vựng**: Học từ vựng tiếng Nhật với phiên âm, nghĩa tiếng Việt và ví dụ
- **Ngữ pháp**: Học các điểm ngữ pháp cơ bản với giải thích chi tiết
- **Bài tập tương tác**: Các dạng bài tập đa dạng (trắc nghiệm, điền từ, dịch thuật)
- **Theo dõi tiến độ**: Dashboard hiển thị tiến độ học tập và điểm số
- **Hệ thống cấp độ**: Từ N5 (cơ bản) đến N1 (nâng cao)
- **Giao diện đẹp**: Thiết kế hiện đại với Bootstrap và Font Awesome

## 🚀 Cài đặt

### Yêu cầu hệ thống

- PHP >= 8.1
- Composer
- MySQL/PostgreSQL
- Node.js & NPM (cho frontend assets)

### Các bước cài đặt

1. **Clone repository**
```bash
git clone <repository-url>
cd japanese-learning-app
```

2. **Cài đặt dependencies**
```bash
composer install
npm install
```

3. **Cấu hình môi trường**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Cấu hình database trong file `.env`**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=japanese_learning
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **Chạy migrations và seeders**
```bash
php artisan migrate
php artisan db:seed
```

6. **Build frontend assets**
```bash
npm run build
```

7. **Chạy ứng dụng**
```bash
php artisan serve
```

Truy cập ứng dụng tại: `http://localhost:8000`

## 📚 Cấu trúc dự án

### Models

- **User**: Người dùng hệ thống
- **Lesson**: Bài học
- **Vocabulary**: Từ vựng
- **Grammar**: Ngữ pháp
- **Exercise**: Bài tập
- **UserProgress**: Tiến độ học của người dùng
- **UserAnswer**: Câu trả lời của người dùng

### Controllers

- **HomeController**: Trang chủ và dashboard
- **LessonController**: Quản lý bài học
- **ExerciseController**: Xử lý bài tập
- **ProfileController**: Quản lý hồ sơ người dùng

### Views

- **layouts/app.blade.php**: Layout chính
- **home.blade.php**: Trang chủ
- **dashboard.blade.php**: Dashboard người dùng
- **lessons/**: Views cho bài học
- **profile/**: Views cho hồ sơ

## 🎯 Các tính năng chi tiết

### Học từ vựng

- Hiển thị từ tiếng Nhật với Hiragana, Katakana, Kanji
- Phiên âm Romaji và nghĩa tiếng Việt
- Câu ví dụ và bản dịch
- Hỗ trợ phát âm (audio files)

### Học ngữ pháp

- Giải thích ngữ pháp chi tiết
- Cấu trúc câu và cách sử dụng
- Ví dụ minh họa
- Lưu ý quan trọng

### Bài tập tương tác

- **Trắc nghiệm**: Chọn đáp án đúng
- **Điền từ**: Điền từ còn thiếu
- **Dịch thuật**: Dịch câu tiếng Việt sang tiếng Nhật
- **Nghe hiểu**: Bài tập nghe (có thể mở rộng)

### Hệ thống điểm số

- Điểm số cho mỗi bài tập
- Tổng điểm tích lũy
- Độ chính xác phần trăm
- Xếp hạng tiến độ

## 🗄️ Database Schema

### Bảng chính

```sql
-- Bảng bài học
lessons (id, title, description, level, order, is_active, created_at, updated_at)

-- Bảng từ vựng
vocabularies (id, lesson_id, japanese, hiragana, katakana, kanji, romaji, vietnamese, english, example_sentence, example_translation, audio_file, difficulty_level, created_at, updated_at)

-- Bảng ngữ pháp
grammars (id, lesson_id, title, explanation, structure, examples, usage_notes, difficulty_level, created_at, updated_at)

-- Bảng bài tập
exercises (id, lesson_id, type, question, options, correct_answer, explanation, audio_file, points, difficulty_level, created_at, updated_at)

-- Bảng tiến độ người dùng
user_progress (id, user_id, lesson_id, is_completed, score, total_questions, correct_answers, started_at, completed_at, created_at, updated_at)

-- Bảng câu trả lời người dùng
user_answers (id, user_id, exercise_id, user_answer, is_correct, points_earned, answered_at, created_at, updated_at)
```

## 🎨 Giao diện

Ứng dụng sử dụng:
- **Bootstrap 5**: Framework CSS
- **Font Awesome**: Icons
- **Google Fonts**: Font Noto Sans JP cho tiếng Nhật
- **Gradient backgrounds**: Thiết kế hiện đại
- **Responsive design**: Tương thích mobile

## 🔧 Cấu hình

### Environment Variables

```env
APP_NAME="Japanese Learning App"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=japanese_learning
DB_USERNAME=root
DB_PASSWORD=

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

## 📝 Sử dụng

### Đăng ký tài khoản

1. Truy cập trang chủ
2. Click "Đăng ký"
3. Điền thông tin tài khoản
4. Xác nhận email (nếu cấu hình)

### Học bài

1. Chọn bài học từ danh sách
2. Đọc từ vựng và ngữ pháp
3. Làm bài tập
4. Hoàn thành bài học

### Theo dõi tiến độ

1. Vào Dashboard
2. Xem thống kê tổng quan
3. Kiểm tra tiến độ từng bài
4. Xem lịch sử học tập

## 🚀 Triển khai

### Production

1. **Cấu hình production**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

2. **Tối ưu hóa**
```bash
composer install --optimize-autoloader --no-dev
npm run production
```

3. **Chạy migrations**
```bash
php artisan migrate --force
```

### Docker (tùy chọn)

```dockerfile
FROM php:8.1-fpm
# ... Docker configuration
```

## 🤝 Đóng góp

1. Fork repository
2. Tạo feature branch
3. Commit changes
4. Push to branch
5. Tạo Pull Request

## 📄 License

Dự án này được phát hành dưới MIT License.

## 📞 Liên hệ

- Email: support@japanese-learning.com
- GitHub: [Repository URL]

## 🙏 Cảm ơn

Cảm ơn tất cả những người đã đóng góp cho dự án này!

---

**Chúc bạn học tiếng Nhật vui vẻ! がんばってください！** 🇯🇵