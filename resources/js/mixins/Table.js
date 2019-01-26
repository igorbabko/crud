export default {
    props: ['items', 'withHeading'],

    data() {
        return {
            currentIndex: null,
            table: null,
            item: null
        }
    },

    mounted() {
        this.initTable()
    },

    computed: {
        withActions() {
            return ! this.items
        }
    },

    watch: {
        items() {
            this.table.clear().rows.add(this.items).draw();
        }
    },

    methods: {
        initTable() {
            if (this.withActions) {
                this.options.ajax = this.dataUrl;

                this.options.columns.push({
                    data: 'id',
                    width: '10%',
                    orderable: false,
                    render: (id, type, row, meta) => `
                        <div class="action-buttons" data-id="${meta.row}">
                            <button type="button" class="btn btn-sm btn-primary btn-add" data-toggle="modal" data-target="#viewModal">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-info btn-edit" data-toggle="modal" data-target="#editModal">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button type="button" class="btn btn-sm btn-danger btn-delete" data-toggle="modal" data-target="#confirmationModal">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    `
                });
            } else {
                this.options.data = this.items;
            }

            this.table = $(this.$refs.table).DataTable({
                ...this.options,
                responsive: true,
                aaSorting: [],
                initComplete: (settings, json) => {
                    let self = this;

                    $(this.$refs.table).delegate('.action-buttons button', 'click', function () {
                        let $btn = $(this);
                        self.currentIndex = $btn.parent().data('id');
                        self.item = self.table.row(self.currentIndex).data();
                    })
                }
            });
        },
        add(item) {
            this.table.row.add(item);

            return this;
        },
        update(item) {
            this.table.row(this.currentIndex).data(item);

            return this;
        },
        remove() {
            this.table.row(this.currentIndex).remove();
            this.table.rows().invalidate('data').draw(false);

            return this;
        },
        reset() {
            this.item = this.currentIndex = null
        }
    }
}
