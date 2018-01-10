<script type="text/javascript">
    $(document).ready(function() {
        $("#pop").fancybox({padding:'0'}).trigger('click');
    });
</script>

<? $rs = $this->db->row("SELECT * FROM modules where module = 'mod_pop'") ?>


<div id="pop">
<!--    <img src="<?=  base_url()?>templates/images/web_under.jpg"/>-->
    <?=  htmlspecialchars_decode($rs->content)?>
</div>