<template>
    <!-- #modal-alert -->
    <div class="modal fade" id="purchaseAmountDetails" ref="modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="u-link-v5 w-100 text-center g-color-green">{{ user.title }}</a>
                    <button type="button" class="close g-ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body g-bg-white g-pa-0">
                    <vue-good-table
                        mode="remote"
                        :columns="columns"
                        :rows="rows"
                        :globalSearch="true"
                        :search-options="{
                            enabled: true,
                            skipDiacritics: true,
                        }"
                        @on-search="onSearch"
                        @on-sort-change="onSortChange" class="g-mb-10"
                    >
                    </vue-good-table>
                    <pagination :meta="meta" @paginate="pageChange" :isEmit="true"></pagination>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Pagination from '../components/Pagination'
import 'vue-good-table/dist/vue-good-table.css'
import { VueGoodTable } from 'vue-good-table';
export default {
    components: {
        VueGoodTable, Pagination
    },

    props: ['user'],

    data() {
        return {
            meta: {
                searchTerm: '',
                total: 0,
                per_page: 5,
                from: 1,
                to: 0,
                current_page: 1,
            },
            sort: 'created_at',
            order: 'desc',

            columns:
            [
                {
                    label: '날짜',
                    field: 'created_at',
                    type: 'date',
                    dateInputFormat: 'yyyy-MM-dd hh:mm:ss',
                    dateOutputFormat: 'yyyy-MM-dd hh:mm:ss',
                    thClass: this.centerClassFunc,
                    tdClass: this.centerClassFunc,
                },
                {
                    label: '제품',
                    field: 'title',
                    thClass: this.centerClassFunc,
                    tdClass: this.centerClassFunc,
                },
                {
                    label: '총액',
                    field: 'total',
                    type: 'number',
                    thClass: this.centerClassFunc,
                    tdClass: this.centerClassFunc,
                },
            ],
            rows: [
            ],
        }
    },

    mounted() {
        $(this.$refs.modal).on("hidden.bs.modal", this.doSomethingOnHidden)

        this.getRecords();
    },

    created() {
        const backButtonRouteGuard = this.$router.beforeEach((to, from, next) => {
            $(this.$refs.modal).modal('hide');
            next(true);
        });

        this.$once('hook:destroyed', () => {
            backButtonRouteGuard();
        });
    },

    methods: {
        onSortChange(params) {
            this.sort = params[0].field;
            this.order = params[0].type;
            this.getRecords();
        },

        getRecords() {
            axios.get(`/super/authority/${this.user.id}?page=${this.meta.current_page}&searchTerm=${this.meta.searchTerm}&per_page=${this.meta.per_page}&sort=${this.sort}&order=${this.order}`)
            .then(({ data }) => {
                this.rows = data.data
                this.meta = data.meta
                this.meta.searchTerm = data.searchTerm
                this.sort = data.sort
                this.order = data.order
            })
            .catch(error => {
                console.log(error.response);
            })
        },

        pageChange(page) {
            this.meta.current_page = page
            this.getRecords()
        },

        centerClassFunc() {
            return 'text-center align-middle';
        },

        doSomethingOnHidden() {
            this.$root.isShowModal = -1
        },

        updateParams(newProps) {
            this.meta = Object.assign({}, this.meta, newProps);
        },

        onSearch: _.debounce(function (params) {
            this.updateParams(params);
            this.getRecords();
            return false;
        }, 100),
    }
}
</script>
