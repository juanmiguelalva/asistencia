<x-app-layout>
    <x-slot name="header">
        <div class="py-2 flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Reporte
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">            
            <x-splade-table :for="$reporte">
            </x-splade-table>
        </div>
    </div>
</x-app-layout>