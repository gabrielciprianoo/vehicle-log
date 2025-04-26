<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('recent') && $request->recent) {
            // Filtro: últimos 7 días
            $vehicles = Vehicle::where('date', '>=', now()->subDays(7)->toDateString())
                ->orderBy('created_at', 'desc')
                ->get();
        } elseif ($request->has('current_month') && $request->current_month) {
            // Filtro: mes actual
            $vehicles = Vehicle::whereYear('date', now()->year)
                ->whereMonth('date', now()->month)
                ->orderBy('created_at', 'desc')
                ->get();
        } elseif ($request->has('month') && $request->month) {
            // Filtro: mes seleccionado
            $vehicles = Vehicle::whereYear('date', now()->year)
                ->whereMonth('date', $request->month)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            // Sin filtros
            $vehicles = Vehicle::orderBy('created_at', 'desc')->get();
        }

        return view('welcome', compact('vehicles'));
    }



    public function create()
    {
        return view('vehicles.create');
    }


    public function store(Request $request)
    {
        // Primero, convertimos los valores de los checkboxes a booleanos
        $checkboxes = [
            'yellow_sheet',
            'blue_sheet',
            'history',
            'gas',
            'plas',
            'km',
            'key',
        ];

        // Convertimos los checkboxes a true o false
        foreach ($checkboxes as $checkbox) {
            $request[$checkbox] = $request->has($checkbox); // Asigna true si está marcado, false si no
        }

        // Ahora validamos los datos, incluyendo los checkboxes ya convertidos
        $validated = $request->validate([
            'date' => 'required|date',
            'vehicle' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'plates' => 'required|string|max:255',
            'service_type' => 'required|string|max:255',
            'order_number' => 'required|string|max:255',
            'yellow_sheet' => 'nullable|boolean',
            'blue_sheet' => 'nullable|boolean',
            'history' => 'nullable|boolean',
            'gas' => 'nullable|boolean',
            'plas' => 'nullable|boolean',
            'km' => 'nullable|boolean',
            'key' => 'nullable|boolean',
            'observations' => 'nullable|string',
        ], [
            // Mensajes personalizados
            'date.required' => 'La fecha es obligatoria.',
            'date.date' => 'La fecha debe ser una fecha válida.',
            'vehicle.required' => 'El campo vehículo es obligatorio.',
            'vehicle.string' => 'El campo vehículo debe ser una cadena de texto.',
            'color.required' => 'El color es obligatorio.',
            'plates.required' => 'Las placas son obligatorias.',
            'service_type.required' => 'El tipo de servicio es obligatorio.',
            'order_number.required' => 'El número de orden es obligatorio.',
            'yellow_sheet.boolean' => 'El valor de la Hoja Amarilla debe ser verdadero o falso.',
            'blue_sheet.boolean' => 'El valor de la Hoja Azul debe ser verdadero o falso.',
            'history.boolean' => 'El valor del Historial debe ser verdadero o falso.',
            'gas.boolean' => 'El valor del Gas debe ser verdadero o falso.',
            'plas.boolean' => 'El valor del Plas debe ser verdadero o falso.',
            'km.boolean' => 'El valor del Km debe ser verdadero o falso.',
            'key.boolean' => 'El valor de la Llave debe ser verdadero o falso.',
            'observations.string' => 'Las observaciones deben ser una cadena de texto.',
        ]);


        // Crear el vehículo con los datos validados
        Vehicle::create($validated);

        // Redirige con mensaje de éxito
        return redirect()->route('home')->with('success', 'Vehiculo registrado exitosamente.');
    }


    public function show($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        return view('vehicles.show', compact('vehicle'));
    }

    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);  // Encuentra el vehículo o muestra error 404
        return view('vehicles.edit', compact('vehicle'));  // Pasamos el vehículo a la vista
    }

    public function update(Request $request, $id)
    {
        // Primero, convertimos los valores de los checkboxes a booleanos
        $checkboxes = [
            'yellow_sheet',
            'blue_sheet',
            'history',
            'gas',
            'plas',
            'km',
            'key',
        ];

        // Convertimos los checkboxes a true o false
        foreach ($checkboxes as $checkbox) {
            $request[$checkbox] = $request->has($checkbox); // Asigna true si está marcado, false si no
        }

        // Ahora validamos los datos, incluyendo los checkboxes ya convertidos
        $validated = $request->validate([
            'date' => 'required|date',
            'vehicle' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'plates' => 'required|string|max:255',
            'service_type' => 'required|string|max:255',
            'order_number' => 'required|string|max:255',
            'yellow_sheet' => 'nullable|boolean',
            'blue_sheet' => 'nullable|boolean',
            'history' => 'nullable|boolean',
            'gas' => 'nullable|boolean',
            'plas' => 'nullable|boolean',
            'km' => 'nullable|boolean',
            'key' => 'nullable|boolean',
            'observations' => 'nullable|string',
        ], [
            // Mensajes personalizados
            'date.required' => 'La fecha es obligatoria.',
            'date.date' => 'La fecha debe ser una fecha válida.',
            'vehicle.required' => 'El campo vehículo es obligatorio.',
            'vehicle.string' => 'El campo vehículo debe ser una cadena de texto.',
            'color.required' => 'El color es obligatorio.',
            'plates.required' => 'Las placas son obligatorias.',
            'service_type.required' => 'El tipo de servicio es obligatorio.',
            'order_number.required' => 'El número de orden es obligatorio.',
            'yellow_sheet.boolean' => 'El valor de la Hoja Amarilla debe ser verdadero o falso.',
            'blue_sheet.boolean' => 'El valor de la Hoja Azul debe ser verdadero o falso.',
            'history.boolean' => 'El valor del Historial debe ser verdadero o falso.',
            'gas.boolean' => 'El valor del Gas debe ser verdadero o falso.',
            'plas.boolean' => 'El valor del Plas debe ser verdadero o falso.',
            'km.boolean' => 'El valor del Km debe ser verdadero o falso.',
            'key.boolean' => 'El valor de la Llave debe ser verdadero o falso.',
            'observations.string' => 'Las observaciones deben ser una cadena de texto.',
        ]);

        // Encuentra el vehículo a actualizar
        $vehicle = Vehicle::findOrFail($id);

        // Actualiza el vehículo con los datos validados
        $vehicle->update($validated);

        // Redirige con mensaje de éxito
        return redirect()->route('home')->with('success', 'Vehículo actualizado exitosamente.');
    }



    public function destroy($id)
    {
        // Buscar el vehículo
        $vehicle = Vehicle::findOrFail($id);

        // Eliminar el vehículo
        $vehicle->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('home')->with('success', 'Vehículo eliminado exitosamente.');
    }
}
