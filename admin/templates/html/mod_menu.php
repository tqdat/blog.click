<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= base_url() ?>templates/dest/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?= $rs->fullname?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="header">MENU </li>
            <li class="<? if($this->uri->segment(1) == 'setting' || $this->uri->segment(1) == 'filemanager' ||$this->uri->segment(1) == 'account' ) echo "treeview active"; else echo "treeview"; ?>" >
                <a href="<?=site_url('setting/site')?>" >
                    <i class="fa fa-cogs"></i> <span>Hệ thống</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<? if($this->uri->segment(2) == 'site') echo "active";?>">
                        <a href="<?=site_url('setting/site')?>"><i class="fa fa-google-wallet"></i> Cấu hình website</a>
                    </li>
                    <li class="<? if($this->uri->segment(2) == 'seo') echo "active";?>">
                        <a href="<?=site_url('setting/seo')?>"><i class="fa fa-sellsy"></i>  SEO Code</a>
                    </li>
                    <li  class="<? if($this->uri->segment(1) == 'filemanager') echo "active";?>">
                        <a href="<?=site_url('filemanager')?>"><i class="fa fa-folder"></i> Quản lý file <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="<? if($this->uri->segment(1) == 'filemanager') echo "treeview-menu menu-open"; else echo "treeview-menu"?>">
                            <li  class="<? if($this->uri->segment(2) == 'images') echo "active";?>">
                                <a href="<?=site_url('filemanager/images')?>"><i class="fa fa-file-picture-o"></i> Quản lý Hình ảnh</a>
                            </li>
                            <li  class="<? if($this->uri->segment(2) == 'filedata') echo "active";?>">
                                <a href="<?=site_url('filemanager/filedata')?>"><i class="fa fa-file-archive-o"></i> Quản lý Files</a>
                            </li>
                            <li  class="<? if($this->uri->segment(2) == 'media') echo "active";?>">
                                <a href="<?=site_url('filemanager/media')?>"><i class="fa fa-file-video-o"></i> Quản lý Media</a>
                            </li>
                        </ul>
                    </li>
                    <li  class="<? if($this->uri->segment(1) == 'account') echo "active";?>">
                        <a href="<?=site_url('account/ds')?>"><i class="fa fa-list-ol"></i>  Danh sách thành viên</a>
                    </li>
                </ul>
            </li>
            <li class="<? if($this->uri->segment(1) == 'category' || $this->uri->segment(1) == 'news') echo "treeview active"; else echo "treeview"; ?>">
                <a href="<?=site_url('news/ds')?>">
                    <i class="fa fa-book"></i>
                    <span>Nội dung - Bài viết</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="<? if($this->uri->segment(1) == 'category') echo "active";?>">
                        <a href="<?=site_url('category')?>"><i class="fa fa-list-alt"></i> Danh mục</a>
                    </li>
                    <li class="<? if($this->uri->segment(1) == 'news') echo "active";?>">
                        <a href="<?=site_url('news/ds')?>"><i class="fa fa-newspaper-o"></i> Tin tức</a>
                    </li>
                </ul>
            </li>
            <li class="<? if($this->uri->segment(1) == 'mod' || $this->uri->segment(1) == 'slideshow' || $this->uri->segment(1) == 'weblink' || $this->uri->segment(1) == 'hotro' || $this->uri->segment(1) == 'khachhang') echo "treeview active"; else echo "treeview"; ?>">
                <a href="<?=site_url('mod/ds')?>">
                    <i class="fa fa-plus-square"></i>
                    <span>Phần mở rộng</span>
                    <span class="fa fa-angle-left pull-right"></span>
                </a>
                <ul class="treeview-menu">
                    <li class="<? if($this->uri->segment(1) == 'mod') echo "active";?>">
                        <a href="<?=site_url('mod/ds')?>"><i class="fa fa-windows"></i> Modules</a>
                    </li>
                    <li class="<? if($this->uri->segment(1) == 'slideshow') echo "active";?>">
                        <a href="<?=site_url('slideshow/ds')?>"><i class="fa fa-sliders"></i> Slide</a>
                    </li>
                    <li class="<? if($this->uri->segment(1) == 'weblink') echo "active";?>">
                        <a href="<?=site_url('weblink/ds')?>"><i class="fa fa-wordpress"></i> Weblink</a>
                    </li>
                    <li class="<? if($this->uri->segment(1) == 'hotro') echo "active";?>">
                        <a href="<?=site_url('hotro/ds')?>"><i class="fa  fa-weibo"></i> Hỗ trợ trực tuyến</a>
                    </li>
                    <li class="<? if($this->uri->segment(1) == 'khachhang') echo "active";?>">
                        <a href="<?=site_url('khachhang/ds')?>"><i class="fa fa-users"></i> Khách hàng</a>
                    </li>
                </ul>
            </li>
            <li class="<? if($this->uri->segment(1) == 'contact') echo "treeview active"; else echo "treeview"?>">
                <a href="<?=site_url('contact')?>">
                    <i class="fa fa-wechat"></i>
                    <span>Liên hệ</span>

                    <span class="fa fa-angle-left pull-right"></span>
                </a>
                <ul class="treeview-menu">
                    <li class="<? if($this->uri->segment(1) == 'contact' && $this->uri->segment(2) == '') echo "active";?>">
                        <a href="<?=site_url('contact')?>"><i class="fa fa-cog"></i> Cấu hình liên hệ</a>
                    </li>
                    <li class="<? if($this->uri->segment(2) == 'listcontact') echo "active";?>">
                        <a href="<?=site_url('contact/listcontact')?>"><i class="fa fa-list-ul"></i> Danh sách liên hệ</a>
                    </li>
                </ul>
            </li>
        </ul>
    </section>
</aside>