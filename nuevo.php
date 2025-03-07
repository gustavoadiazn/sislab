<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario en Tabs</title>
    <style>
        .tab {
            display: none;
        }

        /* Oculta pestañas por defecto */
        .active {
            display: block;
        }

        /* Muestra la pestaña activa */
    </style>
</head>

<body>

    <!-- Menú de Tabs -->
    <button onclick="openTab('tab1')">Formulario 1</button>
    <button onclick="openTab('tab2')">Formulario 2</button>

    <!-- Tab 1 -->
    <div id="tab1" class="tab active">
        <h2>Formulario 1</h2>
        <form id="formDat">
            Nombre: <input type="text" name="nombre" required><br>
            Edad: <input type="number" name="edad" required><br>
        </form>
    </div>

    <!-- Tab 2 -->
    <div id="tab2" class="tab">
        <h2>Formulario 2</h2>
        <form id="form2">
            Correo: <input type="email" name="correo" required><br>
            Teléfono: <input type="tel" name="telefono" required><br>
        </form>
    </div>

    <!-- Botón para guardar todos los formularios -->
    <button onclick="guardarDatos()">Guardar Todo</button>

    <script>
        // Función para cambiar de pestaña
        function openTab(tabId) {
            document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
            document.getElementById(tabId).classList.add('active');
        }

        // Función para guardar los datos de todos los formularios
        function guardarDatos() {
            document.getElementById("formDat").addEventListener("submit", function(event) {
                event.preventDefault(); // Evita el envío normal del formulario

                const formData = new FormData(this); // Captura los datos del formulario

                fetch('guardarDatos.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.text())
                    .then(data => {
                        document.getElementById("mensaje").innerText = data; // Muestra la respuesta
                    })
                    .catch(error => console.error('Error:', error));
            });
        }
    </script>

</body>

</html>