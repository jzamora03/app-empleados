@extends('layouts.app')

@section('title', 'Lista de Empleados')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/empleados_index.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-6">
                <h1 class="mb-0">Lista de Empleados</h1>
                <p class="text-muted">Aquí podrás gestionar a todos los empleados, sus respectivos cargos, aumentar su sueldo
                    y gestionar sus datos.</p>
            </div>
            <div class="col-md-6 text-end">
                <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalEmpleado">
                    <i class="fas fa-user-plus me-2"></i> Nuevo empleado
                </button>
                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modalCargo">
                    <i class="fas fa-briefcase me-2"></i> Agregar Cargo
                </button>
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
                        placeholder="Buscar empleados..." aria-describedby="search-icon">
                </div>
            </div>
        </div>

        <!-- Modal agregar nuevo cargo -->
        <div class="modal fade" id="modalCargo" tabindex="-1" aria-labelledby="modalCargoLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCargoLabel">Agregar Nuevo Cargo</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('cargos.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="cargo" class="form-label">Nombre del Cargo</label>
                                        <input type="text" name="cargo" class="form-control"
                                            placeholder="Escribe el nombre del cargo" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="salario" class="form-label">Salario</label>
                                        <input type="number" name="salario" class="form-control"
                                            placeholder="Escribe el salario" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal agregar empleado-->
        <div class="modal fade" id="modalEmpleado" tabindex="-1" aria-labelledby="modalEmpleadoLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEmpleadoLabel">Agregar nuevo empleado</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('empleados.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nombres" class="form-label">Nombres</label>
                                        <input type="text" name="nombres" class="form-control"
                                            placeholder="Digite el nombre"
                                            value="{{ isset($empleado) ? $empleado->nombres : old('nombres') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="apellidos" class="form-label">Apellidos</label>
                                        <input type="text" name="apellidos" class="form-control"
                                            placeholder="Digite los apellidos"
                                            value="{{ isset($empleado) ? $empleado->apellidos : old('apellidos') }}"
                                            required>
                                    </div>
                                    <!-- Sexo -->
                                    <div class="mb-3">
                                        <label for="sexo" class="form-label">Sexo</label>
                                        <select name="sexo" class="form-control" required>
                                            <option value="">Seleccione una opcion</option>
                                            <option value="M"
                                                {{ isset($empleado) && $empleado->sexo == 'M' ? 'selected' : '' }}>Masculino
                                            </option>
                                            <option value="F"
                                                {{ isset($empleado) && $empleado->sexo == 'F' ? 'selected' : '' }}>Femenino
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                                        <input type="date" name="fecha_ingreso" class="form-control"
                                            value="{{ isset($empleado) ? $empleado->fecha_ingreso : old('fecha_ingreso') }}"
                                            required>
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
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-outline-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Sexo</th>
                        <th>Fecha de Ingreso</th>
                        <th>Cargo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empleados as $empleado)
                        <tr>
                            <td>{{ $empleado->id }}</td>
                            <td>{{ $empleado->nombres }} {{ $empleado->apellidos }}</td>
                            <td>
                                <span class="badge {{ $empleado->sexo == 'M' ? 'bg-primary' : 'bg-pink' }}">
                                    {{ $empleado->sexo == 'M' ? 'Masculino' : 'Femenino' }}
                                </span>
                            </td>
                            <td>{{ $empleado->fecha_ingreso }}</td>
                            <td>{{ $empleado->cargo->cargo }}</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-outline-primary btn-sm me-1 btn-edit"
                                    data-id="{{ $empleado->id }}" data-nombres="{{ $empleado->nombres }}"
                                    data-apellidos="{{ $empleado->apellidos }}" data-sexo="{{ $empleado->sexo }}"
                                    data-fecha_ingreso="{{ $empleado->fecha_ingreso }}"
                                    data-cargo_id="{{ $empleado->cargo_id }}" data-bs-toggle="modal"
                                    data-bs-target="#modalEditarEmpleado">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                </a>
                                <button type="button" class="btn btn-outline-danger btn-sm me-1 btn-delete"
                                    data-id="{{ $empleado->id }}" data-nombres="{{ $empleado->nombres }}"
                                    data-apellidos="{{ $empleado->apellidos }}" data-bs-toggle="modal"
                                    data-bs-target="#modalEliminarEmpleado">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                                <a href="{{ route('empleados.historial', $empleado->id) }}"
                                    class="btn btn-outline-info btn-sm me-1">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('empleados.aumento.create', $empleado->id) }}"
                                    class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Modal para Editar Empleado -->
            <div class="modal fade" id="modalEditarEmpleado" tabindex="-1" aria-labelledby="modalEditarEmpleadoLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditarEmpleadoLabel">Editar Empleado</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formEditarEmpleado" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="edit-nombres" class="form-label">Nombres</label>
                                        <input type="text" name="nombres" id="edit-nombres" class="form-control"
                                            value="" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="edit-apellidos" class="form-label">Apellidos</label>
                                        <input type="text" name="apellidos" id="edit-apellidos" class="form-control"
                                            value="" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="edit-sexo" class="form-label">Sexo</label>
                                        <select name="sexo" id="edit-sexo" class="form-control" required>
                                            <option value="M">Masculino</option>
                                            <option value="F">Femenino</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="edit-fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                                        <input type="date" name="fecha_ingreso" id="edit-fecha_ingreso"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="edit-cargo_id" class="form-label">Cargo</label>
                                        <select name="cargo_id" id="edit-cargo_id" class="form-control" required>
                                            @foreach ($cargos as $cargo)
                                                <option value="{{ $cargo->id }}">{{ $cargo->cargo }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-secondary me-2"
                                        data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para Confirmar Eliminación de Empleado -->
            <div class="modal fade" id="modalEliminarEmpleado" tabindex="-1"
                aria-labelledby="modalEliminarEmpleadoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEliminarEmpleadoLabel">Eliminar Empleado</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que deseas eliminar el registro de <strong
                                id="empleadoEliminarNombre"></strong>?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form id="formEliminarEmpleado" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="d-flex justify-content-center">
            {{ $empleados->links('pagination::bootstrap-4') }}
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Seleccionar todos los botones de editar
            var editButtons = document.querySelectorAll('.btn-edit');

            editButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Obtener los datos del empleado del botón
                    var id = this.getAttribute('data-id');
                    var nombres = this.getAttribute('data-nombres');
                    var apellidos = this.getAttribute('data-apellidos');
                    var sexo = this.getAttribute('data-sexo');
                    var fecha_ingreso = this.getAttribute('data-fecha_ingreso');
                    var cargo_id = this.getAttribute('data-cargo_id');

                    // Asignar los datos al formulario del modal
                    document.getElementById('edit-nombres').value = nombres;
                    document.getElementById('edit-apellidos').value = apellidos;
                    document.getElementById('edit-sexo').value = sexo;
                    document.getElementById('edit-fecha_ingreso').value = fecha_ingreso;
                    document.getElementById('edit-cargo_id').value = cargo_id;

                    // Cambiar la acción del formulario para la edición
                    var form = document.getElementById('formEditarEmpleado');
                    form.action = '/empleados/' + id; // Ruta de actualización de empleado
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Seleccionar todos los botones de eliminar //
            var deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    // Obtener los datos del empleado del botón
                    var id = this.getAttribute('data-id');
                    var nombres = this.getAttribute('data-nombres');
                    var apellidos = this.getAttribute('data-apellidos');

                    // Mostrar el nombre del empleado en el modal //
                    document.getElementById('empleadoEliminarNombre').textContent = nombres + ' ' +
                        apellidos;

                    // Cambiar la acción del formulario de eliminación //
                    var form = document.getElementById('formEliminarEmpleado');
                    form.action = '/empleados/' + id;
                });
            });
        });
    </script>

@endsection
