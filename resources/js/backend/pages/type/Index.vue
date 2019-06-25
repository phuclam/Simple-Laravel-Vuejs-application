<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Room Types</h1>
            <router-link :to="{name: 'type.add'}" class="btn btn-sm btn-primary">Add New</router-link>
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
                <tr v-for="(type, index) in types">
                    <td>{{ type.id }}</td>
                    <td>{{ type.name }}</td>
                    <td>
                        <router-link :to="{name: 'type.edit', params: {id: type.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                        <button v-on:click="deleteType(type.id, index)" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
    import TypeService from './Services'
    export default {
        data() {
            return {
                types: []
            }
        },
        created() {
            TypeService.list().then(data => {
                this.types = data;
            }).catch(error => console.log(error));
        },
        methods: {
            deleteType(id, index) {
                if (confirm('Are you sure you want to delete this type # ' + this.types[index].name + '?')) {
                    TypeService.delete(id).then(data => {
                        if (data === true) {
                            this.types.splice(index, 1);
                        }
                    }).catch(error => console.log(error));

                }
            }
        }
    }
</script>

