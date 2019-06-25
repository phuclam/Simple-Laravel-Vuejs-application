<template>
    <div>
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
    </div>
</template>
<script>
    export default {
        props: {
            room: {
                type: Object,
                required: true
            },
            errors: {
                type: Object,
                required: true
            },
            types: {
                type: Array,
                required: true
            },
            capacities: {
                type: Array,
                required: true
            }
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
        }
    }
</script>
<style>
    .image-box {
        margin-top: 10px;
    }
</style>
