<?php
  class slideshow_model extends model{
      function __construct(){
          parent::__construct();
      }
      function get_num_slideshow(){
          $sql = "select * from slideshow";
          return $this->db->num_rows($sql);
      }
      function get_all_slideshow($limit,$offset){
          $sql = "select * from slideshow LIMIT $limit OFFSET $offset";
          return $this->db->result($sql);
      }
  }
?>
