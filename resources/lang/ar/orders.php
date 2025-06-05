<?php

return [
    // عام
    'orders' => 'الطلبات',
    'order' => 'طلب',
    'order_management' => 'إدارة الطلبات',
    'order_list' => 'قائمة الطلبات',
    'order_details' => 'تفاصيل الطلب',
    'add_order' => 'إضافة طلب',
    'edit_order' => 'تعديل الطلب',
    'create_order' => 'إنشاء طلب',
    'update_order' => 'تحديث الطلب',
    'delete_order' => 'حذف الطلب',
    'view_order' => 'عرض الطلب',
    'order_information' => 'معلومات الطلب',
    'order_history' => 'تاريخ الطلبات',
    'order_statistics' => 'إحصائيات الطلبات',

    // الحقول
    'order_number' => 'رقم الطلب',
    'order_date' => 'تاريخ الطلب',
    'client' => 'العميل',
    'client_name' => 'اسم العميل',
    'table_number' => 'رقم الطاولة',
    'meals' => 'الوجبات',
    'quantity' => 'الكمية',
    'unit_price' => 'سعر الوحدة',
    'total_amount' => 'المبلغ الإجمالي',
    'subtotal' => 'المجموع الفرعي',
    'tax' => 'الضريبة',
    'discount' => 'الخصم',
    'grand_total' => 'المجموع الكلي',
    'payment_method' => 'طريقة الدفع',
    'payment_status' => 'حالة الدفع',
    'payment_date' => 'تاريخ الدفع',
    'due_date' => 'تاريخ الاستحقاق',
    'notes' => 'ملاحظات',
    'waiter' => 'النادل',
    'kitchen_notes' => 'ملاحظات المطبخ',
    'special_requests' => 'طلبات خاصة',

    // حالة الطلب
    'order_statuses' => [
        'pending' => 'في الانتظار',
        'confirmed' => 'مؤكد',
        'preparing' => 'قيد التحضير',
        'ready' => 'جاهز',
        'served' => 'تم التقديم',
        'completed' => 'مكتمل',
        'cancelled' => 'ملغي',
    ],

    // طرق الدفع
    'payment_methods' => [
        'cash' => 'نقداً',
        'credit_card' => 'بطاقة ائتمان',
        'debit_card' => 'بطاقة خصم',
        'bank_transfer' => 'تحويل بنكي',
        'online' => 'دفع إلكتروني',
    ],

    // حالة الدفع
    'payment_statuses' => [
        'paid' => 'مدفوع',
        'unpaid' => 'غير مدفوع',
        'partial' => 'مدفوع جزئياً',
        'refunded' => 'مسترد',
    ],

    // الإجراءات
    'add_new_order' => 'إضافة طلب جديد',
    'edit_order_info' => 'تعديل معلومات الطلب',
    'delete_order_confirm' => 'هل أنت متأكد من حذف هذا الطلب؟',
    'view_order_details' => 'عرض تفاصيل الطلب',
    'print_order' => 'طباعة الطلب',
    'send_to_kitchen' => 'إرسال للمطبخ',
    'mark_as_ready' => 'تحديد كجاهز',
    'mark_as_served' => 'تحديد كمقدم',
    'mark_as_paid' => 'تحديد كمدفوع',
    'add_meal' => 'إضافة وجبة',
    'remove_meal' => 'إزالة وجبة',

    // الرسائل
    'order_created' => 'تم إنشاء الطلب بنجاح.',
    'order_updated' => 'تم تحديث الطلب بنجاح.',
    'order_deleted' => 'تم حذف الطلب بنجاح.',
    'order_cancelled' => 'تم إلغاء الطلب بنجاح.',
    'order_creation_failed' => 'فشل في إنشاء الطلب',
    'order_not_found' => 'الطلب غير موجود.',
    'no_orders_found' => 'لم يتم العثور على طلبات.',
    'no_items_selected' => 'يرجى اختيار عنصر واحد على الأقل للطلب.',
    'order_sent_to_kitchen' => 'تم إرسال الطلب للمطبخ.',
    'order_marked_ready' => 'تم تحديد الطلب كجاهز.',
    'order_marked_served' => 'تم تحديد الطلب كمقدم.',
    'payment_recorded' => 'تم تسجيل الدفع بنجاح.',

    // التحقق
    'client_required' => 'العميل مطلوب.',
    'table_number_required' => 'رقم الطاولة مطلوب.',
    'meals_required' => 'وجبة واحدة على الأقل مطلوبة.',
    'quantity_required' => 'كمية الوجبة مطلوبة.',
    'quantity_numeric' => 'كمية الوجبة يجب أن تكون رقماً.',
    'payment_method_required' => 'طريقة الدفع مطلوبة.',
    'order_date_required' => 'تاريخ الطلب مطلوب.',

    // الإحصائيات
    'total_orders' => 'إجمالي الطلبات',
    'pending_orders' => 'الطلبات المعلقة',
    'completed_orders' => 'الطلبات المكتملة',
    'cancelled_orders' => 'الطلبات الملغية',
    'orders_today' => 'طلبات اليوم',
    'orders_this_week' => 'طلبات هذا الأسبوع',
    'orders_this_month' => 'طلبات هذا الشهر',
    'average_order_value' => 'متوسط قيمة الطلب',
    'popular_meals' => 'الوجبات الشائعة',
    'peak_hours' => 'ساعات الذروة',

    // المرشحات
    'filter_by_status' => 'تصفية حسب الحالة',
    'filter_by_date_range' => 'تصفية حسب نطاق التاريخ',
    'filter_by_payment_status' => 'تصفية حسب حالة الدفع',
    'filter_by_table' => 'تصفية حسب الطاولة',
    'filter_by_waiter' => 'تصفية حسب النادل',
    'search_orders' => 'البحث في الطلبات',
    'search_by_number' => 'البحث برقم الطلب',

    // رؤوس الجدول
    'table' => [
        'id' => 'المعرف',
        'order_number' => 'رقم الطلب',
        'client' => 'العميل',
        'table_number' => 'الطاولة',
        'order_date' => 'تاريخ الطلب',
        'total_amount' => 'المبلغ الإجمالي',
        'payment_status' => 'حالة الدفع',
        'order_status' => 'حالة الطلب',
        'waiter' => 'النادل',
        'actions' => 'الإجراءات',
    ],

    // تسميات النموذج
    'form' => [
        'order_information' => 'معلومات الطلب',
        'client_information' => 'معلومات العميل',
        'meals_services' => 'الوجبات والخدمات',
        'payment_information' => 'معلومات الدفع',
        'additional_information' => 'معلومات إضافية',
        'select_client' => 'اختر العميل',
        'select_meal' => 'اختر الوجبة',
        'add_new_client' => 'إضافة عميل جديد',
    ],

    // المطبخ
    'kitchen' => [
        'kitchen_orders' => 'طلبات المطبخ',
        'new_orders' => 'طلبات جديدة',
        'in_preparation' => 'قيد التحضير',
        'ready_orders' => 'طلبات جاهزة',
        'order_received' => 'تم استلام الطلب',
        'start_preparation' => 'بدء التحضير',
        'mark_ready' => 'تحديد كجاهز',
        'preparation_time' => 'وقت التحضير',
        'estimated_time' => 'الوقت المقدر',
    ],

    // النصوص التوضيحية
    'placeholders' => [
        'select_client' => 'اختر عميلاً',
        'select_meal' => 'اختر وجبة',
        'enter_quantity' => 'أدخل الكمية',
        'enter_table_number' => 'أدخل رقم الطاولة',
        'enter_notes' => 'أدخل ملاحظات',
        'search_orders' => 'البحث في الطلبات...',
    ],
];
