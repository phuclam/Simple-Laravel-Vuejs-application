<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit Hotel</h1>
        </div>
        <form @submit.prevent="onSubmit">
            <div class="form-group">
                <label>Name</label>
                <input type="text" :class="['form-control', errors.name ? 'is-invalid' : '']" v-model="hotel.name">
                <span v-if="errors.name" class="invalid-feedback" role="alert">
                    <strong>{{ errors.name[0] }}</strong>
                </span>
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" :class="['form-control', errors.address ? 'is-invalid' : '']" v-model="hotel.address">
                <span v-if="errors.address" class="invalid-feedback" role="alert">
                    <strong>{{ errors.address[0] }}</strong>
                </span>
            </div>
            <div class="form-group">
                <label>City</label>
                <input type="text" :class="['form-control', errors.city ? 'is-invalid' : '']" v-model="hotel.city">
                <span v-if="errors.city" class="invalid-feedback" role="alert">
                    <strong>{{ errors.city[0] }}</strong>
                </span>
            </div>
            <div class="form-group">
                <label>State</label>
                <input type="text" :class="['form-control', errors.state ? 'is-invalid' : '']" v-model="hotel.state">
                <span v-if="errors.state" class="invalid-feedback" role="alert">
                    <strong>{{ errors.state[0] }}</strong>
                </span>
            </div>
            <div class="form-group">
                <label>Country</label>
                <select v-model="hotel.country" :class="['form-control', errors.country ? 'is-invalid' : '']">
                    <option value="">Select an option</option>
                    <option v-for="(value, key) in countries" :value="key">{{ value }}</option>
                </select>
                <span v-if="errors.country" class="invalid-feedback" role="alert">
                    <strong>{{ errors.country[0] }}</strong>
                </span>
            </div>
            <div class="form-group">
                <label>Zip Code</label>
                <input type="text" :class="['form-control', errors.zip_code ? 'is-invalid' : '']" v-model="hotel.zip_code">
                <span v-if="errors.zip_code" class="invalid-feedback" role="alert">
                    <strong>{{ errors.zip_code[0] }}</strong>
                </span>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" :class="['form-control', errors.phone_number ? 'is-invalid' : '']" v-model="hotel.phone_number">
                <span v-if="errors.phone_number" class="invalid-feedback" role="alert">
                    <strong>{{ errors.phone_number[0] }}</strong>
                </span>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" :class="['form-control', errors.email ? 'is-invalid' : '']" v-model="hotel.email">
                <span v-if="errors.email" class="invalid-feedback" role="alert">
                    <strong>{{ errors.email[0] }}</strong>
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
                    <img v-if="hotel.image_url" :src="hotel.image_url" height="70">
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</template>
<script>
    import HotelService from './Services'

    export default {
        data() {
            return {
                hotel: {},
                countries: [],
                errors: {}
            }
        },
        created() {
            HotelService.detail().then(data => {
                this.hotel = data.hotel;
                this.countries = data.countries;
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
                    this.hotel.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            onSubmit() {
                HotelService.update(this.hotel).then(data => {
                    this.hotel = data;
                    this.$router.push({name: 'home'});
                }).catch(error => {
                    this.errors = error.response.data.errors
                });
            }
        }
    }
</script>