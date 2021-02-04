<template>
    <div class="g-pr-20--lg">
        <div class="g-bg-white g-pa-30 u-shadow-v11 text-center">
            <form @submit.prevent="handleSubmit" autocomplete="off">
                <label class="g-mb-10 g-font-weight-600" for="remitter">핀 번호</label>
                <div class="form-group g-mb-10" v-for="(pin, k) in pinList" :key="k">
                    <div class="col-12">
                        <div class="row list-inline d-flex justify-content-between mb-0 align-items-center">
                            <div :class="classes(k)"  v-for="(number, k) in pin.number" :key="k">
                                <input type="text" class="form-control" :placeholder="placeholder(k)" v-int v-model="pin.number[k]" :maxlength="maxlength(k)">
                            </div>
                            <div class="col-2 g-px-5">
                                <input type="text" class="form-control" placeholder="금액 입력" v-model="pin.amount" v-int>
                            </div>
                            <div class="col-1 align-center g-px-5">
                                <i class="fas fa-minus-circle align-items-center text-center" @click="remove(k)" v-show="k || ( !k && pinList.length > 1)" style="cursor: pointer;"></i>
                                <i class="fas fa-plus-circle" @click="add(k)" v-show="k == pinList.length-1" style="cursor: pointer;"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="my-3">

                <div class="list-inline-item d-flex justify-content-end align-items-center"  v-if="isEmptyPinList">
                    <p class="g-font-weight-400 g-color-gray list-inline-item mb-0 mr-4">총 금액</p>
                    <h4 class="g-font-weight-700 g-color-black list-inline-item mb-0 mr-1">{{ numberWithCommas(total) }}원</h4>
                </div>

                <div class="alert alert-danger g-mt-30">
                    <h5><i class="fa fa-info-circle"></i> 충전시 유의 사항</h5>
                    <p>
                        상품권 금액과 핀 번호가 정확하다면 3분 내로 충전됩니다.
                        핀 번호가 일치하지 않을 시 취소됩니다.
                    </p>
                </div>

                <button class="btn u-btn-outline-primary btn-lg btn-block" :disabled="disabled"><span>요청하기</span></button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            pinList: [{
                number: ['', '', '', ''],
                amount: ''
            }],
        }
    },

    computed: {
        total() {
            let result = 0;
            this.pinList.forEach(pin => {
                if (!isNaN(pin.amount)) {
                    result += Number(pin.amount)
                }
            });
            return result
        },

        isEmptyPinList() {
            return this.pinList[0].amount != ''
        },

        disabled() {
            let check = false
            this.pinList.forEach(pin => {
                if (! pin.amount || isNaN(pin.amount)) {
                    check = true
                }
                for (const i in pin.number) {
                    if (! pin.number[i] || pin.number[i].length < 4) {
                        check = true
                        break
                    }
                }
            });
            return check
        },
    },

    methods: {
        handleSubmit() {
            axios.post('/charges', {
                pinList: this.pinList,
                type: true
            })
            .then(({ data }) => {
                this.$toast.success(data.message, "Success")
                // console.log(data.data)
                this.pinList = [{
                    number: ['', '', '', ''],
                    amount: ''
                }]
            })
            .catch(({ response }) => {
                this.$toast.error('빈칸을 채워주세요.', "Error")
                console.log(response.data.errors)
            })
        },

        add(index) {
            this.pinList.push({
                number: ['', '', '', ''],
                amount: ''
            });
        },

        remove(index) {
            this.pinList.splice(index, 1)
        },

        classes(k) {
            return [
                'g-px-5',
                k != 3 ? 'col-2'  : 'col-3'
            ]
        },

        placeholder(k) {
            return k != 3 ? '4자리'  : '4-6자리'
        },

        maxlength(k) {
            return k != 3 ? '4'  : '6'
        },

        numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        }
    },
}
</script>
