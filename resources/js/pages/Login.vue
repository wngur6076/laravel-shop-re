<template>
    <!-- begin login -->
    <div class="login login-with-news-feed">
        <!-- begin news-feed -->
        <div class="news-feed">
            <div class="news-image" style="background-image: url(/color/assets/img/login-bg/login-bg-11.jpg)"></div>
            <div class="news-caption">
                <h4 class="caption-title"><b>Color</b> Admin App</h4>
                <p>
                    Download the Color Admin app for iPhone®, iPad®, and Android™. Lorem ipsum dolor sit amet,
                    consectetur adipiscing elit.
                </p>
            </div>
        </div>
        <!-- end news-feed -->
        <!-- begin right-content -->
        <div class="right-content">
            <!-- begin login-header -->
            <div class="login-header">
                <div class="brand">
                    <span class="logo"></span> <b>Color</b> Admin
                    <small>responsive bootstrap 4 admin template</small>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-in-alt"></i>
                </div>
            </div>
            <!-- end login-header -->
            <!-- begin login-content -->
            <div class="login-content">
                <form action="index.html" method="GET" class="margin-bottom-0">
                    <div class="form-group m-b-15">
                        <input type="text" class="form-control form-control-lg" placeholder="이메일" required />
                    </div>
                    <div class="form-group m-b-15">
                        <input type="password" class="form-control form-control-lg" placeholder="비밀번호" required />
                    </div>
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-success btn-block btn-lg">로그인</button>
                    </div>
                    <div class="m-t-10 m-b-10 text-center">
                        <router-link :to="{name: 'home'}">
                            비밀번호를 잊으셨나요?
                        </router-link>
                    </div>
                </form>
                <hr class="m-t-15" />
                <div class="register-buttons text-center">
                    <button type="button" class="btn btn-info p-t-15 p-b-15 p-l-40 p-r-40" data-toggle="modal"
                        data-target="#registerModal">새 계정 만들기</button>

                    <div class="modal fade" id="registerModal" tabindex="-1" data-backdrop="static" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">가입하기</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <label class="control-label">이름 <span class="text-danger">*</span></label>
                                        <div class="row m-b-15">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control text-center" placeholder="본인 이름을 입력하세요." required />
                                            </div>
                                        </div>
                                        <label class="control-label">이메일 <span class="text-danger">*</span></label>
                                        <div class="row m-b-15">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control text-center" placeholder="로그인할 때와 비밀번호 재설정해야 할 때 사용하는 정보입니다." required />
                                            </div>
                                        </div>
                                        <label class="control-label">비밀번호 <span class="text-danger">*</span></label>
                                        <div class="row m-b-15">
                                            <div class="col-md-12">
                                                <input type="password" class="form-control text-center" placeholder="여덟 자리 이상의 비밀번호를 입력하세요." required />
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">나가기</button>
                                            <button type="submit" class="btn btn-primary">가입하기</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end login-content -->
        </div>
        <!-- end right-container -->
    </div>
    <!-- end login -->
</template>
