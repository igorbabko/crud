<template>
    <table ref="table" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </tfoot>
    </table>
</template>

<script>
    export default {
        mounted() {
            $(this.$refs.table).DataTable({
                ajax: '/api/lessons',
                // processing: true,
                // serverSide: true,
                // dom: 'Bfrtip',
                // dom: 'l<"toolbar">frtip',
                responsive: true,
                columns: [
                    { data: 'name' },
                    { data: 'actions', width: '20%', orderable: false },
                ],
                initComplete: () => {
                    $('.dataTables_wrapper').prepend(`
                        <div class="text-right mb-2">
                            <button type="button" class="btn btn-success"><i class="fas fa-plus-circle"></i> New</button>
                        </div>
                    `)
                },
                buttons: [
                    {
                        text: 'My button',
                        action: function ( e, dt, node, config ) {
                            alert( 'Button activated' );
                        }
                    }
                ]
            });
        }
    }
</script>
