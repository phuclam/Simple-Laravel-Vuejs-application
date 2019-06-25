<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">New Room</h1>
        </div>
        <div v-if="updated" class="alert alert-success">Updated successfully.</div>
        <form @submit.prevent="onSubmit">
            <room-form :room="room" :errors="errors" :types="types" :capacities="capacities"/>
            <div class="text-center">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</template>
<script>
    import RoomService from './Services'
    import RoomForm from './Form'
    import RoomTypeService from '../type/Services'
    import RoomCapacityService from '../capacity/Services'


    export default {
        components: {RoomForm},
        data() {
            return {
                room: {},
                types: [],
                capacities: [],
                updated: false,
                errors: {}
            }
        },
        created() {
            RoomTypeService.list().then(data => {
                this.types = data
            }).catch(error => console.log(error));

            RoomCapacityService.list().then(data => {
                this.capacities = data
            }).catch(error => console.log(error));
        },
        methods: {
            onSubmit() {
                RoomService.create(this.room).then(data => {
                    this.room = data;
                    this.updated = true;
                    this.errors = {};
                    this.$router.push({name: 'room.edit', params: {id: this.room.id}});
                }).catch(error => {
                    this.errors = error.response.data.errors
                });
            }
        }
    }
</script>
