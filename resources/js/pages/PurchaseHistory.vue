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
                <span v-if="props.column.field == 'title'">
                    <a class="u-link-v5 g-color-black g-color-primary--hover g-cursor-pointer"
                    data-toggle="modal" data-target="#orderDetails" @click="getId(props.row, 4)">
                        {{ props.row.title }}
                    </a>
                </span>
                <span v-else-if="props.column.field == 'file_link'">
                    <a @click="fileLink(props.row.file_link)" style="cursor:pointer" class="file-link"><i class="fas fa-folder-open fa-lg"></i></a>
                </span>
                <span v-else>
                    {{props.formattedRow[props.column.field]}}
                </span>
            </template>
        </vue-good-table>
        <pagination :meta="meta"></pagination>

        <order-details v-if="$root.isShowModal == 4" :orderDetails="selected"></order-details>
    </div>
</template>

<script>
import Pagination from '../components/Pagination'
import 'vue-good-table/dist/vue-good-table.css'
import { VueGoodTable } from 'vue-good-table';
import OrderDetails from '../components/OrderDetails'
export default {
    components: {
        VueGoodTable, Pagination, OrderDetails
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
                {
                    label: '파일',
                    field: 'file_link',
                    thClass: this.centerClassFunc,
                    tdClass: this.tdClassFunc,
                },
            ],
            rows: [],

            selected: {
                hash: '',
                title: ''
            }
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
            this.sort = params[0].field;
            this.order = params[0].type;
            this.getRecords();
        },

        getRecords() {
            axios.get(`/purchase/history?searchTerm=${this.meta.searchTerm}&per_page=${this.meta.per_page}&sort=${this.sort}&order=${this.order}`,
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

        tdClassFunc(row) {
            if (! row.file_link) {
                return 'text-center align-middle g-color-black';
            }
            return 'text-center align-middle g-color-green';
        },

        centerClassFunc() {
            return 'text-center align-middle';
        },

        fileLink(url){
            url ? window.open(url,'_blank','toolbar=no,directories=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=500,height=750,left=0,top=0')
            : ''
        },

        getId(row, val) {
            this.selected.title = row.title
            this.selected.hash = row.hash
            this.$root.isShowModal = val
        },
    }
}
</script>
