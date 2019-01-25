<template>
    <div ref="modal" class="modal fade" id="createLessonModal" tabindex="-1" role="dialog" aria-labelledby="createLessonModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createLessonModalLabel">New Lesson</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="createLesson">
                        <div class="form-group">
                            <label for="name" class="col-form-label">Name:</label>
                            <input v-model="lesson.name" type="text" :class="['form-control', {'is-invalid': isInvalid('name')}]" id="name">
                            <div v-if="isInvalid('name')" v-text="errors.name[0]" class="invalid-feedback"></div>
                        </div>
                        <select class="selectpicker" v-model="lesson.user_ids" multiple>
                            <option v-for="user in users" :value="user.id">{{ user.name }}</option>
                        </select>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button @click="createLesson" type="button" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['users'],

        data() {
            return {
                errors: null,
                lesson: {
                    name: '',
                    user_ids: [],
                }
            }
        },

        mounted () {
            $(this.$refs.modal).on('shown.bs.modal', (e) => {
                $('.selectpicker').selectpicker();
                $('#name').focus()
            })
        },

        computed: {
            isInvalid () {
                return field => {
                    return this.errors && this.errors[field];
                }
            }
        },

        methods: {
            createLesson() {
                axios.post('/api/lessons', this.lesson).then(response => {
                    console.log(response)

                    this.$emit('created', response.data)
                }).catch(error => {
                    this.errors = error.response.data.errors
                })
            }
        }
    }
</script>
