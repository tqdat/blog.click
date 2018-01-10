<ul>
    <li>
        <a href="<?=site_url('cpanel')?>" class="main">
            <img src="<?=base_url()?>templates/icon/dashboards.png" alt="">
            <div class="title">Bảng điều khiển</div>
        </a>
    </li>
    <li>
        <a href="<?=site_url('account/ds')?>" class="main">
            <img src="<?=base_url()?>templates/icon/users.png" alt="">
            <div class="title">Thành viên</div>
        </a>
        <ul>
            <li><a href="<?=site_url('account/ds')?>">Danh sách thành viên</a></li>
            <li><a href="<?=site_url('account/add')?>">Thêm mới</a></li>
        </ul>
    </li>
    <li>
        <a href="#" class="main">
            <img src="<?=base_url()?>templates/icon/options.png" alt="">
            <div class="title">Cấu hình</div>
        </a>
        <ul>
            <li><a href="<?=site_url('setting/site')?>">Cấu hình website</a></li>
            <li><a href="<?=site_url('setting/seo')?>">SEO Code</a></li>
        </ul>
    </li>

    <li>
        <a href="<?=site_url('news/ds')?>" class="main">
            <img src="<?=base_url()?>templates/icon/content.png" alt="">
            <div class="title">Tin tức</div>
        </a>
        <ul>
            <li><a href="<?=site_url('category')?>">Danh mục</a></li>
            <li><a href="<?=site_url('news/ds')?>">Tin tức</a></li>
        </ul>
    </li>
    <li>
        <a href="<?=site_url('mod/ds')?>" class="main">
            <img src="<?=base_url()?>templates/icon/modules.png" alt="">
            <div class="title">Modules</div>
        </a>
    </li>
    <li>
        <a href="<?//=site_url('contact')?>" class="main">
            <img src="<?=base_url()?>templates/icon/contacts.png" alt="">
            <div class="title">Liên hệ</div>
        </a>
        <ul>
            <li><a href="<?=site_url('contact')?>">Cấu hình liên hệ</a></li>
            <li><a href="<?=site_url('contact/listcontact')?>">Danh sách liên hệ</a></li>
        </ul>
    </li>
    <li>
        <a href="<?//=site_url('filemanager')?>" class="main">
            <img src="<?=base_url()?>templates/icon/my_documents.png" alt="">
            <div class="title">Quản lý File</div>
        </a>
    </li>
</ul>