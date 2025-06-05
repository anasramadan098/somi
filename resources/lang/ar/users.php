<?php

return [
    // عام
    'users' => 'المستخدمين',
    'user' => 'مستخدم',
    'manage_users' => 'إدارة المستخدمين',
    'all_users' => 'جميع المستخدمين',
    'add_new_user' => 'إضافة مستخدم جديد',
    'add_user' => 'إضافة مستخدم',
    'create_user' => 'إنشاء مستخدم',
    'edit_user' => 'تعديل مستخدم',
    'update_user' => 'تحديث مستخدم',
    'delete_user' => 'حذف مستخدم',
    'view_user' => 'عرض مستخدم',
    'user_profile' => 'ملف المستخدم',

    // حقول النموذج
    'name' => 'الاسم',
    'email' => 'البريد الإلكتروني',
    'password' => 'كلمة المرور',
    'confirm_password' => 'تأكيد كلمة المرور',
    'role' => 'الدور',
    'status' => 'الحالة',
    'phone' => 'الهاتف',
    'address' => 'العنوان',
    'profile_picture' => 'صورة الملف الشخصي',

    // رؤوس الجدول
    'table' => [
        'id' => 'المعرف',
        'name' => 'الاسم',
        'email' => 'البريد الإلكتروني',
        'role' => 'الدور',
        'status' => 'الحالة',
        'created' => 'تاريخ الإنشاء',
        'actions' => 'الإجراءات',
        'last_login' => 'آخر تسجيل دخول',
        'phone' => 'الهاتف',
    ],

    // الأدوار
    'roles' => [
        'owner' => 'مالك',
        'employee' => 'موظف',
        'admin' => 'مدير',
        'manager' => 'مدير',
        'staff' => 'طاقم',
    ],

    // الحالة
    'statuses' => [
        'active' => 'نشط',
        'inactive' => 'غير نشط',
        'suspended' => 'معلق',
        'pending' => 'في الانتظار',
    ],

    // الرسائل
    'user_created' => 'تم إنشاء المستخدم بنجاح.',
    'user_updated' => 'تم تحديث المستخدم بنجاح.',
    'user_deleted' => 'تم حذف المستخدم بنجاح.',
    'user_not_found' => 'المستخدم غير موجود.',
    'no_users_found' => 'لم يتم العثور على مستخدمين',
    'start_by_adding' => 'ابدأ بإضافة أول مستخدم.',
    'delete_user_confirm' => 'هل أنت متأكد من أنك تريد حذف هذا المستخدم؟',
    'cannot_delete_self' => 'لا يمكنك حذف حسابك الخاص.',
    'password_updated' => 'تم تحديث كلمة المرور بنجاح.',

    // النصوص التوضيحية
    'placeholders' => [
        'enter_name' => 'أدخل اسم المستخدم',
        'enter_email' => 'أدخل عنوان البريد الإلكتروني',
        'enter_password' => 'أدخل كلمة المرور',
        'confirm_password' => 'أكد كلمة المرور',
        'enter_phone' => 'أدخل رقم الهاتف',
        'enter_address' => 'أدخل العنوان',
        'select_role' => 'اختر الدور',
        'select_status' => 'اختر الحالة',
    ],

    // التحقق
    'validation' => [
        'name_required' => 'الاسم مطلوب.',
        'email_required' => 'البريد الإلكتروني مطلوب.',
        'email_unique' => 'هذا البريد الإلكتروني مستخدم بالفعل.',
        'password_required' => 'كلمة المرور مطلوبة.',
        'password_min' => 'يجب أن تكون كلمة المرور 8 أحرف على الأقل.',
        'password_confirmed' => 'تأكيد كلمة المرور غير متطابق.',
        'role_required' => 'الدور مطلوب.',
        'phone_unique' => 'رقم الهاتف هذا مستخدم بالفعل.',
    ],

    // الصلاحيات
    'permissions' => [
        'view_users' => 'عرض المستخدمين',
        'create_users' => 'إنشاء مستخدمين',
        'edit_users' => 'تعديل المستخدمين',
        'delete_users' => 'حذف المستخدمين',
        'manage_roles' => 'إدارة الأدوار',
    ],

    // الملف الشخصي
    'profile' => [
        'my_profile' => 'ملفي الشخصي',
        'edit_profile' => 'تعديل الملف الشخصي',
        'change_password' => 'تغيير كلمة المرور',
        'current_password' => 'كلمة المرور الحالية',
        'new_password' => 'كلمة المرور الجديدة',
        'profile_updated' => 'تم تحديث الملف الشخصي بنجاح.',
        'avatar' => 'الصورة الرمزية',
        'personal_info' => 'المعلومات الشخصية',
        'account_settings' => 'إعدادات الحساب',
    ],

    // النشاط
    'activity' => [
        'last_activity' => 'آخر نشاط',
        'login_history' => 'تاريخ تسجيل الدخول',
        'activity_log' => 'سجل النشاط',
        'never_logged_in' => 'لم يسجل دخول مطلقاً',
        'online' => 'متصل',
        'offline' => 'غير متصل',
    ],
];
