<template>
    <div>
        <div class="text-center">
            <h1>Sign Up</h1>
        </div>
        <div class="row justify-content-md-center">
            <div class="col col-md-5">
                <form @submit.prevent="onSubmit">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" :class="['form-control', errors.email ? 'is-invalid' : '']" v-model="customer.email">
                        <span v-if="errors.email" class="invalid-feedback" role="alert">
                            <strong>{{ errors.email[0] }}</strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" :class="['form-control', errors.password ? 'is-invalid' : '']" v-model="customer.password">
                        <span v-if="errors.password" class="invalid-feedback" role="alert">
                            <strong>{{ errors.password[0] }}</strong>
                        </span>
                    </div>
                    <div class="form-group">
                        <label>Password Confirmation</label>
                        <input type="password" :class="['form-control', errors.password_confirmation ? 'is-invalid' : '']" v-model="customer.password_confirmation">
                        <span v-if="errors.password_confirmation" class="invalid-feedback" role="alert">
                            <strong>{{ errors.password_confirmation[0] }}</strong>
                        </span>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import Services from '../services';

    export default {
        data() {
            return {
                customer: {},
                errors: {}
            }
        },
        methods: {
            onSubmit() {
                Services.register(this.customer).then((data) => {
                    console.log(data);
                }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            }
        }
    }
</script>
<style>
    form {
        margin: 20px 0;
        padding: 20px;
        border: 1px solid #ccc;
    }
</style>