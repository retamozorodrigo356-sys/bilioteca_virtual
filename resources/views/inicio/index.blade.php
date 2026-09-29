<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual - IEST César Augusto Guardia Mayorga</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ route('inicio') }}">
                <img src="{{ asset('images/logo-iest.jpg') }}" alt="Logo IEST César Augusto Guardia Mayorga" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                <span>Biblioteca Virtual</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-label="Menú">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="{{ route('inicio') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('libros.index') }}">Libros</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('autores.index') }}">Autores</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('editores.index') }}">Editoriales</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('traductores.index') }}">Traductores</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <img src="{{ asset('images/logo-iest.jpg') }}" alt="Logo IEST César Augusto Guardia Mayorga" class="rounded-circle shadow mb-3" style="width: 110px; height: 110px; object-fit: cover; border: 4px solid #fff;">
            <p class="text-uppercase fw-semibold mb-1" style="letter-spacing: 2px;">IEST César Augusto Guardia Mayorga</p>
            <h1 class="display-4 fw-bold">¡Bienvenido a la Biblioteca Virtual!</h1>
            <p class="lead mb-4 mx-auto" style="max-width: 700px;">
                Explora nuestro catálogo de libros, autores, editoriales y traductores de la institución.
                Todo el contenido de la biblioteca, al alcance de un clic.
            </p>
            <a href="{{ route('libros.index') }}" class="btn btn-light btn-lg me-2">Ver catálogo completo</a>
            <a href="{{ route('libros.create') }}" class="btn btn-outline-light btn-lg">+ Registrar libro</a>
        </div>
    </header>

    <main class="container py-5">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
            <h2 class="h3 fw-bold mb-0">📖 Algunos libros de nuestro catálogo</h2>
            <a href="{{ route('libros.index') }}" class="btn btn-sm btn-outline-primary">Ver todos</a>
        </div>

        @if($libros->isEmpty())
            <div class="alert alert-info text-center py-4">
                Todavía no hay libros registrados.
                <a href="{{ route('libros.create') }}" class="alert-link">¡Sé el primero en agregar uno!</a>
            </div>
        @else
            <div class="row g-4">
                @foreach($libros as $libro)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card h-100 shadow-sm border-0">
                            @if($libro->img_libros)
                                <img src="{{ asset('storage/' . $libro->img_libros) }}" class="card-img-top" alt="{{ $libro->Titulo }}" style="height: 260px; object-fit: cover;">
                            @else
                                <div class="card-img-top bg-secondary-subtle d-flex align-items-center justify-content-center text-muted" style="height: 260px; font-size: 3rem;">📚</div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h3 class="h6 fw-bold mb-1">{{ $libro->Titulo }}</h3>
                                <p class="small text-muted mb-2">
                                    {{ trim(($libro->autor->Nombre ?? '') . ' ' . ($libro->autor->Apellidos ?? '')) ?: 'Autor no registrado' }}
                                </p>
                                <div class="mt-auto d-flex flex-wrap gap-1">
                                    <span class="badge bg-info text-dark">{{ $libro->Tipo }}</span>
                                    @if($libro->genero)
                                        <span class="badge bg-secondary">{{ $libro->genero }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>

    <footer class="bg-dark text-white text-center py-4">
        <p class="mb-1">IEST César Augusto Guardia Mayorga &middot; Biblioteca Virtual &copy; {{ date('Y') }}</p>
        <p class="mb-0"><a href="{{ route('libros.index') }}" class="text-white text-decoration-underline">Ir al catálogo</a></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
