<?php
$this->db->query('DROP TABLE IF EXISTS `'.DB_ROOT.'tendoo_news`');
$this->db->query('DROP TABLE IF EXISTS `'.DB_ROOT.'tendoo_comments`');
$this->db->query('DROP TABLE IF EXISTS `'.DB_ROOT.'tendoo_news_setting`');
$this->db->query('DROP TABLE IF EXISTS `'.DB_ROOT.'tendoo_news_category`');
$this->db->where('MOD_NAMESPACE','news')->delete('tendoo_modules_actions');
