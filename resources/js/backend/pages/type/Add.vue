<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">New Type</h1>
        </div>
        <div v-if="updated" class="alert alert-success">Updated successfully.</div>
        <form @submit.prevent="onSubmit">
            <type-form :type="type" :errors="errors"/>
            <div class="text-center">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</template>
<script>
    import TypeService from './Services'
    import TypeForm from './Form'

    export default {
        components: {TypeForm},
        data() {
            return {
                type: {},
                updated: false,
                errors: {}
            }
        },
        methods: {
            onSubmit() {
                TypeService.create(this.type).then(data => {
                    this.type = data;
                    this.updated = true;
                    this.errors = {};
                    this.$router.push({name: 'type.edit', params: {id: this.type.id}});
                }).catch(error => {
                    this.errors = error.response.data.errors
                });
            }
        }
    }
</script>
