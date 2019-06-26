<template>
    <div>
        <div class="alert alert-success" v-if="deleted">The booking #{{ booking.id }} has been deleted successfully.</div>
        <div class="table-responsive" v-if="!deleted">
            <table class="table table-bordered">
                <tr>
                    <th colspan="4">
                        <div class="d-flex justify-content-between">
                            <div><span class="py-1 d-block">Booking ID: #{{ booking.id }}</span></div>
                            <div>
                                <router-link :to="{name: 'booking.edit', params: {id: booking.id}}" class="btn btn-sm btn-primary mx-1">Edit</router-link>
                                <button v-on:click="deleteBooking(booking.id)" class="btn btn-sm btn-danger mx-1">Delete</button>
                            </div>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th class="w-25">Room</th>
                    <td class="w-25">{{ booking.room.name }}</td>
                    <th class="w-25">Customer</th>
                    <td class="w-25">{{ booking.user_id ? booking.user.name : booking.name}}</td>
                </tr>
                <tr>
                    <th class="w-25">Date Start</th>
                    <td class="w-25">{{ booking.date_start | moment("DD MMMM YYYY")}}</td>
                    <th class="w-25">Date End</th>
                    <td class="w-25">{{ booking.date_end | moment("DD MMMM YYYY")}}</td>
                </tr>
                <tr>
                    <th class="w-25">Night(s)</th>
                    <td class="w-25">{{ booking.nights }}</td>
                    <th class="w-25">Price</th>
                    <td class="w-25">${{ booking.price }}</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    import BookingService from '../pages/booking/Services'

    export default {
        props: {
            booking: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                deleted: false
            }
        },
        methods: {
            deleteBooking(id) {
                if (confirm('Are you sure you want to delete this booking # ' + this.booking.id + '?')) {
                    BookingService.delete(id).then(data => {
                        if (data === true) {
                            this.deleted = true;

                        }
                    }).catch(error => console.log(error));

                }
            }
        }
    }
</script>

<style scoped>

</style>