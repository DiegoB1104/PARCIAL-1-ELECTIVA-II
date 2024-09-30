@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Realizar Pedido de Medicamentos</h1>

    {{-- Mostrar mensajes de éxito --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Mostrar errores de validación --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulario para crear pedido --}}
    <form action="{{ route('pedidos.confirmar') }}" method="POST">
        @csrf

        {{-- Nombre del medicamento --}}
        <div class="form-group">
            <label for="nombre_medicamento">Nombre del Medicamento:</label>
            <input type="text" id="nombre_medicamento" name="nombre_medicamento" class="form-control" value="{{ old('nombre_medicamento') }}" required>
        </div>

        {{-- Tipo del medicamento --}}
        <div class="form-group">
            <label for="tipo_medicamento">Tipo del Medicamento:</label>
            <select id="tipo_medicamento" name="tipo_medicamento" class="form-control" required>
                <option value="" disabled selected>Selecciona el tipo de medicamento</option>
                <option value="analgésico" {{ old('tipo_medicamento') == 'analgésico' ? 'selected' : '' }}>Analgésico</option>
                <option value="analéptico" {{ old('tipo_medicamento') == 'analéptico' ? 'selected' : '' }}>Analéptico</option>
                <option value="anestésico" {{ old('tipo_medicamento') == 'anestésico' ? 'selected' : '' }}>Anestésico</option>
                <option value="antiácido" {{ old('tipo_medicamento') == 'antiácido' ? 'selected' : '' }}>Antiácido</option>
                <option value="antidepresivo" {{ old('tipo_medicamento') == 'antidepresivo' ? 'selected' : '' }}>Antidepresivo</option>
                <option value="antibiótico" {{ old('tipo_medicamento') == 'antibiótico' ? 'selected' : '' }}>Antibiótico</option>
            </select>
        </div>

        {{-- Cantidad de medicamento --}}
        <div class="form-group">
            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" class="form-control" min="1" value="{{ old('cantidad') }}" required>
        </div>

        {{-- Distribuidor --}}
        <div class="form-group">
            <label>Distribuidor:</label><br>
            <div class="form-check">
                <input type="radio" id="cofarma" name="distribuidor" value="Cofarma" class="form-check-input" {{ old('distribuidor') == 'Cofarma' ? 'checked' : '' }} required>
                <label class="form-check-label" for="cofarma">Cofarma</label>
            </div>
            <div class="form-check">
                <input type="radio" id="empsephar" name="distribuidor" value="Empsephar" class="form-check-input" {{ old('distribuidor') == 'Empsephar' ? 'checked' : '' }} required>
                <label class="form-check-label" for="empsephar">Empsephar</label>
            </div>
            <div class="form-check">
                <input type="radio" id="cemefar" name="distribuidor" value="Cemefar" class="form-check-input" {{ old('distribuidor') == 'Cemefar' ? 'checked' : '' }} required>
                <label class="form-check-label" for="cemefar">Cemefar</label>
            </div>
        </div>

        {{-- Sucursal --}}
        <div class="form-group">
            <label>Sucursal:</label><br>
            <div class="form-check">
                <input type="checkbox" id="principal" name="sucursal[]" value="principal" class="form-check-input" {{ is_array(old('sucursal')) && in_array('principal', old('sucursal')) ? 'checked' : '' }}>
                <label class="form-check-label" for="principal">Principal</label>
            </div>
            <div class="form-check">
                <input type="checkbox" id="secundaria" name="sucursal[]" value="secundaria" class="form-check-input" {{ is_array(old('sucursal')) && in_array('secundaria', old('sucursal')) ? 'checked' : '' }}>
                <label class="form-check-label" for="secundaria">Secundaria</label>
            </div>
        </div>

        {{-- Botones --}}
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Confirmar</button>
            <button type="reset" class="btn btn-secondary">Cancelar</button>
        </div>
    </form>

    {{-- Mostrar lista de pedidos creados --}}
    <h2 class="mt-5">Pedidos Creados</h2>

    @if($pedidos->isEmpty())
        <p>No hay pedidos creados.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Medicamento</th>
                    <th>Tipo</th>
                    <th>Cantidad</th>
                    <th>Distribuidor</th>
                    <th>Sucursal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                    <tr>
                        <td>{{ $pedido->id }}</td>
                        <td>{{ $pedido->nombre_medicamento }}</td>
                        <td>{{ $pedido->tipo_medicamento }}</td>
                        <td>{{ $pedido->cantidad }}</td>
                        <td>{{ $pedido->distribuidor }}</td>
                        <<td>
    @if(in_array('principal', $pedido->sucursal))
        Principal (Calle de la Rosa n. 28)
    @endif
    @if(in_array('secundaria', $pedido->sucursal))
        , Secundaria (Calle Alcazabilla n. 3)
    @endif
</td>

                        <td>
                            <a href="{{ route('pedidos.editar', $pedido->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('pedidos.eliminar', $pedido->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
