<template>
    <div>
        <div class="text-right mb-2">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createLessonModal"><i class="fas fa-plus-circle"></i> New</button>
        </div>
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
        <lesson-modal :lesson="lesson" :users="users" @created="add" />
    </div>
</template>

<script>
    import LessonModal from './LessonModal'

    export default {
        components: {
            LessonModal
        },

        data() {
            return {
                lesson: null,
                table: null,
                lessons: [],
                users: [],
            }
        },

        mounted() {
            axios.get('/api/lessons').then(response => {
                this.lessons = response.data.data
            })

            axios.get('/api/users').then(response => {
                this.users = response.data.data
            })

            this.table = $(this.$refs.table).DataTable({
                ajax: '/api/lessons',
                // processing: true,
                // serverSide: true,
                // dom: 'Bfrtip',
                // dom: 'l<"toolbar">frtip',
                responsive: true,
                columns: [
                    { data: 'name' },
                    {
                        data: 'lesson',
                        width: '20%',
                        orderable: false,
                        render: (id, type, row, meta) => `
                            <div class="action-buttons" data-id="${meta.row}">
                                <a href="#" class="btn btn-sm btn-primary btn-add">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-info btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-danger btn-delete">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        `
                    }
                ],
                initComplete: (settings, json) => {
                    let self = this

                    $(this.$refs.table).delegate('a', 'click', function () {
                        let rowId = $(this).parent().data('id')

                        this.lesson = self.table.row(rowId).data()
                    })
                }
            });
        },

        methods: {
            show(index) {
                console.log('sdf')
                // console.log(this.table.row(index))
            },
            add(lesson) {
                this.table.row.add(lesson)
            },
            update(lesson, i) {
                console.log('updating')
                console.log(lesson)

                this.table.row(lesson, i)
            },
        }
    }
</script>
