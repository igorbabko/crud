<template>
    <div>
        <div class="text-right mb-2">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#lessonModal"><i class="fas fa-plus-circle"></i> New</button>
        </div>
        <table ref="table" class="table table-striped table-bordered nowrap">
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
        <lesson-modal
                :lesson="lesson"
                :users="users"
                @created="add"
                @updated="update"
        />
        <show-lesson-modal :lesson="lesson" />
    </div>
</template>

<script>
    import LessonModal from './LessonModal'
    import ShowLessonModal from './ShowLessonModal'

    export default {
        components: {
            LessonModal,
            ShowLessonModal
        },

        data() {
            return {
                currentIndex: null,
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
                        width: '10%',
                        orderable: false,
                        render: (id, type, row, meta) => `
                            <div class="action-buttons" data-id="${meta.row}">
                                <button type="button" class="btn btn-sm btn-primary btn-add" data-toggle="modal" data-target="#showLessonModal">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-info btn-edit" data-toggle="modal" data-target="#lessonModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <a href="#" class="btn btn-sm btn-danger btn-delete">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        `
                    }
                ],
                initComplete: (settings, json) => {
                    let self = this

                    $(this.$refs.table).delegate('.action-buttons button', 'click', function () {
                        let $btn = $(this);
                        self.currentIndex = $btn.parent().data('id');
                        self.lesson = self.table.row(self.currentIndex).data();

                        if ($btn.hasClass('btn-show')) {
                        } else if ($btn.hasClass('btn-edit')) {
                        } else if ($btn.hasClass('btn-delete')) {
                            // document.confirm()
                        }
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
            update(lesson) {
                console.log('updating')
                console.log(lesson)
                console.log(this.currentIndex)

                this.table.row(this.currentIndex).data(lesson)
            },
        }
    }
</script>
