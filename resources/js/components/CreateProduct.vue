<template>
    <!-- #modal-alert -->
    <div class="modal fade" id="createProduct" ref="modal" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">게시물 만들기</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <product-form @submitted="create"></product-form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ProductForm from './ProductForm.vue'

export default {
    components: { ProductForm },

    mounted(){
        $(this.$refs.modal).on("hidden.bs.modal", this.doSomethingOnHidden)
    },
    
    methods: {
        create(data) {
            axios.post('/products', data)
                .then(({ data }) => {
                    $(this.$refs.modal).modal('hide')
                    this.$toast.success(data.message, "Success")
                    if (this.$route.name != 'home')
                        this.$router.push({name: 'home'})
                    // 배열첫번째에 상품 추가 위한 이벤트
                    this.$emit('created', data.product)
                })
                .catch(({ response }) => {
                    console.log(response.data.errors)
                })
        },

        doSomethingOnHidden() {
            this.$root.isShowModal = -1
        },
    },
}
</script>
