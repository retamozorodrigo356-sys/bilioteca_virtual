<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Traductor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5" style="max-width: 600px;">
        <div class="card shadow border-0">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">🌐 Registrar Nuevo Traductor</h4>
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

                <form action="{{ route('traductores.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nombre</label>
                        <input type="text" name="Nombre" class="form-control" value="{{ old('Nombre') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Apellidos</label>
                        <input type="text" name="Apellidos" class="form-control" value="{{ old('Apellidos') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Idioma Nativo</label>
                        <input type="text" name="idioma_nativo" class="form-control" value="{{ old('idioma_nativo') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Idiomas de Traducción</label>
                        <input type="text" name="idiomas_traduccion" class="form-control" value="{{ old('idiomas_traduccion') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Certificaciones</label>
                        <input type="number" name="certificaciones" class="form-control" value="{{ old('certificaciones') }}">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Foto del Traductor (`img_traductores`)</label>
                        <div class="mb-2">
                            <img id="imgPreview" src="" alt="Vista previa" class="img-thumbnail rounded" style="width: 70px; display: none;">
                        </div>
                        <input type="file" id="img_traductores" name="img_traductores" class="form-control" accept="image/*">
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('traductores.index') }}" class="btn btn-secondary">Volver</a>
                        <button type="submit" class="btn btn-success">Guardar Traductor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('img_traductores').addEventListener('change', function (e) {
            const preview = document.getElementById('imgPreview');
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (ev) {
                    preview.src = ev.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        });
    </script>
</body>
</html>
