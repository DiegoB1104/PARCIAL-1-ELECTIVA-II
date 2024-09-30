@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Pedido de Medicamento</h1>

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

    {{-- Formulario para editar el pedido --}}
    <form action="{{ route('pedidos.actualizar', $pedido->id) }}" method="POST">
        @csrf

        {{-- Nombre del medicamento --}}
        <div class="form-group">
            <label for="nombre_medicamento">Nombre del Medicamento:</label>
            <input type="text" id="nombre_medicamento" name="nombre_medicamento" class="form-control" value="{{ old('nombre_medicamento', $pedido->nombre_medicamento) }}" required>
        </div>

        {{-- Tipo del medicamento --}}
        <div class="form-group">
            <label for="tipo_medicamento">Tipo del Medicamento:</label>
            <select id="tipo_medicamento" name="tipo_medicamento" class="form-control" required>
                <option value="" disabled>Selecciona el tipo de medicamento</option>
                <option value="analgésico" {{ $pedido->tipo_medicamento == 'analgésico' ? 'selected' : '' }}>Analgésico</option>
                <option value="analéptico" {{ $pedido->tipo_medicamento == 'analéptico' ? 'selected' : '' }}>Analéptico</option>
                <option value="anestésico" {{ $pedido->tipo_medicamento == 'anestésico' ? 'selected' : '' }}>Anestésico</option>
                <option value="antiácido" {{ $pedido->tipo_medicamento == 'antiácido' ? 'selected' : '' }}>Antiácido</option>
                <option value="antidepresivo" {{ $pedido->tipo_medicamento == 'antidepresivo' ? 'selected' : '' }}>Antidepresivo</option>
                <option value="antibiótico" {{ $pedido->tipo_medicamento == 'antibiótico' ? 'selected' : '' }}>Antibiótico</option>
            </select>
        </div>

        {{-- Cantidad --}}
        <div class="form-group">
            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" class="form-control" min="1" value="{{ old('cantidad', $pedido->cantidad) }}" required>
        </div>

        {{-- Distribuidor --}}
        <div class="form-group">
            <label>Distribuidor:</label><br>
            <div class="form-check">
                <input type="radio" id="cofarma" name="distribuidor" value="Cofarma" class="form-check-input" {{ $pedido->distribuidor == 'Cofarma' ? 'checked' : '' }} required>
                <label class="form-check-label" for="cofarma">Cofarma</label>
            </div>
            <div class="form-check">
                <input type="radio" id="empsephar" name="distribuidor" value="Empsephar" class="form-check-input" {{ $pedido->distribuidor == 'Empsephar' ? 'checked' : '' }} required>
                <label class="form-check-label" for="empsephar">Empsephar</label>
            </div>
            <div class="form-check">
                <input type="radio" id="cemefar" name="distribuidor" value="Cemefar" class="form-check-input" {{ $pedido->distribuidor == 'Cemefar' ? 'checked' : '' }} required>
                <label class="form-check-label" for="cemefar">Cemefar</label>
            </div>
        </div>

        {{-- Sucursal --}}
        <div class="form-group">
            <label>Sucursal:</label><br>
            <div class="form-check">
                <input type="checkbox" id="principal" name="sucursal[]" value="principal" class="form-check-input" {{ in_array('principal', $pedido->sucursal) ? 'checked' : '' }}>
                <label class="form-check-label" for="principal">Principal</label>
            </div>
            <div class="form-check">
                <input type="checkbox" id="secundaria" name="sucursal[]" value="secundaria" class="form-check-input" {{ in_array('secundaria', $pedido->sucursal) ? 'checked' : '' }}>
                <label class="form-check-label" for="secundaria">Secundaria</label>
            </div>
        </div>

        {{-- Botones --}}
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Actualizar Pedido</button>
            <a href="{{ route('pedidos.crear') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection
