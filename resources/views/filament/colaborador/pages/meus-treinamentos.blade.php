<x-filament-panels::page>
    <div class="space-y-6">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">
                Consulta de Treinamentos
            </h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                Esta área permite que você consulte seus próprios treinamentos e status. 
                Você não pode alterar informações no sistema, apenas visualizar.
            </p>
        </div>
        
        {{ $this->table }}
    </div>
</x-filament-panels::page>

