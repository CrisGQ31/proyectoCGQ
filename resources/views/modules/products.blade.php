@extends('layouts.dashboard')

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Listado de Productos</h3>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Formulario para crear un producto -->
        <div class="box-body">
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre del Producto</label>
                    <input type="text" id="name" name="name" class="form-control" required placeholder="Nombre del producto">
                </div>
                <div class="form-group">
                    <label for="price">Precio</label>
                    <input type="text" id="price" name="price" class="form-control" required placeholder="Precio del producto">
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" id="stock" name="stock" class="form-control" required placeholder="Cantidad disponible">
                </div>
                <button type="submit" class="btn btn-primary">Crear Producto</button>
            </form>
        </div>

        <!-- Listado de productos -->
        <div class="box-body">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay productos registrados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

