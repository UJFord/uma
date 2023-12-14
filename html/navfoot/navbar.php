<!-- VARIABLES -->
<?php
// current page
$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- HTML -->
<nav id="nav" class="navbar sticky-top navbar-expand-lg bg-success navbar-dark">
	<div class="container">
		<!-- changing src path depending on the current page -->
		<a href="<?php echo ($current_page != 'index.php')? '../index.php' : '#';?>" class="navbar-brand">
			<!-- changing src path depending on the current page -->
			<img src="<?php echo ($current_page == 'index.php')? 'img/logo/umalogo.png' : '../img/logo/umalogo.png';?>" class="me-2" height="54" alt="Uma Logo" loading="lazy" />
		</a>

		<!-- search -->
		<div id="nav-search" class="p-2 rounded-pill w-auto">
			<i class="px-1 fa-solid fa-magnifying-glass"></i>
			<input type="text" placeholder="Search Uma" />
		</div>

		<!-- button for mobile -->
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">
			<span class="navbar-toggler-icon"></span>
		</button>

		<!-- links -->
		<div class="collapse navbar-collapse" id="navmenu">
			<ul class="navbar-nav ms-auto">
				<li class="nav-item">
					<a href="#" class="nav-link">Sarangani</a>
				</li>
				<li class="nav-item">
					<a href="/uma/html/tribes.php" class="nav-link">People</a>
				</li>
				<li class="nav-item">
					<a href="/uma/html/crops.php" class="nav-link">Traditional Crops</a>
				<li class="nav-item">
					<a href="/uma/html/practices.php" class="nav-link">Practices</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">Sources</a>
				</li>
			</ul>
		</div>
	</div>
</nav>