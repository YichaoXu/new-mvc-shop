<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>Your personal account information</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= PATH_URL . 'home' ?>"><i class="zmdi zmdi-home"></i> ChiKoi</a></li>
                        <li class="breadcrumb-item"><a href="admin.php?controller=user&action=listall">User</a></li>
                        <li class="breadcrumb-item active">Your Profile Info</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12">
                    <?php if ($user_info['verified'] == 0) : ?>
                        <div class='alert alert-danger' style='text-align: center;'><strong>Note!</strong> It seems your account has not yet confirmed the link sent to your email or the email has been changed. Please check your inbox and click on the confirmation link in the email to activate your email, account and help increase account security!! </div>
                    <?php endif; ?>
                    <div class="card">
                        <h3>Thông tin tải khoản cá nhân</h3>
                        <table id="info" class="table">
                            <tr>
                                <td><strong>Full Name</strong></td>
                                <td><?= $user_info['user_name']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Username</strong> </td>
                                <td><?= $user_info['user_username']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Permissions</strong> </td>
                                <td><strong><?php if ($user_info['role_id'] == 0) {
                                    echo 'Người đăng ký';
                                } elseif ($user_info['role_id'] == 1) {
                                    echo 'Admin - Quản trị viên';
                                } else {
                                    echo 'Moderator';
                                } ?></strong></td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong> </td>
                                <td><?= $user_info['user_email']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Address</strong> </td>
                                <td><?= $user_info['user_address']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Mobile</strong> </td>
                                <td><?= $user_info['user_phone']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Account Registration Date</strong> </td>
                                <td><?= $user_info['createDate']; ?></td>
                            </tr>
                            <tr>
                                <td><strong>Avatar</strong> </td>
                                <td><img style="max-width:250px;" src="public/upload/images/<?= $user_info['user_avatar']; ?>" alt="<?= $user_info['user_name']; ?>"> </td>
                            </tr>
                        </table>
                    </div>
                    <div class="form-group" style="text-align: center;">
                        <a class="btn btn-primary waves-effect" href="admin.php?controller=user&action=edit&amp;user_id=<?= $user_info['id']; ?>">Chỉnh sửa Thông Tin</a>
                        <a class="btn btn-primary waves-effect" href="admin.php?controller=user&action=change-password&amp;user_id=<?= $user_info['id']; ?>">Đổi mật khẩu</a>
                        <a class="btn btn-warning waves-effect" href="admin.php?controller=user&action=listall">Trở về</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
