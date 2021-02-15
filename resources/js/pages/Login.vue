<template>
    <!-- begin login -->
    <div class="login login-with-news-feed">
        <!-- begin news-feed -->
        <div class="news-feed">
            <div class="news-image" style="background-image: url(/color/assets/img/login-bg/login-bg-11.jpg)"></div>
        </div>
        <!-- end news-feed -->
        <!-- begin right-content -->
        <div class="right-content">
            <!-- begin login-header -->
            <div class="login-header">
                <div class="brand">
                    <span class="logo"></span> <b>Hack</b> Shopping
                    <small>Korea's best hack shopping mall</small>
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
                        <input type="text" :class="errorClass()" v-model="email" placeholder="email" autofocus required />
                    </div>
                    <div class="form-group m-b-15">
                        <input type="password" :class="errorClass()" v-model="password" placeholder="password" required />
                    </div>
                    <div v-if="has_error" class="alert alert-danger text-center">
                        <strong>가입하지 않은 아이디이거나, 잘못된 비밀번호입니다.</strong>
                    </div>
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-dark btn-block btn-lg">Login</button>
                    </div>
                    <div class="m-t-10 m-b-10 text-center">
                        <a class="g-color-green">Forget?</a>
                        <span class="g-color-black">|</span>
                        <a class="g-color-green" data-toggle="modal" data-target="#registerModal">Register</a>
                    </div>
                    <hr class="m-t-10 m-b-10" />
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-block btn-lg loginBtn loginBtn--google text-center" @click="authProvider('google')">Google</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-block btn-lg loginBtn loginBtn--facebook text-center" @click="authProvider('facebook')">Facebook</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- end login-content -->
        </div>
        <register></register>
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
        register,
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
                fetchUser: true,
                params: {
                    email: app.email,
                    password: app.password
                }
            })
            .then(() => {
                // success
                this.$router.push({
                    name: 'home'
                })
                let message = this.$auth.user().name + '님 환영합니다.'
                this.$toast.success(message, "Success");
            }, ({ response }) => {
                // error
                app.has_error = true
                this.$toast.error(response.data.message, response.data.error)
            });

        },

        authProvider(provider) {
            this.$auth.oauth2(provider, {
                params: {
                    redirect_uri: `social/${provider}`,
                    response_type: 'code',
                    scope: 'email',
                    state: {},
                },
                staySignedIn: true,
                fetchUser: true,
            })
        },

    },
}
</script>

<style lang="scss" scoped>
    a {
        cursor: pointer;
    }
    /* Shared */
    .loginBtn {
        box-sizing: border-box;
        position: relative;
        /* width: 13em;  - apply for fixed size */
        margin: 0.2em;
        padding: 0 15px 0 46px;
        border: none;
        text-align: left;
        line-height: 34px;
        white-space: nowrap;
        border-radius: 0.2em;
        font-size: 16px;
        color: #FFF;
    }
    .loginBtn:before {
        content: "";
        box-sizing: border-box;
        position: absolute;
        top: 0;
        left: 0;
        width: 34px;
        height: 100%;
    }
    .loginBtn:focus {
        outline: none;
    }


    /* Facebook */
    .loginBtn--facebook {
        background-color: #4C69BA;
        background-image: linear-gradient(#4C69BA, #3B55A0);
        /*font-family: "Helvetica neue", Helvetica Neue, Helvetica, Arial, sans-serif;*/
        text-shadow: 0 -1px 0 #354C8C;
    }
    .loginBtn--facebook:before {
        border-right: #364e92 1px solid;
        background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_facebook.png') 6px 6px no-repeat;
    }
    .loginBtn--facebook:hover,
    .loginBtn--facebook:focus {
        background-color: #5B7BD5;
        background-image: linear-gradient(#5B7BD5, #4864B1);
    }


    /* Google */
    .loginBtn--google {
    /*font-family: "Roboto", Roboto, arial, sans-serif;*/
        background: #DD4B39;
    }
    .loginBtn--google:before {
        border-right: #BB3F30 1px solid;
        background: url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/14082/icon_google.png') 6px 6px no-repeat;
    }
    .loginBtn--google:hover,
    .loginBtn--google:focus {
        background: #E74B37;
    }
</style>
