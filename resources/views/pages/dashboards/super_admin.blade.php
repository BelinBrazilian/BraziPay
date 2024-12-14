<?php
/*
 1. Administrador Geral
    - Análise de comportamento dos clientes (ex.: planos mais populares).
    - Assinaturas ativas, novas e canceladas.
    - Assinaturas criadas e canceladas no mês.
    - Assinaturas em atraso ou canceladas.
    - Assinaturas mais lucrativas.
    - Clientes mais recentes.
    - Faturas canceladas ou renegociadas.
    - Faturas pendentes e em atraso.
    - Faturas pendentes e vencidas.
    - Faturas próximas ao vencimento.
    - Gráfico de assinaturas por plano ou produto.
    - Gráfico de crescimento de clientes e receitas.
    - Gráficos de receita, assinaturas e clientes.
    - Histórico de alterações sensíveis (ex.: preços ou permissões).
    - Indicadores de churn rate (taxa de cancelamento).
    - Lista de clientes inadimplentes.
    - Links rápidos para acessar informações de clientes ou reenviar cobranças.
    - Links rápidos para acessar faturas pendentes ou entrar em contato com clientes.
    - Links rápidos para acessar relatórios ou auditorias detalhadas.
    - Links rápidos para criar novos clientes ou gerenciar assinaturas.
    - Links rápidos para criar Webhooks ou consultar a documentação da API.
    - Links rápidos para criar ou editar planos e produtos.
    - Links rápidos para emitir faturas ou acessar relatórios detalhados.
    - Links rápidos para gerenciar configurações, usuários e permissões.
    - Logs de atividades dos usuários.
    - Logs de Webhooks e integrações recentes.
    - Notificações críticas do sistema (ex.: falha de Webhooks, integrações).
    - Notificações de falhas em cobranças.
    - Notificações de falhas em integrações.
    - Notificações de mudanças no status de clientes (ex.: cliente inativo ou upgrade de plano).
    - Notificações de planos ou produtos inativos.
    - Novos clientes cadastrados.
    - Planos mais vendidos.
    - Receita líquida e bruta.
    - Receita projetada (MRR – Monthly Recurring Revenue).
    - Receita gerada por tipo de produto.
    - Receita total do mês.
    - Relatório básico de pagamentos (faturas pendentes ou vencidas).
    - Relatórios financeiros resumidos (gráficos de receita, inadimplência, lucro por produto).
    - Relatórios resumidos de conformidade (notas fiscais e pagamentos).
    - Status de Webhooks configurados (ativos/inativos).
    - Tarefas pendentes (cobranças manuais, renegociações).
    - Total de inadimplências.
    - Total de valores vencidos.
    - Últimos eventos de integração com APIs.
    - Últimos eventos do sistema (criação de usuários, atualizações de configurações).
 */
?>

<x-default-layout>

    @section('title')
        Dashboard
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('dashboard') }}
    @endsection

    {{-- begin::Row --}}
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        {{-- begin::Col --}}
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            @include('partials/widgets/cards/_widget-20')

            @include('partials/widgets/cards/_widget-7')
        </div>
        {{-- end::Col --}}
        {{-- begin::Col --}}
        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
            @include('partials/widgets/cards/_widget-17')

            @include('partials/widgets/lists/_widget-26')
        </div>
        {{-- end::Col --}}
        {{-- begin::Col --}}
        <div class="col-xxl-6">
            @include('partials/widgets/engage/_widget-10')
        </div>
        {{-- end::Col --}}
    </div>
    {{-- end::Row --}}

    {{-- begin::Row --}}
    <div class="row gx-5 gx-xl-10">
        {{-- begin::Col --}}
        <div class="col-xxl-6 mb-5 mb-xl-10">
            @include('partials/widgets/charts/_widget-8')
        </div>
        {{-- end::Col --}}
        {{-- begin::Col --}}
        <div class="col-xl-6 mb-5 mb-xl-10">
            @include('partials/widgets/tables/_widget-16')
        </div>
        {{-- end::Col --}}
    </div>
    {{-- end::Row --}}

    {{-- begin::Row --}}
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        {{-- begin::Col --}}
        <div class="col-xxl-6">
            @include('partials/widgets/cards/_widget-18')
        </div>
        {{-- end::Col --}}
        {{-- begin::Col --}}
        <div class="col-xl-6">
            @include('partials/widgets/charts/_widget-36')
        </div>
        {{-- end::Col --}}
    </div>
    {{-- end::Row --}}

    {{-- begin::Row --}}
    <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
        {{-- begin::Col --}}
        <div class="col-xl-4">
            @include('partials/widgets/charts/_widget-35')
        </div>
        {{-- end::Col --}}
        {{-- begin::Col --}}
        <div class="col-xl-8">
            @include('partials/widgets/tables/_widget-14')
        </div>
        {{-- end::Col --}}
    </div>
    {{-- end::Row --}}

    {{-- begin::Row --}}
    <div class="row gx-5 gx-xl-10">
        {{-- begin::Col --}}
        <div class="col-xl-4">
            @include('partials/widgets/charts/_widget-31')
        </div>
        {{-- end::Col --}}
        {{-- begin::Col --}}
        <div class="col-xl-8">
            @include('partials/widgets/charts/_widget-24')
        </div>
        {{-- end::Col --}}
    </div>
    {{-- end::Row --}}
</x-default-layout>
