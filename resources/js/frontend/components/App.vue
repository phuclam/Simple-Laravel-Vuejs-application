<template>
    <div>
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <h5 class="my-0 mr-md-auto font-weight-normal">Company name</h5>
            <nav class="my-2 my-md-0 mr-md-3">
                <router-link to="/logout" class="p-2 text-dark">Booking</router-link>
            </nav>
            <a class="btn btn-outline-primary" href="#">Sign up</a>
        </div>
        <div class="container">
            <h1>Auth Flow</h1>
            <ul>
                <li>
                    <router-link v-if="loggedIn" to="/logout">Log out</router-link>
                    <router-link v-if="!loggedIn" to="/login">Log in</router-link>
                </li>
                <li>
                    <router-link to="/about">About</router-link>
                </li>
                <li>
                    <router-link to="/dashboard">Dashboard</router-link>
                    (authenticated)
                </li>
            </ul>
            <template v-if="$route.matched.length">
                <router-view></router-view>
            </template>
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
