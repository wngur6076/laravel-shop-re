<template>
    <div class="modal fade" id="productDetails" ref="modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="u-link-v5 w-100 text-center g-color-green">{{ product.title }}</a>
                    <button type="button" class="close g-ml-0" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body g-bg-white g-pa-0">
                    <vue-good-table
                        :columns="columns"
                        :rows="rows"
                        :sort-options="{
                            enabled: true,
                            initialSortBy: {field: 'created_at', type: 'desc'}
                        }"
                        :search-options="{
                            enabled: true
                        }"
                        :pagination-options="{
                            enabled: true,
                            mode: 'pages',
                            perPage: 5,
                            dropdownAllowAll: false,
                        }">
                        <template slot="table-row" slot-scope="props">
                            <span v-if="props.column.field == 'period'">
                                {{ periodConvert(props.row.period) }}
                            </span>
                            <span v-else-if="props.column.field == 'code'">
                                <a class="u-link-v5 g-color-black g-color-primary--hover g-cursor-pointer"
                                    v-if="props.row.code.length > textMaxSize" @click="textReadMore(props.row.originalIndex)">
                                    {{ props.row.code }}
                                </a>
                                <p v-else class="g-mb-0">{{ props.row.code }}</p>
                            </span>
                            <span v-else>
                                {{props.formattedRow[props.column.field]}}
                            </span>
                        </template>
                    </vue-good-table>
                </div>
                <div class="modal-footer g-pa-5">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">확인</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import 'vue-good-table/dist/vue-good-table.css'
import { VueGoodTable } from 'vue-good-table';
export default {
    components: {
        VueGoodTable
    },

    props: ['product'],

    data() {
        return {
            textMaxSize: 20,
            tempCodeList: [],

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
                    label: '기간',
                    field: 'period',
                    type: 'number',
                    thClass: this.centerClassFunc,
                    tdClass: this.centerClassFunc,
                },
                {
                    label: '코드',
                    field: 'code',
                    thClass: this.centerClassFunc,
                    tdClass: this.centerClassFunc,
                },
                {
                    label: '금액',
                    field: 'price',
                    type: 'number',
                    thClass: this.centerClassFunc,
                    tdClass: this.centerClassFunc,
                },
            ],
            rows: [],
        }
    },

    mounted(){
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
        getRecords() {
            axios.get(`/my-products/${this.product.id}`)
            .then(({ data }) => {
                this.rows = data.data
                this.tempCodeList = []
                this.rows.forEach(element => {
                    this.tempCodeList.push(element.code)
                    if (element.code.length > this.textMaxSize)
                        element.code = element.code.substr(0, this.textMaxSize-2) + '...';
                    element.readMore = false
                });
            })
            .catch(error => {
                console.log(error.response);
            })
        },

        doSomethingOnHidden() {
            this.$root.isShowModal = -1
        },

        periodConvert(period) {
            if (period == 255) {
                return '무제한'
            } else {
                return period + '일'
            }
        },

        centerClassFunc() {
            return 'text-center align-middle';
        },

        textReadMore(index) {
            this.rows[index].readMore = ! this.rows[index].readMore

            if (! this.rows[index].readMore) {
                this.rows[index].code = this.rows[index].code.substr(0, this.textMaxSize-2) + '...';
            } else {
                this.rows[index].code = this.tempCodeList[index]
            }
        }
    }
}
</script>
