<?php

return [
    'main' => [
        [
            'key' => 'dashboard',
            'icon' => 'element-11',
            'route' => 'dashboard',
            'children' => [
                ['key' => 'init', 'route' => 'dashboard'],
                ['key' => 'admin', 'route' => 'dashboard'],
                ['key' => 'auditor', 'route' => 'dashboard'],
                ['key' => 'billingOperator', 'route' => 'dashboard'],
                ['key' => 'customerManager', 'route' => 'dashboard'],
                ['key' => 'dataManager', 'route' => 'dashboard'],
                ['key' => 'developer', 'route' => 'dashboard'],
                ['key' => 'financialManager', 'route' => 'dashboard'],
                ['key' => 'productManager', 'route' => 'dashboard'],
                ['key' => 'superAdmin', 'route' => 'dashboard'],
                ['key' => 'support', 'route' => 'dashboard'],
            ],
        ],
        [
            'key' => 'customers',
            'icon' => 'users',
            'route' => 'dashboard',
            'children' => [
                ['key' => 'list', 'route' => 'dashboard'],
                ['key' => 'add', 'route' => 'dashboard'],
                ['key' => 'manage', 'route' => 'dashboard'],
            ],
        ],
        [
            'key' => 'invoicesAndCharges',
            'icon' => 'receipt',
            'route' => 'dashboard',
            'children' => [
                ['key' => 'listInvoices', 'route' => 'dashboard'],
                ['key' => 'issueInvoice', 'route' => 'dashboard'],
                ['key' => 'pendingInvoices', 'route' => 'dashboard'],
                ['key' => 'canceledInvoices', 'route' => 'dashboard'],
                ['key' => 'manualCharges', 'route' => 'dashboard'],
            ],
        ],
        [
            'key' => 'productsAndPlans',
            'icon' => 'box',
            'route' => 'dashboard',
            'children' => [
                ['key' => 'listProducts', 'route' => 'dashboard'],
                ['key' => 'addProduct', 'route' => 'dashboard'],
                ['key' => 'managePlans', 'route' => 'dashboard'],
                ['key' => 'addPlan', 'route' => 'dashboard'],
            ],
        ],
        [
            'key' => 'reports',
            'icon' => 'chart-line',
            'route' => 'dashboard',
            'children' => [
                ['key' => 'financial', 'route' => 'dashboard'],
                ['key' => 'customers', 'route' => 'dashboard'],
                ['key' => 'subscriptions', 'route' => 'dashboard'],
                ['key' => 'export', 'route' => 'dashboard'],
            ],
        ],
        [
            'key' => 'integrations',
            'icon' => 'plug',
            'route' => 'dashboard',
            'children' => [
                ['key' => 'manageWebhooks', 'route' => 'dashboard'],
                ['key' => 'webhookLogs', 'route' => 'dashboard'],
                ['key' => 'configureApiKeys', 'route' => 'dashboard'],
                ['key' => 'viewApiDocs', 'route' => 'dashboard'],
            ],
        ],
        [
            'key' => 'settings',
            'icon' => 'settings',
            'route' => 'dashboard',
            'children' => [
                ['key' => 'general', 'route' => 'dashboard'],
                ['key' => 'customization', 'route' => 'dashboard'],
                ['key' => 'regional', 'route' => 'dashboard'],
                ['key' => 'systemLogs', 'route' => 'dashboard'],
                ['key' => 'notifications', 'route' => 'dashboard'],
            ],
        ],
        [
            'key' => 'usersAndPermissions',
            'icon' => 'users-cog',
            'route' => 'dashboard',
            'children' => [
                ['key' => 'listUsers', 'route' => 'dashboard'],
                ['key' => 'addUser', 'route' => 'dashboard'],
                ['key' => 'managePermissions', 'route' => 'dashboard'],
            ],
        ],
        [
            'key' => 'support',
            'icon' => 'headset',
            'route' => 'dashboard',
            'children' => [
                ['key' => 'openTicket', 'route' => 'dashboard'],
                ['key' => 'viewTickets', 'route' => 'dashboard'],
                ['key' => 'documentation', 'route' => 'dashboard'],
            ],
        ],
    ],
];
