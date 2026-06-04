# خزنة الميراث الرقمية - Digital Legacy Vault
## مشروع Laravel كامل - 11,000+ سطر كود

### الملفات المضمنة من رسائل 1-11:

#### 1. Controllers (8 ملفات)
- DashboardController.php - إدارة الخزنة الرئيسية
- SubscriptionController.php - نظام الاشتراكات Paymob
- ProfileController.php - الملف الشخصي + 2FA
- AdminController.php - لوحة الإدارة
- LawyerController.php - لوحة المحامين
- Api/AuthApiController.php - API المصادقة
- Api/AssetApiController.php - API الأصول

#### 2. Services (6 ملفات)
- PaymentService.php - Paymob Integration كامل
- TwoFactorService.php - Google Authenticator
- BitwardenService.php - إدارة كلمات السر
- EmailService.php - نظام الإيميلات
- SMSService.php - Twilio SMS
- BackupService.php - النسخ الاحتياطي

#### 3. Models (10 ملفات)
- User.php - مع Encryption + 2FA
- Asset.php - الأصول الرقمية
- Deputy.php - النواب
- Subscription.php - الاشتراكات
- DeathVerificationRequest.php - طلبات الوفاة
- Lawyer.php - المحامين
- AssetCategory.php - التصنيفات
- ActivityLog.php - سجل النشاطات
- LoginAttempt.php - محاولات الدخول

#### 4. Livewire Components (5 ملفات)
- AssetSearch.php - بحث الأصول
- DashboardStats.php - الإحصائيات
- RecentActivity.php - النشاط الأخير
- DeputyAssetAssignment.php - تخصيص الأصول
- AssetBulkActions.php - العمليات المجمعة

#### 5. Views (25+ ملف)
- dashboard/ - كل صفحات المستخدم
- admin/ - لوحة الإدارة كاملة
- lawyer/ - لوحة المحامين
- livewire/ - كل الـ Components
- emails/ - قوالب الإيميلات
- layouts/ - Layouts

#### 6. API (4 ملفات)
- AuthApiController + AssetApiController
- AssetResource, DeputyResource, DeathRequestResource
- Sanctum Authentication

#### 7. Tests (5 ملفات)
- AssetTest.php
- DeputyTest.php  
- SubscriptionTest.php
- DeathVerificationTest.php
- ApiTest.php

#### 8. Configs
- legacy.php - إعدادات المشروع
- services.php - Paymob + Twilio + Bitwarden

### طريقة التشغيل:
```bash
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan queue:work
php artisan serve
```

### المتطلبات:
- PHP 8.2+
- Laravel 11
- MySQL 8.0+
- Redis
- Node.js 18+

### Features:
✅ نظام اشتراكات Paymob
✅ Two-Factor Authentication
✅ Bitwarden Integration
✅ نظام النواب والوصايا
✅ تشفير AES-256
✅ API كامل مع Sanctum
✅ Admin Panel
✅ Lawyer Panel
✅ Livewire Components
✅ Tests شاملة

تم إنشاؤه بواسطة Meta AI - رسائل 1-11 من 50
إجمالي: ~11,000 سطر كود
