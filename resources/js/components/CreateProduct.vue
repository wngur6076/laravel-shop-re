<template>
    <!-- #modal-alert -->
    <div class="modal fade" id="createProduct" ref="modal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">게시물 만들기</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
                        <div class="form-group mb-0">
                            <h4 class="h6 g-font-weight-600 g-color-black g-mb-0">Info</h4>
                            <input type="text"
                                class="form-control form-control-md g-resize-none g-brd-none g-brd-bottom g-brd-gray-light-v7 g-brd-gray-light-v3 rounded-0"
                                placeholder="임팩트 있는 제목 입력하세요." v-model="title">
                            <textarea id="inputGroup-2_3"
                                class="form-control form-control-md g-brd-none g-brd-gray-light-v7 g-brd-gray-light-v3--focus rounded-0 g-resize-none"
                                placeholder="상품에 대한 소개 해주세요." v-model="body"></textarea>
                        </div>

                        <div class="form-group g-mb-15">
                            <h4 class="h6 g-font-weight-600 g-color-black g-mb-15">Thumbnail</h4>
                            <label class="form-check-inline u-check g-pl-25 ml-0 g-mr-25">
                                <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" name="radInline1_1"
                                    type="radio" value="video" v-model="thumbnail">
                                <div class="u-check-icon-radio-v4 g-absolute-centered--y g-left-0 g-width-18 g-height-18">
                                    <i class="g-absolute-centered d-block g-width-10 g-height-10 g-bg-primary--checked"></i>
                                </div>
                                유튜브
                            </label>

                            <label class="form-check-inline u-check g-pl-25 ml-0 g-mr-25">
                                <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" name="radInline1_1" type="radio"
                                    value="image" v-model="thumbnail">
                                <div class="u-check-icon-radio-v4 g-absolute-centered--y g-left-0 g-width-18 g-height-18">
                                    <i class="g-absolute-centered d-block g-width-10 g-height-10 g-bg-primary--checked"></i>
                                </div>
                                이미지
                            </label>
                        </div>

                        <div class="form-group" v-if="thumbnail=='video'">
                            <h4 class="h6 g-font-weight-600 g-color-black g-mb-15">Video</h4>
                            <div class="input-group g-brd-gray-light-v2">
                                <input class="form-control form-control-md rounded-0" placeholder="https://youtu.be/동영상번호" v-model="video" type="text">

                                <div class="input-group-btn">
                                    <div class="btn btn-md h-100 u-btn-primary rounded-0" @click="redirect(video)">확인</div>
                                </div>
                            </div>
                        </div>

                        <!-- File Input -->
                        <div class="form-group" v-else>
                            <h4 class="h6 g-font-weight-600 g-color-black g-mb-15">Image</h4>
                            <file-select v-model="photo"></file-select>
                        </div>
                        <!-- End File Input -->
                        <div class="form-group">
                            <h4 class="h6 g-font-weight-600 g-color-black g-mb-15">Tags</h4>
                            <select2-multiple-control v-model="tagsSelect" :options="$root.tags"/>
                        </div>

                        <div class="form-group" v-for="(input,k) in inputs" :key="k">
                            <h4 class="h6 g-font-weight-600 g-color-black g-mb-15">Price {{ k+1 }}</h4>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <select v-model="input.period" class="form-control">
                                            <option disabled value="">코드 기간 선택</option>
                                            <option>1</option>
                                            <option>7</option>
                                            <option>15</option>
                                            <option>30</option>
                                            <option>영구제</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" v-model="input.code" placeholder="코드 입력">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <input type="text" class="form-control" v-model="input.price" placeholder="가격 입력" v-int>
                                            <div class="input-group-prepend"><span class="input-group-text">원</span></div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                            <span>
                                <i class="fas fa-minus-circle" @click="remove(k)" v-show="k || ( !k && inputs.length > 1)"></i>
                                <i class="fas fa-plus-circle" @click="add(k)" v-show="k == inputs.length-1"></i>
                            </span>
                        </div>

                        <div class="form-group">
                            <h4 class="h6 g-font-weight-600 g-color-black g-mb-15">FileLink</h4>
                            <div class="input-group g-brd-gray-light-v2">
                                <input class="form-control form-control-md rounded-0" placeholder="파일 다운로드 주소 입력 해주세요." v-model="fileLink" type="text">

                                <div class="input-group-btn">
                                    <div class="btn btn-md h-100 u-btn-primary rounded-0" @click="redirect(fileLink)">확인</div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer form-group">
                            <button type="submit" :disabled="isInvalid" class="btn btn-primary btn-block">게시</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Select2MultipleControl from 'v-select2-multiple-component';
import FileSelect from './FileSelect.vue'

export default {
    components: { Select2MultipleControl, FileSelect },

    data() {
        return {
            title: '',
            body: '',
            thumbnail: 'video',
            video: '',
            photo: '',
            tagsSelect: [],
            fileLink: '',

            inputs: [
                {
                    period: '',
                    code: '',
                    price: '',
                }
            ]
        }
    },

    computed: {
        isInvalid () {
            return this.body.length < 10 || this.title.length < 5 || !Object.keys(this.tagsSelect).length;
        },
    },

    methods:{
        redirect(url) {
            window.open(url, "_blank");
        },

        handleSubmit() {
            const data = new FormData();
            data.append('title', this.title);
            data.append('body', this.body);

            const json = JSON.stringify({
                tagsSelect: this.tagsSelect
            });
            data.append('data', json);

            if (this.thumbnail == 'video') {
                data.append('video', this.video)
                this.photo = ''
            } else {
                data.append('photo', this.photo);
            }

            axios.post('/products', data)
                .then(({ data }) => {
                    this.dataClear()
                    $(this.$refs.modal).modal('hide')
                    this.$toast.success(data.message, "Success")
                    this.$emit('created', data.product)
                })
                .catch(({ response }) => {
                    console.log(response.data.errors)
                })
        },

        dataClear() {
            this.title = '',
            this.body = '',
            this.thumbnail = 'video',
            this.video = '',
            this.photo = '',
            this.tagsSelect = []
        },

        add(index) {
            this.inputs.push({
                period: '',
                code: '',
                price: '',
            });
        },

        remove(index) {
            this.inputs.splice(index, 1);
        },
    },

}
</script>

<style lang="scss">
@import 'resources/sass/_variables.scss';

    .fa-minus-circle {
        color: $red;
    }

    .fa-plus-circle {
        color: $green;
    }
</style>
