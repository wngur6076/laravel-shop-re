<template>
    <div class="modal fade" id="passwordRemindModal" tabindex="-1" data-backdrop="static" aria-hidden="true" ref="modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">계정찾기</h5>
                    <button type="button" @click="clearText" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="authFind" method="post">
                        <label class="control-label">이메일 <span class="text-danger">*</span></label>
                        <div class="row m-b-15">
                            <div class="col-12">
                                <input type="email" :class="errorClass('email')" v-model="email"
                                    placeholder="계정을 검색하려면 이메일 주소를 입력하세요." required />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" :disabled="$root.loading">
                                <div v-if="$root.loading">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </div>
                                <span v-else>계정찾기</span>
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                @click="clearText">나가기</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: null,

                errors: {}
            }
        },

        methods: {
            errorClass(column) {
                return [
                    'form-control text-center',
                    this.errors[column] && this.errors[column][0] ? 'is-invalid' : ''
                ]
            },

            clearText() {
                this.email = null
                this.errors = {}
            },

            authFind() {
                this.$root.loading = true;
                axios.post('/auth/remind', {
                    email: this.email,
                })
                .then(({ data }) => {
                    $(this.$refs.modal).modal('hide')
                    this.clearText()
                    this.$root.loading = false
                    this.$toast.info('비밀번호를 바꾸는 방법을 담은 이메일을 발송했습니다.', "Info")
                })
                .catch(res => {
                    this.$root.loading = false
                    this.errors = res.response.data.errors || {}
                    this.$toast.error('입력을 다시 확인해주세요.', "Error")
                })
            }
        },
    }
</script>
