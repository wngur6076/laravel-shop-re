<template>
    <!-- #modal-alert -->
    <div class="modal fade" id="orderDetails" ref="modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <a class="u-link-v5 w-100 text-center g-color-green">{{ orderDetails.title }}</a>
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
                            initialSortBy: {field: 'period', type: 'asc'}
                        }"
                        :search-options="{
                            enabled: true
                        }">
                        <template slot="table-row" slot-scope="props">
                            <span v-if="props.column.field == 'period'">
                                {{ periodConvert(props.row.period) }}
                            </span>
                            <span v-else-if="props.column.field == 'code'">
                                <a class="u-link-v5 g-color-black g-color-primary--hover g-cursor-pointer" @click="copyToClipboard(props.row.id)" :ref="props.row.id">{{ props.row.code }}</a>
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

    props: ['orderDetails'],

    data() {
        return {
            columns:
            [
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

    methods: {
        getRecords() {
            axios.get(`/charges/purchase/${this.orderDetails.hash}`)
            .then(({ data }) => {
                this.rows = data.codeList
            })
            .catch(error => {
                console.log(error.response);
            })
        },

        centerClassFunc() {
            return 'text-center align-middle';
        },

        periodConvert(period) {
            if (period == 255) {
                return '무제한'
            } else {
                return period + '일'
            }
        },

        doSomethingOnHidden() {
            this.$root.isShowModal = -1
        },

        copyToClipboard(containerid){
            var range = document.createRange();
            let containerNode = this.$refs[containerid]
            range.selectNode(containerNode); //// this part
            window.getSelection().removeAllRanges();
            window.getSelection().addRange(range);
            document.execCommand("copy");
            window.getSelection().removeAllRanges();
            this.$toast.success('클립보드에 복사되었습니다', "Success")
        }
    },
}
</script>
