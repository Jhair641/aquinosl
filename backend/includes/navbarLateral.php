<nav id="sidebar" class="sidebar js-sidebar">
	<div class="sidebar-content js-simplebar">
		<a class="sidebar-brand" href="index.html">
			<span class="align-middle">AQUINO SL</span>
		</a>
		<ul class="sidebar-nav">
			<li class="sidebar-header">
				Paginas
			</li>
			<li class="sidebar-item active">
				<a class="sidebar-link" onclick="loadPage('clientes')">
					<i class="align-middle" data-feather="user-plus"></i>
					<span class="align-middle">Clientes</span>
				</a>
			</li>
			<li class="sidebar-item">
				<a class="sidebar-link" onclick="loadPage('empleados')">
					<i class="align-middle" data-feather="users"></i>
					<span class="align-middle">Empleados</span>
				</a>
			</li>
			<li class="sidebar-item">
				<a class="sidebar-link" onclick="loadPage('cargas')">
					<i class="align-middle" data-feather="package"></i>
					<span class="align-middle">Cargas</span>
				</a>
			</li>
			<li class="sidebar-item">
				<a class="sidebar-link" onclick="loadPage('vehiculos')">
					<i class="align-middle" data-feather="truck"></i>
					<span class="align-middle">Vehiculos</span>
				</a>
			</li>
		</ul>
	</div>
</nav>

<script>
	function loadPage(page) {
		// Hacer la solicitud para obtener la página
		fetch(`./includes/pages/${page}.php`)
			.then(response => {
				if (!response.ok) throw new Error(`Error al cargar la página: ${response.status}`);
				return response.text();
			})
			.then(html => {
				// Reemplazar el contenido dinámico
				document.getElementById('content').innerHTML = html;

				// Reinicializar modales después de actualizar el DOM
				const modals = document.querySelectorAll('.modal');
				modals.forEach(modal => {
					new bootstrap.Modal(modal); // Re-inicializa el modal con la configuración por defecto
				});

				// Reemplazar íconos Feather si estás usándolos
				feather.replace();

				// Actualizar la clase 'active' en la barra lateral
				updateActiveSidebar(page);
			})
			.catch(error => console.error('Error cargando la página:', error));
	}
	
	// Función para actualizar el enlace activo en la barra lateral
	function updateActiveSidebar(page) {
		// Eliminar la clase 'active' de todos los elementos de la barra lateral
		document.querySelectorAll('.sidebar-item').forEach(item => item.classList.remove('active'));

		// Agregar la clase 'active' al elemento correspondiente
		const activeItem = document.querySelector(`.sidebar-item .sidebar-link[onclick="loadPage('${page}')"]`);
		if (activeItem) {
			activeItem.closest('.sidebar-item').classList.add('active');
		}
	}
</script>

