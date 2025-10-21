# 🚀 JAPANESE LEARNING APP - HƯỚNG DẪN KHÔI PHỤC DỮ LIỆU

## 📋 Tổng quan

File `restore_data.php` là script khôi phục dữ liệu hoàn chỉnh cho ứng dụng học tiếng Nhật. Script này sẽ tự động khôi phục tất cả dữ liệu cần thiết để app hoạt động bình thường.

## 🎯 Khi nào cần sử dụng

- ✅ Khi dữ liệu bị mất hoặc bị xóa
- ✅ Khi chuyển sang máy mới
- ✅ Khi reset database
- ✅ Khi có lỗi dữ liệu không hiển thị đúng
- ✅ Khi cần khôi phục nhanh chóng

## 🚀 Cách sử dụng

### Bước 1: Mở Terminal/Command Prompt
```bash
cd japanese-learning-app
```

### Bước 2: Chạy script khôi phục
```bash
php restore_data.php
```

### Bước 3: Chờ script hoàn thành
Script sẽ tự động:
- Xóa cache
- Chạy migrations
- Khôi phục bảng chữ cái (Hiragana, Katakana, Kanji)
- Khôi phục nội dung JLPT (N5-N1)
- Khôi phục hệ thống thành tích
- Kiểm tra dữ liệu

## 📊 Dữ liệu được khôi phục

### 🔤 Bảng chữ cái
- **Hiragana**: 46 ký tự cơ bản
- **Katakana**: 46 ký tự cơ bản
- **Kanji**: 189 ký tự (N5: 115, N4: 59, N3-N1: 15)

### 📚 Nội dung JLPT
- **N5**: 25 bài học + 555 từ vựng + ngữ pháp + bài tập
- **N4**: 20 bài học + từ vựng + ngữ pháp + bài tập
- **N3**: 20 bài học + từ vựng + ngữ pháp + bài tập
- **N2**: 20 bài học + từ vựng + ngữ pháp + bài tập
- **N1**: 20 bài học + từ vựng + ngữ pháp + bài tập

### 🏆 Hệ thống thành tích
- 15+ achievements khác nhau
- Hệ thống điểm và streak
- Badges và rewards

## ⚠️ Lưu ý quan trọng

1. **Backup trước khi chạy**: Nếu có dữ liệu quan trọng, hãy backup trước
2. **Chạy trong thư mục gốc**: Đảm bảo đang ở thư mục `japanese-learning-app`
3. **Quyền admin**: Có thể cần quyền admin để chạy migrations
4. **Kết nối database**: Đảm bảo database đã được cấu hình đúng

## 🔧 Troubleshooting

### Lỗi "Class not found"
```bash
composer install
php artisan config:clear
```

### Lỗi database connection
```bash
php artisan config:cache
php artisan migrate:status
```

### Lỗi permission
```bash
# Windows
# Chạy Command Prompt as Administrator

# Linux/Mac
sudo php restore_data.php
```

## 📈 Sau khi khôi phục

### Kiểm tra app
1. Truy cập: `http://localhost:8000`
2. Kiểm tra JLPT dashboard: `http://localhost:8000/jlpt`
3. Kiểm tra Analytics: `http://localhost:8000/analytics`
4. Kiểm tra Achievements: `http://localhost:8000/achievements`

### Chạy server
```bash
php artisan serve
```

## 🎉 Kết quả mong đợi

Sau khi chạy thành công, bạn sẽ thấy:
- ✅ Tất cả số liệu hiển thị đúng trên JLPT dashboard
- ✅ Bảng chữ cái đầy đủ
- ✅ Bài học N5-N1 hoàn chỉnh
- ✅ Từ vựng phong phú
- ✅ Hệ thống thành tích hoạt động
- ✅ Tất cả tính năng mới sẵn sàng

## 📞 Hỗ trợ

Nếu gặp vấn đề, hãy kiểm tra:
1. Log file: `storage/logs/laravel.log`
2. Database connection trong `.env`
3. Quyền truy cập file và thư mục
4. Phiên bản PHP và Laravel

---

**🎊 Chúc bạn học tiếng Nhật vui vẻ!**
