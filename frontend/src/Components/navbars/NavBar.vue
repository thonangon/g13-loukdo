<template>
  <div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-dark border-right" id="sidebar-wrapper">
      <div class="sidebar-heading text-light">Admin Dashboard</div>
      <div class="list-group list-group-flush">
        <router-link to="/admin/overview" class="list-group-item list-group-item-action bg-dark text-light">
          <i class="bi bi-house me-2"></i> Overview
        </router-link>
        <router-link to="/admin/orders" class="list-group-item list-group-item-action bg-dark text-light">
          <i class="bi bi-cart-dash me-2"></i> Orders
        </router-link>
        <router-link to="/admin/products" class="list-group-item list-group-item-action bg-dark text-light">
          <i class="bi bi-box me-2"></i> Products
        </router-link>
        <router-link to="/admin/customers" class="list-group-item list-group-item-action bg-dark text-light">
          <i class="bi bi-person-lines-fill me-2"></i> Customers
        </router-link>
        <router-link to="/admin/reports" class="list-group-item list-group-item-action bg-dark text-light">
          <i class="bi bi-bar-chart me-2"></i> Reports
        </router-link>
        <router-link to="/admin/settings" class="list-group-item list-group-item-action bg-dark text-light">
          <i class="bi bi-gear me-2"></i> Settings
        </router-link>
        <router-link to="/logout" class="list-group-item list-group-item-action bg-dark text-light">
          <i class="bi bi-box-arrow-right me-2"></i> Logout
        </router-link>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <b-navbar toggleable="lg" type="light" variant="light" class="border-bottom bg-white shadow-sm">
        <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>
        <b-navbar-brand href="#">Admin Dashboard</b-navbar-brand>
        <b-collapse id="nav-collapse" is-nav>
          <b-navbar-nav class="ml-auto d-flex align-items-center">
            <b-nav-item class="mx-3 position-relative">
              <i class="bi bi-bell" style="font-size: 1.5rem;"></i>
              <span class="badge badge-danger position-absolute top-0 start-100 translate-middle">3</span>
            </b-nav-item>
            <b-nav-item-dropdown right>
              <template #button-content>
                <em>Admin</em>
              </template>
              <b-dropdown-item href="#">Profile</b-dropdown-item>
              <b-dropdown-item href="#">Settings</b-dropdown-item>
              <b-dropdown-item href="#">Logout</b-dropdown-item>
            </b-nav-item-dropdown>
          </b-navbar-nav>
        </b-collapse>
      </b-navbar>

      <div class="container-fluid mt-4">
        <router-view></router-view>
      </div>
    </div>
    <!-- /#page-content-wrapper -->
  </div>
</template>

<script>
export default {
  name: 'AdminLayout'
};
</script>

<style scoped>
#wrapper {
  display: flex;
  align-items: stretch;
}

#sidebar-wrapper {
  min-height: 100vh;
  width: 250px;
  background-color: #232f3e;
}

#sidebar-wrapper .sidebar-heading {
  padding: 1rem 1.25rem;
  font-size: 1.5rem;
  color: #fff;
}

#sidebar-wrapper .list-group {
  width: 100%;
}

#sidebar-wrapper .list-group-item {
  background-color: #232f3e;
  color: #fff;
  border: none;
}

#sidebar-wrapper .list-group-item:hover {
  background-color: #37475a;
}

#page-content-wrapper {
  flex: 1;
  padding: 20px;
  background-color: #f8f9fa;
}

.b-navbar {
  background-color: #fff !important;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.b-nav-item .badge {
  font-size: 0.75rem;
  background-color: #dc3545;
  color: #fff;
}

.position-relative {
  position: relative;
}

.position-absolute {
  position: absolute;
}

.top-0 {
  top: 0;
}

.start-100 {
  left: 100%;
}

.translate-middle {
  transform: translate(-50%, -50%);
}

.me-2 {
  margin-right: 0.5rem;
}
</style>
