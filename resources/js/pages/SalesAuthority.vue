<template>
    <div class="g-pr-20--lg">
        <vue-good-table ref="my-table"
            mode="remote"
            :columns="columns"
            :rows="rows"
            :globalSearch="true"
            :select-options="{
                enabled: true,
                selectOnCheckboxOnly: true,
            }"
            :search-options="{
                enabled: true,
                skipDiacritics: true,
            }"
            @on-sort-change="onSortChange"
            @on-search="onSearch" class="g-mb-10">
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'purchase_amount' && props.row.purchase_amount">
                    <a class="u-link-v5 g-color-black g-color-primary--hover g-cursor-pointer"
                    >
                        {{ props.row.purchase_amount }}
                    </a>
                </span>
                <span v-else-if="props.column.field == 'credit'">
                    <span :class="classes(props.row.credit)" class="badge">{{ creditCheck(props.row.credit) }}</span>
                </span>
                <span v-else>
                    {{props.formattedRow[props.column.field]}}
                </span>
            </template>

            <div slot="table-actions">
                <button class="btn u-btn-primary g-mr-5" @click="remove(false)">승인하기</button>
            </div>
            <div slot="selected-row-actions">
                <a class="btn-delete" style="color: orangered;" @click="remove(true)">기각하기</a>
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
            sort: 'purchase_amount',
            order: 'desc',

            columns:
            [
                {
                    label: '이름',
                    field: 'name',
                    thClass: this.centerClassFunc,
                    tdClass: this.centerClassFunc,
                },
                {
                    label: '등급',
                    field: 'credit',
                    type: 'number',
                    thClass: this.centerClassFunc,
                    tdClass: this.centerClassFunc,
                },
                {
                    label: '이메일',
                    field: 'email',
                    thClass: this.centerClassFunc,
                    tdClass: this.centerClassFunc,
                },
                {
                    label: '보유금액',
                    field: 'money',
                    type: 'number',
                    thClass: this.centerClassFunc,
                    tdClass: this.centerClassFunc,
                },
                {
                    label: '구매금액',
                    field: 'purchase_amount',
                    type: 'number',
                    thClass: this.centerClassFunc,
                    tdClass: this.centerClassFunc,
                },
            ],
            rows: [

            ],
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
            this.sort = params[0].field == 'credit' ? 'role' : params[0].field;
            this.order = params[0].type;
            this.getRecords();
        },

        getRecords() {
            axios.get(`/super/authority?searchTerm=${this.meta.searchTerm}&per_page=${this.meta.per_page}&sort=${this.sort}&order=${this.order}`,
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

            axios.post('/super/authority', {
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

        creditCheck(credit) {
            if (credit == 3)
                return '관리자'
            else if (credit == 2)
                return '판매자'
            else if (credit == 1)
                return '구매자'
            else
                return '비구매자'
        },

        classes(credit) {
            if (credit == 3)
                return 'badge-warning'
            else if (credit == 2)
                return 'badge-success'
            else if (credit == 1)
                return 'badge-primary'
            else
                return 'badge-secondary'
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
