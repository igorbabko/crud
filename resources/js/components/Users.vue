<template>
    <table ref="table" class="table table-striped table-bordered nowrap" style="width:100%">
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
        mounted() {
            $(this.$refs.table).DataTable({
                ajax: '/api/users',
                dataSrc: 'data',
                columns: [
                    { data: 'name' },
                    { data: 'email' },
                    { data: 'job_title' },
                ]
            });
        }
    }
</script>
