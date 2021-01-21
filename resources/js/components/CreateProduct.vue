<template>
    <!-- #modal-alert -->
    <div class="modal fade" id="createProduct">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">게시물 만들기</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-0">
                        <h4 class="h6 g-font-weight-600 g-color-black g-mb-0">Info</h4>
                        <input type="text"
                            class="form-control form-control-md g-resize-none g-brd-none g-brd-bottom g-brd-gray-light-v7 g-brd-gray-light-v3 rounded-0"
                            placeholder="임팩트 있는 제목 입력하세요.">
                        <textarea id="inputGroup-2_3"
                            class="form-control form-control-md g-brd-none g-brd-gray-light-v7 g-brd-gray-light-v3--focus rounded-0 g-resize-none"
                            placeholder="상품에 대한 소개 해주세요."></textarea>
                    </div>

                    <h4 class="h6 g-font-weight-600 g-color-black g-mb-15">Thumbnail</h4>
                    <div class="g-mb-15">
                        <label class="form-check-inline u-check g-pl-25 ml-0 g-mr-25">
                            <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" name="radInline1_1"
                                type="radio" value="video" v-model="picked">
                            <div class="u-check-icon-radio-v4 g-absolute-centered--y g-left-0 g-width-18 g-height-18">
                                <i class="g-absolute-centered d-block g-width-10 g-height-10 g-bg-primary--checked"></i>
                            </div>
                            유튜브
                        </label>

                        <label class="form-check-inline u-check g-pl-25 ml-0 g-mr-25">
                            <input class="g-hidden-xs-up g-pos-abs g-top-0 g-left-0" name="radInline1_1" type="radio"
                                value="image" v-model="picked">
                            <div class="u-check-icon-radio-v4 g-absolute-centered--y g-left-0 g-width-18 g-height-18">
                                <i class="g-absolute-centered d-block g-width-10 g-height-10 g-bg-primary--checked"></i>
                            </div>
                            이미지
                        </label>
                    </div>

                    <div class="form-group" v-show="picked=='video'">
                        <h4 class="h6 g-font-weight-600 g-color-black g-mb-15">Video</h4>
                        <div class="input-group g-brd-gray-light-v2">
                            <input class="form-control form-control-md rounded-0" placeholder="https://youtu.be/동영상번호" v-model="videoUrl" type="text">

                            <div class="input-group-btn">
                                <button class="btn btn-md h-100 u-btn-primary rounded-0" @click="youtubeRedirect">확인</button>
                            </div>
                        </div>
                    </div>

                    <!-- File Input -->
                    <div class="form-group" v-show="picked=='image'">
                        <h4 class="h6 g-font-weight-600 g-color-black g-mb-15">Image</h4>
                        <div class="input-group u-file-attach-v1 g-brd-gray-light-v2">
                            <input class="form-control form-control-md rounded-0" placeholder="클릭하세요."
                                readonly="" type="text">

                            <div class="input-group-btn">
                                <button class="btn btn-md h-100 u-btn-primary rounded-0" type="submit">검색</button>
                                <input type="file">
                            </div>
                        </div>
                    </div>
                    <!-- End File Input -->
                </div>
                <div class="modal-footer">
                    <div class="btn btn-primary btn-block" data-dismiss="modal">게시</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            picked: 'video',
            videoUrl: null,
        }
    },

    methods:{
        youtubeRedirect: function () {   
            window.open(this.videoUrl, "_blank");    
        }
    }
}
</script>