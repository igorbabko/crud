<template>
    <table ref="table" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
            </tr>
        </tfoot>
    </table>
</template>

<script>
    export default {
        mounted() {
            $(this.$refs.table).DataTable({
                ajax: '/api/lessons',
                dataSrc: 'data',
                columns: [
                    { data: 'name' },
                ]
            });
        }
    }
</script>
