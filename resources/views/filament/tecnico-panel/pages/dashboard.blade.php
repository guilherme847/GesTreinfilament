<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Mensagem de boas-vindas --}}
        <div class="bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 rounded-lg p-6 border border-amber-200 dark:border-amber-800">
            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <svg class="w-12 h-12 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
                        Gestão de Treinamentos Obrigatórios
                    </h2>
                    <p class="text-gray-700 dark:text-gray-300 mb-4">
                        Como Técnico de Segurança, você é responsável por cadastrar e gerenciar todos os treinamentos obrigatórios relacionados à segurança do trabalho, garantindo a conformidade com as Normas Regulamentadoras (NRs).
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2">✅ Suas Responsabilidades</h3>
                            <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
                                <li>• Cadastrar treinamentos obrigatórios (NRs)</li>
                                <li>• Definir carga horária e validade</li>
                                <li>• Gerenciar modalidades de treinamento</li>
                                <li>• Acompanhar status dos treinamentos</li>
                            </ul>
                        </div>
                        <div class="bg-white dark:bg-gray-800 rounded-lg p-4 shadow-sm">
                            <h3 class="font-semibold text-gray-900 dark:text-white mb-2">📋 Regra de Negócio (RN01)</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Somente o Técnico de Segurança pode cadastrar e lançar treinamentos obrigatórios relacionados à segurança do trabalho.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Cards informativos --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Treinamentos Ativos</h3>
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="text-3xl font-bold text-gray-900 dark:text-white">
                    {{ \App\Models\Treinamento::where('Tipo', 'obrigatorio')->where('Status', 'ativo')->count() }}
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                    Treinamentos obrigatórios disponíveis
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Total de Treinamentos</h3>
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <p class="text-3xl font-bold text-gray-900 dark:text-white">
                    {{ \App\Models\Treinamento::where('Tipo', 'obrigatorio')->count() }}
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                    Incluindo inativos e arquivados
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Com Prática</h3>
                    <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <p class="text-3xl font-bold text-gray-900 dark:text-white">
                    {{ \App\Models\Treinamento::where('Tipo', 'obrigatorio')->where('requer_validacao_pratica', 1)->count() }}
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                    Requerem validação prática
                </p>
            </div>
        </div>

        {{-- Ações rápidas --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm border border-gray-200 dark:border-gray-700">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Ações Rápidas</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @php
                    $createUrl = \App\Filament\TecnicoPanel\Resources\TreinamentoObrigatorioResource::getUrl('create');
                    $indexUrl = \App\Filament\TecnicoPanel\Resources\TreinamentoObrigatorioResource::getUrl('index');
                @endphp
                
                <a href="{{ $createUrl }}" 
                   class="flex items-center p-4 bg-amber-50 dark:bg-amber-900/20 rounded-lg hover:bg-amber-100 dark:hover:bg-amber-900/30 transition-colors group">
                    <svg class="w-10 h-10 text-amber-600 dark:text-amber-400 mr-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <div>
                        <h4 class="font-semibold text-gray-900 dark:text-white">Novo Treinamento</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Cadastrar treinamento obrigatório</p>
                    </div>
                </a>
                
                <a href="{{ $indexUrl }}" 
                   class="flex items-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors group">
                    <svg class="w-10 h-10 text-blue-600 dark:text-blue-400 mr-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    <div>
                        <h4 class="font-semibold text-gray-900 dark:text-white">Listar Treinamentos</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Ver todos os treinamentos cadastrados</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</x-filament-panels::page>

