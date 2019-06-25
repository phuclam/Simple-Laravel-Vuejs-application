<template>
    <div>
        <div class="form-group">
            <label>Name</label>
            <input type="text" :class="['form-control', errors.name ? 'is-invalid' : '']" v-model="capacity.name">
            <span v-if="errors.name" class="invalid-feedback" role="alert">
                <strong>{{ errors.name[0] }}</strong>
            </span>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            capacity: {
                capacity: Object,
                required: true
            },
            errors: {
                capacity: Object,
                required: true
            }
        }
    }
</script>
