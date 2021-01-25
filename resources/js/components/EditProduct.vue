<template>
    <!-- #modal-alert -->
    <div class="modal fade" id="editProduct" ref="modal" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">게시물 수정</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <product-form @submitted="update" :is-edit="true" :id="id"></product-form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ProductForm from './ProductForm.vue'

export default {
    props: ['id'],

    components: { ProductForm },
    
    mounted(){
        $(this.$refs.modal).on("hidden.bs.modal", this.doSomethingOnHidden)
    },

    methods: {
        update(data) {
            // 그냥 axios.put으로 보내면 폼데이터가 []로 가서 해결 위해
            data.append('_method', 'put');
            axios.post(`products/${this.id}`, data)
                .then(({ data }) => {
                    $(this.$refs.modal).modal('hide')
                    this.$toast.success(data.message, "Success")
                    // 배열첫번째에 상품 추가 위한 이벤트
                    this.$emit('updated', data.product)
                })
                .catch(({ response }) => {
                    console.log(response.data.errors)
                })
        },

        doSomethingOnHidden() {
            this.$root.isShowModal = -1
        }
    },
}
</script>