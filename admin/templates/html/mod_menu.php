<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= base_url() ?>templates/dest/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            <li class="treeview">
                <a href="<?=site_url('')?>">
                    <i class="fa fa-cogs"></i> <span>Hệ thống</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=site_url('setting/site')?>"><i class="fa fa-google-wallet"></i> Cấu hình website</a></li>
                    <li><a href="<?=site_url('setting/seo')?>"><i class="fa fa-sellsy"></i>  SEO Code</a></li>
                    <li>
                        <a href="<?=site_url('filemanager')?>"><i class="fa fa-folder"></i> Quản lý file <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="<?=site_url('filemanager/images')?>"><i class="fa fa-file-picture-o"></i> Quản lý Hình ảnh</a></li>
                            <li><a href="<?=site_url('filemanager/filedata')?>"><i class="fa fa-file-archive-o"></i> Quản lý Files</a></li>
                            <li><a href="<?=site_url('filemanager/media')?>"><i class="fa fa-file-video-o"></i> Quản lý Media</a></li>
                        </ul>
                    </li>
                    <li><a href="<?=site_url('account/ds')?>"><i class="fa fa-list-ol"></i>  Danh sách thành viên</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="<?=site_url('news/ds')?>">
                    <i class="fa fa-book"></i>
                    <span>Nội dung - Bài viết</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=site_url('category')?>"><i class="fa fa-list-alt"></i> Danh mục</a></li>
                    <li><a href="<?=site_url('news/ds')?>"><i class="fa fa-newspaper-o"></i> Tin tức</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="<?=site_url('mod/ds')?>">
                    <i class="fa fa-plus-square"></i>
                    <span>Phần mở rộng</span>
                    <span class="fa fa-angle-left pull-right"></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=site_url('mod/ds')?>"><i class="fa fa-windows"></i> Modules</a></li>
                    <li><a href="<?=site_url('slideshow/ds')?>"><i class="fa fa-sliders"></i> Slide</a></li>
                    <li><a href="<?=site_url('weblink/ds')?>"><i class="fa fa-wordpress"></i> Weblink</a></li>
                    <li><a href="<?=site_url('hotro/ds')?>"><i class="fa  fa-weibo"></i> Hỗ trợ trực tuyến</a></li>
                    <li><a href="<?=site_url('khachhang/ds')?>"><i class="fa fa-users"></i> Khách hàng</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="<?=site_url('contact')?>">
                    <i class="fa fa-wechat"></i>
                    <span>Liên hệ</span>
                    <span class="fa fa-angle-left pull-right"></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?=site_url('contact')?>"><i class="fa fa-cog"></i> Cấu hình liên hệ</a></li>
                    <li><a href="<?=site_url('contact/listcontact')?>"><i class="fa fa-list-ul"></i> Danh sách liên hệ</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>