@extends('layouts.app')

@section('title', 'Historial de Aumentos')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/empleados_index.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-6">
                <h1 class="mb-0">Historial de Aumentos</h1>
                <p class="text-muted">Historial de aumentos salariales para el empleado <b>{{ $empleado->nombres }}
                        {{ $empleado->apellidos }}</b>.</p>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('empleados.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Volver a la lista de empleados
                </a>
            </div>
        </div>

        <div class="row mb-3 align-items-center">
            <div class="col-md-6 text-start">
                <a href="#" class="btn btn-outline-primary me-2">
                    <i class="fas fa-file-excel me-1"></i> Exportar a Excel
                </a>
                <a href="#" class="btn btn-outline-danger me-2">
                    <i class="fas fa-file-pdf me-1"></i> Exportar a PDF
                </a>
                <a href="#" class="btn btn-outline-info">
                    <i class="fas fa-share-alt me-1"></i> Compartir
                </a>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <span class="input-group-text" id="search-icon"><i class="fas fa-search"></i></span>
                    <input type="text" class="form-control form-control-sm" id="search"
                        placeholder="Buscar en historial..." aria-describedby="search-icon">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            @if ($empleado->aumentos->count() > 0)
                <table class="table table-striped">
                    <thead class="table-light">
                        <tr>
                            {{-- <th>ID</th>
                    <th>Responsable</th> --}}
                            <th>Fecha</th>
                            <th>Valor del Aumento</th>
                            <th>Cargo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aumentos as $aumento)
                            <tr>
                                {{-- <td>{{ $aumento->empleado_id }}</td>
                        <td>{{ $aumento->nombre_empleado }} {{ $aumento->apellidos_empleado }}</td>  --}}
                                <td>{{ $aumento->fecha }}</td>
                                {{-- <td>{{ $aumento->valor }}</td> --}}
                                <td>${{ number_format($aumento->valor, 0, ',', '.') }} COP</td>
                                <!-- Aquí agregamos el formato de moneda -->
                                <td>{{ $aumento->nombre_cargo }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No hay aumentos registrados para este empleado.</p>
            @endif
        </div>

        <div class="d-flex justify-content-center">
            {{ $aumentos->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection
