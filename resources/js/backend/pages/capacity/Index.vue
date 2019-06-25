<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Room Capacities</h1>
            <router-link :to="{name: 'capacity.add'}" class="btn btn-sm btn-primary">Add New</router-link>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(capacity, index) in capacitys">
                    <td>{{ capacity.id }}</td>
                    <td>{{ capacity.name }}</td>
                    <td>
                        <router-link :to="{name: 'capacity.edit', params: {id: capacity.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                        <button v-on:click="deleteCapacity(capacity.id, index)" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
    import CapacityService from './Services'

    export default {
        data() {
            return {
                capacitys: []
            }
        },
        created() {
            CapacityService.list().then(data => {
                this.capacitys = data;
            }).catch(error => console.log(error));
        },
        methods: {
            deleteCapacity(id, index) {
                if (confirm('Are you sure you want to delete this capacity # ' + this.capacitys[index].name + '?')) {
                    CapacityService.delete(id).then(data => {
                        if (data === true) {
                            this.capacitys.splice(index, 1);
                        }
                    }).catch(error => console.log(error));

                }
            }
        }
    }
</script>

