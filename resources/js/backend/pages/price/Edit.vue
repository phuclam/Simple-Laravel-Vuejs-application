<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit Price</h1>
        </div>
        <div v-if="updated" class="alert alert-success">Updated successfully.</div>
        <form @submit.prevent="onSubmit">
            <price-form :price="price" :errors="errors" />
            <div class="text-center">
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</template>
<script>
    import PriceService from './Services'
    import PriceForm from './Form'

    export default {
        components: {PriceForm},
        data() {
            return {
                price: {},
                updated: false,
                errors: {}
            }
        },
        created() {
            PriceService.detail(this.$route.params.id).then(data => {
                this.price = data;
            }).catch(error => console.log(error));
        },
        methods: {
            onSubmit() {
                PriceService.update(this.$route.params.id, this.price).then(data => {
                    this.price = data;
                    this.updated = true;
                    this.errors = {};
                }).catch(error => {
                    this.errors = error.response.data.errors
                });
            }
        }
    }
</script>
