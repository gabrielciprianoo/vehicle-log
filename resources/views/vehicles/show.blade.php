@extends('layouts.app')

@section('content')
<div class=" max-w-4xl mx-auto flex justify-between items-center mb-6">
    <a href="{{ route('home') }}" class="p-2 bg-green-800 rounded-lg text-white hover:bg-green-900 text-sm font-bold transition duration-300 cursor-pointer">
        Regresar 
    </a>
    
</div>
<div class="max-w-2xl mx-auto p-8 mt-10 bg-white rounded-2xl shadow-xl space-y-6">

    <!-- Nombre del vehículo y fecha -->
    <div class="flex justify-between items-center p-4">
        <h1 class="text-2xl font-bold text-gray-800 capitalize">{{ $vehicle->vehicle }}</h1>
        <span class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($vehicle->date)->format('j/M/Y') }}</span>
    </div>

    <!-- Información general -->
    <div class="space-y-1">

        <div class="p-4 flex gap-2 bg-gray-50 rounded-lg shadow-sm">
            <p class="text-gray-500 text-sm">Placas</p>
            <p class="text-gray-700 font-semibold">{{ $vehicle->plates }}</p>
        </div>

        <div class="p-4 flex gap-2 bg-gray-50 rounded-lg shadow-sm">
            <p class="text-gray-500 text-sm">Color</p>
            <p class="text-gray-700 text-sm font-semibold capitalize">{{ $vehicle->color }}</p>
        </div>

        <div class="p-4 flex gap-2 bg-gray-50 rounded-lg shadow-sm">
            <p class="text-gray-500 text-sm">Servicio</p>
            <p class="text-gray-700 text-sm font-semibold">{{ $vehicle->service_type }}</p>
        </div>

        <div class="p-4 flex gap-2 bg-gray-50 rounded-lg shadow-sm">
            <p class="text-gray-500 text-sm">Número de Orden</p>
            <p class="text-gray-700 text-sm font-semibold">{{ $vehicle->order_number }}</p>
        </div>

        <!-- Documentos (verde o amarillo según valor) -->
        <div class="grid md:grid-cols-2 gap-4">

            <div class="p-4 flex gap-2 rounded-lg shadow-sm {{ $vehicle->yellow_sheet ? 'bg-green-100' : 'bg-yellow-100' }}">
                <p class="text-gray-600 text-sm">Hoja Amarilla</p>
                <p class="text-gray-800 text-sm font-semibold">{{ $vehicle->yellow_sheet ? 'Sí' : 'No' }}</p>
            </div>

            <div class="p-4 flex gap-2 rounded-lg shadow-sm {{ $vehicle->blue_sheet ? 'bg-green-100' : 'bg-yellow-100' }}">
                <p class="text-gray-600 text-sm">Hoja Azul</p>
                <p class="text-gray-800 text-sm font-semibold">{{ $vehicle->blue_sheet ? 'Sí' : 'No' }}</p>
            </div>

            <div class="p-4 flex gap-2 rounded-lg shadow-sm {{ $vehicle->history ? 'bg-green-100' : 'bg-yellow-100' }}">
                <p class="text-gray-600 text-sm">Historial</p>
                <p class="text-gray-800 text-sm font-semibold">{{ $vehicle->history ? 'Sí' : 'No' }}</p>
            </div>

            <div class="p-4 flex gap-2 rounded-lg shadow-sm {{ $vehicle->gas ? 'bg-green-100' : ' bg-yellow-100' }}">
                <p class="text-gray-600 text-sm">Gas</p>
                <p class="text-gray-800 text-sm font-semibold">{{ $vehicle->gas ? 'Sí' : 'No' }}</p>
            </div>

            <div class="p-4 flex gap-2 rounded-lg shadow-sm {{ $vehicle->plas ? 'bg-green-100' : 'bg-yellow-100' }}">
                <p class="text-gray-600 text-sm">Plas</p>
                <p class="text-gray-800 text-sm font-semibold">{{ $vehicle->plas ? 'Sí' : 'No' }}</p>
            </div>

            <div class="p-4 flex gap-2 rounded-lg shadow-sm {{ $vehicle->km ? 'bg-green-100' : 'bg-yellow-100' }}">
                <p class="text-gray-600 text-sm">KM</p>
                <p class="text-gray-800 text-sm font-semibold">{{ $vehicle->km ? 'Sí' : 'No' }}</p>
            </div>

            <div class="p-4 flex gap-2 rounded-lg shadow-sm {{ $vehicle->key ? 'bg-green-100' : 'bg-yellow-100' }}">
                <p class="text-gray-600 text-sm">Llave</p>
                <p class="text-gray-800 text-sm font-semibold">{{ $vehicle->key ? 'Sí' : 'No' }}</p>
            </div>

        </div>

        <!-- Observaciones solo si existen -->
        @if($vehicle->observations)
        <div class="p-6 bg-blue-50 rounded-lg shadow-inner">
            <h2 class="text-lg font-bold text-blue-700 mb-2">Observaciones</h2>
            <p class="text-gray-700">{{ $vehicle->observations }}</p>
        </div>
        @endif

    </div>

   

</div>
@endsection
