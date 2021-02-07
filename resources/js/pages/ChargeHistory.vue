<template>
    <div class="g-pr-20--lg">
        <vue-good-table
            mode="remote"
            :columns="columns"
            :rows="rows"
            :globalSearch="true"
            :search-options="{
                enabled: true,
                skipDiacritics: true,
            }"
            @on-sort-change="onSortChange"
            @on-search="onSearch" class="g-mb-10">
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'accept'">
                    <i class="fas fa-check fa-lg"></i>
                </span>
                <span v-else>
                    {{props.formattedRow[props.column.field]}}
                </span>
            </template>
        </vue-good-table>
        <pagination :meta="meta"></pagination>
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

    data() {
        return {
            meta: {
                searchTerm: '',
                total: 0,
                per_page: 20,
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
                    label: '종류',
                    field: 'type',
                    thClass: this.centerClassFunc,
                    tdClass: this.centerClassFunc,
                },
                {
                    label: '핀번호',
                    field: 'pin_number',
                    thClass: this.centerClassFunc,
                    tdClass: this.centerClassFunc,
                },
                {
                    label: '금액',
                    field: 'amount',
                    type: 'number',
                    thClass: this.centerClassFunc,
                    tdClass: this.centerClassFunc,
                },
                {
                    label: '승인',
                    field: 'accept',
                    thClass: this.centerClassFunc,
                    tdClass: this.tdClassFunc,
                },
            ],
            rows: [],
        };
    },

    watch: {
        "$route": 'getRecords'
    },

    mounted() {
        this.getRecords();
    },

    methods: {
        onSortChange(params) {
            params[0].field == 'accept' ? this.sort = 'deleted_at' : this.sort = params[0].field;
            this.order = params[0].type;
            this.getRecords();
        },

        getRecords() {
            axios.get(`/charges/history?searchTerm=${this.meta.searchTerm}&per_page=${this.meta.per_page}&sort=${this.sort}&order=${this.order}`,
            { params: this.$route.query })
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

        updateParams(newProps) {
            this.meta = Object.assign({}, this.meta, newProps);
        },

        onSearch: _.debounce(function (params) {
            this.updateParams(params);
            this.getRecords();
            return false;
        }, 100),

        centerClassFunc() {
            return 'text-center align-middle';
        },

        tdClassFunc(row) {
            if (! row.accept) {
                return 'text-center align-middle';
            }
            return 'text-center align-middle g-color-green';
        },
    }
}
</script>
