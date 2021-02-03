<template>
    <div class="g-pr-20--lg">
        <vue-good-table ref="my-table"
            :columns="columns"
            :rows="rows"
            :select-options="{ enabled: true }"
            :search-options="{ enabled: true }"
            :pagination-options="pagination">
            <div slot="table-actions">
                <button class="btn u-btn-primary btn-lg btn-block" @click="accept"><span>승인하기</span></button>
            </div>
        </vue-good-table>
    </div>
</template>

<script>
    import 'vue-good-table/dist/vue-good-table.css'
    import { VueGoodTable } from 'vue-good-table';
    export default {
        components: {
            VueGoodTable,
        },

        data() {
            return {
                columns: [
                    {
                        label: '날짜',
                        field: 'created_at',
                        type: 'date',
                        dateInputFormat: 'yyyy-MM-dd hh:mm:ss',
                        dateOutputFormat: 'yyyy-MM-dd hh:mm:ss',
                    },
                    {
                        label: '종류',
                        field: 'type',
                    },
                    {
                        label: '핀번호',
                        field: 'pin_number',
                    },
                    {
                        label: '금액',
                        field: 'amount',
                        type: 'number',
                    },
                ],
                rows: [],

                pagination: {
                    enabled: true,
                    mode: 'pages',
                    perPage: 20
                },
            };
        },

        mounted() {
            this.fetchChargeAccept();
        },

        methods: {
            fetchChargeAccept() {
                axios.get('/admin/accept')
                .then(({ data }) => {
                    this.rows = data.data
                })
                .catch(error => {
                    console.log(error.response);
                })
            },

            accept() {
                let selectIds = []
                this.$refs['my-table'].selectedRows.forEach(row => {
                    selectIds.push(row.id)
                });
                axios.post('/admin/accept', {
                    selectIds: selectIds,
                })
                .then(({ data }) => {
                    console.log(data)
                })
                .catch(({ response }) => {
                    console.log(response.data.errors)
                })
            },
        },
    }

</script>
