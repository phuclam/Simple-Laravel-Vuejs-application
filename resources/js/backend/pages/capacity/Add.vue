<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">New Capacity</h1>
        </div>
        <div v-if="updated" class="alert alert-success">Updated successfully.</div>
        <form @submit.prevent="onSubmit">
            <capacity-form :capacity="capacity" :errors="errors"/>
            <div class="text-center">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</template>
<script>
    import CapacityService from './Services'
    import CapacityForm from './Form'

    export default {
        components: {CapacityForm},
        data() {
            return {
                capacity: {},
                updated: false,
                errors: {}
            }
        },
        methods: {
            onSubmit() {
                CapacityService.create(this.capacity).then(data => {
                    this.capacity = data;
                    this.updated = true;
                    this.errors = {};
                    this.$router.push({name: 'capacity.edit', params: {id: this.capacity.id}});
                }).catch(error => {
                    this.errors = error.response.data.errors
                });
            }
        }
    }
</script>
