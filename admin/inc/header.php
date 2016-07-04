<!-- Logo -->
<a href="" class="logo" style="font-size:14px"><b>GIS Bengkel Kota Padang</b></a>

<!-- Header Navbar -->
<nav class="navbar navbar-static-top" role="navigation">
<!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
	<span class="sr-only">Toggle navigation</span>
  </a>
  <div class="navbar-custom-menu">
	<ul class="nav navbar-nav">
	  <!-- User Account Menu -->
	  <li class="dropdown user user-menu">
		<!-- Menu Toggle Button -->
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		  <!-- The user image in the navbar-->
		  <img src="dist/img/avatar5.png" class="user-image" alt="User Image"/>
		  <!-- hidden-xs hides the username on small devices so only the image appears. -->
		  <span class="hidden-xs"><?php echo $_SESSION['username']; ?></span>
		</a>
		<ul class="dropdown-menu">
		  <!-- The user image in the menu -->
		  <li class="user-header">
			<img src="dist/img/avatar5.png" class="img-circle" alt="User Image" />
			<p><?php echo $_SESSION['username']; ?></p>
		  </li>
		  <!-- Menu Footer-->
		  <li class="user-footer">
			<div class="pull-left">
			  <a href="index.php?page=profil" class="btn btn-default btn-flat">Profil</a>
			</div>
			<div class="pull-right">
			  <a href="logout.php" class="btn btn-default btn-flat">Keluar</a>
			</div>
		  </li>
		</ul>
	  </li>
	</ul>
  </div>
</nav>
