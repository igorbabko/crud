<template>
    <div>
        <div v-if="withHeading" class="heading-line mb-2">
            <h1>Lessons</h1>
            <button @click="reset" type="button" class="btn btn-success" data-toggle="modal" data-target="#editModal">
                <i class="fas fa-plus-circle"></i> New
            </button>
        </div>
        <table ref="table" class="table table-striped table-bordered nowrap">
            <thead>
                <tr>
                    <th>Name</th>
                    <th v-if="withActions">Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th v-if="withActions">Actions</th>
                </tr>
            </tfoot>
        </table>

        <template v-if="withActions">
            <view-modal v-if="item" title="Users" :item="item">
                <users :items="item.users" />
            </view-modal>

            <edit-modal
                    :item="item"
                    :users="users"
                    @created="add"
                    @updated="update"
            />

            <confirmation-modal
                    :item="item"
                    type="lessons"
                    @deleted="remove"
            />
        </template>
    </div>
</template>

<script>
    import EditModal from './LessonModal';
    import ViewModal from './ViewModal';
    import Table from '../mixins/Table';

    export default {
        mixins: [Table],

        components: {
            ViewModal,
            EditModal
        },

        data() {
            return {
                type: 'lessons',
                users: [],
                dataUrl: '/api/lessons',
                options: {
                    columns: [
                        { data: 'name' }
                    ]
                }
            }
        },

        mounted() {
            axios.get('/api/users').then(response => {
                this.users = response.data.data;
            });
        }
    }
</script>
