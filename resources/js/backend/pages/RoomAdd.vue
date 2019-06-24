<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">New Room</h1>
        </div>
        <div v-if="updated" class="alert alert-success">Updated successfully.</div>
        <form @submit.prevent="onSubmit">
            <div class="form-group">
                <label>Name</label>
                <input type="text" :class="['form-control', errors.name ? 'is-invalid' : '']" v-model="room.name">
                <span v-if="errors.name" class="invalid-feedback" role="alert">
                    <strong>{{ errors.name[0] }}</strong>
                </span>
            </div>
            <div class="form-group">
                <label>Type</label>
                <select v-model="room.type_id" :class="['form-control', errors.type_id ? 'is-invalid' : '']">
                    <option value="">Select an option</option>
                    <option v-for="type in types" :value="type.id">{{type.name}}</option>
                </select>
                <span v-if="errors.type_id" class="invalid-feedback" role="alert">
                    <strong>{{ errors.type_id[0] }}</strong>
                </span>
            </div>
            <div class="form-group">
                <label>Capacity</label>
                <select v-model="room.capacity_id" :class="['form-control', errors.capacity_id ? 'is-invalid' : '']">
                    <option value="">Select an option</option>
                    <option v-for="capacity in capacities" :value="capacity.id">{{capacity.name}}</option>
                </select>
                <span v-if="errors.capacity_id" class="invalid-feedback" role="alert">
                    <strong>{{ errors.capacity_id[0] }}</strong>
                </span>
            </div>
            <div class="form-group">
                <label>Image</label>
                <div class="custom-file">
                    <input type="file" v-on:change="onFileChange" :class="['custom-file-input', errors.image ? 'is-invalid' : '']" id="validatedCustomFile" accept="image/*">
                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                    <span v-if="errors.image" class="invalid-feedback" role="alert">
                        <strong>{{ errors.image[0] }}</strong>
                    </span>
                </div>
                <div class="image-box">
                    <img v-if="room.image_url" :src="room.image_url" height="70">
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</template>
<script>
    import RoomService from '../services/Room'
    import RoomTypeService from '../services/RoomType'
    import RoomCapacityService from '../services/RoomCapacity'

    export default {
        data() {
            return {
                room: {},
                types: [],
                capacities: [],
                updated: false,
                errors: []
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
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.room.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            onSubmit() {
                RoomService.create(this.room).then(data => {
                    this.room = data;
                    this.updated = true;
                    this.errors = [];
                    this.$router.push({name: 'room.edit', params: {id: this.room.id}});
                }).catch(error => {
                    this.errors = error.response.data.errors
                });
            }
        }
    }
</script>
<style>
    .image-box{
        margin-top: 10px;
    }
</style>
