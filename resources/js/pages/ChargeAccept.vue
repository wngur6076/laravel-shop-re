<template>
    <div class="g-pr-20--lg">
        <vue-good-table ref="my-table"
            mode="remote"
            :columns="columns"
            :rows="rows"
            :globalSearch="true"
            :select-options="{ enabled: true }"
            :search-options="{
                enabled: true,
                skipDiacritics: true,
            }"
            @on-sort-change="onSortChange"
            @on-search="onSearch" class="g-mb-10">
            <div slot="table-actions">
                <button class="btn u-btn-primary" @click="remove(false)">승인하기</button>
            </div>
            <div slot="selected-row-actions">
                <a class="btn-delete" style="color: orangered;" @click="remove(true)">삭제하기</a>
            </div>
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
            this.sort = params[0].field;
            this.order = params[0].type;
            this.getRecords();
        },

        getRecords() {
            axios.get(`/admin/accept?searchTerm=${this.meta.searchTerm}&per_page=${this.meta.per_page}&sort=${this.sort}&order=${this.order}`,
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

        remove(type) {
            let selectIds = []
            this.$refs['my-table'].selectedRows.forEach(row => {
                selectIds.push(row.id)
            });

            axios.post('/admin/accept', {
                selectIds: selectIds,
                type: type
            })
            .then(({ data }) => {
                this.getRecords();
                this.$toast.success(data.message, "Success")
            })
            .catch(({ response }) => {
                this.$toast.error('승인 목록을 확인하세요.', "Error")
                console.log(response.data.errors)
            })
        },

        centerClassFunc() {
            return 'text-center align-middle';
        },
    },
}
</script>

<style lang="scss">
    .btn-delete {
        cursor: pointer;
        &:hover {
            font-weight: 900;
        }
    }

    a:hover {
        text-decoration: none;
    }
</style>
