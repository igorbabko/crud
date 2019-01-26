<template>
    <div>
        <div v-if="withHeading" class="heading-line mb-2">
            <h1>Users</h1>
            <button @click="reset" type="button" class="btn btn-success" data-toggle="modal" data-target="#editModal">
                <i class="fas fa-plus-circle"></i> New
            </button>
        </div>
        <table ref="table" class="table table-striped table-bordered nowrap">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Job Title</th>
                    <th v-if="withActions">Actions</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Job Title</th>
                    <th v-if="withActions">Actions</th>
                </tr>
            </tfoot>
        </table>

        <template v-if="withActions">
            <view-modal v-if="item" title="Lessons" :item="item">
                <lessons :items="item.lessons" />
            </view-modal>

            <edit-modal
                    :item="item"
                    :lessons="lessons"
                    @created="add"
                    @updated="update"
            />

            <confirmation-modal
                    :item="item"
                    type="users"
                    @deleted="remove"
            />
        </template>
    </div>
</template>

<script>
    import ViewModal from './ViewModal';
    import EditModal from './UserModal';
    import Table from '../mixins/Table';

    export default {
        mixins: [Table],

        components: {
            ViewModal,
            EditModal
        },

        data() {
            return {
                dataUrl: '/api/users',
                lessons: [],
                options: {
                    columns: [
                        { data: 'name' },
                        { data: 'email' },
                        { data: 'job_title' }
                    ]
                }
            }
        },

        mounted() {
            axios.get('/api/lessons').then(response => {
                this.lessons = response.data.data;
            });
        }
    }
</script>
