<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Bookings</h1>
            <router-link :to="{name: 'booking.add'}" class="btn btn-sm btn-primary">Add New</router-link>
        </div>
        <div class="big-datepicker">
            <datepicker :highlighted="highlighted" v-model="date" :inline="true" @changedMonth="changeMonth"></datepicker>
        </div>
    </div>
</template>
<script>
    import BookingService from './Services'
    import Datepicker from 'vuejs-datepicker';

    export default {
        components: {Datepicker},
        data() {
            return {
                bookings: [],
                date: null,
                highlighted: {
                    dates: [],
                }
            }
        },
        created() {
            BookingService.list().then(data => {
                this.bookings = data;
            }).catch(error => console.log(error));


            this.highlighted.dates.push(new Date('2019-06-22'))
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
            changeMonth() {
                console.log(this.date)
            }
        }
    }
</script>
<style>
    .big-datepicker .vdp-datepicker__calendar{
        width: 100%;
        border: 0;
        border-left: 1px solid #CCC;
        border-top: 1px solid #CCC;
    }
    .big-datepicker .vdp-datepicker__calendar .cell{
        height: 60px;
        line-height: 60px;
        border-right: 1px solid #CCC;
        border-bottom: 1px solid #CCC;
    }
    .big-datepicker .vdp-datepicker__calendar .cell.day-header{
        font-size: 100%;
        border-top: 1px solid #CCC;
        background: #e6e6e6
    }
    .big-datepicker .vdp-datepicker__calendar header .next{
        border-right: 1px solid #CCC;
    }
</style>

