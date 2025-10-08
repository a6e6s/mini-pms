# Mini PMS - Project Management System

[English](#english) | [العربية](#arabic)

---

<a name="english"></a>
## 🇬🇧 English

### 📋 Description
A modern, lightweight project management system built with Laravel and Filament, featuring Kanban boards, task tracking, and team collaboration tools.

### ✨ Key Features

#### Core Features
- ✅ User authentication and authorization
- ✅ Role-based access control (Admin, User)
- ✅ User profile management
- ✅ Multi-language support (English, Arabic)
- ✅ Dark mode support
- ✅ Responsive design for mobile and desktop

#### Project Management
- ✅ Create, edit, and delete projects
- ✅ Project dashboard with statistics
- ✅ Project ownership and team assignment

#### Task Management
- ✅ Create, edit, and delete tasks
- ✅ Task status management (To Do, In Progress, Done, etc.)
- ✅ Kanban board view with drag-and-drop
- ✅ Task assignment to multiple users
- ✅ Due dates and time tracking
- ✅ Task descriptions and inline editing

#### Collaboration
- ✅ Comments on tasks
- ✅ File attachments (upload and download)
- ✅ Activity logging with detailed tracking
- ✅ Real-time activity feed

#### Advanced Features
- ✅ Search functionality for tasks and projects
- ✅ Polymorphic comments, attachments, and activities
- ✅ Task filtering (All tasks, My tasks, My project tasks)
- ✅ Comprehensive activity tracking (status changes, attachments, comments, etc.)

### 🛠️ Technology Stack

- **Backend:** Laravel 12.x
- **Admin Panel:** Filament 4.x
- **Database:** MariaDB/MySQL
- **PHP:** 8.2+
- **Authentication:** Filament Shield (Role & Permission)
- **Frontend:** Livewire, Alpine.js, Tailwind CSS

### 📦 Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- MariaDB/MySQL
- Git

### 🚀 Installation

1. **Clone the repository**
```bash
git clone <repository-url>
cd mini-pms
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Install Node dependencies**
```bash
npm install
```

4. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

5. **Configure database**
Edit `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mini_pms
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. **Run migrations and seeders**
```bash
php artisan migrate --seed
```

7. **Create Filament admin user**
```bash
php artisan make:filament-user
```

8. **Create storage link**
```bash
php artisan storage:link
```

9. **Build assets**
```bash
npm run build
```

10. **Start the development server**
```bash
php artisan serve
```

11. **Access the application**
- URL: `http://localhost:8000/admin`
- Login with the credentials you created in step 7

### 📝 License
MIT License

---

<a name="arabic"></a>
## 🇸🇦 العربية

### 📋 الوصف
نظام إدارة مشاريع حديث وخفيف مبني على Laravel و Filament، يتميز بلوحات كانبان وتتبع المهام وأدوات التعاون الجماعي.

### ✨ المميزات الرئيسية

#### الميزات الأساسية
- ✅ مصادقة وتفويض المستخدمين
- ✅ التحكم في الوصول على أساس الأدوار (مشرف، مستخدم)
- ✅ إدارة ملف المستخدم
- ✅ دعم متعدد اللغات (الإنجليزية، العربية)
- ✅ دعم الوضع الداكن
- ✅ تصميم متجاوب للهاتف المحمول وسطح المكتب

#### إدارة المشاريع
- ✅ إنشاء وتعديل وحذف المشاريع
- ✅ لوحة معلومات المشروع مع الإحصائيات
- ✅ ملكية المشروع وتعيين الفريق

#### إدارة المهام
- ✅ إنشاء وتعديل وحذف المهام
- ✅ إدارة حالة المهام (قيد الانتظار، قيد التنفيذ، مكتمل، إلخ)
- ✅ عرض لوحة كانبان مع السحب والإفلات
- ✅ تعيين المهام لعدة مستخدمين
- ✅ تواريخ الاستحقاق وتتبع الوقت
- ✅ أوصاف المهام والتحرير المباشر

#### التعاون
- ✅ التعليقات على المهام
- ✅ مرفقات الملفات (رفع وتحميل)
- ✅ تسجيل النشاط مع التتبع التفصيلي
- ✅ موجز النشاط في الوقت الفعلي

#### الميزات المتقدمة
- ✅ وظيفة البحث عن المهام والمشاريع
- ✅ تعليقات ومرفقات وأنشطة متعددة الأشكال
- ✅ تصفية المهام (جميع المهام، مهامي، مهام مشاريعي)
- ✅ تتبع شامل للنشاط (تغييرات الحالة، المرفقات، التعليقات، إلخ)

### 🛠️ التقنيات المستخدمة

- **الخلفية:** Laravel 12.x
- **لوحة الإدارة:** Filament 4.x
- **قاعدة البيانات:** MariaDB/MySQL
- **PHP:** 8.2+
- **المصادقة:** Filament Shield (الأدوار والصلاحيات)
- **الواجهة الأمامية:** Livewire, Alpine.js, Tailwind CSS

### 📦 المتطلبات

- PHP >= 8.2
- Composer
- Node.js & NPM
- MariaDB/MySQL
- Git

### 🚀 التثبيت

1. **استنساخ المستودع**
```bash
git clone <repository-url>
cd mini-pms
```

2. **تثبيت اعتماديات PHP**
```bash
composer install
```

3. **تثبيت اعتماديات Node**
```bash
npm install
```

4. **إعداد البيئة**
```bash
cp .env.example .env
php artisan key:generate
```

5. **تكوين قاعدة البيانات**
تحرير ملف `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mini_pms
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. **تشغيل الترحيلات والبذور**
```bash
php artisan migrate --seed
```

7. **إنشاء مستخدم مشرف Filament**
```bash
php artisan make:filament-user
```

8. **إنشاء رابط التخزين**
```bash
php artisan storage:link
```

9. **بناء الأصول**
```bash
npm run build
```

10. **بدء خادم التطوير**
```bash
php artisan serve
```

11. **الوصول إلى التطبيق**
- الرابط: `http://localhost:8000/admin`
- قم بتسجيل الدخول باستخدام بيانات الاعتماد التي أنشأتها في الخطوة 7

### 📝 الترخيص
رخصة MIT

---

## 🤝 Contributing
Contributions are welcome! Please feel free to submit a Pull Request.

## 📧 Contact
For questions or support, please open an issue on GitHub.
