<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual - Traductores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h1 class="h2 text-primary fw-bold mb-0">📚 Biblioteca Virtual</h1>
            <nav class="d-flex gap-2">
                <a href="{{ route('libros.index') }}" class="btn btn-sm btn-outline-secondary">Libros</a>
                <a href="{{ route('autores.index') }}" class="btn btn-sm btn-outline-secondary">Autores</a>
                <a href="{{ route('editores.index') }}" class="btn btn-sm btn-outline-secondary">Editoriales</a>
            </nav>
            <a href="{{ route('traductores.create') }}" class="btn btn-success">+ Registrar Nuevo Traductor</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">Foto</th>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Idioma Nativo</th>
                                <th>Idiomas de Traducción</th>
                                <th>Certificaciones</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($traductores as $traductor)
                                <tr>
                                    <td class="text-center" style="width: 80px;">
                                        @if($traductor->img_traductores)
                                            <img src="{{ asset('storage/' . $traductor->img_traductores) }}" alt="{{ $traductor->Nombre }}" class="img-thumbnail rounded" style="width: 50px; height: 70px; object-fit: cover;">
                                        @else
                                            <span class="badge bg-secondary">Sin foto</span>
                                        @endif
                                    </td>
                                    <td>{{ $traductor->ID_traductores }}</td>
                                    <td class="fw-bold">{{ $traductor->Nombre }}</td>
                                    <td>{{ $traductor->Apellidos }}</td>
                                    <td>{{ $traductor->idioma_nativo ?? 'N/A' }}</td>
                                    <td>{{ $traductor->idiomas_traduccion ?? 'N/A' }}</td>
                                    <td>{{ $traductor->certificaciones ?? 'N/A' }}</td>
                                    <td class="text-center" style="width: 150px;">
                                        <a href="{{ route('traductores.edit', $traductor->ID_traductores) }}" class="btn btn-sm btn-warning mb-1">Editar</a>

                                        <form action="{{ route('traductores.destroy', $traductor->ID_traductores) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger mb-1" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        No hay traductores registrados en la biblioteca.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
