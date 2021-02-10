<template>
    <!-- #modal-alert -->
    <div class="modal fade" id="readProduct" ref="modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content u-shadow-v11">
                <div class="modal-header g-pa-0">
                    <div class="embed-responsive embed-responsive-16by9" v-if="product.video">
                        <iframe width="100%" :src="product.video" frameborder="0" allowfullscreen></iframe>
                    </div>
                    <img class="img-fluid w-100" :src="product.image" v-else alt="Image Description">
                </div>
                <div class="modal-body g-bg-white g-pa-30">
                    <span class="d-block g-color-gray-dark-v4 g-font-weight-600 g-font-size-12 text-uppercase mb-2">{{ product.created_date }}</span>
                    <h2 class="h5 g-color-black g-font-weight-600 mb-3">
                        <!-- <a class="u-link-v5 g-color-black g-color-primary--hover g-cursor-pointer product-title">
                            {{ product.title }}
                        </a> -->
                        <a class="u-link-v5 g-color-green product-title">
                            {{ product.title }}
                        </a>
                    </h2>
                    <div class="d-block g-color-gray-dark-v4 g-font-weight-400 g-font-size-14 mb-2 product-body" v-html="product.body_html" ref="bodyHtml"></div>
                    <ul class="u-list-inline mb-0">
                        <li v-for="(tag, key) in product.tags" :key="key" class="list-inline-item g-mb-5">
                            <router-link :to="{ name: 'tags.shop', params: { slug: tag.slug } }" class="u-tags-v1 g-color-gray-dark-v4 g-color-white--hover g-bg-gray-light-v5 g-bg-primary--hover g-font-size-14 g-py-4 g-px-10">
                                {{ tag.text }}
                            </router-link>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">확인</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['id'],

    data() {
        return {
            product: [],
        }
    },

    mounted(){
        $(this.$refs.modal).on("hidden.bs.modal", this.doSomethingOnHidden)

        this.fetchProduct();
    },

    created() {
        const backButtonRouteGuard = this.$router.beforeEach((to, from, next) => {
            $(this.$refs.modal).modal('hide');
            next(true);
        });

        this.$once('hook:destroyed', () => {
            backButtonRouteGuard();
        });
    },

    methods: {
        fetchProduct() {
            axios.get(`products/${this.id}`)
            .then(({ data }) => {
                this.product = data.product
            })
            .catch(error => {
                console.log(error.response);
            })
        },

        doSomethingOnHidden() {
            this.$root.isShowModal = -1
        }
    },
}
</script>

<style lang="scss" scoped>
    .product-body, .product-title {
        word-break: break-all;
    }
</style>
