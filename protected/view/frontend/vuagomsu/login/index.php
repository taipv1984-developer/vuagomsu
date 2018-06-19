<h1 class="title-head"><span>Đăng nhập tài khoản</span></h1>
<div class="row">
    <div class="col-lg-6 col-md-6">
        <div class="page-login margin-bottom-30">
            <div id="login">
                <span>
                Nếu bạn đã có tài khoản, đăng nhập tại đây.
                </span>
                <form accept-charset="UTF-8" action="" id="customer_login" method="post">
                    <div class="form-signup clearfix">
                        <fieldset class="form-group">
                            <label>Email: </label>
                            <input type="email" class="form-control form-control-lg" value="" name="username" placeholder="Email">
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Mật khẩu: </label>
                            <input type="password" class="form-control form-control-lg" value="" name="password" placeholder="Mật khẩu">
                        </fieldset>
                        <div class="pull-xs-left" style="margin-top: 25px;">
                            <input class="btn btn-lg btn-style btn-dark margin-bottom-10" type="submit" value="Đăng nhập">
                            <a href="<?=URLHelper::getUrl('home/register')?>" class="btn btn-success btn-register" style="border-radius: 5px">
                                Đăng ký
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div id="recover-password" class="form-signup">
                <span>
                Bạn quên mật khẩu? Nhập địa chỉ email để lấy lại mật khẩu qua email.
                </span>
            <form accept-charset="UTF-8" action="<?=URLHelper::getUrl('home/forget_password')?>" method="post">
                <input name="FormType" type="hidden" value="recover_customer_password">
                <input name="utf8" type="hidden" value="true">
                <div class="form-signup">
                </div>
                <div class="form-signup clearfix">
                    <fieldset class="form-group">
                        <label>Email: </label>
                        <input type="email" class="form-control form-control-lg" value="" name="Email" id="recover-email" placeholder="Email">
                    </fieldset>
                </div>
                <div class="action_bottom">
                    <input class="btn btn-lg btn-style btn-dark" style="margin-top: 25px;" type="submit" value="Lấy lại mật khẩu">
                </div>
            </form>
        </div>
    </div>
</div>