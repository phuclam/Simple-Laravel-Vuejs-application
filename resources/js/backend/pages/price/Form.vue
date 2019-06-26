<template>
    <div>
        <div class="form-group">
            <label>Room Type</label>
            <select v-model="price.type_id" :class="['form-control', errors.type_id ? 'is-invalid' : '']">
                <option value="">Select an Type</option>
                <option v-for="type in types" :value="type.id">{{type.name}}</option>
            </select>
            <span v-if="errors.type_id" class="invalid-feedback" role="alert">
                <strong>{{ errors.type_id[0] }}</strong>
            </span>
        </div>
        <div class="form-group">
            <label>Room Capacity</label>
            <select v-model="price.capacity_id" :class="['form-control', errors.capacity_id ? 'is-invalid' : '']">
                <option value="">Select an Capacity</option>
                <option v-for="capacity in capacities" :value="capacity.id">{{capacity.name}}</option>
            </select>
            <span v-if="errors.capacity_id" class="invalid-feedback" role="alert">
                <strong>{{ errors.capacity_id[0] }}</strong>
            </span>
        </div>
        <div class="form-group">
            <label>Day Type</label>
            <select v-model="price.day_type" :class="['form-control', errors.day_type ? 'is-invalid' : '']">
                <option value="">Select an Day Type</option>
                <option value="Weekday">Weekday</option>
                <option value="Weekend">Weekend</option>
            </select>
            <span v-if="errors.day_type" class="invalid-feedback" role="alert">
                <strong>{{ errors.day_type[0] }}</strong>
            </span>
        </div>
        <div class="form-group">
            <label>Price</label>
            <input type="number" :class="['form-control', errors.price ? 'is-invalid' : '']" v-model="price.price">
            <span v-if="errors.price" class="invalid-feedback" role="alert">
                <strong>{{ errors.price[0] }}</strong>
            </span>
        </div>
    </div>
</template>
<script>
    import RoomTypeService from '../type/Services'
    import RoomCapacityService from '../capacity/Services'

    export default {
        props: {
            price: {
                type: Object,
                required: true
            },
            errors: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                types: [],
                capacities: []
            }
        },
        created() {
            RoomTypeService.list().then(data => {
                this.types = data
            }).catch(error => console.log(error));

            RoomCapacityService.list().then(data => {
                this.capacities = data
            }).catch(error => console.log(error));
        }
    }
</script>
