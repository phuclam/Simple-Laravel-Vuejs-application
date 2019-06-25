<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit Capacity</h1>
        </div>
        <div v-if="updated" class="alert alert-success">Updated successfully.</div>
        <form @submit.prevent="onSubmit">
            <capacity-form :capacity="capacity" :errors="errors" />
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
        created() {
            CapacityService.detail(this.$route.params.id).then(data => {
                this.capacity = data;
            }).catch(error => console.log(error));
        },
        methods: {
            onSubmit() {
                CapacityService.update(this.$route.params.id, this.capacity).then(data => {
                    this.capacity = data;
                    this.updated = true;
                    this.errors = {};
                }).catch(error => {
                    this.errors = error.response.data.errors
                });
            }
        }
    }
</script>
