<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Bookings</h1>
            <router-link :to="{name: 'booking.add'}" class="btn btn-sm btn-primary">Add New</router-link>
        </div>
        <div class="mb-2">
            <button type="button" v-on:click="selectMode('calendar')" :class="['btn', mode === 'calendar' ? 'btn-outline-primary' : 'btn-outline-secondary']" title="Calendar Mode"><span class="oi oi-calendar"></span></button>
            <button type="button" v-on:click="selectMode('list')" :class="['btn', mode === 'list' ? 'btn-outline-primary' : 'btn-outline-secondary']" title="List Mode"><span class="oi oi-list"></span></button>
        </div>
        <div class="big-datepicker" v-if="!selected && mode === 'calendar'">
            <datepicker :use-utc="true" :highlighted="highlighted" v-model="date" :inline="true"></datepicker>
            <div class="my-3">
                <i>** The highlighted dates is the dates have been reserved. Click on a date to see the bookings.</i>
            </div>
        </div>
        <div class="table-responsive" v-if="!selected && mode === 'list'">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Room</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Date Start</th>
                    <th>Date End</th>
                    <th class="text-center">Nights</th>
                    <th class="text-right">Price</th>
                    <th class="text-center">Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="booking in bookings">
                    <td>{{ booking.id }}</td>
                    <td>{{ booking.room.name }}</td>
                    <td>{{ booking.user ? booking.user.name : booking.name}}</td>
                    <td>{{ booking.phone }}</td>
                    <td>{{ booking.date_start | moment("DD MMMM YYYY")}}</td>
                    <td>{{ booking.date_end | moment("DD MMMM YYYY")}}</td>
                    <td class="text-center">{{ booking.nights}}</td>
                    <td class="text-right">{{ booking.price}}</td>
                    <td class="text-center">
                        <router-link :to="{name: 'booking.edit', params: {id: booking.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                        <button v-on:click="deleteBooking(booking.id)" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div v-if="selected">
            <a href="#" v-on:click="refreshBookings()" class="my-3 btn btn-sm btn-link"><span class="oi oi-caret-left"></span> Back to calendar</a>
            <booking-detail :booking="booking" v-for="booking in bookings" :key="booking.id"></booking-detail>
            <p v-if="bookings.length === 0">There is any booking on this date yet.</p>
        </div>

    </div>
</template>
<script>
    import BookingService from './Services'
    import Datepicker from 'vuejs-datepicker';
    import BookingDetail from "../../components/BookingDetail";

    export default {
        components: {BookingDetail, Datepicker},
        data() {
            return {
                bookings: [],
                date: null,
                highlighted: {
                    dates: [],
                },
                selected: false,
                mode: $cookies.get('booking-view') ? $cookies.get('booking-view') : 'calendar'
            }
        },
        created() {
            BookingService.list().then(data => {
                this.bookings = data.bookings;
                if (data.reserved.length > 0) {
                    data.reserved.forEach((v) => {
                        this.highlighted.dates.push(new Date(v));
                    })
                }
            }).catch(error => console.log(error));
        },
        methods: {
            deleteBooking(id, index) {
                if (confirm('Are you sure you want to delete this booking # ' + this.bookings[index].name + '?')) {
                    BookingService.delete(id).then(data => {
                        if (data === true) {
                            this.bookings.splice(index, 1);
                        }
                    }).catch(error => console.log(error));

                }
            },
            refreshBookings() {
                BookingService.list().then(data => {
                    this.bookings = data.bookings;
                    this.highlighted.dates = [];
                    if (data.reserved.length > 0) {
                        data.reserved.forEach((v) => {
                            this.highlighted.dates.push(new Date(v));
                        })
                    }
                }).catch(error => console.log(error));

                this.selected = false;
            },
            selectMode(m) {
                this.refreshBookings();
                this.mode = m;
                $cookies.set('booking-view', m);
            }
        },
        watch: {
            date: function () {
                BookingService.list({date: this.date}).then(data => {
                    this.bookings = data.bookings;
                    this.selected = true;
                }).catch(error => console.log(error));
            }
        }
    }
</script>
<style>
    .big-datepicker .vdp-datepicker__calendar {
        width: 100%;
        border: 0;
        border-left: 1px solid #CCC;
        border-top: 1px solid #CCC;
    }

    .big-datepicker .vdp-datepicker__calendar .cell {
        height: 60px;
        line-height: 60px;
        border-right: 1px solid #CCC;
        border-bottom: 1px solid #CCC;
    }

    .big-datepicker .vdp-datepicker__calendar .cell.day-header {
        font-size: 100%;
        border-top: 1px solid #CCC;
        background: #e6e6e6
    }

    .big-datepicker .vdp-datepicker__calendar header .next {
        border-right: 1px solid #CCC;
    }
</style>

