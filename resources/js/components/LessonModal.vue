<template>
    <div ref="modal" class="modal fade" id="lessonModal" tabindex="-1" role="dialog" aria-labelledby="lessonModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lessonModalLabel">{{ title }}</h5>
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
    export default {
        props: ['lesson', 'users'],

        data() {
            return {
                $modal: null,
                errors: null,
                form: {
                    name: '',
                    user_ids: [],
                }
            }
        },

        mounted() {
            this.$modal = $(this.$refs.modal);

            this.$modal.on('show.bs.modal', (e) => {
                this.form.name = this.lesson ? this.lesson.name : '';
                this.form.user_ids = this.userIds;

                this.$nextTick(() => $('.selectpicker').selectpicker('refresh'))
            });

            this.$modal.on('shown.bs.modal', (e) => {
                $('#name').select().focus();
            });

            this.$modal.on('hide.bs.modal', (e) => {
                this.form = { name: '', user_ids: [] }
            });

            this.$modal.on('hidden.bs.modal', (e) => {
                $('.selectpicker').selectpicker('refresh');
                this.$emit('reset')
            });
        },

        computed: {
            isInvalid() {
                return field => this.errors && this.errors[field];
            },
            userIds() {
                return this.lesson ? this.lesson.users.map(user => parseInt(user.id)) : [];
            },
            title() {
                return this.lesson ? 'Edit Lesson' : 'Create Lesson';
            }
        },

        methods: {
            submit() {
                return this.lesson ? this.update() : this.create();
            },

            create() {
                axios.post('/api/lessons', this.form).then(response => {
                    this.$emit('created', response.data);
                    this.$modal.modal('hide');
                }).catch(error => {
                    this.errors = error.response.data.errors;
                })
            },

            update() {
                axios.patch(`/api/lessons/${this.lesson.id}`, this.form).then(response => {
                    this.$emit('updated', response.data);
                    this.$modal.modal('hide');
                }).catch(error => {
                    this.errors = error.response.data.errors;
                })
            }
        }
    }
</script>
