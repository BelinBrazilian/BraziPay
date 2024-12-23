<?php

return [
    'main' => [
        [
            'key' => 'dashboard',
            'icon' => 'element-11',
            'route' => 'dashboard',
            'children' => [
                ['key' => 'init', 'route' => 'dashboard'],
                ['key' => 'admin', 'route' => 'dashboard'], // TODO: Ajustar rota específica se necessário
                ['key' => 'auditor', 'route' => 'dashboard'], // TODO: Ajustar rota específica se necessário
                ['key' => 'billingOperator', 'route' => 'dashboard'], // TODO: Ajustar rota específica se necessário
                ['key' => 'customerManager', 'route' => 'dashboard'], // TODO: Ajustar rota específica se necessário
                ['key' => 'dataManager', 'route' => 'dashboard'], // TODO: Ajustar rota específica se necessário
                ['key' => 'developer', 'route' => 'dashboard'], // TODO: Ajustar rota específica se necessário
                ['key' => 'financialManager', 'route' => 'dashboard'], // TODO: Ajustar rota específica se necessário
                ['key' => 'productManager', 'route' => 'dashboard'], // TODO: Ajustar rota específica se necessário
                ['key' => 'superAdmin', 'route' => 'dashboard'], // TODO: Ajustar rota específica se necessário
                ['key' => 'support', 'route' => 'dashboard'], // TODO: Ajustar rota específica se necessário
            ],
        ],
        [
            'key' => 'customers',
            'icon' => 'users',
            'route' => 'customers.index',
            'children' => [
                ['key' => 'list', 'route' => 'customers.index'],
                ['key' => 'add', 'route' => 'dashboard'], // TODO: Adicionar rota para criar cliente
//                ['key' => 'manage', 'route' => 'customers.unarchive'], // Restaurar clientes arquivados
            ],
        ],
        [
            'key' => 'invoicesAndCharges',
            'icon' => 'receipt',
            'route' => 'invoices.index',
            'children' => [
                ['key' => 'listInvoices', 'route' => 'invoices.index'],
                ['key' => 'issueInvoice', 'route' => 'dashboard'], // TODO: Adicionar rota para emissão de fatura
                ['key' => 'pendingInvoices', 'route' => 'dashboard'], // TODO: Adicionar rota para faturas pendentes
                ['key' => 'canceledInvoices', 'route' => 'dashboard'], // TODO: Adicionar rota para faturas canceladas
//                ['key' => 'manualCharges', 'route' => 'charges.capture'], // Captura de cobrança manual
            ],
        ],
        [
            'key' => 'productsAndPlans',
            'icon' => 'box',
            'route' => 'plans.index',
            'children' => [
                ['key' => 'listProducts', 'route' => 'dashboard'], // TODO: Adicionar rota de listagem de produtos
                ['key' => 'addProduct', 'route' => 'dashboard'], // TODO: Adicionar rota para criar produto
                ['key' => 'managePlans', 'route' => 'plans.index'],
                ['key' => 'addPlan', 'route' => 'dashboard'], // TODO: Adicionar rota para criar plano
            ],
        ],
        [
            'key' => 'reports',
            'icon' => 'chart-line',
            'route' => 'export_batches.index',
            'children' => [
                ['key' => 'financial', 'route' => 'dashboard'], // TODO: Adicionar rota para relatórios financeiros
                ['key' => 'customers', 'route' => 'dashboard'], // TODO: Adicionar rota para relatórios de clientes
                ['key' => 'subscriptions', 'route' => 'dashboard'], // TODO: Adicionar rota para relatórios de assinaturas
                ['key' => 'export', 'route' => 'export_batches.index'], // Exportação de relatórios
            ],
        ],
        [
            'key' => 'integrations',
            'icon' => 'plug',
            'route' => 'dashboard', // TODO: Adicionar rota base para integrações
            'children' => [
                ['key' => 'manageWebhooks', 'route' => 'dashboard'], // TODO: Adicionar rota para gerenciar webhooks
                ['key' => 'webhookLogs', 'route' => 'dashboard'], // TODO: Adicionar rota para logs de webhooks
                ['key' => 'configureApiKeys', 'route' => 'dashboard'], // TODO: Adicionar rota para configurar chaves API
                ['key' => 'viewApiDocs', 'route' => 'dashboard'], // TODO: Adicionar rota para documentação da API
            ],
        ],
        [
            'key' => 'settings',
            'icon' => 'settings',
            'route' => 'roles.index',
            'children' => [
                ['key' => 'general', 'route' => 'dashboard'], // TODO: Adicionar rota para configurações gerais
                ['key' => 'customization', 'route' => 'dashboard'], // TODO: Adicionar rota para customizações
                ['key' => 'regional', 'route' => 'dashboard'], // TODO: Adicionar rota para configurações regionais
                ['key' => 'systemLogs', 'route' => 'dashboard'], // TODO: Adicionar rota para logs do sistema
                ['key' => 'notifications', 'route' => 'notifications.index'], // Gerenciamento de notificações
            ],
        ],
        [
            'key' => 'usersAndPermissions',
            'icon' => 'users-cog',
            'route' => 'user-management.users.index',
            'children' => [
                ['key' => 'listUsers', 'route' => 'user-management.users.index'],
                ['key' => 'addUser', 'route' => 'dashboard'], // TODO: Adicionar rota para adicionar usuário
                ['key' => 'managePermissions', 'route' => 'user-management.permissions.index'], // Gerenciamento de permissões
            ],
        ],
        [
            'key' => 'support',
            'icon' => 'headset',
            'route' => 'issues.index',
            'children' => [
                ['key' => 'openTicket', 'route' => 'dashboard'], // TODO: Adicionar rota para abrir ticket
                ['key' => 'viewTickets', 'route' => 'issues.index'], // Visualizar tickets
                ['key' => 'documentation', 'route' => 'dashboard'], // TODO: Adicionar rota para documentação
            ],
        ],
    ],
];
