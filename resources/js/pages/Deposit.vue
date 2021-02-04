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
                    <label class="g-mb-10 g-font-weight-600" for="remittance">입금 할 금액</label>
                    <input id="remittance"
                        class="text-center form-control form-control-md g-brd-none g-brd-bottom g-brd-gray-light-v7 g-brd-gray-light-v3--focus rounded-0 px-0 g-py-10"
                        type="text" placeholder="충전하실 금액을 입력해주세요." v-model="amount">
                </div>

                <div class="alert alert-danger">
                    <h5><i class="fa fa-info-circle"></i> 충전시 유의 사항</h5>
                    <p>
                        입금자명은 한 번 지정시 변경이 불가능 합니다.
                        입금금액과 입금자명이 정확하다면 3분내로 충전됩니다.
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
