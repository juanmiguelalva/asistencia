@php
use App\Helper\ClasesHelper;
@endphp
<x-app-layout>
    <x-slot name="header">
        <div class="py-2 flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-6 text-xl">
                {{ __('Mis Clases') }}
            </h2>
            <div id="clock" class="font-semibold text-xl text-gray-800 leading-6 text-xl"></div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-splade-table :for="$clases">
                <x-splade-cell asistencia as="$clase">
                    @if(ClasesHelper::canRegister($clase))
                        @if(!ClasesHelper::isRegistered($clase))  
                        <x-splade-form action="{{ route('mis_clases.index') }}" :default="$clase">
                            <x-splade-input type="hidden" name="id"/>    
                            <x-splade-submit type="submit" class="flex font-normal space-x-2 pe-5 border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-blue-500 hover:bg-blue-700 text-white border-transparent focus:border-blue-700 focus:ring-blue-600">Registrar</x-splade-submit>
                        </x-splade-form>
                        @else
                        {!!ClasesHelper::isRegistered($clase)!!}
                        {{-- <span class="inline-flex items-center bg-red-100 text-red-800 font-medium mr-2 ps-3 pe-4 py-1 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 pe-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                            Tardanza
                        </span>
                        <span class="inline-flex items-center bg-green-100 text-green-700 font-medium mr-2 ps-3 pe-4 py-1 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 pe-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg> Registrada
                        </span> --}}
                        @endif
                    @else
                        <button class="flex font-normal cursor-not-allowed space-x-2 pe-5 border rounded-md shadow-sm font-bold py-2 px-4 focus:outline-none focus:ring focus:ring-opacity-50 bg-blue-200 text-white border-transparent focus:border-blue-700 focus:ring-blue-600" disabled>
                            <p>Registrar</p>                       
                        </button>
                    @endif
                </x-splade-cell>
            </x-splade-table>
        </div>
        {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-splade-table :for="$claseso">
            </x-splade-table>
        </div> --}}
    </div>
</x-app-layout>
<x-splade-script>
    function updateClock() {
        var now = new Date();
        var clock = document.getElementById('clock');
        clock ? clock.innerText = now.toLocaleTimeString() : null;
        setTimeout(updateClock, 1000);
    }
    updateClock();
</x-splade-script>