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
                            <label for="email" class="col-form-label">Email:</label>
                            <input v-model="form.email" type="email" :class="['form-control', {'is-invalid': isInvalid('email')}]" id="email">
                            <div v-if="isInvalid('email')" v-text="errors.email[0]" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="job_title" class="col-form-label">Job Title:</label>
                            <input v-model="form.job_title" type="text" :class="['form-control', {'is-invalid': isInvalid('job_title')}]" id="job_title">
                            <div v-if="isInvalid('job_title')" v-text="errors.job_title[0]" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="userIds" class="col-form-label">Lessons:</label>
                            <select id="userIds" class="selectpicker" v-model="form.lesson_ids" multiple>
                                <option v-for="lesson in lessons" :key="lesson.id" :value="lesson.id">{{ lesson.name }}</option>
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

        props: ['lessons'],

        data() {
            return {
                type: 'users',
                form: {
                    name: '',
                    email: '',
                    job_title: '',
                    lesson_ids: []
                }
            }
        },

        computed: {
            lessonIds() {
                return this.item ? this.item.lessons.map(lesson => parseInt(lesson.id)) : [];
            },
        },

        methods: {
            fillForm() {
                this.form.name = this.item ? this.item.name : '';
                this.form.email = this.item ? this.item.email : '';
                this.form.job_title = this.item ? this.item.job_title : '';
                this.form.lesson_ids = this.lessonIds;
            },
            emptyForm() {
                this.form = { name: '', email: '', job_title: '', lesson_ids: [] };
            }
        }
    }
</script>
