<template>
    <div>
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
            <h5 class="my-0 mr-md-auto font-weight-normal"><router-link to="/">Online Booking</router-link></h5>
            <nav class="my-2 my-md-0 mr-md-3">
                <router-link to="/logout" class="p-2 text-dark">Booking</router-link>
            </nav>
            <router-link to="/register" class="btn btn-outline-primary">Sign up</router-link>
        </div>
        <div class="container">
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
