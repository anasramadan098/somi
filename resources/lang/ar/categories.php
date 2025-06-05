<?php

return [
    // عناوين الصفحات
    'categories' => 'الفئات',
    'category_list' => 'قائمة الفئات',
    'create_category' => 'إنشاء فئة',
    'create_new_category' => 'إنشاء فئة جديدة',
    'edit_category' => 'تعديل الفئة',
    'add_category' => 'إضافة فئة',

    // حقول الفئة
    'category_name' => 'اسم الفئة',
    'category_name_ar' => 'اسم الفئة (عربي)',
    'category_name_en' => 'اسم الفئة (إنجليزي)',
    'description' => 'الوصف',
    'description_ar' => 'الوصف (عربي)',
    'description_en' => 'الوصف (إنجليزي)',
    'type' => 'النوع',
    'status' => 'الحالة',
    'image' => 'الصورة',

    // أنواع الفئات
    'types' => [
        'food' => 'طعام',
        'drink' => 'مشروبات',
    ],

    // حالات الفئة
    'active' => 'نشط',
    'inactive' => 'غير نشط',

    // جدول الفئات
    'table' => [
        'name' => 'الاسم',
        'description' => 'الوصف',
        'products_count' => 'عدد المنتجات',
        'type' => 'النوع',
        'created_at' => 'تاريخ الإنشاء',
        'actions' => 'الإجراءات',
    ],

    // النماذج
    'placeholders' => [
        'enter_category_name' => 'أدخل اسم الفئة',
        'enter_category_name_ar' => 'أدخل اسم الفئة بالعربية',
        'enter_category_name_en' => 'أدخل اسم الفئة بالإنجليزية',
        'enter_description' => 'أدخل وصف الفئة',
        'enter_description_ar' => 'أدخل وصف الفئة بالعربية',
        'enter_description_en' => 'أدخل وصف الفئة بالإنجليزية',
    ],

    // الرسائل
    'category_created' => 'تم إنشاء الفئة بنجاح',
    'category_updated' => 'تم تحديث الفئة بنجاح',
    'category_deleted' => 'تم حذف الفئة بنجاح',
    'confirm_delete' => 'هل أنت متأكد من حذف هذه الفئة؟',
    'no_categories_found' => 'لا توجد فئات',

    // التحقق من الصحة
    'validation' => [
        'name_required' => 'اسم الفئة مطلوب',
        'name_ar_required' => 'اسم الفئة بالعربية مطلوب',
        'name_en_required' => 'اسم الفئة بالإنجليزية مطلوب',
        'type_required' => 'نوع الفئة مطلوب',
        'type_invalid' => 'نوع الفئة غير صحيح',
    ],
];
