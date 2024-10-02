@extends('layouts.app')

@section('title', isset($empleado) ? 'Editar Empleado' : 'Nuevo Empleado')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>{{ isset($empleado) ? 'Editar Empleado' : 'Nuevo Empleado' }}</h2>

            <form action="{{ isset($empleado) ? route('empleados.update', $empleado->id) : route('empleados.store') }}"
                method="POST">
                @csrf
                @if (isset($empleado))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="nombres" class="form-label">Nombres</label>
                    <input type="text" name="nombres" class="form-control"
                        value="{{ isset($empleado) ? $empleado->nombres : old('nombres') }}" required>
                </div>

                <div class="mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control"
                        value="{{ isset($empleado) ? $empleado->apellidos : old('apellidos') }}" required>
                </div>

                <div class="mb-3">
                    <label for="sexo" class="form-label">Sexo</label>
                    <select name="sexo" class="form-control" required>
                        <option value="M" {{ isset($empleado) && $empleado->sexo == 'M' ? 'selected' : '' }}>Masculino
                        </option>
                        <option value="F" {{ isset($empleado) && $empleado->sexo == 'F' ? 'selected' : '' }}>Femenino
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                    <input type="date" name="fecha_ingreso" class="form-control"
                        value="{{ isset($empleado) ? $empleado->fecha_ingreso : old('fecha_ingreso') }}" required>
                </div>

                <div class="mb-3">
                    <label for="cargo_id" class="form-label">Cargo</label>
                    <select name="cargo_id" class="form-control" required>
                        @foreach ($cargos as $cargo)
                            <option value="{{ $cargo->id }}"
                                {{ isset($empleado) && $empleado->cargo_id == $cargo->id ? 'selected' : '' }}>
                                {{ $cargo->cargo }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-success">{{ isset($empleado) ? 'Actualizar' : 'Crear' }}</button>
            </form>
        </div>
    </div>
@endsection
