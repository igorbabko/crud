<template>
    <div ref="modal" class="modal fade" id="showLessonModal" tabindex="-1" role="dialog" aria-labelledby="showLessonModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div v-if="lesson" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showLessonModalLabel">{{ lesson.name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <users :users="lesson.users" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['lesson'],

        mounted() {
            $(this.$refs.modal).on('hidden.bs.modal', (e) => {
                this.$emit('reset');
            });
        }
    }
</script>
