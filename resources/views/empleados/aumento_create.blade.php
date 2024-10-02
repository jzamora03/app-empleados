@extends('layouts.app')

@section('title', 'Registrar Aumento para ' . $empleado->nombres)

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Registrar Aumento para: {{ $empleado->nombres }} {{ $empleado->apellidos }}</h2>

        <form action="{{ route('empleados.aumento.store', $empleado->id) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha del Aumento</label>
                <input type="date" name="fecha" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="valor" class="form-label">Valor del Aumento</label>
                <input type="number" name="valor" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="cargo_id" class="form-label">Cargo</label>
                <select name="cargo_id" class="form-control" required>
                    @foreach($cargos as $cargo)
                        <option value="{{ $cargo->id }}">{{ $cargo->cargo }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Guardar Aumento</button>
        </form>
    </div>
</div>
@endsection
