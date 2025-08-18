<!-- Sidebar Nav -->
<aside id="sidebar" class="js-custom-scroll side-nav">
<ul id="sideNav" class="side-nav-menu side-nav-menu-top-level mb-0">
  <!-- Title -->
  <li class="sidebar-heading h6">Dashboard</li>
  <!-- End Title -->

  <!-- Dashboard -->
  <li class="side-nav-menu-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
	<a class="side-nav-menu-link media align-items-center" href="{{ route('dashboard') }}">
	  <span class="side-nav-menu-icon d-flex mr-3">
		<i class="gd-dashboard"></i>
	  </span>
	  <span class="side-nav-fadeout-on-closed media-body">Dashboard</span>
	</a>
  </li>
  <!-- End Dashboard -->

  <!-- Title -->
  <li class="sidebar-heading h6">Management</li>
  <!-- End Title -->

  <!-- Categories -->
  <li class="side-nav-menu-item side-nav-has-menu {{ Request::is('admin/categories*') ? 'active' : '' }}">
	<a class="side-nav-menu-link media align-items-center" href="#"
	   data-target="#subCategories">
	  <span class="side-nav-menu-icon d-flex mr-3">
		<i class="gd-folder"></i>
	  </span>
	  <span class="side-nav-fadeout-on-closed media-body">Categories</span>
	  <span class="side-nav-control-icon d-flex">
		<i class="gd-angle-right side-nav-fadeout-on-closed"></i>
	  </span>
	  <span class="side-nav__indicator side-nav-fadeout-on-closed"></span>
	</a>

	<!-- Categories: sub -->
	<ul id="subCategories" class="side-nav-menu side-nav-menu-second-level mb-0">
	  <li class="side-nav-menu-item {{ Request::is('admin/categories') ? 'active' : '' }}">
		<a class="side-nav-menu-link" href="{{ route('category.index') }}">All Categories</a>
	  </li>
	  <li class="side-nav-menu-item {{ Request::is('admin/categories/create') ? 'active' : '' }}">
		<a class="side-nav-menu-link" href="{{ route('category.create') }}">Add Category</a>
	  </li>
	</ul>
	<!-- Categories: sub -->
  </li>
  <!-- End Categories -->

  <!-- Products -->
  <li class="side-nav-menu-item side-nav-has-menu {{ Request::is('admin/products*') ? 'active' : '' }}">
	<a class="side-nav-menu-link media align-items-center" href="#"
	   data-target="#subProducts">
	  <span class="side-nav-menu-icon d-flex mr-3">
		<i class="gd-package"></i>
	  </span>
	  <span class="side-nav-fadeout-on-closed media-body">Products</span>
	  <span class="side-nav-control-icon d-flex">
		<i class="gd-angle-right side-nav-fadeout-on-closed"></i>
	  </span>
	  <span class="side-nav__indicator side-nav-fadeout-on-closed"></span>
	</a>

	<!-- Products: sub -->
	<ul id="subProducts" class="side-nav-menu side-nav-menu-second-level mb-0">
	  <li class="side-nav-menu-item {{ Request::is('admin/products') ? 'active' : '' }}">
		<a class="side-nav-menu-link" href="{{ route('product.index') }}">All Products</a>
	  </li>
	  <li class="side-nav-menu-item {{ Request::is('admin/products/create') ? 'active' : '' }}">
		<a class="side-nav-menu-link" href="{{ route('product.create') }}">Add Product</a>
	  </li>
	</ul>
	<!-- Products: sub -->
  </li>
  <!-- End Products -->

  <!-- Users -->
  <li class="side-nav-menu-item side-nav-has-menu {{ Request::is('admin/users*') ? 'active' : '' }}">
	<a class="side-nav-menu-link media align-items-center" href="#"
	   data-target="#subLayouts">
	  <span class="side-nav-menu-icon d-flex mr-3">
		<i class="gd-user"></i>
	  </span>
	  <span class="side-nav-fadeout-on-closed media-body">Users</span>
	  <span class="side-nav-control-icon d-flex">
		<i class="gd-angle-right side-nav-fadeout-on-closed"></i>
	  </span>
	  <span class="side-nav__indicator side-nav-fadeout-on-closed"></span>
	</a>

	<!-- Users: sub -->
	<ul id="subLayouts" class="side-nav-menu side-nav-menu-second-level mb-0">
	  <li class="side-nav-menu-item {{ Request::is('admin/users') ? 'active' : '' }}">
		<a class="side-nav-menu-link" href="{{ route('user.index') }}">All Users</a>
	  </li>
	  <li class="side-nav-menu-item {{ Request::is('admin/users/create') ? 'active' : '' }}">
		<a class="side-nav-menu-link" href="{{ route('user.create') }}">Add User</a>
	  </li>
	</ul>
	<!-- Users: sub -->
  </li>
  <!-- End Users -->

</ul>
</aside>
<!-- End Sidebar Nav -->
