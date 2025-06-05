<?php

return [
    // General
    'orders' => 'Orders',
    'order' => 'Order',
    'order_management' => 'Order Management',
    'order_list' => 'Order List',
    'order_details' => 'Order Details',
    'add_order' => 'Add Order',
    'edit_order' => 'Edit Order',
    'create_order' => 'Create Order',
    'update_order' => 'Update Order',
    'delete_order' => 'Delete Order',
    'view_order' => 'View Order',
    'order_information' => 'Order Information',
    'order_history' => 'Order History',
    'order_statistics' => 'Order Statistics',

    // Fields
    'order_number' => 'Order Number',
    'order_date' => 'Order Date',
    'client' => 'Client',
    'client_name' => 'Client Name',
    'table_number' => 'Table Number',
    'meals' => 'Meals',
    'quantity' => 'Quantity',
    'unit_price' => 'Unit Price',
    'total_amount' => 'Total Amount',
    'subtotal' => 'Subtotal',
    'tax' => 'Tax',
    'discount' => 'Discount',
    'grand_total' => 'Grand Total',
    'payment_method' => 'Payment Method',
    'payment_status' => 'Payment Status',
    'payment_date' => 'Payment Date',
    'due_date' => 'Due Date',
    'notes' => 'Notes',
    'waiter' => 'Waiter',
    'kitchen_notes' => 'Kitchen Notes',
    'special_requests' => 'Special Requests',

    // Order Status
    'order_statuses' => [
        'pending' => 'Pending',
        'confirmed' => 'Confirmed',
        'preparing' => 'Preparing',
        'ready' => 'Ready',
        'served' => 'Served',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
    ],

    // Payment Methods
    'payment_methods' => [
        'cash' => 'Cash',
        'credit_card' => 'Credit Card',
        'debit_card' => 'Debit Card',
        'bank_transfer' => 'Bank Transfer',
        'online' => 'Online Payment',
    ],

    // Payment Status
    'payment_statuses' => [
        'paid' => 'Paid',
        'unpaid' => 'Unpaid',
        'partial' => 'Partially Paid',
        'refunded' => 'Refunded',
    ],

    // Actions
    'add_new_order' => 'Add New Order',
    'edit_order_info' => 'Edit Order Information',
    'delete_order_confirm' => 'Are you sure you want to delete this order?',
    'view_order_details' => 'View Order Details',
    'print_order' => 'Print Order',
    'send_to_kitchen' => 'Send to Kitchen',
    'mark_as_ready' => 'Mark as Ready',
    'mark_as_served' => 'Mark as Served',
    'mark_as_paid' => 'Mark as Paid',
    'add_meal' => 'Add Meal',
    'remove_meal' => 'Remove Meal',

    // Messages
    'order_created' => 'Order has been created successfully.',
    'order_updated' => 'Order has been updated successfully.',
    'order_deleted' => 'Order has been deleted successfully.',
    'order_cancelled' => 'Order has been cancelled successfully.',
    'order_creation_failed' => 'Failed to create order',
    'order_not_found' => 'Order not found.',
    'no_orders_found' => 'No orders found.',
    'no_items_selected' => 'Please select at least one item for the order.',
    'order_sent_to_kitchen' => 'Order has been sent to kitchen.',
    'order_marked_ready' => 'Order has been marked as ready.',
    'order_marked_served' => 'Order has been marked as served.',
    'payment_recorded' => 'Payment has been recorded successfully.',

    // Validation
    'client_required' => 'Client is required.',
    'table_number_required' => 'Table number is required.',
    'meals_required' => 'At least one meal is required.',
    'quantity_required' => 'Meal quantity is required.',
    'quantity_numeric' => 'Meal quantity must be a number.',
    'payment_method_required' => 'Payment method is required.',
    'order_date_required' => 'Order date is required.',

    // Statistics
    'total_orders' => 'Total Orders',
    'pending_orders' => 'Pending Orders',
    'completed_orders' => 'Completed Orders',
    'cancelled_orders' => 'Cancelled Orders',
    'orders_today' => 'Orders Today',
    'orders_this_week' => 'Orders This Week',
    'orders_this_month' => 'Orders This Month',
    'average_order_value' => 'Average Order Value',
    'popular_meals' => 'Popular Meals',
    'peak_hours' => 'Peak Hours',

    // Filters
    'filter_by_status' => 'Filter by Status',
    'filter_by_date_range' => 'Filter by Date Range',
    'filter_by_payment_status' => 'Filter by Payment Status',
    'filter_by_table' => 'Filter by Table',
    'filter_by_waiter' => 'Filter by Waiter',
    'search_orders' => 'Search Orders',
    'search_by_number' => 'Search by order number',

    // Table Headers
    'table' => [
        'id' => 'ID',
        'order_number' => 'Order #',
        'client' => 'Client',
        'table_number' => 'Table',
        'order_date' => 'Order Date',
        'total_amount' => 'Total Amount',
        'payment_status' => 'Payment Status',
        'order_status' => 'Order Status',
        'waiter' => 'Waiter',
        'actions' => 'Actions',
    ],

    // Form Labels
    'form' => [
        'order_information' => 'Order Information',
        'client_information' => 'Client Information',
        'meals_services' => 'Meals & Services',
        'payment_information' => 'Payment Information',
        'additional_information' => 'Additional Information',
        'select_client' => 'Select Client',
        'select_meal' => 'Select Meal',
        'add_new_client' => 'Add New Client',
    ],

    // Kitchen
    'kitchen' => [
        'kitchen_orders' => 'Kitchen Orders',
        'new_orders' => 'New Orders',
        'in_preparation' => 'In Preparation',
        'ready_orders' => 'Ready Orders',
        'order_received' => 'Order Received',
        'start_preparation' => 'Start Preparation',
        'mark_ready' => 'Mark Ready',
        'preparation_time' => 'Preparation Time',
        'estimated_time' => 'Estimated Time',
    ],

    // Placeholders
    'placeholders' => [
        'select_client' => 'Select a client',
        'select_meal' => 'Select a meal',
        'enter_quantity' => 'Enter quantity',
        'enter_table_number' => 'Enter table number',
        'enter_notes' => 'Enter notes',
        'search_orders' => 'Search orders...',
    ],
];
