<?php

return [
    // عناوين عامة
    'meals' => 'الوجبات',
    'meal' => 'وجبة',
    'create_meal' => 'إنشاء وجبة',
    'create_new_meal' => 'إنشاء وجبة جديدة',
    'edit_meal' => 'تعديل الوجبة',
    'meal_details' => 'تفاصيل الوجبة',
    'meal_list' => 'قائمة الوجبات',
    'no_meals_found' => 'لا توجد وجبات',

    // حقول الوجبة
    'meal_name' => 'اسم الوجبة',
    'meal_name_ar' => 'اسم الوجبة (عربي)',
    'meal_name_en' => 'اسم الوجبة (إنجليزي)',
    'description' => 'الوصف',
    'description_ar' => 'الوصف (عربي)',
    'description_en' => 'الوصف (إنجليزي)',
    'price' => 'السعر',
    'category' => 'الفئة',
    'preparation_time' => 'وقت التحضير',
    'minutes' => 'دقيقة',
    'meal_image' => 'صورة الوجبة',
    'availability' => 'التوفر',
    'available' => 'متوفر',
    'status' => 'الحالة',
    'active' => 'نشط',
    'image_help' => 'اختر صورة للوجبة (اختياري)',

    // المكونات
    'ingredients' => 'المكونات',
    'ingredient' => 'المكون',
    'add_ingredient' => 'إضافة مكون',
    'remove_ingredient' => 'حذف المكون',
    'select_ingredient' => 'اختر مكون',
    'quantity' => 'الكمية',
    'unit' => 'الوحدة',
    'notes' => 'ملاحظات',
    'optional_notes' => 'ملاحظات اختيارية',
    'ingredients_help' => 'أضف المكونات المطلوبة لتحضير هذه الوجبة مع الكميات المطلوبة',
    'max_available' => 'الحد الأقصى المتاح',
    'quantity_exceeds_stock' => 'الكمية تتجاوز المخزون المتاح',

    // رسائل التحقق
    'please_add_at_least_one_ingredient' => 'يرجى إضافة مكون واحد على الأقل',
    'please_complete_all_ingredients' => 'يرجى إكمال جميع بيانات المكونات',
    'cannot_remove_last_ingredient' => 'لا يمكن حذف المكون الأخير',
    'add_first_ingredient' => 'إضافة المكون الأول',
    'add_another_ingredient' => 'إضافة مكون آخر',

    // Placeholders
    'placeholders' => [
        'enter_meal_name' => 'أدخل اسم الوجبة',
        'enter_description' => 'أدخل وصف الوجبة',
        'enter_price' => 'أدخل السعر',
        'select_category' => 'اختر الفئة',
        'enter_preparation_time' => 'أدخل وقت التحضير بالدقائق',
    ],

    // حالات الوجبة
    'statuses' => [
        'active' => 'نشط',
        'inactive' => 'غير نشط',
    ],

    // رسائل النجاح والخطأ
    'meal_created' => 'تم إنشاء الوجبة بنجاح',
    'meal_updated' => 'تم تحديث الوجبة بنجاح',
    'meal_deleted' => 'تم حذف الوجبة بنجاح',
    'meal_not_found' => 'الوجبة غير موجودة',

    // صفحة العرض
    'basic_information' => 'المعلومات الأساسية',
    'quick_stats' => 'إحصائيات سريعة',
    'current_image' => 'الصورة الحالية',
    'no_image' => 'لا توجد صورة',
    'no_ingredients' => 'لا توجد مكونات',
    'no_ingredients_description' => 'لم يتم إضافة أي مكونات لهذه الوجبة بعد',
    'unavailable' => 'غير متوفر',
    'inactive' => 'غير نشط',
    'view_meal' => 'عرض الوجبة',
    'update_meal' => 'تحديث الوجبة',
    'delete_meal_confirm' => 'تأكيد حذف الوجبة',
    'delete_warning' => 'هل أنت متأكد من حذف هذه الوجبة؟',
    'delete_warning_description' => 'هذا الإجراء لا يمكن التراجع عنه. سيتم حذف جميع البيانات المرتبطة بهذه الوجبة.',

    // أزرار
    'save' => 'حفظ',
    'cancel' => 'إلغاء',
    'edit' => 'تعديل',
    'delete' => 'حذف',
    'view' => 'عرض',

    // جدول الوجبات
    'table' => [
        'name' => 'الاسم',
        'category' => 'الفئة',
        'price' => 'السعر',
        'status' => 'الحالة',
        'availability' => 'التوفر',
        'preparation_time' => 'وقت التحضير',
        'actions' => 'الإجراءات',
        'image' => 'الصورة',
        'ingredients_count' => 'عدد المكونات',
    ],
];
