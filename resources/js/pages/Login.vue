<template>
    <!-- begin login -->
    <div class="login login-with-news-feed">
        <!-- begin news-feed -->
        <div class="news-feed">
            <div class="news-image" style="background-image: url(/color/assets/img/login-bg/login-bg-11.jpg)"></div>
            <div class="news-caption">
                <h4 class="caption-title"><b>Color</b> Admin App</h4>
                <p>
                    Download the Color Admin app for iPhone®, iPad®, and Android™. Lorem ipsum dolor sit amet,
                    consectetur adipiscing elit.
                </p>
            </div>
        </div>
        <!-- end news-feed -->
        <!-- begin right-content -->
        <div class="right-content">
            <!-- begin login-header -->
            <div class="login-header">
                <div class="brand">
                    <span class="logo"></span> <b>Color</b> Admin
                    <small>responsive bootstrap 4 admin template</small>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-in-alt"></i>
                </div>
            </div>
            <!-- end login-header -->
            <!-- begin login-content -->
            <div class="login-content">
                <form @submit.prevent="login" method="post" class="margin-bottom-0">
                    <div class="form-group m-b-15">
                        <input type="text" :class="errorClass()" v-model="email" placeholder="이메일" autofocus required />
                    </div>
                    <div class="form-group m-b-15">
                        <input type="password" :class="errorClass()" v-model="password" placeholder="비밀번호" required />
                    </div>
                    <div v-if="has_error" class="alert alert-danger text-center">
                        <strong>가입하지 않은 아이디이거나, 잘못된 비밀번호입니다.</strong>
                    </div>
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-success btn-block btn-lg">로그인</button>
                    </div>
                    <div class="m-t-10 m-b-10 text-center">
                        <router-link :to="{name: 'home'}">
                            비밀번호를 잊으셨나요?
                        </router-link>
                    </div>
                </form>
                <hr class="m-t-15" />
                <register></register>
            </div>
            <!-- end login-content -->
        </div>
        <!-- end right-container -->
    </div>
    <!-- end login -->
</template>

<script>
import register from '../components/Register'

export default {
    data() {
        return {
            email: null,
            password: null,
            has_error: false
        }
    },

    components: {
        register
    },

    methods: {
        errorClass() {
            return [
                'form-control form-control-lg',
                this.has_error  ? 'is-invalid' : ''
            ]
        },
            
        login() {
            var app = this
            this.$auth.login({
                params: {
                    email: app.email,
                    password: app.password
                },
                success: function () {
                    this.$router.push({
                        name: 'home'
                    })
                    let message = this.$auth.user().name + '님 환영합니다.'
                    this.$toast.success(message, "Success");
                },
                error: function () {
                    app.has_error = true
                },
                rememberMe: true,
                fetchUser: true
            })
        }
    },
}
</script>
