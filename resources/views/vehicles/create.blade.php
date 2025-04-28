@extends('layouts.app')

@section('content')
    <div class=" max-w-4xl mx-auto flex justify-between items-center mb-6">
        <a href="{{ route('home') }}"
            class="p-2 bg-green-800 rounded-lg text-white hover:bg-green-900 text-sm font-bold transition duration-300 cursor-pointer">
            Regresar
        </a>

    </div>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-8">
        <h1 class="text-xl capitalize font-bold text-center mb-10">registrar nuevo vehiculo</h1>
        {{-- Mensaje de error --}}

        {{-- Mensaje de éxito --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-6 text-center">
                {{ session('success') }}
            </div>
        @endif

        {{-- Errores de validación --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-6">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('vehicles.store') }}" method="POST" class="space-y-6">
            @csrf

            {{-- Grid de campos principales --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Fecha --}}
                <div>
                    <label for="date" class="block text-gray-700 font-semibold mb-2">Fecha</label>
                    <input type="date" name="date" id="date" value="{{ old('date') }}"
                        class="w-full border border-gray-400 rounded-lg p-2 focus:ring-red-500 focus:border-red-500"
                        required>
                </div>

                {{-- Vehículo --}}
                <div>
                    <label for="vehicle" class="block text-gray-700 font-semibold mb-2">Vehículo</label>
                    <input type="text" name="vehicle" id="vehicle" value="{{ old('vehicle') }}"
                        class="w-full border border-gray-400 rounded-lg p-2 focus:ring-red-500 focus:border-red-500"
                        required>
                </div>

                {{-- Color --}}
                <div>
                    <label for="color" class="block text-gray-700 font-semibold mb-2">Color</label>
                    <input type="text" name="color" id="color" value="{{ old('color') }}"
                        class="w-full border border-gray-400 rounded-lg p-2 focus:ring-red-500 focus:border-red-500"
                        required>
                </div>

                {{-- Placas --}}
                <div>
                    <label for="plates" class="block text-gray-700 font-semibold mb-2">Placas</label>
                    <input type="text" name="plates" id="plates" value="{{ old('plates') }}"
                        class="w-full border border-gray-400 rounded-lg p-2 focus:ring-red-500 focus:border-red-500"
                        required>
                </div>

                {{-- Tipo de servicio --}}
                <div>
                    <label for="service_type" class="block text-gray-700 font-semibold mb-2">Tipo de Servicio</label>
                    <input type="text" name="service_type" id="service_type" value="{{ old('service_type') }}"
                        class="w-full border border-gray-400 rounded-lg p-2 focus:ring-red-500 focus:border-red-500"
                        required>
                </div>

                {{-- Número de orden --}}
                <div>
                    <label for="order_number" class="block text-gray-700 font-semibold mb-2">Número de Orden</label>
                    <input type="text" name="order_number" id="order_number" value="{{ old('order_number') }}"
                        class="w-full border border-gray-400 rounded-lg p-2 focus:ring-red-500 focus:border-red-500"
                        required>
                </div>

                {{-- VIN --}}
                <div>
                    <label for="vin" class="block text-gray-700 font-semibold mb-2">VIN</label>
                    <input type="text" name="vin" id="vin" value="{{ old('vin') }}"
                        class="w-full border border-gray-400 rounded-lg p-2 focus:ring-red-500 focus:border-red-500">
                </div>


            </div>

            {{-- Checkboxes --}}
            <div class="mt-8">
                <h3 class="text-gray-700 font-semibold mb-4">Documentos / Estado:</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @php
                        $checkboxes = [
                            'yellow_sheet' => 'Hoja Amarilla',
                            'blue_sheet' => 'Hoja Azul',
                            'history' => 'Historial',
                            'gas' => 'Gas',
                            'plas' => 'Plas',
                            'km' => 'Km',
                            'key' => 'Llave',
                        ];
                    @endphp

                    @foreach ($checkboxes as $name => $label)
                        <label class="flex items-center space-x-2 text-gray-600">
                            <input type="checkbox" name="{{ $name }}" id="{{ $name }}"
                                {{ old($name) ? 'checked' : '' }} class="text-red-600 focus:ring-red-500 rounded">
                            <span>{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Áreas por las que ha pasado --}}
            <div class="mt-8">
                <h3 class="text-gray-700 font-semibold mb-4">Áreas por las que ha pasado:</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @php
                        $areas = [
                            'diagnostic' => 'Diagnóstico',
                            'dismantling' => 'Desmontaje',
                            'disassembly' => 'Desarmado',
                            'assembly' => 'Armado',
                            'mounting' => 'Montaje',
                            'testing' => 'Pruebas',
                            'delivered' => 'Entregado',
                        ];
                    @endphp

                    @foreach ($areas as $name => $label)
                        <label class="flex items-center space-x-2 text-gray-600">
                            <input type="checkbox" name="{{ $name }}" id="{{ $name }}"
                                {{ old($name) ? 'checked' : '' }} class="text-red-600 focus:ring-red-500 rounded">
                            <span>{{ $label }}</span>
                        </label>
                    @endforeach
                </div>
            </div>


            {{-- Observaciones --}}
            <div class="mt-8">
                <label for="observations" class="block text-gray-700 font-semibold mb-2">Observaciones</label>
                <textarea name="observations" id="observations" rows="4"
                    class="w-full border border-gray-400 rounded-lg p-2 focus:ring-red-500 focus:border-red-500">{{ old('observations') }}</textarea>
            </div>

            {{-- Botón --}}
            <div class="text-center mt-8">
                <button type="submit"
                    class="bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-8 rounded-lg transition duration-300 w-full cursor-pointer">
                    Registrar
                </button>
            </div>

        </form>
    </div>
@endsection
