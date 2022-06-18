<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		<div class="sidebar-wrapper" data-simplebar="true">
			<div class="sidebar-header">
				<div>
					<img src="{{route('home')}}/assets/images/u-import.png" class="logo-icon" alt="logo icon">
				</div>
			</div>
			<!--navigation-->
			<ul class="metismenu" id="menu">
				<li>
					<a href="{{route('home')}}" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-home-circle'></i>
						</div>
						<div class="menu-title">Dashboard</div>
					</a>
					<ul>
						<li> <a href="{{route('import.shipment')}}"><i class="bx bx-right-arrow-alt"></i>Import</a>
						</li>
						<li> <a href="{{route('import.list')}}"><i class="bx bx-right-arrow-alt"></i>List</a>
						</li>
					</ul>
				</li>
			
			</ul>
			<!--end navigation-->
		</div>
		<!--end sidebar wrapper -->
		<!--start header -->
		<header>
			<div class="topbar d-flex align-items-center">
				<nav class="navbar navbar-expand">
					
					<div class="top-menu ms-auto">
						
					</div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="{{route('home')}}/assets/images/avatars/pp.jpg" class="user-img" alt="user avatar">
							<div class="user-info ps-3">
								<p class="user-name mb-0">Silas Campos</p>
								<p class="designattion mb-0">DEV</p>
							</div>
						</a>
					</div>
				</nav>
			</div>
		</header>