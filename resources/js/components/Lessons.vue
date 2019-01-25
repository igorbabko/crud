<template>
    <div>
        <div class="text-right mb-2">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#lessonModal">
                <i class="fas fa-plus-circle"></i> New
            </button>
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
        <delete-lesson-modal :lesson="lesson" @deleted="remove" />
    </div>
</template>

<script>
    import DeleteLessonModal from './DeleteLessonModal';
    import ShowLessonModal from './ShowLessonModal';
    import LessonModal from './LessonModal';

    export default {
        components: {
            DeleteLessonModal,
            ShowLessonModal,
            LessonModal
        },

        data() {
            return {
                currentIndex: null,
                lesson: null,
                table: null,
                lessons: [],
                users: []
            }
        },

        mounted() {
            axios.get('/api/lessons').then(response => {
                this.lessons = response.data.data;
            });

            axios.get('/api/users').then(response => {
                this.users = response.data.data;
            });

            this.table = $(this.$refs.table).DataTable({
                ajax: '/api/lessons',
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
                                <a href="#" >
                                <button type="button" class="btn btn-sm btn-danger btn-delete" data-toggle="modal" data-target="#deleteLessonModal">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        `
                    }
                ],
                initComplete: (settings, json) => {
                    let self = this;

                    $(this.$refs.table).delegate('.action-buttons button', 'click', function () {
                        let $btn = $(this);
                        self.currentIndex = $btn.parent().data('id');
                        self.lesson = self.table.row(self.currentIndex).data();
                    })
                }
            });
        },

        methods: {
            add(lesson) {
                this.table.row.add(lesson);

                return this;
            },
            update(lesson) {
                this.table.row(this.currentIndex).data(lesson);

                return this;
            },
            remove() {
                this.table.row(this.currentIndex).remove().draw();

                return this;
            }
        }
    }
</script>
