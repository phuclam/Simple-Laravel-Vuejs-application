<template>
    <div>
        <div class="form-group">
            <label>Room</label>
            <select v-model="booking.room_id" :class="['form-control', errors.room_id ? 'is-invalid' : '']">
                <option value="">Select an Room</option>
                <option v-for="room in rooms" :value="room.id">{{room.name}}</option>
            </select>
            <span v-if="errors.room_id" class="invalid-feedback" role="alert">
                <strong>{{ errors.room_id[0] }}</strong>
            </span>
        </div>
        <div class="form-group">
            <label>Customer</label>
            <select v-model="booking.user_id" :class="['form-control', errors.user_id ? 'is-invalid' : '']">
                <option value="">Select an Customer</option>
                <option v-for="user in users" :value="user.id">{{user.name}}</option>
            </select>
            <span v-if="errors.user_id" class="invalid-feedback" role="alert">
                <strong>{{ errors.user_id[0] }}</strong>
            </span>
        </div>
        <div class="form-group">
            <label>or Customer Name</label>
            <input type="text" :class="['form-control', errors.name ? 'is-invalid' : '']" v-model="booking.name">
            <span v-if="errors.name" class="invalid-feedback" role="alert">
                <strong>{{ errors.name[0] }}</strong>
            </span>
        </div>
        <div class="form-group">
            <label>Date Start</label>
            <datepicker :disabled-dates="{to: min_start}" :use-utc="true" :input-class="['form-control', errors.date_start ? 'is-invalid' : '']" v-model="booking.date_start"
                        placeholder="Select Date"></datepicker>
            <span v-if="errors.date_start" class="invalid-feedback" role="alert">
                <strong>{{ errors.date_start[0] }}</strong>
            </span>
        </div>
        <div class="form-group">
            <label>Date End</label>
            <datepicker :disabled-dates="{to: min_end}" :use-utc="true" :input-class="['form-control', errors.date_end ? 'is-invalid' : '']" v-model="booking.date_end"
                        placeholder="Select Date"></datepicker>
            <span v-if="errors.date_end" class="invalid-feedback" role="alert">
                <strong>{{ errors.date_end[0] }}</strong>
            </span>
        </div>
        <div class="form-group">
            <label>Nights</label>
            <input type="number" readonly :class="['form-control', errors.nights ? 'is-invalid' : '']" v-model="booking.nights">
            <span v-if="errors.nights" class="invalid-feedback" role="alert">
                <strong>{{ errors.nights[0] }}</strong>
            </span>
        </div>
        <div class="form-group" v-if="booking.id">
            <label>Price</label>
            <input type="number" class="form-control" :value="booking.price" readonly>
        </div>
    </div>
</template>
<script>
    import Datepicker from "vuejs-datepicker";

    export default {
        components: {Datepicker},
        props: {
            booking: {
                type: Object,
                required: true
            },
            users: {
                type: Array,
                required: true
            },
            rooms: {
                type: Array,
                required: true
            },
            errors: {
                type: Object,
                required: true
            }
        },
        computed: {
            date_start: function () {
                return this.booking.date_start;
            },
            date_end: function () {
                return this.booking.date_end;
            },
            min_start: function () {
                return new Date();
            },
            min_end: function () {
                let day = typeof this.booking.date_start !== 'undefined' ? new Date(this.booking.date_start) : new Date();
                let nextDay = new Date(day);
                nextDay.setDate(day.getDate() + 1);
                return nextDay;
            }
        },
        methods: {
            calculateNights() {
                if (typeof this.booking.date_start !== 'undefined' && typeof this.booking.date_end !== 'undefined') {
                    let start = new Date(this.booking.date_start);
                    let end = new Date(this.booking.date_end);

                    this.booking.nights = Math.round((end - start) / (60 * 60 * 24 * 1000));
                    this.booking.nights = this.booking.nights < 0 ? 0 : this.booking.nights;
                }
            }
        },
        watch: {
            date_start: function () {
                this.calculateNights();
            },
            date_end: function () {
                this.calculateNights();
            }
        }
    }
</script>
