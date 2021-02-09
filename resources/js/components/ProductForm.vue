<template>
    <form @submit.prevent="handleSubmit" enctype="multipart/form-data">
        <div class="form-group mb-0">
            <h4 class="h6 g-font-weight-600 g-color-black g-mb-0">Info</h4>
            <input type="text"
                class="form-control form-control-md g-resize-none g-brd-none g-brd-bottom g-brd-gray-light-v7 g-brd-gray-light-v3 rounded-0"
                placeholder="임팩트 있는 제목 입력하세요." v-model="title">
            <textarea id="inputGroup-2_3"
                class="form-control form-control-md g-brd-none g-brd-gray-light-v7 g-brd-gray-light-v3--focus rounded-0 g-resize-none"
                placeholder="상품에 대한 소개 해주세요. (마크다운 문법 가능)" v-model="body"></textarea>
        </div>

        <div class="form-group g-mb-15">
            <h4 class="h6 g-font-weight-600 g-color-black g-mb-15">Thumbnail</h4>
            <label class="form-check-inline u-check g-pl-25 ml-0 g-mr-25">
                <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" name="radInline1_1" type="radio" value="video"
                    v-model="thumbnail">
                <div class="u-check-icon-radio-v4 g-absolute-centered--y g-left-0 g-width-18 g-height-18">
                    <i class="g-absolute-centered d-block g-width-10 g-height-10 g-bg-primary--checked"></i>
                </div>
                유튜브
            </label>

            <label class="form-check-inline u-check g-pl-25 ml-0 g-mr-25">
                <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" name="radInline1_1" type="radio" value="image"
                    v-model="thumbnail">
                <div class="u-check-icon-radio-v4 g-absolute-centered--y g-left-0 g-width-18 g-height-18">
                    <i class="g-absolute-centered d-block g-width-10 g-height-10 g-bg-primary--checked"></i>
                </div>
                이미지
            </label>
        </div>

        <div class="form-group" v-if="thumbnail=='video'">
            <h4 class="h6 g-font-weight-600 g-color-black g-mb-15">Video</h4>
            <div class="input-group g-brd-gray-light-v2">
                <input class="form-control form-control-md rounded-0" placeholder="https://youtu.be/동영상번호"
                    v-model="video" type="text">

                <div class="input-group-btn">
                    <div class="btn btn-md h-100 u-btn-primary rounded-0" @click="redirect(video)">확인</div>
                </div>
            </div>
        </div>

        <!-- File Input -->
        <div class="form-group" v-else>
            <h4 class="h6 g-font-weight-600 g-color-black g-mb-15">Image</h4>
            <file-select v-model="photo" :labelPlaceholder="imageName"></file-select>
        </div>
        <!-- End File Input -->
        <div class="form-group">
            <h4 class="h6 g-font-weight-600 g-color-black g-mb-15">Tags</h4>
            <select2-multiple-control v-model="tagsSelect" :options="$root.tags" />
        </div>

        <div class="form-group" v-for="(code, k) in codeList" :key="k">
            <h4 class="h6 g-font-weight-600 g-color-black g-mb-15">Code {{ k+1 }}</h4>
            <div class="col-12">
                <div class="row">
                    <div class="col-3">
                        <select v-model="code.period" @change="periodChange(k)" class="form-control">
                            <option disabled value="">코드 기간 선택</option>
                            <option>1</option>
                            <option>7</option>
                            <option>15</option>
                            <option>30</option>
                            <option>영구제</option>
                        </select>
                    </div>
                    <div class="col-5">
                        <input type="text" class="form-control" v-model="code.code" placeholder="코드 입력">
                    </div>
                    <div class="col-4">
                        <div class="input-group">
                            <input type="text" class="form-control" :disabled="code.disabled" v-model="code.price" @change="priceChange(k)" placeholder="가격 입력" v-int>
                            <div class="input-group-prepend"><span class="input-group-text">원</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <span>
                <i class="fas fa-minus-circle" @click="remove(k)" v-show="k || ( !k && codeList.length > 1)" style="cursor: pointer;"></i>
                <i class="fas fa-plus-circle" @click="add(k)" v-show="k == codeList.length-1" style="cursor: pointer;"></i>
            </span>
            <div class="alert alert-danger text-center" v-if="code.has_error">
                <p>코드기간, 코드입력, 가격입력 모두 작성해주세요.</p>
            </div>
        </div>

        <div class="form-group">
            <h4 class="h6 g-font-weight-600 g-color-black g-mb-15">FileLink</h4>
            <div class="input-group g-brd-gray-light-v2">
                <input class="form-control form-control-md rounded-0" placeholder="파일 다운로드 주소 입력 해주세요."
                    v-model="fileLink" type="text">

                <div class="input-group-btn">
                    <div class="btn btn-md h-100 u-btn-primary rounded-0" @click="redirect(fileLink)">확인</div>
                </div>
            </div>
        </div>

        <div class="modal-footer form-group">
            <button type="submit" :disabled="isInvalid" class="btn btn-primary btn-block">{{ buttonText }}</button>
        </div>
    </form>
</template>

<script>
import Select2MultipleControl from 'v-select2-multiple-component'
import FileSelect from './FileSelect.vue'

export default {
    components: { Select2MultipleControl, FileSelect },

    props: {
        isEdit: {
            type: Boolean,
            default: false
        },

        id: {
            default: ''
        }
    },

    data() {
        return {
            title: '',
            body: '',
            thumbnail: 'video',
            video: '',
            photo: '',
            tagsSelect: [],
            fileLink: '',
            imageName: 'No file choosen',

            codeList: [
                {
                    period: '',
                    code: '',
                    price: '',
                    disabled: false,
                    has_error: false
                }
            ],
        }
    },

    mounted () {
        if (this.isEdit) {
            this.fetchProduct();
        }
    },

    computed: {
        isInvalid () {
            return this.body.length < 10 || this.title.length < 5 || !Object.keys(this.tagsSelect).length
            || this.isInCode() || this.fileLink == ''
        },

        buttonText() {
            return this.isEdit ? '저장' : '게시'
        }
    },

    methods:{
        fetchProduct() {
            axios.get(`products/${this.id}`)
            .then(({ data }) => {
                this.title = data.product.title
                this.body = data.product.body

                this.video = data.product.video_name
                this.imageName = data.product.image_name
                if (this.video)
                    this.thumbnail = 'video'
                else
                    this.thumbnail = 'image'
                data.product.tags.forEach(tag => {
                    this.tagsSelect.push(tag.id)
                });
                this.fileLink = data.product.file_link
                if (data.product.code_list[0].period)
                    this.codeList = data.product.code_list
                this.periodConvert('디코딩')
            })
            .catch(error => {
                console.log(error.response);
            })
        },

        redirect(url) {
            window.open(url, "_blank");
        },

        isInCode() {
            let len = this.codeList.length-1
            return this.codeList[len].period == '' ||
                this.codeList[len].code == '' ||
                this.codeList[len].price == '' ||
                isNaN(this.codeList[len].price)
        },

        periodConvert(convert = '인코딩') {
            this.codeList.forEach(element => {
                if (convert == '인코딩' && element.period == '영구제')
                    element.period = '-1'
                else if (convert == '디코딩' && element.period == '-1')
                    element.period = '영구제'
            });
        },

        handleSubmit() {
            this.codeList.forEach(item => {
                this.$delete(item, 'has_error')
            });
            this.periodConvert()

            const data = new FormData();
            data.append('title', this.title);
            data.append('body', this.body);
            data.append('file_link', this.fileLink);

            const json = JSON.stringify({
                tagsSelect: this.tagsSelect,
                codeList: this.codeList
            });
            data.append('data', json);

            if (this.thumbnail == 'video')
                this.photo = ''
            else
                this.video = ''

            data.append('photo', this.photo)
            data.append('video', this.video)

            this.$emit('submitted', data)
        },

        add(index) {
            if (! this.codeList[index].period || ! this.codeList[index].price) {
                this.codeList[index].has_error = true
                return
            } else {
                this.codeList[index].has_error = false
            }
            this.codeList.push({
                period: '',
                code: '',
                price: '',
                disabled: false,
                has_error: false
            });
        },

        remove(index) {
            let check = false;
            if (! this.codeList[index].disabled) {
                this.codeList.forEach(item => {
                    if (item.period == this.codeList[index].period && item.disabled)
                        check = true
                });
            }
            if (! check) {
                this.codeList.splice(index, 1);
            }
        },

        periodChange(index) {
            this.codeList[index].price = ''
            this.codeList[index].disabled = false

            this.codeList.forEach(item => {
                if (item.period == this.codeList[index].period && item.price) {
                    this.codeList[index].price = item.price
                    this.codeList[index].disabled = true;
                }
            });
        },

        /* 가격을 변경하면 같은기간의 현재가격 전체가 변경 */
        priceChange(index) {
            if (! this.codeList[index].disabled) {
                this.codeList.forEach(item => {
                    if (this.codeList[index].period == item.period) {
                        item.price = this.codeList[index].price
                    }
                });
            }
        }
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
