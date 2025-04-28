@extends('layouts.app')

@section('content')
    <h1 class="text-black text-3xl font-bold mb-4">Bienvenido a la Bitácora de Vehículos</h1>
    <p class="text-black">Gestiona los registros de manera fácil y rápida.</p>
    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded my-6 text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex mt-4 flex-wrap w-[90%] items-center gap-4 mb-6">

        <!-- Filtros de Checkboxes -->
        <form method="GET" action="{{ route('home') }}" class="flex items-center gap-6 bg-white p-4 rounded shadow">
            <label class="flex items-center space-x-2 text-gray-700">
                <input type="checkbox" name="recent" value="1" onchange="this.form.submit()"
                    {{ request('recent') ? 'checked' : '' }} class="form-checkbox text-blue-600">
                <span>Últimos 7 días</span>
            </label>

            <label class="flex items-center space-x-2 text-gray-700">
                <input type="checkbox" name="current_month" value="1" onchange="this.form.submit()"
                    {{ request('current_month') ? 'checked' : '' }} class="form-checkbox text-blue-600">
                <span>Mes actual</span>
            </label>
        </form>

        <!-- Filtro por Año y Mes -->
        <form method="GET" action="{{ route('home') }}"
            class="flex flex-col lg:flex-row justify-between items-center  gap-4 bg-white p-4 rounded shadow">
            <label class="flex items-center  space-x-2 text-gray-700">
                <select name="year" id="year" onchange="this.form.submit()"
                    class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md p-2">
                    <option value="">Todos los años</option>
                    @for ($y = now()->year; $y >= 2020; $y--)
                        {{-- Puedes ajustar el rango de años aquí --}}
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endfor
                </select>
                <span>Año</span>
            </label>

            <label class="flex  items-center space-x-2 text-gray-700">
                <select name="month" id="month" onchange="this.form.submit()"
                    class="border-gray-300 focus:ring-blue-500 focus:border-blue-500 rounded-md p-2">
                    <option value="">Todos los meses</option>
                    @for ($m = 1; $m <= 12; $m++)
                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->locale('es')->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>
                <span>Mes</span>
            </label>
        </form>

        <!-- Filtro por número de orden de servicio -->
        <form method="GET" action="{{ route('home') }}" class="inline-flex w-full md:w-auto items-center">
            <input type="text" name="order_number" id="order_number" value="{{ request('order_number') }}"
                placeholder="VIN / # Orden" class="border rounded w-full p-2">
            <button type="submit" class="ml-2 p-2 bg-blue-500 text-white rounded">Buscar</button>
        </form>


        <form method="GET" action="{{ route('home') }}" class="inline-block">
            <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-700">
                Quitar filtros
            </button>
        </form>

    </div>





    <div class="flex justify-left mt-10">
        <a href="{{ route('vehicles.create') }}"
            class="p-2 bg-green-800 rounded-lg text-white hover:bg-green-900 text-sm font-bold transition duration-300 cursor-pointer">
            Registrar Nuevo Vehículo
        </a>
    </div>

    <!-- Contenedor de tarjetas -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mt-10">

        @foreach ($vehicles as $vehicle)
            <div>
                <div
                    class="{{ $vehicle->blue_sheet ? 'bg-blue-100' : 'bg-yellow-100' }} shadow-md hover:shadow-lg transition-shadow rounded-xl p-6 mb-6 border border-gray-200">
                    <!-- Header: Vehículo + Acciones -->
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-2xl font-bold text-gray-800 capitalize">{{ $vehicle->vehicle }}</h3>

                        <div class="flex items-center space-x-3">
                            <!-- Botón Editar -->
                            <a href="{{ route('vehicles.edit', $vehicle->id) }}"
                                class="text-blue-500 hover:text-blue-700 w-6 h-6">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-6">
                                    <path
                                        d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                    <path
                                        d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                </svg>

                            </a>

                            <!-- Botón Eliminar -->
                            <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST"
                                onsubmit="return confirm('¿Estás seguro de eliminar este vehículo?');" class="w-6 h-6">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 w-full h-full cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-6">
                                        <path fill-rule="evenodd"
                                            d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                            clip-rule="evenodd" />
                                    </svg>

                                </button>
                            </form>
                        </div>

                    </div>

                    <!-- Datos principales -->
                    <div class="space-y-2 mb-4">
                        <p class="text-sm text-gray-500"><strong>Fecha:</strong>
                            {{ \Carbon\Carbon::parse($vehicle->date)->format('d-m-Y') }}</p>
                        <p class="text-sm text-gray-700"><strong>Placas:</strong> {{ $vehicle->plates }}</p>
                        <p class="text-sm text-gray-700"><strong>Número de orden:</strong> {{ $vehicle->order_number }}</p>
                        <p class="text-sm text-gray-700"><strong>VIN:</strong> {{ $vehicle->vin }}</p>
                        <p class="text-sm text-gray-700"><strong>Servicio:</strong> {{ $vehicle->service_type }}</p>
                    </div>

                    <!-- Botón Ver Detalle -->
                    <div class="flex justify-between items-center md:flex-row flex-col gap-1">
                        <a href="{{ route('vehicles.show', $vehicle->id) }}"
                            class="inline-block bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition">
                            Ver detalles
                        </a>
                        @if ($vehicle->delivered)
                            <p class="p-2 rounded-lg text-sm font-bold bg-green-800 text-white">Finalizado</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
