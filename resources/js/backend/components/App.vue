<template>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <router-link to="/admin/" class="nav-link">Home</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/admin/rooms" class="nav-link">Rooms</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/admin/types" class="nav-link">Room Types</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/admin/capacities" class="nav-link">Room Capacities</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/admin/prices" class="nav-link">Price List</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/admin/bookings" class="nav-link">Bookings</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/admin/customers" class="nav-link">Customers</router-link>
                        </li>
                    </ul>
                </div>
            </nav>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <template v-if="$route.matched.length">
                    <router-view></router-view>
                </template>
            </main>
        </div>
    </div>
</template>

<style>
    .nav-link.router-link-exact-active {
        color: #007bff;
    }
</style>
