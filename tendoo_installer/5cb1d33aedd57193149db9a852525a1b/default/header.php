<html>
	<head>
		<meta charset="utf-8">
        <meta name="description" content="<?php echo $this->core->tendoo->getDescription();?>">
		<meta name="keywords" content="<?php echo $this->core->tendoo->getKeywords();?>">
		<script>
			var site_url	=	'<?php echo $this->core->url->site_url();?>';
			var base_url	=	'<?php echo $this->core->url->main_url();?>';
		</script>
		<title><?php echo $this->core->tendoo->getTitle();?></title>
		<?php echo $this->core->file->css_load();?>
		<?php echo $this->core->file->js_load();?>        
	</head>
