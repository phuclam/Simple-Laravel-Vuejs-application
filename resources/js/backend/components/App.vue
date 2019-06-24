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
                            <a class="nav-link" href="#">Room Types</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Room Capacities</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Price List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Bookings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Customers</a>
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

<script>
    import auth from '../auth'

    export default {
        data() {
            return {
                loggedIn: auth.loggedIn()
            }
        },
        created() {
            auth.onChange = loggedIn => {
                this.loggedIn = loggedIn
            }
        }
    }
</script>

<style>
    .nav-link.router-link-exact-active {
        color: #007bff;
    }
</style>
