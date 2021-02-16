<template>
    <div id="main">
        <header header id="js-header" class="u-header u-header--static">
            <div class="u-header__section u-header__section--light g-bg-white g-transition-0_3">
                <nav class="js-mega-menu navbar navbar-expand-lg hs-menu-initialized hs-menu-horizontal g-pt-0 g-pb-0">
                    <div class="container">
                        <router-link class="navbar-brand" :to="{ name: 'home' }">
                            <img src="/files/logo/logo.png" class="d-flex g-width-90 g-height-50" alt="">
                            <!-- End Logo -->
                        </router-link>

                    </div>
                </nav>
            </div>
        </header>

        <div class="container g-pt-100 g-pb-20">
            <div class="row justify-content-center">
                <div class="col-8">
                    <!-- begin panel -->
                    <div class="panel panel-inverse border border-dark" data-sortable-id="form-stuff-1">
                        <!-- begin panel-heading -->
                        <div class="panel-heading">
                            <h4 class="panel-title">비밀번호 변경</h4>
                        </div>
                        <!-- end panel-heading -->
                        <!-- begin panel-body -->
                        <div class="panel-body p-b-0">
                            <div class="alert alert-muted text-center">
                                8자 이상의 새 비밀번호를 만드세요. <code>영문, 숫자, 특수기호</code>를 함께 사용하면 보안 수준이 높은 비밀번호를 만들 수 있습니다.
                            </div>
                            <form class="m-t-25" @submit.prevent="reset" method="post">
                                <div class="form-group row m-b-15">
                                    <label class="col-form-label col-md-2">새 비밀번호</label>
                                    <div class="col-md-10">
                                        <input type="password" class="form-control m-b-5" :class="errorClass()" v-model="password" placeholder="새로운 비밀번호" autofocus required />
                                    </div>
                                </div>
                                <div class="form-group row m-b-15">
                                    <label class="col-form-label col-md-2">비밀번호 확인</label>
                                    <div class="col-md-10">
                                        <input type="password" class="form-control m-b-5" :class="errorClass()" v-model="passwordConfirmation" placeholder="새로운 비밀번호 확인" required />
                                    </div>
                                </div>
                                <div class="modal-footer p-10 m-t-20">
                                    <button type="submit" class="btn btn-dark" :disabled="$root.loading">
                                        <div v-if="$root.loading">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Loading...
                                        </div>
                                        <span v-else>변경하기</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- end panel-body -->
                    </div>
                    <!-- end panel -->


                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            password: '',
            passwordConfirmation: '',
            has_error: false
        }
    },

    methods: {
        reset() {
            this.$root.loading = true;
            axios.post('/auth/reset', {
                password: this.password,
                password_confirmation: this.passwordConfirmation,
                code: this.$route.query.code,
            })
            .then(({ data }) => {
                this.$root.loading = false
                this.$router.push({
                    name: 'home'
                })
                this.$toast.success(data.message, "Success");
            })
            .catch(res => {
                this.$root.loading = false
                this.has_error = true
                this.$toast.error(res.response.data.message, "Error")
            })
        },

        errorClass() {
            return [
                this.has_error  ? 'is-invalid' : ''
            ]
        },
    },
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/_variables.scss';
.u-header__section {
    margin: 0;
    padding: 0;
    box-shadow: 2px 2px 2px 2px $gray;
}

</style>
