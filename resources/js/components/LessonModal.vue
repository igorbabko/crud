<template>
    <div ref="modal" class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">{{ title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="submit">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name:</label>
                            <input v-model="form.name" type="text" :class="['form-control', {'is-invalid': isInvalid('name')}]" id="name">
                            <div v-if="isInvalid('name')" v-text="errors.name[0]" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="userIds" class="col-form-label">Users:</label>
                            <select id="userIds" class="selectpicker" v-model="form.user_ids" multiple>
                                <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button @click="submit" type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Modal from '../mixins/Modal';

    export default {
        mixins: [Modal],

        props: ['users'],

        data() {
            return {
                type: 'lessons',
                form: {
                    name: '',
                    user_ids: []
                }
            }
        },

        computed: {
            userIds() {
                return this.item ? this.item.users.map(user => parseInt(user.id)) : [];
            },
        },

        methods: {
            fillForm() {
                this.form.name = this.item ? this.item.name : '';
                this.form.user_ids = this.userIds;
            },
            emptyForm() {
                this.form = { name: '', user_ids: [] };
            }
        }
    }
</script>
