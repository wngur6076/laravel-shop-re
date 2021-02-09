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
        >
        <div slot="table-actions">
            <v-date-picker v-model="range" is-range>
            <template v-slot="{ inputValue, inputEvents }">
                <div class="flex justify-center items-center">
                    <div class="dropdown-group d-inline-block">
                        <div class="dropdown-button btn-more rounded-circle" data-toggle="dropdown">
                            <i class="fas fa-calendar fa-lg"></i>
                        </div>
                        <div class="dropdown-menu">
                            <button class="dropdown-item pointer-none">조회기간</button>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item">일별</button>
                            <button class="dropdown-item">일주일</button>
                            <button class="dropdown-item">월별</button>
                            <button class="dropdown-item">분기별</button>
                        </div>
                    </div>

                    <input
                        :value="inputValue.start"
                        v-on="inputEvents.start"
                        class="border px-2 py-1 w-32 rounded focus:outline-none focus:border-indigo-300 picker"
                    />
                    <i class="fas fa-arrow-right"></i>
                    <input
                        :value="inputValue.end"
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
                start: this.$moment().format('YYYY-MM-DD'),
                end: this.$moment().subtract(7,'d').format('YYYY-MM-DD'),
            },

            columns: [
                {
                    label: '제품',
                    field: 'title',
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
                { id: 0, title: '서든어택 무반동+오토에임', quantity: 38, sales: 200000, children: [
                    { id: 1, title: '1일 코드',  quantity: 1, sales: 100000 },
                    { id: 2, title: '7일 코드',  quantity: 7, sales: 50000 },
                    { id: 3, title: '30일 코드', quantity: 30, sales: 50000 }
                ]},
                { id: 4, title: '서든어택 오토텔', quantity: 14, sales: 10000, children: [
                    { id: 5, title: '1일 코드', quantity: 7, sales: 5000 },
                    { id: 6, title: '7일 코드',   quantity: 7, sales: 5000 }
                ]}
            ],

        }
    },

    watch: {
        range() {
            console.log(this.$moment(this.range.start).format('YYYY-MM-DD'))
        }
    },

    methods: {
        centerClassFunc() {
            return 'text-center align-middle';
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