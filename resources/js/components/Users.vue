<template>
    <table ref="table" class="table table-striped table-bordered nowrap">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Job Title</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Job Title</th>
            </tr>
        </tfoot>
    </table>
</template>

<script>
    export default {
        props: ['users'],

        data() {
            return {
                table: null,
            }
        },

        mounted() {
            let options = {
                responsive: true,
                columns: [
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'job_title' },
                ]
            };

            if (this.users) {
                options.data = this.users;
                // options.dataSrc = 'data';
            } else {
                options.ajax = '/api/users';
            }

            this.table = $(this.$refs.table).DataTable(options);
        },

        watch: {
            users() {
                this.table.clear().rows.add(this.users).draw();
            }
        }
    }
</script>
