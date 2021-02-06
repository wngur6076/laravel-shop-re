<template>
    <div class="g-pr-20--lg">
        <vue-good-table ref="my-table"
            mode="remote"
            :columns="columns"
            :rows="rows"
            :globalSearch="true"
            :search-options="{
                enabled: true,
                skipDiacritics: true,
            }"
            class="g-mb-10">
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'product'">
                    <a class="u-link-v5 g-color-black g-color-primary--hover g-cursor-pointer product-title"
                    data-toggle="modal" data-target="#readProduct" @click="click(props.row.hash)">
                        {{ props.row.product }}
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
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: '제품',
                    field: 'product',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: '총액',
                    field: 'total',
                    type: 'number',
                    thClass: 'text-center',
                    tdClass: 'text-center',
                },
                {
                    label: '파일',
                    field: 'file_link',
                    thClass: 'text-center',
                    tdClass: this.tdClassFunc,
                },
            ],
            rows: [
                /* { created_at: '2021-02-05 10:06:10', product: '서든 플라이 학살용', total: '5,0000', file_link: 'https://drive.google.com/file/d/1LYozTVCPd5HMAxn0Ypy0M1fu7I6b3GtW/view?usp=sharing', hash: 'alkdawo1' },
                { created_at: '2021-02-04 08:01:05', product: '서든 플라이 랭커용', total: '2,1000', file_link: '', hash: 'besgkp2' } */
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
        getRecords() {
            axios.get(`/charges/purchase?searchTerm=${this.meta.searchTerm}&per_page=${this.meta.per_page}&sort=${this.sort}&order=${this.order}`,
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

        tdClassFunc(row) {
            if (! row.file_link) {
                return 'text-center g-color-black';
            }
            return 'text-center g-color-green';
        },

        fileLink(url){
            url ? window.open(url,'_blank','toolbar=no,directories=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=500,height=750,left=0,top=0')
            : ''
        },

        click(hash) {
            console.log(hash)
        }
    }
}
</script>
