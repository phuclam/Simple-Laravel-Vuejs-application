<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Room Prices</h1>
            <router-link :to="{name: 'price.add'}" class="btn btn-sm btn-primary">Add New</router-link>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Room Type</th>
                    <th>Room Capacity</th>
                    <th>Day Type</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(price, index) in prices">
                    <td>{{ price.id }}</td>
                    <td>{{ price.type.name }}</td>
                    <td>{{ price.capacity.name }}</td>
                    <td>{{ price.day_type }}</td>
                    <td>{{ price.price }}</td>
                    <td>
                        <router-link :to="{name: 'price.edit', params: {id: price.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                        <button v-on:click="deletePrice(price.id, index)" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
    import PriceService from './Services'

    export default {
        data() {
            return {
                prices: []
            }
        },
        created() {
            PriceService.list().then(data => {
                this.prices = data;
            }).catch(error => console.log(error));
        },
        methods: {
            deletePrice(id, index) {
                if (confirm('Are you sure you want to delete this price # ' + this.prices[index].name + '?')) {
                    PriceService.delete(id).then(data => {
                        if (data === true) {
                            this.prices.splice(index, 1);
                        }
                    }).catch(error => console.log(error));

                }
            }
        }
    }
</script>

