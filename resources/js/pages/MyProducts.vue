<template>
    <div class="g-pr-20--lg">
        <vue-good-table
            :columns="columns"
            :rows="rows"
            :search-options="{
                enabled: true
            }"
            :pagination-options="{
                enabled: true,
                mode: 'pages',
                perPage: 10,
                dropdownAllowAll: false,
            }"
            :sort-options="{
                enabled: true,
                initialSortBy: {field: 'created_at', type: 'desc'}
            }"
        >
        <template slot="table-row" slot-scope="props">
            <span v-if="props.column.field == 'title'">
                <a class="u-link-v5 g-color-black g-color-primary--hover g-cursor-pointer">
                    {{ props.row.title }}
                </a>
            </span>
            <span v-else-if="props.column.field == 'tags'">
                <ul class="u-list-inline mb-0">
                    <li v-for="(tag, key) in props.row.tags" :key="key" class="list-inline-item g-mb-5">
                        <router-link :to="{ name: 'tags.shop', params: { slug: tag.slug } }" class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-12 g-py-4 g-px-10">
                            {{ tag.text }}
                        </router-link>
                    </li>
                </ul>
            </span>
            <span v-else-if="props.column.field == 'file_link'">
                <a @click="fileLink(props.row.file_link)" style="cursor:pointer" class="g-color-primary--hover"><i class="fas fa-file-download fa-lg"></i></a>
            </span>
            <span v-else-if="props.column.field == 'manager'">
                <!-- <i class="fas fa-ellipsis-h"></i> -->
                <div class="dropdown-group dropleft">
                    <div class="dropdown-button btn-more rounded-circle" data-toggle="dropdown">
                        <a class="u-link-v5 g-line-height-0 g-font-size-24 g-color-gray-light-v6 g-color-secondary--hover g-cursor-pointer">
                            <i class="fas fa-ellipsis-h"></i>
                        </a>
                    </div>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item pointer-none">{{ textReadMore(props.row.title) }}</button>
                        <div class="dropdown-divider"></div>
                        <button class="dropdown-item" data-toggle="modal" data-target="#readProduct" @click="getId(props.row.id, 2)"><i class="fas fa-glasses"></i> <span class="g-ml-3">게시물 보기</span></button>
                        <button class="dropdown-item" data-toggle="modal" data-target="#editProduct" @click="getId(props.row.id, 1)"><i class="fas fa-pencil-alt"></i> <span class="g-ml-4">게시물 수정</span></button>
                        <button class="dropdown-item" @click="destroy(props.row.id)"><i class="fas fa-trash"></i> <span class="g-ml-5">게시물 삭제</span></button>
                    </div>
                </div>
            </span>
            <span v-else>
                {{props.formattedRow[props.column.field]}}
            </span>
        </template>
        </vue-good-table>
        <!-- 게시글 수정 Modal -->
        <edit-product v-if="$root.isShowModal == 1" :id="selectedId" @updated="edit"></edit-product>
        <!-- 게시글 읽기 Modal -->
        <read-product v-if="$root.isShowModal == 2" :id="selectedId"></read-product>
    </div>
</template>

<script>
import 'vue-good-table/dist/vue-good-table.css'
import { VueGoodTable } from 'vue-good-table';
import ReadProduct from '../components/ReadProduct'
import EditProduct from '../components/EditProduct'
export default {
    components: {
        VueGoodTable, ReadProduct, EditProduct
    },

    data() {
        return {
            selectedId: '',

            columns: [
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
                    label: '태그',
                    field: 'tags',
                    thClass: this.centerClassFunc,
                    tdClass: this.centerClassFunc,
                    sortable: true,
                    sortFn: this.sortFn,
                },
                {
                    label: '파일',
                    field: 'file_link',
                    thClass: this.centerClassFunc,
                    tdClass: this.centerClassFunc,
                },
                {
                    label: '관리',
                    field: 'manager',
                    thClass: this.centerClassFunc,
                    tdClass: this.centerClassFunc,
                },
            ],

            rows: [

            ],
        }
    },

    mounted() {
        this.getRecords();
    },

    methods: {
        getRecords() {
            axios.get('/my-products')
            .then(({ data }) => {
                this.rows = data.data
            })
            .catch(error => {
                console.log(error.response);
            })
        },

        sortFn(x, y) {
            return (x[0].text < y[0].text ? -1 : (x[0].text > y[0].text ? 1 : 0));
        },

        centerClassFunc() {
            return 'text-center align-middle';
        },

        fileLink(url){
            url ? window.open(url,'_blank','toolbar=no,directories=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=500,height=750,left=0,top=0')
            : ''
        },

        textReadMore(str) {
            var length = 15; // 표시할 글자수 기준
            if (str.length > length) {
                str = str.substr(0, length-2) + '...';
            }
            return str
        },

        getId(id, val) {
            this.selectedId = id
            this.$root.isShowModal = val
        },

        findItemIndex() {
            return this.rows.findIndex(item => item.id == this.selectedId)
        },

        edit(product) {
            this.getRecords();
        },

        destroy(id) {
            this.getId(id, -1)

            this.$toast.question('정말 삭제 하시겠습니까?', "확인", {
            timeout: 20000,
            close: false,
            overlay: true,
            displayMode: 'once',
            id: 'question',
            zindex: 999,
            title: 'Hey',
            position: 'center',
            buttons: [
                ['<button><b>YES</b></button>', (instance, toast) => {

                    this.delete();

                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                }, true],
                ['<button>NO</button>', function (instance, toast) {

                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                }],
            ]
            })
        },

        delete() {
            axios.delete(`products/${this.selectedId}`)
                .then(({ data })  => {
                    // this.items.splice(this.findItemIndex(), 1)
                    this.getRecords()
                    this.$toast.success(data.message, "Success", { timeout: 2000 })
                })
        },
    },
}
</script>

<style lang="scss" scoped>
    .dropdown-item {
        &.pointer-none { pointer-events: none; }
    }
</style>
