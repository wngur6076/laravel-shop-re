<template>
    <div class="g-pr-20--lg">
        <vue-good-table
            ref="MyCoolTable"
            :columns="columns"
            :rows="rows"
            :search-options="{
                enabled: true
            }"
            :group-options="{
                enabled: true,
                collapsable: true
            }"
            :pagination-options="{
                enabled: true,
                mode: 'pages',
                perPage: 20,
                dropdownAllowAll: false,
            }"
        >
        <template slot="table-row" slot-scope="props">
            <span v-if="props.column.field == 'title'">
                {{ periodConvert(props.row.title) }}
            </span>
            <span v-else>
                {{props.formattedRow[props.column.field]}}
            </span>
        </template>
        
        <div slot="table-actions">
            <v-date-picker v-model="range" is-range :masks="masks">
            <template v-slot="{ inputEvents }">
                <div class="flex justify-center items-center">
                    <div class="dropdown-group d-inline-block">
                        <div class="dropdown-button btn-more rounded-circle" data-toggle="dropdown">
                            <i class="fas fa-calendar fa-lg"></i>
                        </div>
                        <div class="dropdown-menu">
                            <button class="dropdown-item pointer-none">조회기간</button>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item" @click="inquiry(0, 'd')">일별</button>
                            <button class="dropdown-item" @click="inquiry(7, 'd')">일주일</button>
                            <button class="dropdown-item" @click="inquiry(1, 'M')">월별</button>
                            <button class="dropdown-item" @click="inquiry(6, 'M')">분기별</button>
                        </div>
                    </div>

                    <input
                        v-model="range.start"
                        v-on="inputEvents.start"
                        class="border px-2 py-1 w-32 rounded focus:outline-none focus:border-indigo-300 picker"
                    />
                    <i class="fas fa-arrow-right"></i>
                    <input
                        v-model="range.end"
                        v-on="inputEvents.end"
                        class="border px-2 py-1 w-32 rounded focus:outline-none focus:border-indigo-300 picker g-mr-5"
                    />
                </div>
            </template>
            </v-date-picker>
        </div>
        </vue-good-table>

    </div>
</template>

<script>
import 'vue-good-table/dist/vue-good-table.css'
import { VueGoodTable } from 'vue-good-table';
export default {
    components: {
        VueGoodTable
    },

    data() {
        return {
            range: {
                start: this.$moment().subtract(1, 'M').format('YYYY-MM-DD'),
                end: this.$moment().format('YYYY-MM-DD'),
            },

            masks: {
                input: 'YYYY-MM-DD',
            },      

            columns: [
                {
                    label: '제품',
                    field: 'title',
                    type: 'number',
                    thClass: this.centerClassFunc,
                    tdClass: this.centerClassFunc,
                },
                {
                    label: '수량',
                    field: 'quantity',
                    type: 'number',
                    thClass: this.centerClassFunc,
                    tdClass: this.centerClassFunc,
                },
                {
                    label: '매출',
                    field: 'sales',
                    type: 'number',
                    thClass: this.centerClassFunc,
                    tdClass: this.centerClassFunc,
                },
            ],
            rows: [
                /* { id: 0, title: '서든어택 무반동+오토에임', quantity: 38, sales: 200000, children: [
                    { id: 1, title: '1일 코드',  quantity: 1, sales: 100000 },
                    { id: 2, title: '7일 코드',  quantity: 7, sales: 50000 },
                    { id: 3, title: '30일 코드', quantity: 30, sales: 50000 }
                ]},
                { id: 4, title: '서든어택 오토텔', quantity: 14, sales: 10000, children: [
                    { id: 5, title: '1일 코드', quantity: 7, sales: 5000 },
                    { id: 6, title: '7일 코드',   quantity: 7, sales: 5000 }
                ]} */
            ],

        }
    },

    watch: {
        range() {
            this.range.start =this.$moment(this.range.start).format('YYYY-MM-DD')
            this.range.end =this.$moment(this.range.end).format('YYYY-MM-DD')
            this.getRecords();
        }
    },

    mounted() {
        this.getRecords();
    },

    methods: {
        getRecords() {
            axios.get(`/admin/sales?start=${this.range.start}&end=${this.range.end}`)
            .then(({ data }) => {
                this.rows = data.data
                console.log(data)
            })
            .catch(error => {
                console.log(error.response);
            })
        },

        centerClassFunc() {
            return 'text-center align-middle';
        },

        inquiry(n, s) {
            this.range.start = this.$moment(this.range.end).subtract(n, s).format('YYYY-MM-DD')
            this.getRecords();
        },

        periodConvert(period) {
            if (period == 255) {
                return '무제한'
            } else {
                return period + '일'
            }
        },
    }
}
</script>

<style lang="scss" scoped>
    .picker {
        width: 90px;
        
    }

    .dropdown-item {
        &.pointer-none { pointer-events: none; }
    }

    .btn-more {
        cursor: pointer;
        &:hover {
            .fa-calendar {
                color: rgb(114, 192, 44);
            }
        }
    }
</style>