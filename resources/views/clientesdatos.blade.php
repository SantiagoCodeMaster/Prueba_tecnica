<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Datos de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <style>
        .card {
            max-width: 1000px;
            margin: 2rem auto;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
        .header-bg {
            background-color: #f8f9fa;
        }
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }
            .btn {
                margin: 5px 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header header-bg">
                <h3 class="mb-0">Listado de Clientes</h3>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cédula</th>
                                <th>Celular</th>
                                <th>Correo</th>
                                <th>Departamento</th>
                                <th>Ciudad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->Nombre }}</td>
                                <td>{{ $cliente->Apellido }}</td>
                                <td>{{ $cliente->Cedula }}</td>
                                <td>{{ $cliente->Celular }}</td>
                                <td>{{ $cliente->Correo_Electrónico }}</td>
                                <td>{{ $cliente->departamento->nombre ?? 'N/A' }}</td>
                                <td>{{ $cliente->ciudad->nombre ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between mt-4 gap-2 flex-wrap">
                    <!-- Download Excel button -->
                    <a href="{{ route('export.excel') }}" class="btn btn-outline-success flex-fill">
                        <i class="bi bi-file-earmark-excel me-2"></i>Descargar Excel
                    </a>

                    <!-- Download Excel button from Frontend -->
                    <button id="descargarExcelFrontend" class="btn btn-outline-success flex-fill">
                        <i class="bi bi-file-earmark-excel me-2"></i>Descargar Excel (Frontend)
                    </button>

                    <!-- Back button -->
                    <a href="{{ route('encuesta') }}" class="btn btn-primary flex-fill">
                        <i class="bi bi-arrow-left me-2"></i>Volver
                    </a>

                    <!-- Form to see winner -->
                    <form id="seleccionarGanadorForm" method="POST" action="{{ route('seleccionar.ganador') }}" class="flex-fill">
                        @csrf
                        <button type="submit" class="btn btn-outline-success w-100">
                            <i class="bi bi-trophy me-2"></i>Ver si gané
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal to show winner -->
    <div class="modal fade" id="modalGanador" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-trophy me-2"></i>¡Felicidades al ganador!
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h4 id="nombreGanador"></h4>
                        <p class="mb-1" id="cedulaGanador"></p>
                        <p class="mb-1" id="ubicacionGanador"></p>
                        <p class="mb-0" id="correoGanador"></p>
                        <p class="text-success mt-2"><i class="bi bi-star-fill"></i> ¡Felicidades!  ganaste una Toyota Hilux, <i class="bi bi-star-fill"></i></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('seleccionarGanadorForm').addEventListener('submit', function(event) {
            event.preventDefault();

            fetch("{{ route('seleccionar.ganador') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    document.getElementById('nombreGanador').textContent = data.ganador.Nombre + ' ' + data.ganador.Apellido;
                    document.getElementById('cedulaGanador').textContent = 'Cédula: ' + data.ganador.Cedula;
                    document.getElementById('ubicacionGanador').textContent = data.ciudad + ', ' + data.departamento;
                    document.getElementById('correoGanador').textContent = data.ganador.Correo_Electrónico;

                    const modal = new bootstrap.Modal(document.getElementById('modalGanador'));
                    modal.show();
                }
            })
            .catch(error => console.error('Error:', error));
        });

        document.getElementById('descargarExcelFrontend').addEventListener('click', function() {
            // Get the data from the table
            const table = document.querySelector('table');
            const rows = table.querySelectorAll('tr');

            // Create an array to store the data
            const data = [];

            // Iterate over the rows of the table
            rows.forEach(row => {
                const rowData = [];
                const cells = row.querySelectorAll('td, th');

                // Iterate over the cells in the row
                cells.forEach(cell => {
                    rowData.push(cell.textContent);
                });

                data.push(rowData);
            });

            // Create a new Excel workbook
            const workbook = XLSX.utils.book_new();
            const worksheet = XLSX.utils.aoa_to_sheet(data);

            // Aadd the worksheet to the workbook
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Clientes');

            // Download the Excel file
            XLSX.writeFile(workbook, 'Clientes.xlsx');
        });
    </script>
</body>
</html>
