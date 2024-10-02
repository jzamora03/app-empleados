@extends('layouts.app')

@section('title', 'Lista de Cargos')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h2>Lista de Cargos</h2>
        <a href="{{ route('empleados.index') }}" class="btn btn-secondary mb-3">Volver a la lista de empleados</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cargo</th>
                    <th>Salario</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cargos as $cargo)
                    <tr>
                        <td>{{ $cargo->id }}</td>
                        <td>{{ $cargo->cargo }}</td>
                        <td>{{ $cargo->salario }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
