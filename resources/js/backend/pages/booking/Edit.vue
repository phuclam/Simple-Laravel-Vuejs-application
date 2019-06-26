<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit Booking</h1>
        </div>
        <div v-if="updated" class="alert alert-success">Updated successfully.</div>
        <form @submit.prevent="onSubmit">
            <booking-form :booking="booking" :rooms="rooms" :users="users" :errors="errors" />
            <div class="text-center">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</template>
<script>
    import BookingService from './Services'
    import BookingForm from './Form'

    export default {
        components: {BookingForm},
        data() {
            return {
                booking: {},
                users: [],
                rooms: [],
                updated: false,
                errors: {}
            }
        },
        created() {
            BookingService.detail(this.$route.params.id).then(data => {
                this.booking = data.booking;
                this.users = data.users;
                this.rooms = data.rooms;
            }).catch(error => console.log(error));
        },
        methods: {
            onSubmit() {
                BookingService.update(this.$route.params.id, this.booking).then(data => {
                    this.booking = data;
                    this.updated = true;
                    this.errors = {};
                }).catch(error => {
                    this.errors = error.response.data.errors
                });
            }
        }
    }
</script>
