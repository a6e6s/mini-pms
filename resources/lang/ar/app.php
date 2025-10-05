<?php

return [
    // Navigation
    'navigation' => [
        'tasks' => 'المهام',
        'kanban_board' => 'لوحة كانبان',
        'projects' => 'المشاريع',
        'users' => 'المستخدمين',
        'task_statuses' => 'حالات المهام',
        'comments' => 'التعليقات',
        'attachments' => 'المرفقات',
    ],

    // Resources
    'resources' => [
        'tasks' => 'المهام',
        'projects' => 'المشاريع',
        'users' => 'المستخدمين',
        'task_statuses' => 'حالات المهام',
        'comments' => 'التعليقات',
        'attachments' => 'المرفقات',
    ],

    // Fields
    'fields' => [
        'title' => 'العنوان',
        'description' => 'الوصف',
        'project' => 'المشروع',
        'status' => 'الحالة',
        'due_date' => 'تاريخ الاستحقاق',
        'estimated_time' => 'الوقت المقدر',
        'time_taken' => 'الوقت المستغرق',
        'assigned_user' => 'المستخدم المكلف',
        'attachments' => 'المرفقات',
        'name' => 'الاسم',
        'email' => 'البريد الإلكتروني',
        'email_address' => 'عنوان البريد الإلكتروني',
        'address' => 'العنوان',
        'password' => 'كلمة المرور',
        'role' => 'الدور',
        'user_role' => 'دور المستخدم',
        'phone' => 'الهاتف',
        'active' => 'نشط',
        'owner' => 'المالك',
        'created_at' => 'تاريخ الإنشاء',
        'updated_at' => 'تاريخ التحديث',
        'color' => 'اللون',
        'body' => 'المحتوى',
        'file_path' => 'مسار الملف',
        'file_name' => 'اسم الملف',
        'file_size' => 'حجم الملف',
        'mime_type' => 'نوع الملف',
        'due_at' => 'تاريخ الاستحقاق',
        'time_estimated' => 'الوقت المقدر (بالدقائق)',
        'select_user' => 'اختر المستخدم',
        'your_comment' => 'تعليقك',
        'user_id' => 'معرف المستخدم',
        'full_name' => 'الاسم الكامل',
        'phone_number' => 'رقم الهاتف',
        'registered_at' => 'تاريخ التسجيل',
        'last_updated' => 'آخر تحديث',
    ],

    // Kanban Board
    'kanban' => [
        'all_tasks' => 'جميع المهام',
        'my_tasks' => 'مهامي',
        'my_project_tasks' => 'مهام مشاريعي',
        'all_projects' => 'جميع المشاريع',
        'all_users' => 'جميع المستخدمين',
        'task' => 'مهمة',
        'tasks' => 'مهام',
        'due' => 'الاستحقاق',
        'new_task' => 'مهمة جديدة',
        'view_task' => 'عرض المهمة',
        'add_comment' => 'إضافة تعليق',
        'assign_to' => 'تكليف إلى',
        'close' => 'إغلاق',
        'not_set' => 'غير محدد',
        'click_to_add_description' => 'انقر لإضافة وصف...',
        'comments' => 'التعليقات',
        'no_comments_yet' => 'لا توجد تعليقات بعد.',
        'write_comment_placeholder' => 'اكتب تعليقك هنا...',
        'comment_added_successfully' => 'تم إضافة التعليق بنجاح',
        'user_assigned_successfully' => 'تم تكليف المستخدم بنجاح',
        'minutes' => 'دقيقة',
        'no_tasks' => 'لا توجد مهام',
    ],

    // Actions
    'actions' => [
        'create' => 'إنشاء',
        'edit' => 'تعديل',
        'delete' => 'حذف',
        'view' => 'عرض',
        'save' => 'حفظ',
        'cancel' => 'إلغاء',
        'activate' => 'تفعيل',
        'deactivate' => 'إلغاء التفعيل',
    ],

    // Messages
    'messages' => [
        'success' => 'تمت العملية بنجاح',
        'error' => 'حدث خطأ',
        'validation_error' => 'يرجى التحقق من النموذج للأخطاء',
        'unauthorized' => 'ليس لديك صلاحية لتنفيذ هذا الإجراء',
    ],

    // Filters
    'filters' => [
        'all' => 'الكل',
        'active' => 'نشط',
        'inactive' => 'غير نشط',
    ],

    // Sections
    'sections' => [
        'user_information' => 'معلومات المستخدم',
        'user_details' => 'تفاصيل المستخدم',
    ],

    // Form Labels
    'form' => [
        'required' => 'مطلوب',
        'optional' => 'اختياري',
        'search' => 'بحث',
        'select_option' => 'اختر خيار',
        'multiple_selection' => 'يمكن اختيار عدة خيارات',
        'file_upload' => 'رفع ملف',
        'max_file_size' => 'الحد الأقصى لحجم الملف: 10 ميجابايت',
        'accepted_file_types' => 'أنواع الملفات المقبولة: PDF، الصور، مستندات Word، الملفات النصية',
        'estimated_time_help' => 'الوقت المقدر لإكمال هذه المهمة بالدقائق',
    ],

    // Global enum translations
    'Admin' => 'مشرف',
    'User' => 'مستخدم',
    'Primary' => 'أساسي',
    'Secondary' => 'ثانوي',
    'Success' => 'نجاح',
    'Danger' => 'خطر',
    'Warning' => 'تحذير',
    'Info' => 'معلومات',
    'Light' => 'فاتح',
    'Dark' => 'غامق',
];
