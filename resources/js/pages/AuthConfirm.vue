<template>
    <div class="spinner"></div>
</template>

<script>
export default {
    mounted() {
        this.$auth.login({
            method: 'POST',
            url: 'auth/confirm',
            fetchUser: true,
            redirect: {name: 'home'},
            params: {
                code: this.$route.query.code,
            }
        })
        .then(() => {
            // success
            let message = this.$auth.user().name + '님 환영합니다.'
            this.$toast.success(message, "Success");
        }, () => {
            // error
            this.$router.push({
                name: 'login'
            })
            this.$toast.error('사용한 코드입니다.', "Error")
        });
    }
}
</script>
