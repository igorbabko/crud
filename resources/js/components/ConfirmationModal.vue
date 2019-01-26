<template>
    <div ref="modal" class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Are you sure?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button @click="remove" type="button" class="btn btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['item', 'type'],

        data() {
            return {
                $modal: null
            }
        },

        mounted() {
            this.$modal = $(this.$refs.modal);

            this.$modal.on('hidden.bs.modal', (e) => {
                this.$emit('reset');
            });
        },

        methods: {
            remove() {
                axios.delete(`/api/${this.type}/${this.item.id}`).then(response => {
                    this.$emit('deleted');
                    this.$modal.modal('hide');
                });
            }
        }
    }
</script>
