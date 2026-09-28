<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual - Libros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h1 class="h2 text-primary fw-bold mb-0">📚 Biblioteca Virtual</h1>
            <nav class="d-flex gap-2">
                <a href="{{ route('autores.index') }}" class="btn btn-sm btn-outline-secondary">Autores</a>
                <a href="{{ route('editores.index') }}" class="btn btn-sm btn-outline-secondary">Editoriales</a>
                <a href="{{ route('traductores.index') }}" class="btn btn-sm btn-outline-secondary">Traductores</a>
            </nav>
            <a href="{{ route('libros.create') }}" class="btn btn-success">+ Registrar Nuevo Libro</a>
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
                                <th class="text-center">Portada</th>
                                <th>ID</th>
                                <th>Título</th>
                                <th>Tipo</th>
                                <th>Género</th>
                                <th>Autor</th>
                                <th>Editor / Editorial</th>
                                <th>Traductor</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($libros as $libro)
                                <tr>
                                    <td class="text-center" style="width: 80px;">
                                        @if($libro->img_libros)
                                            <img src="{{ asset('storage/' . $libro->img_libros) }}" alt="{{ $libro->Titulo }}" class="img-thumbnail rounded" style="width: 50px; height: 70px; object-fit: cover;">
                                        @else
                                            <span class="badge bg-secondary">Sin foto</span>
                                        @endif
                                    </td>
                                    <td>{{ $libro->ID_libro }}</td>
                                    <td class="fw-bold">{{ $libro->Titulo }}</td>
                                    <td><span class="badge bg-info text-dark">{{ $libro->Tipo }}</span></td>
                                    <td>{{ $libro->genero ?? 'N/A' }}</td>
                                    <td>
                                        @if($libro->autor && $libro->autor->img_autores)
                                            <img src="{{ asset('storage/' . $libro->autor->img_autores) }}" class="rounded-circle me-1" style="width: 28px; height: 28px; object-fit: cover;">
                                        @endif
                                        {{ $libro->autor->Nombre ?? '' }} {{ $libro->autor->Apellidos ?? '' }}
                                    </td>
                                    <td>
                                        @if($libro->editor && $libro->editor->img_editores)
                                            <img src="{{ asset('storage/' . $libro->editor->img_editores) }}" class="rounded-circle me-1" style="width: 28px; height: 28px; object-fit: cover;">
                                        @endif
                                        {{ $libro->editor->Nombre ?? '' }} {{ $libro->editor->Apellidos ?? '' }}
                                        @if(!empty($libro->editor->nombre_editorial))
                                            <small class="text-muted d-block">({{ $libro->editor->nombre_editorial }})</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($libro->traductor && $libro->traductor->img_traductores)
                                            <img src="{{ asset('storage/' . $libro->traductor->img_traductores) }}" class="rounded-circle me-1" style="width: 28px; height: 28px; object-fit: cover;">
                                        @endif
                                        {{ $libro->traductor->Nombre ?? '' }} {{ $libro->traductor->Apellidos ?? '' }}
                                    </td>
                                    <td class="text-center" style="width: 150px;">
                                        <a href="{{ route('libros.edit', $libro->ID_libro) }}" class="btn btn-sm btn-warning mb-1">Editar</a>

                                        <form action="{{ route('libros.destroy', $libro->ID_libro) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger mb-1" onclick="return confirm('¿Estás seguro de que deseas eliminar este registro?')">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4 text-muted">
                                        No hay libros registrados en la biblioteca.
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
