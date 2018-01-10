<div class="main">
    <div class="search_box">
        <form id="searchTour" action="<?=site_url('tim-kiem')?>" method="get">
            <div class="col-md-4 col-sm-4 col-xs-12" style="padding-left:0">
                <input name="keywords" type="text" class="search_txt" placeholder="Nhập Điểm đến, Tên Tour, Mã Tour">
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12" style="padding-left:0">
                <select class="search_txt" name="khoihanh">
                    <option value="">Điểm đến</option>
                    <?php
                    $citylist = $this->dnx->get_all_diemden();
			foreach($citylist as $val){?>
                        <option value="<?=$val->city_id?>"><?=$val->city_name?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2 col-sm-2" style="padding-left:0">                 
                <select class="search_txt" name="ngay">
                    <option value="">Số ngày đi tour</option>
                    <option value="1">1 ngày</option>
                    <option value="2">2 ngày 1 đêm</option>
                    <option value="3">3 ngày 2 đêm</option>
                    <option value="4">4 ngày 3 đêm</option>
                    <option value="4">5 ngày 4 đêm</option>
                    <option value="4">6 ngày 5 đêm</option>
                    <option value="4">7 ngày 6 đêm</option>
                </select>
            </div>

            <div class="col-md-2 col-sm-2 col-xs-12" style="padding-left:0">
                <select class="search_txt" name="price_search">
                    <option value="">Giá</option>
                    <?php 
                        $sql = "SELECT * FROM price_search WHERE published = 1";
                        $price_search = $this->db->result($sql);
                        foreach($price_search as $list) {
                    ?>
                        <option value="<?=$list->id?>"><?=$list->price?></option>
                    <?php 
                        }
                    ?>
                </select>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-12">
                <input name="submit" type="submit" class="btn_search" value="Seach">
            </div>
        </form>
        
    </div>
    
</div>
<div class="clearfix"></div>
<style>
.cityname {vertical-align: text-bottom; margin-right:10px; cursor:pointer; position:relative }
.cityname i {position:absolute; right:-10px; top:0}
.diadanh {vertical-align: text-bottom; margin-right:10px}
#diemden {display:none}
.search_box {float:right; width:100%; height:auto; position:relative; text-align:right; margin-top:10px; margin-bottom:10px}
.search_txt {margin:5px; width:100%; border:2px solid white; background:white; padding:8px; float:left; background:#eee}
.btn_search {background:#f06e00; color:white; border:1px solid #f06e00; width:100%; padding:2px 6px;margin-top:7px}
.btn_search:hover {color:#720101; background:white}
select .search_txt {height: 30px !important;}
</style>
