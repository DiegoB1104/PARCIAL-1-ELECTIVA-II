<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoController extends Controller
{
    public function crear()
{
    // Obtenemos todos los pedidos creados
    $pedidos = Pedido::all();

    // Retornamos la vista de creación con los pedidos
    return view('pedidos.crear', compact('pedidos'));
}

    public function confirmar(Request $request)
    {
        $validatedData = $request->validate([
            'nombre_medicamento' => 'required|alpha_num',
            'tipo_medicamento' => 'required|in:analgésico,analéptico,anestésico,antiácido,antidepresivo,antibiótico',
            'cantidad' => 'required|integer|min:1',
            'distribuidor' => 'required|in:Cofarma,Empsephar,Cemefar',
            'sucursal' => 'required|array|min:1',
        ]);

        Pedido::create($validatedData);

        return redirect()->back()->with('success', 'Pedido realizado con éxito');
    }

    public function editar($id)
    {
        $pedido = Pedido::findOrFail($id);
        return view('pedidos.editar', compact('pedido'));
    }

    public function actualizar(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);

        $pedido->update($request->validate([
            'nombre_medicamento' => 'required|alpha_num',
            'tipo_medicamento' => 'required|in:analgésico,analéptico,anestésico,antiácido,antidepresivo,antibiótico',
            'cantidad' => 'required|integer|min:1',
            'distribuidor' => 'required|in:Cofarma,Empsephar,Cemefar',
            'sucursal' => 'required|array|min:1',
        ]));

        return redirect()->route('pedidos.crear')->with('success', 'Pedido actualizado exitosamente.');
    }

    public function eliminar($id)
    {
        Pedido::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Pedido eliminado con éxito');
    }
}

