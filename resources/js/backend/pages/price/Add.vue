<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">New Price</h1>
        </div>
        <div v-if="updated" class="alert alert-success">Updated successfully.</div>
        <div v-if="duplicated" class="alert alert-danger">This type of price has been added.</div>
        <form @submit.prevent="onSubmit">
            <price-form :price="price" :errors="errors"/>
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
                duplicated: false,
                errors: {}
            }
        },
        methods: {
            onSubmit() {
                PriceService.create(this.price).then(data => {
                    this.price = data;
                    this.updated = true;
                    this.errors = {};
                    this.$router.push({name: 'price.edit', params: {id: this.price.id}});
                }).catch(error => {
                    if (typeof error.response.data.errors !== 'undefined') {
                        this.errors = error.response.data.errors;
                    }
                    this.duplicated = true;
                });
            }
        }
    }
</script>
