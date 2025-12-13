@extends('layouts.app')

@section('title', 'Introdução - GESTREIN')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <div class="mb-6">
                        <h1 class="text-3xl font-bold text-[#1a1f3a] mb-2">Bem-vindo ao GESTREIN</h1>
                        <p class="text-[#ff6b35] font-semibold">Sistema de Gestão de Treinamentos</p>
        </div>

        <div class="prose max-w-none">
            <p class="text-gray-700 leading-relaxed mb-4">
                Bem-vindo ao manual do sistema de gestão de treinamentos! Este sistema foi desenvolvido para otimizar 
                o gerenciamento de treinamentos corporativos, substituindo métodos manuais por uma solução moderna, 
                responsiva e intuitiva.
            </p>

            <h2 class="text-2xl font-semibold text-[#1a1f3a] mt-8 mb-4">Funcionalidades Principais</h2>
            
            <div class="grid md:grid-cols-2 gap-6 mt-6">
                <div class="p-4 border-l-4 border-[#3b82f6] bg-gray-50 rounded">
                    <h3 class="font-semibold text-[#1a1f3a] mb-2">Cadastro de Treinamentos</h3>
                    <p class="text-gray-600 text-sm">
                        Registre todos os treinamentos da empresa com informações detalhadas sobre carga horária, 
                        validade e categoria.
                    </p>
                </div>

                <div class="p-4 border-l-4 border-[#ff6b35] bg-gray-50 rounded">
                    <h3 class="font-semibold text-[#1a1f3a] mb-2">Gestão de Colaboradores</h3>
                    <p class="text-gray-600 text-sm">
                        Cadastre e gerencie os colaboradores da empresa, incluindo informações sobre função, 
                        setor e matrícula.
                    </p>
                </div>

                <div class="p-4 border-l-4 border-[#3b82f6] bg-gray-50 rounded">
                    <h3 class="font-semibold text-[#1a1f3a] mb-2">Registro de Participação</h3>
                    <p class="text-gray-600 text-sm">
                        Registre a participação dos colaboradores em treinamentos, incluindo presença e conclusão.
                    </p>
                </div>

                <div class="p-4 border-l-4 border-[#ff6b35] bg-gray-50 rounded">
                    <h3 class="font-semibold text-[#1a1f3a] mb-2">Relatórios e Alertas</h3>
                    <p class="text-gray-600 text-sm">
                        Gere relatórios de validade de treinamentos e receba alertas automáticos quando 
                        estiverem próximos do vencimento.
                    </p>
                </div>
            </div>

            <h2 class="text-2xl font-semibold text-[#1a1f3a] mt-8 mb-4">Níveis de Acesso</h2>
            <ul class="list-disc list-inside space-y-2 text-gray-700">
                <li><strong class="text-[#1a1f3a]">Técnico de Segurança:</strong> Pode cadastrar e lançar treinamentos obrigatórios</li>
                <li><strong class="text-[#1a1f3a]">RH:</strong> Pode cadastrar colaboradores e criar treinamentos da área</li>
                <li><strong class="text-[#1a1f3a]">Instrutor:</strong> Pode registrar presença e notas dos participantes</li>
                <li><strong class="text-[#1a1f3a]">Colaborador:</strong> Pode consultar seus próprios treinamentos</li>
            </ul>

            <div class="mt-8 p-4 bg-[#ff6b35] bg-opacity-10 border border-[#ff6b35] rounded-lg">
                <p class="text-gray-700">
                    <strong class="text-[#ff6b35]">Dica:</strong> Se tiver dúvidas sobre como utilizar o sistema, 
                    consulte as seções específicas do manual ou entre em contato com o suporte.
                </p>
            </div>

            <div class="mt-8 text-center">
                <a href="{{ url('/') }}" class="btn-gestrein-primary inline-block">
                    Voltar para o Início
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
