export default {
    props: ['item'],

    data() {
        return {
            $modal: null,
            errors: null
        }
    },

    mounted() {
        this.$modal = $(this.$refs.modal);

        this.$modal.on('show.bs.modal', (e) => {
            this.fillForm()

            this.$nextTick(() => $('.selectpicker').selectpicker('refresh'))
        });

        this.$modal.on('shown.bs.modal', (e) => {
            this.$modal.find('input').first().select().focus();
        });

        this.$modal.on('hide.bs.modal', (e) => {
            this.emptyForm()
        });

        this.$modal.on('hidden.bs.modal', (e) => {
            $('.selectpicker').selectpicker('refresh');
            this.$emit('reset');
        });
    },

    computed: {
        isInvalid() {
            return field => this.errors && this.errors[field];
        },
        title() {
            return (this.item ? 'Edit ' : 'Create ') + this.resourceName;
        },
        resourceName() {
            let name = pluralize.singular(this.type);
            return name.charAt(0).toUpperCase() + name.slice(1);
        }
    },

    watch: {
        item(value) {
            value ? this.fillForm() : this.emptyForm()
        }
    },

    methods: {
        submit() {
            return this.item ? this.update() : this.create();
        },

        create() {
            axios.post(`/api/${this.type}`, this.form).then(response => {
                this.$emit('created', response.data);
                this.$modal.modal('hide');
            }).catch(error => {
                this.errors = error.response.data.errors;
            })
        },

        update() {
            axios.patch(`/api/${this.type}/${this.item.id}`, this.form).then(response => {
                this.$emit('updated', response.data);
                this.$modal.modal('hide');
            }).catch(error => {
                this.errors = error.response.data.errors;
            })
        }
    }
}
