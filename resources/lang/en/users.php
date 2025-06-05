<?php

return [
    // General
    'users' => 'Users',
    'user' => 'User',
    'manage_users' => 'Manage Users',
    'all_users' => 'All Users',
    'add_new_user' => 'Add New User',
    'add_user' => 'Add User',
    'create_user' => 'Create User',
    'edit_user' => 'Edit User',
    'update_user' => 'Update User',
    'delete_user' => 'Delete User',
    'view_user' => 'View User',
    'user_profile' => 'User Profile',

    // Form Fields
    'name' => 'Name',
    'email' => 'Email',
    'password' => 'Password',
    'confirm_password' => 'Confirm Password',
    'role' => 'Role',
    'status' => 'Status',
    'phone' => 'Phone',
    'address' => 'Address',
    'profile_picture' => 'Profile Picture',

    // Table Headers
    'table' => [
        'id' => 'ID',
        'name' => 'Name',
        'email' => 'Email',
        'role' => 'Role',
        'status' => 'Status',
        'created' => 'Created',
        'actions' => 'Actions',
        'last_login' => 'Last Login',
        'phone' => 'Phone',
    ],

    // Roles
    'roles' => [
        'owner' => 'Owner',
        'employee' => 'Employee',
        'admin' => 'Administrator',
        'manager' => 'Manager',
        'staff' => 'Staff',
    ],

    // Status
    'statuses' => [
        'active' => 'Active',
        'inactive' => 'Inactive',
        'suspended' => 'Suspended',
        'pending' => 'Pending',
    ],

    // Messages
    'user_created' => 'User has been created successfully.',
    'user_updated' => 'User has been updated successfully.',
    'user_deleted' => 'User has been deleted successfully.',
    'user_not_found' => 'User not found.',
    'no_users_found' => 'No users found',
    'start_by_adding' => 'Start by adding your first user.',
    'delete_user_confirm' => 'Are you sure you want to delete this user?',
    'cannot_delete_self' => 'You cannot delete your own account.',
    'password_updated' => 'Password has been updated successfully.',

    // Placeholders
    'placeholders' => [
        'enter_name' => 'Enter user name',
        'enter_email' => 'Enter email address',
        'enter_password' => 'Enter password',
        'confirm_password' => 'Confirm password',
        'enter_phone' => 'Enter phone number',
        'enter_address' => 'Enter address',
        'select_role' => 'Select role',
        'select_status' => 'Select status',
    ],

    // Validation
    'validation' => [
        'name_required' => 'Name is required.',
        'email_required' => 'Email is required.',
        'email_unique' => 'This email is already taken.',
        'password_required' => 'Password is required.',
        'password_min' => 'Password must be at least 8 characters.',
        'password_confirmed' => 'Password confirmation does not match.',
        'role_required' => 'Role is required.',
        'phone_unique' => 'This phone number is already taken.',
    ],

    // Permissions
    'permissions' => [
        'view_users' => 'View Users',
        'create_users' => 'Create Users',
        'edit_users' => 'Edit Users',
        'delete_users' => 'Delete Users',
        'manage_roles' => 'Manage Roles',
    ],

    // Profile
    'profile' => [
        'my_profile' => 'My Profile',
        'edit_profile' => 'Edit Profile',
        'change_password' => 'Change Password',
        'current_password' => 'Current Password',
        'new_password' => 'New Password',
        'profile_updated' => 'Profile updated successfully.',
        'avatar' => 'Avatar',
        'personal_info' => 'Personal Information',
        'account_settings' => 'Account Settings',
    ],

    // Activity
    'activity' => [
        'last_activity' => 'Last Activity',
        'login_history' => 'Login History',
        'activity_log' => 'Activity Log',
        'never_logged_in' => 'Never logged in',
        'online' => 'Online',
        'offline' => 'Offline',
    ],
];
