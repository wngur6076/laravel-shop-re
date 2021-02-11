<template>
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
                                <a class="u-link-v5 g-color-black g-color-primary--hover g-cursor-pointer"
                                    v-if="props.row.code.length > textMaxSize" @click="textReadMore(props.row.originalIndex)">
                                    {{ props.row.code }}
                                </a>
                                <p v-else>{{ props.row.code }}</p>
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
}
</script>
