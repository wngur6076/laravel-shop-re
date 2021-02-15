<template>
    <div class="spinner"></div>
</template>

<script>
export default {
    mounted() {
        let provider = this.$route.params.provider
        this.$auth.oauth2(provider, {
            url: `auth/social/${provider}`,
            code: true,
            fetchUser: true,
            data: {
                code: this.$route.query.code,
                state: this.$route.query.state
            },
        })
        .then(() => {
            // success
            let message = this.$auth.user().name + '님 환영합니다.'
            this.$toast.success(message, "Success");
        }, () => {
            // error
            this.$toast.error('입력을 다시 확인해주세요.', "Error")
        });
    },
}
</script>
