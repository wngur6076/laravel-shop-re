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
    },
}
</script>