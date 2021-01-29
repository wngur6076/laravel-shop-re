<template>
    <!-- #modal-alert -->
    <div class="modal fade" id="payment" ref="modal" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">구매하기</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="handleSubmit">
                        <div class="form-group">
                            <h4 class="h6 g-font-weight-600 g-color-black g-mb-15">옵션선택</h4>
                            <select class="form-control" v-model="selected" @change="addOption">
                                <option disabled value="">선택</option>
                                <option v-for="(price, k) in priceList" :key="k" v-bind:value="price">
                                    {{ optionTitle(price) + ` | ${numberWithCommas(price.price)}원` }}
                                </option>
                            </select>
                        </div>

                        <div class="alert alert-danger text-center" v-if="has_error">
                            <p>{{ error_message }}</p>
                        </div>

                        <div class="form-group" v-for="(option, k) in selectOptions" :key="k">
                            <div class="jumbotron g-mb-10">
                                <p class="g-color-gray">{{ optionTitle(option) }}</p>
                                <hr class="my-3">

                                <div class="list-inline d-flex justify-content-between mb-0 align-items-center">
                                        <quantity v-model="option.quantity" class="list-inline-item" :min="1" :max="option.maxQuantity"></quantity>

                                        <div class="list-inline-item d-flex">
                                            <p class="g-font-weight-600 g-color-black mb-0 list-inline-item">{{ numberWithCommas(option.price * option.quantity) }}원</p>
                                            <i class="fas fa-minus-circle list-inline-item" @click="remove(k)" style="cursor: pointer;"></i>
                                        </div>
                                </div>
                            </div>
                        </div>

                        <div class="list-inline-item d-flex justify-content-end align-items-center g-mb-10" v-if="isEmptyOptions">
                            <p class="g-font-weight-400 g-color-gray list-inline-item mb-0 mr-4">총 상품금액</p>
                            <h4 class="g-font-weight-700 g-color-black list-inline-item mb-0 mr-1">{{ numberWithCommas(totalPrice) }}원</h4>
                        </div>

                        <div class="modal-footer form-group">
                            <button type="submit" class="btn btn-primary btn-block">구매하기</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Quantity from './Quantity.vue'

export default {
    components: { Quantity },

    props: ['id'],

    data() {
        return {
            product: [],
            priceList: [],
            selected: '',
            selectOptions: [],
            selectIds: [],
            quantityList: [],

            has_error: false,
            error_message: ''
        }
    },

    mounted(){
        $(this.$refs.modal).on("hidden.bs.modal", this.doSomethingOnHidden)

        this.fetchProduct();
    },

    computed: {
        totalPrice() {
            let result = 0;
            this.selectOptions.forEach(option => {
                result += option.price * option.quantity
            });
            return result
        },

        isEmptyOptions() {
            return Object.keys(this.selectOptions).length
        }
    },

    methods: {
        handleSubmit() {
            this.dataInit()

            this.selectOptions.forEach(option => {
                this.selectIds.push(option.id)
                this.quantityList.push(option.quantity)
            });

            axios.post(`payment/${this.id}`, {
                selectIds: this.selectIds,
                quantityList: this.quantityList,
            })
            .then(({ data }) => {
                console.log(data.totalPrice)
            })
            .catch(error => {
                this.has_error = true
                this.error_message = error.response.data.error
                console.log(this.error_message);
            })
        },

        dataInit() {
            this.has_error = false
            this.selectIds = []
            this.quantityList = []
        },

        optionTitle(price) {
            return this.product.title + ` | ${this.getPeriod(price.period)} 코드`
        },

        getPeriod(period) {
            let title = period;
            if (title != '영구제') {
                title = `${period}일`
            }
            return title;
        },

        doSomethingOnHidden() {
            this.$root.isShowModal = -1
        },

        fetchProduct() {
            axios.get(`payment/${this.id}`)
            .then(({ data }) => {
                this.product = data.product
                this.priceList = this.product.price_list

                for (const i in this.priceList) {
                    this.priceList[i].maxQuantity = this.product.max_quantity_list[i]
                }
                this.periodConvert('디코딩')
            })
            .catch(error => {
                console.log(error.response);
            })
        },

        periodConvert(convert = '인코딩') {
            this.priceList.forEach(element => {
                if (convert == '인코딩' && element.period == '영구제')
                    element.period = '-1'
                else if (convert == '디코딩' && element.period == '-1')
                    element.period = '영구제'
            });
        },

        addOption() {
            let check = false;
            this.selectOptions.forEach(option => {
                if (option.id == this.selected.id)
                    check = true
            });

            if (! check) {
                this.selectOptions.push(this.selected);
            }

            this.selected = ""
        },

        remove(index) {
            this.selectOptions.splice(index, 1);
        },

        numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }
    },
}
</script>

<style lang="scss" scoped>
    .jumbotron {
        padding: 20px 15px;
    }
</style>
