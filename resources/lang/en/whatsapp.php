<?php

return [
    // General
    'whatsapp' => 'WhatsApp',
    'send_whatsapp' => 'Send WhatsApp',
    'whatsapp_message' => 'WhatsApp Message',
    'whatsapp_marketing' => 'WhatsApp Marketing',
    'whatsapp_notifications' => 'WhatsApp Notifications',
    'whatsapp_phone' => 'WhatsApp Phone',
    'enable_whatsapp' => 'Enable WhatsApp',
    'disable_whatsapp' => 'Disable WhatsApp',

    // Welcome Messages
    'welcome' => [
        'greeting' => 'Hello :name! 👋',
        'message' => 'Welcome to :restaurant! We\'re delighted to have you as our valued customer.',
        'features' => 'Here\'s what you can expect from us:',
        'feature_1' => 'Fresh and delicious meals prepared with love',
        'feature_2' => 'Fast and reliable service',
        'feature_3' => 'Special offers and promotions just for you',
        'closing' => 'Thank you for choosing us!',
        'signature' => 'Best regards,\n:restaurant Team'
    ],

    // Order Confirmation
    'order_confirmation' => [
        'greeting' => 'Hello :name! 👋',
        'confirmed' => 'Your order has been confirmed! ✅',
        'order_details' => 'Order Details',
        'order_number' => 'Order Number',
        'order_date' => 'Order Date',
        'table_number' => 'Table Number',
        'items' => 'Items',
        'total' => 'Total',
        'estimated_time' => 'Estimated Ready Time',
        'thank_you' => 'Thank you for your order! We\'ll notify you when it\'s ready.',
        'signature' => 'Best regards,\n:restaurant Team'
    ],

    // Marketing Messages
    'marketing' => [
        'greeting' => 'Hello :name! 👋',
        'default_subject' => 'Special Offer Just for You!',
        'recommendations' => 'Recommended for You',
        'special_offers' => 'Special Offers',
        'contact_us' => 'Contact us for more information or to place an order.',
        'visit_us' => 'Visit us today and enjoy our delicious meals!',
        'signature' => 'Best regards,\n:restaurant Team'
    ],

    // Messages
    'messages' => [
        'welcome_sent' => 'Welcome message sent successfully!',
        'marketing_sent' => 'Marketing messages sent successfully to :success out of :total clients.',
        'order_confirmation_sent' => 'Order confirmation sent successfully!',
        'message_sent' => 'WhatsApp message sent successfully!',
        'messages_queued' => 'Messages have been queued for sending.',
    ],

    // Errors
    'errors' => [
        'service_disabled' => 'WhatsApp service is currently disabled.',
        'no_whatsapp_number' => 'Client does not have a WhatsApp number or notifications disabled.',
        'invalid_phone' => 'Invalid phone number format.',
        'send_failed' => 'Failed to send WhatsApp message.',
        'connection_failed' => 'Failed to connect to WhatsApp service.',
        'rate_limit' => 'Rate limit exceeded. Please try again later.',
        'template_not_found' => 'WhatsApp template not found.',
        'insufficient_balance' => 'Insufficient account balance.',
    ],

    // Test Messages
    'test' => [
        'message' => 'This is a test message from :app. WhatsApp integration is working correctly! ✅',
        'success' => 'Test message sent successfully!',
        'failed' => 'Test message failed to send.',
    ],

    // Status
    'status' => [
        'enabled' => 'Enabled',
        'disabled' => 'Disabled',
        'connected' => 'Connected',
        'disconnected' => 'Disconnected',
        'configured' => 'Configured',
        'not_configured' => 'Not Configured',
    ],

    // Settings
    'settings' => [
        'whatsapp_settings' => 'WhatsApp Settings',
        'api_configuration' => 'API Configuration',
        'twilio_sid' => 'Twilio Account SID',
        'twilio_token' => 'Twilio Auth Token',
        'whatsapp_number' => 'WhatsApp Business Number',
        'enable_service' => 'Enable WhatsApp Service',
        'test_connection' => 'Test Connection',
        'save_settings' => 'Save Settings',
        'settings_saved' => 'WhatsApp settings saved successfully!',
        'twilio_sid_help' => 'Your Twilio Account SID from the Twilio Console',
        'twilio_token_help' => 'Your Twilio Auth Token from the Twilio Console',
        'whatsapp_number_help' => 'Your WhatsApp Business number in format: whatsapp:+1234567890',
        'test_connection_help' => 'Send a test message to verify your WhatsApp configuration',
    ],

    // Templates
    'templates' => [
        'welcome_template' => 'Welcome Template',
        'order_confirmation_template' => 'Order Confirmation Template',
        'marketing_template' => 'Marketing Template',
        'custom_template' => 'Custom Template',
        'template_variables' => 'Available Variables',
        'client_name' => 'Client Name',
        'restaurant_name' => 'Restaurant Name',
        'order_details' => 'Order Details',
        'total_amount' => 'Total Amount',
    ],

    // Buttons
    'buttons' => [
        'send_welcome' => 'Send Welcome',
        'send_marketing' => 'Send Marketing',
        'send_message' => 'Send Message',
        'test_whatsapp' => 'Test WhatsApp',
        'configure_whatsapp' => 'Configure WhatsApp',
        'view_templates' => 'View Templates',
        'send_to_selected' => 'Send to Selected',
        'send_to_all' => 'Send to All',
    ],

    // Form Labels
    'form' => [
        'select_clients' => 'Select Clients',
        'message_content' => 'Message Content',
        'subject' => 'Subject',
        'phone_number' => 'Phone Number',
        'send_method' => 'Send Method',
        'email_only' => 'Email Only',
        'whatsapp_only' => 'WhatsApp Only',
        'both' => 'Both Email & WhatsApp',
        'media_url' => 'Media URL (Optional)',
        'custom_message' => 'Custom Message',
    ],

    // Validation
    'validation' => [
        'phone_required' => 'Phone number is required.',
        'phone_invalid' => 'Phone number format is invalid.',
        'content_required' => 'Message content is required.',
        'clients_required' => 'Please select at least one client.',
        'send_method_required' => 'Please select a send method.',
    ],

    // Statistics
    'stats' => [
        'title' => 'WhatsApp Statistics',
        'total_sent' => 'Total Messages Sent',
        'success_rate' => 'Success Rate',
        'failed_messages' => 'Failed Messages',
        'pending_messages' => 'Pending Messages',
        'clients_with_whatsapp' => 'Clients with WhatsApp',
        'whatsapp_enabled_clients' => 'WhatsApp Enabled Clients',
        'total_clients' => 'Total Clients',
    ],
];
