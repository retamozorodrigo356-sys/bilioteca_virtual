<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Autor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5" style="max-width: 600px;">
        <div class="card shadow border-0">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">✏️ Editar Autor</h4>
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

                <form action="{{ route('autores.update', $autor->ID_autores) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nombre</label>
                        <input type="text" name="Nombre" class="form-control" value="{{ old('Nombre', $autor->Nombre) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Apellidos</label>
                        <input type="text" name="Apellidos" class="form-control" value="{{ old('Apellidos', $autor->Apellidos) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $autor->telefono) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Correo Electrónico</label>
                        <input type="email" name="correo" class="form-control" value="{{ old('correo', $autor->correo) }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Cambiar Foto (`img_autores`)</label>
                        <div class="mb-2">
                            <img id="imgPreview" width="70" class="img-thumbnail rounded"
                                src="{{ $autor->img_autores ? asset('storage/' . $autor->img_autores) : '' }}"
                                alt="Foto actual"
                                style="{{ $autor->img_autores ? '' : 'display:none;' }}">
                        </div>
                        <input type="file" id="img_autores" name="img_autores" class="form-control" accept="image/*">
                        @if($autor->img_autores)
                            <small class="text-muted">Si no seleccionas una nueva imagen, se conservará la foto actual.</small>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('autores.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-warning">Actualizar Autor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('img_autores').addEventListener('change', function (e) {
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
