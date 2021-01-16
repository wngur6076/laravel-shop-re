<template>
    <div class="register-buttons text-center">
        <button type="button" class="btn btn-info p-t-15 p-b-15 p-l-40 p-r-40" data-toggle="modal"
            data-target="#registerModal">새 계정 만들기</button>

        <div class="modal fade" id="registerModal" tabindex="-1" data-backdrop="static" aria-hidden="true" ref="modal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">가입하기</h5>
                        <button type="button" @click="clearText" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="register" method="post">
                            <label class="control-label">이름 <span class="text-danger">*</span></label>
                            <div class="row m-b-15">
                                <div class="col-md-12">
                                    <input type="text" :class="errorClass('name')" v-model="name"
                                        placeholder="본인 이름을 입력하세요." required autofocus />
                                </div>
                            </div>
                            <label class="control-label">이메일 <span class="text-danger">*</span></label>
                            <div class="row m-b-15">
                                <div class="col-md-12">
                                    <input type="email" :class="errorClass('email')" v-model="email"
                                        placeholder="로그인할 때와 비밀번호 재설정해야 할 때 사용하는 정보입니다." required />
                                </div>
                            </div>
                            <label class="control-label">비밀번호 <span class="text-danger">*</span></label>
                            <div class="row m-b-15">
                                <div class="col-md-12">
                                    <input type="password" :class="errorClass('password')" v-model="password"
                                        placeholder="여덟 자리 이상의 비밀번호를 입력하세요." required />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">가입하기</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                    @click="clearText">나가기</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                name: null,
                email: null,
                password: null,

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
                this.name = null
                this.email = null
                this.password = null
                this.errors = {}
            },

            register() {
                var app = this
                this.$auth.register({
                    data: {
                        name: app.name,
                        email: app.email,
                        password: app.password,
                    },
                    success: function () {
                        $(this.$refs.modal).modal('hide')
                        app.clearText()
                        this.$toast.success('회원 가입 완료되었습니다.', "Success")
                    },
                    error: function (res) {
                        app.errors = res.response.data.errors || {}
                        this.$toast.error('입력을 다시 확인해주세요.', "Error")
                    }
                })
            }
        },
    }
</script>
