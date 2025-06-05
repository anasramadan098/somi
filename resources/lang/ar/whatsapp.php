<?php

return [
    // عام
    'whatsapp' => 'واتساب',
    'send_whatsapp' => 'إرسال واتساب',
    'whatsapp_message' => 'رسالة واتساب',
    'whatsapp_marketing' => 'تسويق واتساب',
    'whatsapp_notifications' => 'إشعارات واتساب',
    'whatsapp_phone' => 'رقم واتساب',
    'enable_whatsapp' => 'تفعيل واتساب',
    'disable_whatsapp' => 'إلغاء تفعيل واتساب',

    // رسائل الترحيب
    'welcome' => [
        'greeting' => 'مرحباً :name! 👋',
        'message' => 'أهلاً وسهلاً بك في :restaurant! نحن سعداء لوجودك كعميل عزيز لدينا.',
        'features' => 'إليك ما يمكنك توقعه منا:',
        'feature_1' => 'وجبات طازجة ولذيذة محضرة بحب',
        'feature_2' => 'خدمة سريعة وموثوقة',
        'feature_3' => 'عروض وخصومات خاصة لك',
        'closing' => 'شكراً لاختيارك لنا!',
        'signature' => 'مع أطيب التحيات،\nفريق :restaurant'
    ],

    // تأكيد الطلب
    'order_confirmation' => [
        'greeting' => 'مرحباً :name! 👋',
        'confirmed' => 'تم تأكيد طلبك! ✅',
        'order_details' => 'تفاصيل الطلب',
        'order_number' => 'رقم الطلب',
        'order_date' => 'تاريخ الطلب',
        'table_number' => 'رقم الطاولة',
        'items' => 'العناصر',
        'total' => 'الإجمالي',
        'estimated_time' => 'الوقت المقدر للجاهزية',
        'thank_you' => 'شكراً لطلبك! سنقوم بإشعارك عندما يصبح جاهزاً.',
        'signature' => 'مع أطيب التحيات،\nفريق :restaurant'
    ],

    // الرسائل التسويقية
    'marketing' => [
        'greeting' => 'مرحباً :name! 👋',
        'default_subject' => 'عرض خاص لك فقط!',
        'recommendations' => 'مُوصى لك',
        'special_offers' => 'العروض الخاصة',
        'contact_us' => 'تواصل معنا للمزيد من المعلومات أو لتقديم طلب.',
        'visit_us' => 'زرنا اليوم واستمتع بوجباتنا اللذيذة!',
        'signature' => 'مع أطيب التحيات،\nفريق :restaurant'
    ],

    // الرسائل
    'messages' => [
        'welcome_sent' => 'تم إرسال رسالة الترحيب بنجاح!',
        'marketing_sent' => 'تم إرسال الرسائل التسويقية بنجاح إلى :success من أصل :total عميل.',
        'order_confirmation_sent' => 'تم إرسال تأكيد الطلب بنجاح!',
        'message_sent' => 'تم إرسال رسالة واتساب بنجاح!',
        'messages_queued' => 'تم وضع الرسائل في قائمة الانتظار للإرسال.',
    ],

    // الأخطاء
    'errors' => [
        'service_disabled' => 'خدمة واتساب معطلة حالياً.',
        'no_whatsapp_number' => 'العميل لا يملك رقم واتساب أو الإشعارات معطلة.',
        'invalid_phone' => 'تنسيق رقم الهاتف غير صحيح.',
        'send_failed' => 'فشل في إرسال رسالة واتساب.',
        'connection_failed' => 'فشل في الاتصال بخدمة واتساب.',
        'rate_limit' => 'تم تجاوز حد المعدل. يرجى المحاولة مرة أخرى لاحقاً.',
        'template_not_found' => 'قالب واتساب غير موجود.',
        'insufficient_balance' => 'رصيد الحساب غير كافي.',
    ],

    // رسائل الاختبار
    'test' => [
        'message' => 'هذه رسالة اختبار من :app. تكامل واتساب يعمل بشكل صحيح! ✅',
        'success' => 'تم إرسال رسالة الاختبار بنجاح!',
        'failed' => 'فشل في إرسال رسالة الاختبار.',
    ],

    // الحالة
    'status' => [
        'enabled' => 'مُفعل',
        'disabled' => 'معطل',
        'connected' => 'متصل',
        'disconnected' => 'غير متصل',
        'configured' => 'مُكوّن',
        'not_configured' => 'غير مُكوّن',
    ],

    // الإعدادات
    'settings' => [
        'whatsapp_settings' => 'إعدادات واتساب',
        'api_configuration' => 'تكوين API',
        'twilio_sid' => 'معرف حساب Twilio',
        'twilio_token' => 'رمز مصادقة Twilio',
        'whatsapp_number' => 'رقم واتساب الأعمال',
        'enable_service' => 'تفعيل خدمة واتساب',
        'test_connection' => 'اختبار الاتصال',
        'save_settings' => 'حفظ الإعدادات',
        'settings_saved' => 'تم حفظ إعدادات واتساب بنجاح!',
        'twilio_sid_help' => 'معرف حساب Twilio الخاص بك من وحة تحكم Twilio',
        'twilio_token_help' => 'رمز مصادقة Twilio الخاص بك من لوحة تحكم Twilio',
        'whatsapp_number_help' => 'رقم واتساب الأعمال الخاص بك بالتنسيق: whatsapp:+1234567890',
        'test_connection_help' => 'إرسال رسالة اختبار للتحقق من تكوين واتساب',
    ],

    // القوالب
    'templates' => [
        'welcome_template' => 'قالب الترحيب',
        'order_confirmation_template' => 'قالب تأكيد الطلب',
        'marketing_template' => 'قالب التسويق',
        'custom_template' => 'قالب مخصص',
        'template_variables' => 'المتغيرات المتاحة',
        'client_name' => 'اسم العميل',
        'restaurant_name' => 'اسم المطعم',
        'order_details' => 'تفاصيل الطلب',
        'total_amount' => 'المبلغ الإجمالي',
    ],

    // الأزرار
    'buttons' => [
        'send_welcome' => 'إرسال ترحيب',
        'send_marketing' => 'إرسال تسويقي',
        'send_message' => 'إرسال رسالة',
        'test_whatsapp' => 'اختبار واتساب',
        'configure_whatsapp' => 'تكوين واتساب',
        'view_templates' => 'عرض القوالب',
        'send_to_selected' => 'إرسال للمحددين',
        'send_to_all' => 'إرسال للجميع',
    ],

    // تسميات النموذج
    'form' => [
        'select_clients' => 'اختر العملاء',
        'message_content' => 'محتوى الرسالة',
        'subject' => 'الموضوع',
        'phone_number' => 'رقم الهاتف',
        'send_method' => 'طريقة الإرسال',
        'email_only' => 'إيميل فقط',
        'whatsapp_only' => 'واتساب فقط',
        'both' => 'كلاهما (إيميل وواتساب)',
        'media_url' => 'رابط الوسائط (اختياري)',
        'custom_message' => 'رسالة مخصصة',
    ],

    // التحقق
    'validation' => [
        'phone_required' => 'رقم الهاتف مطلوب.',
        'phone_invalid' => 'تنسيق رقم الهاتف غير صحيح.',
        'content_required' => 'محتوى الرسالة مطلوب.',
        'clients_required' => 'يرجى اختيار عميل واحد على الأقل.',
        'send_method_required' => 'يرجى اختيار طريقة الإرسال.',
    ],

    // الإحصائيات
    'stats' => [
        'title' => 'إحصائيات واتساب',
        'total_sent' => 'إجمالي الرسائل المرسلة',
        'success_rate' => 'معدل النجاح',
        'failed_messages' => 'الرسائل الفاشلة',
        'pending_messages' => 'الرسائل المعلقة',
        'clients_with_whatsapp' => 'العملاء مع واتساب',
        'whatsapp_enabled_clients' => 'العملاء المفعلين لواتساب',
        'total_clients' => 'إجمالي العملاء',
    ],
];
