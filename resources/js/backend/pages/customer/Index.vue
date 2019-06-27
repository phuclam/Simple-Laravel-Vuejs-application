<template>
    <div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Customers</h1>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Registered</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(user) in users">
                    <td>{{ user.id }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.created_at | moment("DD MMMM YYYY \\a\\t hh:mm A")}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script>
    import CustomerService from './Services'

    export default {
        data() {
            return {
                users: []
            }
        },
        created() {
            CustomerService.list().then(data => {
                this.users = data;
            }).catch(error => console.log(error));
        }
    }
</script>

