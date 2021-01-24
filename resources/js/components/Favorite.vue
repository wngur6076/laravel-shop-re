<template>
    <a title="Click to mark as favorite product (Click again to undo)"
        :class="classes" @click.prevent="toggle">
        <i class="fas fa-star fa-2x"></i>
        <span class="d-inline-block g-color-gray-dark-v4 g-font-size-13 g-text-underline--none--hover">
            {{ this.product.favorites_count }}
        </span>
    </a>
</template>

<script>
export default {
    props: ['product'],

    computed: {
        classes () {
            return [
                'favorite',
                ! this.$auth.check() ? 'off' : (this.product.is_favorited ? 'favorited' : '')
            ]
        },

        endpoint () {
            return `/${this.product.id}/favorites`;
        },
    },

    methods: {
        toggle () {
            if (! this.$auth.check()) {
                this.$toast.warning('Please login to favorite this product', "warning", {
                    timeout: 3000,
                    position: 'bottomLeft'
                })
                return;
            }
            this.product.is_favorited ? this.destory() : this.create();
        },

        destory () {
            axios.delete(this.endpoint)
            .then(res => {
                this.product.favorites_count--;
                this.product.is_favorited = false;
            })
        },

        create () {
            axios.post(this.endpoint)
            .then(res => {
                this.product.favorites_count++;
                this.product.is_favorited = true;
            })
        }
    },
}
</script>

<style lang="scss" scoped>
@import 'resources/sass/_variables.scss';

    .favorite {
        cursor: pointer;
        color: $gray;
        &.favorited, &.favorited:hover {
            color: $orange;
        }

        &.off, &.off:hover {
            color: $dark-white;
        }
    }
</style>