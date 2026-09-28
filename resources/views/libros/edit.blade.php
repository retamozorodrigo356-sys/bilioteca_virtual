<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Libro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5" style="max-width: 700px;">
        <div class="card shadow border-0">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">✏️ Editar Libro</h4>
            </div>
            <div class="card-body p-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('libros.update', $libro->ID_libro) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Título del Libro</label>
                        <input type="text" name="Titulo" class="form-control" value="{{ $libro->Titulo }}" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tipo</label>
                            <input type="text" name="Tipo" class="form-control" value="{{ $libro->Tipo }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Género</label>
                            <input type="text" name="genero" class="form-control" value="{{ $libro->genero }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Autor</label>
                        <select name="ID_autor" class="form-select" required>
                            @foreach($autores as $autor)
                                <option value="{{ $autor->ID_autores }}" {{ $libro->ID_autor == $autor->ID_autores ? 'selected' : '' }}>
                                    {{ $autor->Nombre }} {{ $autor->Apellidos }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Editor / Editorial</label>
                        <select name="ID_editor" class="form-select" required>
                            @foreach($editores as $editor)
                                <option value="{{ $editor->ID_editores }}" {{ $libro->ID_editor == $editor->ID_editores ? 'selected' : '' }}>
                                    {{ $editor->Nombre }} {{ $editor->Apellidos }}{{ $editor->nombre_editorial ? ' (' . $editor->nombre_editorial . ')' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Traductor</label>
                        <select name="ID_traductor" class="form-select" required>
                            @foreach($traductores as $traductor)
                                <option value="{{ $traductor->ID_traductores }}" {{ $libro->ID_traductor == $traductor->ID_traductores ? 'selected' : '' }}>
                                    {{ $traductor->Nombre }} {{ $traductor->Apellidos }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Cambiar Portada (`img_libros`)</label>
                        <div class="mb-2">
                            <img id="imgPreview" width="70" class="img-thumbnail rounded"
                                src="{{ $libro->img_libros ? asset('storage/' . $libro->img_libros) : '' }}"
                                alt="Portada actual"
                                style="{{ $libro->img_libros ? '' : 'display:none;' }}">
                        </div>
                        <input type="file" id="img_libros" name="img_libros" class="form-control" accept="image/*">
                        @if($libro->img_libros)
                            <small class="text-muted">Si no seleccionas una nueva imagen, se conservará la portada actual.</small>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('libros.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-warning">Actualizar Libro</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('img_libros').addEventListener('change', function (e) {
            const preview = document.getElementById('imgPreview');
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (ev) {
                    preview.src = ev.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
