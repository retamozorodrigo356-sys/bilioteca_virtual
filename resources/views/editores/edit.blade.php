<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Editor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5" style="max-width: 600px;">
        <div class="card shadow border-0">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">✏️ Editar Editor</h4>
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

                <form action="{{ route('editores.update', $editor->ID_editores) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nombre</label>
                        <input type="text" name="Nombre" class="form-control" value="{{ old('Nombre', $editor->Nombre) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Apellidos</label>
                        <input type="text" name="Apellidos" class="form-control" value="{{ old('Apellidos', $editor->Apellidos) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nombre de la Editorial</label>
                        <input type="text" name="nombre_editorial" class="form-control" value="{{ old('nombre_editorial', $editor->nombre_editorial) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">País</label>
                        <input type="text" name="pais" class="form-control" value="{{ old('pais', $editor->pais) }}">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Cambiar Foto (`img_editores`)</label>
                        <div class="mb-2">
                            <img id="imgPreview" width="70" class="img-thumbnail rounded"
                                src="{{ $editor->img_editores ? asset('storage/' . $editor->img_editores) : '' }}"
                                alt="Foto actual"
                                style="{{ $editor->img_editores ? '' : 'display:none;' }}">
                        </div>
                        <input type="file" id="img_editores" name="img_editores" class="form-control" accept="image/*">
                        @if($editor->img_editores)
                            <small class="text-muted">Si no seleccionas una nueva imagen, se conservará la foto actual.</small>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('editores.index') }}" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-warning">Actualizar Editor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('img_editores').addEventListener('change', function (e) {
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
