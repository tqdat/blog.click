 <ul class="lsupport" style="list-style: none;padding:10px; background:#f5f5f5">
    <?
    $listsp = $this->db->result("SELECT * FROM support ORDER BY ordering ASC");
    $s = 1;
    foreach($listsp as $val):
    ?>
    <li <?=($s == count($listsp))?'style="border-bottom:0px"':''?>>
        
        <div class="img" style="  width: 100px;
  height: 80px;
  float: left;
  overflow: hidden;
  display: block;
  margin-right: 8px;"><img src="<?=base_url()?>data/support/<?=$val->images?>" alt="<?=$val->name?>" style="width: 100px;
  min-height: 80px;"></div>
         <p style="font-weight: bold;
  color: #007ABF;
  padding-bottom: 0" class="title"><?=$val->title?></p>
        <table>
            <tr>
                <td style="width: 20px;">
                    <?php if ($val->nick) { ?>  <a href="ymsgr:sendIM?<?=$val->nick?>"><img  border="0" alt="<?=$val->name?>" src="<?=base_url()?>templates/images/yahoo-icon.png" style="border: 0; margin: 1px;"></a> <?php }?>                       
                </td>
                <td><b><?=$val->name?></b></td>
            </tr>
            <tr>
                <td>
                   <?php if ($val->skype) { ?> <a href="skype:<?=$val->skype?>?chat"><img alt="<?=$val->name?>" src="<?=base_url()?>templates/images/skype-icon.png" style="width: 15px;"></a>   <?php }?>                     
                </td>
                <td><?=$val->phone?></td>
            </tr> 
        </table>
    </li>
	<div class="clearfix" style="margin: 3px 0;"></div>
    <?
    $s++;
    endforeach;?>
</ul>