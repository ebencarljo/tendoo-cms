<?php
$this->core->db->query('DROP TABLE IF EXISTS `Tendoo_contents`');
$this->core->db->where('MOD_NAMESPACE','Tendoo_contents')->delete('Tendoo_modules_actions');