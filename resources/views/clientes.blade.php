<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Formulario de Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            max-width: 800px;
            margin: 2rem auto;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-label.required:after {
            content: "*";
            color: #dc3545;
            margin-left: 3px;
        }
        #responseMessage {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            max-width: 400px;
        }
        .loading-cities {
            color: #6c757d;
            font-style: italic;
        }
        .btn-submit {
            transition: all 0.3s ease;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0 text-center">Formulario de Registro</h3>
            </div>
            
            <div class="card-body">
                <form method="POST" action="{{ route('encuesta.store') }}" id="registrationForm">
                    @csrf
                    
                    <div class="row g-4">
                        <!-- Name -->
                        <div class="col-md-6">
                            <label class="form-label required">Nombre</label>
                            <input type="text" name="Nombre" class="form-control" 
                                   pattern="[A-Za-záéíóúÁÉÍÓÚñÑ ]+" 
                                   title="Solo se permiten letras y espacios" required>
                        </div>

                        <!-- LastName -->
                        <div class="col-md-6">
                            <label class="form-label required">Apellido</label>
                            <input type="text" name="Apellido" class="form-control" 
                                   pattern="[A-Za-záéíóúÁÉÍÓÚñÑ ]+" 
                                   title="Solo se permiten letras y espacios" required>
                        </div>

                        <!-- Cédula -->
                        <div class="col-md-6">
                            <label class="form-label required">Cédula</label>
                            <input type="number" name="Cedula" class="form-control" 
                                   min="0" required>
                        </div>

                        <!-- Departamento -->
                        <div class="col-md-6">
                            <label class="form-label required">Departamento</label>
                            <select name="departamento_id" id="departamentoSelect" 
                                    class="form-select" required>
                                <option value="" selected disabled>Seleccione un departamento</option>
                                @foreach($departamentos as $departamento)
                                    <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- City-->
                        <div class="col-md-6">
                            <label class="form-label required">Ciudad</label>
                            <select name="ciudad_id" id="ciudadSelect" class="form-select" 
                                    required disabled>
                                <option value="" selected disabled>Seleccione un departamento primero</option>
                            </select>
                        </div>

                        <!-- TelePhone -->
                        <div class="col-md-6">
                            <label class="form-label required">Celular</label>
                            <input type="number" name="Celular" class="form-control" required>
                        </div>

                        <!-- Email -->
                        <div class="col-md-12">
                            <label class="form-label required">Correo Electrónico</label>
                            <input type="email" name="Correo_Electrónico" 
                                   class="form-control" required>
                        </div>

                        <!-- Habeas Data -->
                        <div class="col-12 mt-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       id="habeasData" required>
                                <label class="form-check-label" for="habeasData">
                                    Autorizo el tratamiento de mis datos de acuerdo con la 
                                    <a href="#" target="_blank" class="text-decoration-none">política de protección de datos</a>
                                </label>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary w-100 py-2 btn-submit">
                                <span class="spinner-border spinner-border-sm d-none" role="status"></span>
                                Registrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Response messages -->
    <div id="responseMessage"></div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Load cities when department changes
            $('#departamentoSelect').change(function() {
                const departamentoId = $(this).val();
                const $ciudadSelect = $('#ciudadSelect');
                
                if (departamentoId) {
                    $ciudadSelect.prop('disabled', true).html(
                        '<option class="loading-cities" value="" selected disabled>Cargando ciudades...</option>'
                    );

                    $.ajax({
                        url: `/ciudades/${departamentoId}`,
                        type: 'GET',
                        success: function(data) {
                            if(data.length > 0) {
                                $ciudadSelect.prop('disabled', false).html(
                                    '<option value="" selected disabled>Seleccione una ciudad</option>'
                                );
                                
                                data.forEach(ciudad => {
                                    $ciudadSelect.append(
                                        `<option value="${ciudad.id}">${ciudad.nombre}</option>`
                                    );
                                });
                            } else {
                                $ciudadSelect.html(
                                    '<option value="" selected disabled>No se encontraron ciudades</option>'
                                );
                            }
                        },
                        error: function() {
                            $ciudadSelect.html(
                                '<option value="" selected disabled>Error al cargar ciudades</option>'
                            );
                        }
                    });
                } else {
                    $ciudadSelect.prop('disabled', true).html(
                        '<option value="" selected disabled>Seleccione un departamento primero</option>'
                    );
                }
            });
        });
    </script>
</body>
</html>
