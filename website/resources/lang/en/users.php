<?php

return [

    'title' => 'Users',
    'myprofile' => 'My Profile',
    'your_profile' => 'Your Profile',
    'edit.myprofile' => 'Edit my profile',
    'add' => 'Add User',
    'edit_user' => 'Edit user',
    'activation' => 'User Activation',
    'basic.information' => 'Basic information',
    'contact.information' => 'Contact information',
    'account.information' => 'Account information',
    //'roles' => 'Roles',
    'status' => 'Account status',
    'company' => 'Company',
    'export_csv' => 'Export CSV',
    'phone' => [
        'label' => 'Phone'
    ],
    'user_status' => 'User status',
    'address' => [
        'label' => 'Address'
    ],
    'city' => [
        'label' => 'City',
    ],

    'status.enabled' => 'Enabled',
    'status.disabled' => 'Disabled',
    'country' => [
        'label' => 'Country',
        'required' => 'You need to select a country',
    ],
    'password' => [
        'label' => 'Password',
        'confirm' => 'Confirm password',
        'required' => 'Password is required',
        'between' => 'Password must be between 6 and 30 characters',
        'confirmed' => 'Passwords do not match',
        'new_password' => 'New Password',
        'confirm_new_password' => 'Confirm New Password'
    ],
    'success' => 'User updated successfully',
    'attached' => 'Attached document',
    'attached.file' => 'Currently attached document',
    'avatar' => 'User Avatar',
    'shipping_address' => 'Shipping address',
    'billing_address' => 'Billing address',

    // Validations
    'name' => [
      'label' => 'Name',
    ],
    'email' => [
        'label' => 'Email',
        'invalid' => 'Email is invalid',
        'required' => 'Email field is required',
        'unique' => 'Email has already been taken',
        'max' => 'Email can be a maximum of 255 chars',
    ],
    'username' => [
        'required' => 'Username field is required',
        'max' => 'Username can be a maximum of 255 chars',
        'min' => 'Username can be a minimum of 2 chars',
        ],
    'roles' => [
        'label' => 'Roles',
        'required' => 'A role is required',
        'exists' => 'Valid role is required',
        ],
    'first_name' => [
        'label' => 'First name',
        'required' => 'First name field is required',
        'max' => 'First name can be a maximum of 255 chars',
        'min' => 'First name can be a minimum of 2 chars',
        ],
    'last_name' =>  [
        'label' => 'Last name',
        'required' => 'Last name field is required',
        'max' => 'Last name can be a maximum of 255 chars',
        'min' => 'Last name can be a minimum of 2 chars',
        ],
    'file' => [
        'required' => 'You have to select a file',
        'max' => 'The file can me a maximum of 30MB',
        'mimes' => 'Only doc/docx/pdf/csv file formats are accepted',
        ],

];
