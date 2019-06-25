<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Hotel Details</h1>
            <router-link :to="{name: 'hotel.edit'}" class="btn btn-sm btn-primary">Edit</router-link>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th style="width: 20%">Name</th>
                    <td>{{ hotel.name }}</td>
                </tr>
                <tr>
                    <th style="width: 20%">Address</th>
                    <td>{{ hotel.address }}</td>
                </tr>
                <tr>
                    <th style="width: 20%">City</th>
                    <td>{{ hotel.city }}</td>
                </tr>
                <tr>
                    <th style="width: 20%">State</th>
                    <td>{{ hotel.state }}</td>
                </tr>
                <tr>
                    <th style="width: 20%">Country</th>
                    <td>{{ countries[hotel.country] }}</td>
                </tr>
                <tr>
                    <th style="width: 20%">Zip Code</th>
                    <td>{{ hotel.zip_code }}</td>
                </tr>
                <tr>
                    <th style="width: 20%">Phone Number</th>
                    <td>{{ hotel.phone_number }}</td>
                </tr>
                <tr>
                    <th style="width: 20%">Email</th>
                    <td><a :href="'mailto:'+hotel.email">{{ hotel.email }}</a></td>
                </tr>
                <tr>
                    <th style="width: 20%">Image</th>
                    <td><img v-if="hotel.image_url" :src="hotel.image_url"></td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    import HotelService from './Services'

    export default {
        data() {
            return {
                hotel: {},
                countries: []
            }
        },
        created() {
            HotelService.detail().then(data => {
                this.hotel = data.hotel;
                this.countries = data.countries;
            }).catch(error => console.log(error));
        }
    }
</script>
<style>
    img {
        max-width: 100%;
    }
</style>