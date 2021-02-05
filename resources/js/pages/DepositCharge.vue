<template>
    <div class="g-pr-20--lg">
        <div class="g-bg-white g-pa-30 u-shadow-v11 text-center">
            <form @submit.prevent="handleSubmit" autocomplete="off">
                <div class="form-group g-mb-30">
                    <label class="g-mb-10 g-font-weight-600" for="remitter">입금자명</label>
                    <input id="remitter"
                        class="text-center form-control form-control-md g-brd-none g-brd-bottom g-brd-gray-light-v7 g-brd-gray-light-v3--focus rounded-0 px-0 g-py-10"
                        type="text" placeholder="입금자 이름을 입력해주세요." v-model="name" disabled>
                </div>

                <div class="form-group g-mb-30">
                    <label class="g-mb-10 g-font-weight-600" for="remittance">입금할 금액</label>
                    <input id="remittance"
                        class="text-center form-control form-control-md g-brd-none g-brd-bottom g-brd-gray-light-v7 g-brd-gray-light-v3--focus rounded-0 px-0 g-py-10"
                        type="text" placeholder="충전하실 금액을 입력해주세요." v-model="amount">
                </div>

                <div class="alert alert-danger">
                    <h5><i class="fa fa-info-circle"></i> 충전 유의 사항</h5>
                    <p>
                        입금자명은 한 번 지정 시 변경이 불가능합니다.
                        입금금액과 입금자명이 정확하다면 3분 내로 충전됩니다.
                        24시간 동안 입금이 없을 시 취소됩니다.
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
            name: this.$auth.user().name,
            amount: ''
        }
    },

    watch: {
        amount: function(newValue) {
            const result = newValue.replace(/[^0-9]/g,'')
            .replace(/,/g,'')
            .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            Vue.nextTick(() => this.amount = result);
        }
    },

    computed: {
        disabled() {
            return !this.amount || isNaN(this.uncomma(this.amount))
        }
    },

    methods: {
        handleSubmit() {
            this.$toast.question('입금은행: 부산은행 | 입금계좌: 1122035150602 | 예금주: 김*혁', "계좌번호 안내", {
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

                    this.submit();

                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                }, true],
                ['<button>NO</button>', function (instance, toast) {

                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                }],
            ]
            })
        },

        submit() {
            axios.post('/charges', {
                pin_number: this.name,
                amount: this.uncomma(this.amount),
                type: false
            })
            .then(({ data }) => {
                this.$toast.success(data.message, "Success")
                this.amount = ''
            })
            .catch(({ response }) => {
                console.log(response.data.errors)
            })
        },

        uncomma(str) {
            return str.replace(/[^\d]+/g, '')
        }
    }
}
</script>
