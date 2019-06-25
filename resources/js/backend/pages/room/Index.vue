<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Rooms</h1>
            <router-link :to="{name: 'room.add'}" class="btn btn-sm btn-primary">Add New</router-link>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Capacity</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(room, index) in rooms">
                    <td>{{ room.id }}</td>
                    <td>{{ room.name }}</td>
                    <td>{{ room.type ? room.type.name : '' }}</td>
                    <td>{{ room.capacity ? room.capacity.name : ''}}</td>
                    <td>
                        <router-link :to="{name: 'room.edit', params: {id: room.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                        <button v-on:click="deleteRoom(room.id, index)" class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
    import RoomService from './Services'
    export default {
        data() {
            return {
                rooms: []
            }
        },
        created() {
            RoomService.list().then(data => {
                this.rooms = data;
            }).catch(error => console.log(error));
        },
        methods: {
            deleteRoom(id, index) {
                if (confirm('Are you sure you want to delete this room # ' + this.rooms[index].name + '?')) {
                    RoomService.delete(id).then(data => {
                        if (data === true) {
                            this.rooms.splice(index, 1);
                        }
                    }).catch(error => console.log(error));

                }
            }
        }
    }
</script>

