<?php echo $lmenu;?>
<section id="content" adminIndexIntro>
  <section class="vbox"><?php echo $inner_head;?>
    
    <footer class="footer bg-white b-t">
      <div class="row m-t-sm text-center-xs">
        <div class="col-sm-2" id="ajaxLoading"> </div>
        <div class="col-sm-4 col-sm-offset-6 text-right text-center-xs">
          <ul class="pagination pagination-sm m-t-none m-b-none">
            
          </ul>
        </div>
      </div>
    </footer>
    <section class="scrollable" id="pjax-container">
      <header>
        <div class="row b-b m-l-none m-r-none">
          <div class="col-sm-4">
            <h4 class="m-t m-b-none"><?php echo $this->tendoo->getTitle();?></h4>
            <p class="block text-muted"><?php echo $pageDescription;?></p>
          </div>
          
          <div class="col-sm-8">
          	<button data-step="1" data-position="left" data-intro="<strong>Bienvenue sur Tendoo <?php echo TENDOO_VERSION;?></strong><br>Nous allons maintenant vous présenter Tendoo, si vous êtes prêt cliquez sur 'Suivant'.<br><br>Vous pouvez également utiliser les flèches directionnelles pour naviguer dans cette visite guidée." launch_visit type="button" class="btn btn-lg <?php echo theme_button_class();?>" style="float:right;margin:10px;"><i style="font-size:20px;" class="fa fa-question-circle"></i><?php 
		  if($this->users_global->current('ADMIN_INDEX_VISIT') == '0')
		  {
		  ?> <span>Cliquez pour une visite</span><?php
		  }
		  ?></button>
          </div>
          <?php 
		  if($this->users_global->current('ADMIN_INDEX_VISIT') == '0')
		  {
		  ?>
         	<script type="text/javascript">
				$('[launch_visit]').bind('click',function(){
					tendoo.doAction('<?php echo $this->url->site_url(array('admin','ajax','setViewed?page=ADMIN_INDEX_VISIT'));?>',function(){
					},{});
				});
			</script>
          <?php
		  }
		  ?>
          
        </div>
      </header>
	  <section class="scrollable wrapper"> <?php echo notice_from_url();?>
        <!-- data-toggle="tooltip" data-placement="right" title="" data-original-title="Statistiques sur le traffic de votre site." -->
        <div class="row">
          <div class="col-lg-9"> 
            <!-- Start Here -->
            <?php
              if($this->users_global->current('OPEN_APP_TAB') == '0')
              {
                  $icon_1	=	'';
                  $collapse	=	'collapse';
              }
              else
              {
                  $icon_1	=	'active';
                  $collapse	=	'';
              }
              ?>
            <section class="panel pos-rlt clearfix" data-intro="Utilisez ce panel pour accéder aux différents modules que vous aurez installé." data-step="11" data-position="bottom">
              <header class="panel-heading">
                <ul class="nav nav-pills pull-right">
                  <li> <a data-requestType="silent" data-url="<?php echo $this->url->site_url(array('admin','ajax','toogle_app_tab'));?>" href="#" class="panel-toggle text-muted <?php echo $icon_1;?>"><i class="fa fa-caret-down text-active"></i><i class="fa fa-caret-up text"></i></a> </li>
                </ul>
                Applications </header>
              <div class="panel-body clearfix <?php echo $collapse;?>">
                <div class="icon icon-grid">
                  <?php
                if($appIconApi)
                {
                    foreach($appIconApi as $a)
                    {
                        eval($options[0]['ADMIN_ICONS']);
                        if(isset($icons) && count($icons) > 1)
                        {
                            foreach($icons as $i)
                            {
                                if($i	==	$a['ICON_MODULE_NAMESPACE'].'/'.$a['ICON_NAMESPACE'])
                                {
									// .'?ajax=true' we're no more accessing ajax content, but directly app.
                        ?>
                        <div class="tendoo-icon-set" data-toggle="tooltip" data-placement="right" title="<?php echo $a['ICON_MODULE']['HUMAN_NAME'];?>" modal-title="<?php echo $a['ICON_MODULE']['HUMAN_NAME'];?>" data-url="<?php echo $this->url->site_url(array('admin','open','modules',$a['ICON_MODULE']['ID']));?>">
                        	
                          <img class="G-icon" src="<?php echo $this->tendoo_admin->getAppImgIco($a['ICON_MODULE']['NAMESPACE']);?>">
                  			<p><?php echo word_limiter($a['ICON_MODULE']['HUMAN_NAME'],4);?></p>
                            <!--<span class="badge up bg-info m-l-n-sm">300</span>-->
                  		</div>
                  <?php
                                }
                            }
                        }
						else
						{
							echo tendoo_info('Aucune icone disponible. Activez les icones depuis <a href="'.$this->url->site_url(array('admin','setting')).'"><strong>les param&egrave;tres</strong></a>.');
						}
                    }
                }
				else
				{
					echo tendoo_info('Aucune icone disponible. Activez les icones depuis <a href="'.$this->url->site_url(array('admin','setting')).'"><strong>les param&egrave;tres</strong></a>.');
				}
                ?>
                </div>
              </div>
            </section>
            <!-- End Here -->
			<?php
			if($this->users_global->isSuperAdmin() || $this->tendoo_admin->adminAccess('system','toolsAccess',$this->users_global->current('PRIVILEGE')) != FALSE)
			{
				if($this->users_global->current('SHOW_ADMIN_INDEX_STATS') == "1")
				{
					$currentTime	=	$this->tendoo->datetime();
					$dateArray		=	$this->tendoo->time(strtotime($currentTime),TRUE);
					$stats		=	$this->tendoo_admin->tendoo_visit_stats();
					$visitLine		=	'';
					if(array_key_exists($dateArray['M'],$stats['statistics']['unique'][$dateArray['y']]))
					{
						$totalUnique	=	$stats['statistics']['unique'][$dateArray['y']][$dateArray['M']]['totalVisits'];
						$totalGlobal	=	$stats['statistics']['global'][$dateArray['y']][$dateArray['M']]['totalVisits'];
					}
					else
					{
						$totalUnique	=	0;
						$totalGlobal	=	0;
						$this->notice->push_notice(tendoo_info('Aucune visite n\'a &eacute;t&eacute; &eacute;ffectu&eacute;e ce mois'));
					}
					$overAllUnique	=	$stats['statistics']['overAll']['unique']['totalVisits'];
					$overAllGlobal	=	$stats['statistics']['overAll']['global']['totalVisits'];
					//echo '<pre>';
					//print_r();
					//echo '</pre>';
					if(is_array($stats['ordered']))
					{
						foreach($stats['ordered'] as $year)
						{
							foreach($year as $month)
							{
								$uniqVisit[]	=	count($month);
							}
						}
						for($i=0;$i<count($uniqVisit);$i++)
						{
							if(array_key_exists($i+1,$uniqVisit))
							{
								$visitLine.=	$uniqVisit[$i].',';
							}
							else
							{
								$visitLine.=	$uniqVisit[$i];
							}
						}
					}
					else
					{
						$visitLine	=	'';
					}
				}
				
				?>
            <ul class="list-group gutter list-group-lg list-group-sp sortable">
              <?php
					if((int)$this->users_global->current('SHOW_ADMIN_INDEX_STATS') == 1)
                {
                ?>
              <li class="list-group-item" draggable="true" style="padding:0px;" data-intro="Vous aurez la possibilité de voir les statistiques des visites sur une durée de 5 mois. Vous pouvez désactiver ce panel depuis les 'Paramètres' dans la section 'Autorisations'." data-step="12" data-position="top">
                <header class="panel-heading <?php echo theme_class();?> lter"> <span class="pull-right"><?php echo $dateArray['month'];?></span> <span class="h4">Stats. sur <?php echo $this->tendoo_admin->getStatLimitation();?> mois<br>
                  <small class="text-muted"></small> </span>
                  <div class="text-center padder m-b-n-sm m-t-sm">
                    <div class="sparkline" data-type="line" data-resize="true" data-height="48" data-width="100%" data-line-width="2" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="3" data-data="[<?php echo $visitLine;?>]"></div>
                    <div class="sparkline inline"></div>
                  </div>
                </header>
                <div class="panel-body" style="height:105px;">
                  <div> <span class="text-muted">Visites ce mois (uniques/globales) :</span> <span class="h3 block"><?php echo $totalUnique;?>/<small><?php echo $totalGlobal;?></small></span> </div>
                  <div><small>Visites uniques</small> : <span><?php echo $overAllUnique;?></span></div>
                  <div><small>Visites r&eacute;guli&egrave;res</small> : <span><?php echo $overAllGlobal;?></span></div>
                </div>
              </li>
              <?php
                }
                    ?>
              <li class="list-group-item" draggable="true" style="padding:0px;">
                <?php
                    if(in_array($this->users_global->current('SHOW_WELCOME'),array('1','TRUE')))
                    {
                    ?>
                <div class="panel-body">
                  <div class="carousel slide auto" id="c-slide">
                    <ol class="carousel-indicators out" style="bottom:10px;">
                      <li data-target="#c-slide" data-slide-to="0" class=""></li>
                      <li data-target="#c-slide" data-slide-to="1" class=""></li>
                      <li data-target="#c-slide" data-slide-to="2" class="active"></li>
                    </ol>
                    <div class="carousel-inner" style="min-height:180px;" >
                      <div class="item">
                        <p class="text-center"> <em class="h4 text-mute">Premier pas sur Tendoo</em><br>
                          <br/>
                          D&eacute;couvrer comment publier votre premier article en suivant <a href="<?php echo $this->url->site_url(array('admin','discover','firstSteps'));?>"><strong>ces instructions</strong></a>. Vous pouvez aussi apprendre &agrave; configurer votre site web en suivant <a href="<?php echo $this->url->site_url(array('admin','discover','firstSettings'));?>"><strong>ces instructions</strong></a>. Apprenez &eacute;galement &agrave; g&eacute;rer le fonctionnement de votre site web dans la section <a href="<?php echo $this->url->site_url(array('admin','system'));?>"><strong>Syst&egrave;me</strong></a> et dans la section <a href="<?php echo $this->url->site_url(array('admin','discover','aboutSecurity'));?>"><strong>S&eacute;curit&eacute;</strong></a> </p>
                      </div>
                      <div class="item">
                        <p class="text-center"> <em class="h4 text-mute">C'est quoi Tendoo ?</em><br>
                          <br/>
                          <small class="text-muted">Tendoo vous permet de rapidement cr&eacute;er votre site web, sans avoir n&eacute;cessairement besoin d'un expert. La cr&eacute;ation et la gestion d'un site web ne pourra pas &ecirc;tre plus facile. Si vous d&eacute;butez, <a href="#">vous devez savoir ceci</a>, cependant si vous &ecirc;tes un habitu&eacute; de CMS, ce petit aper&ccedil;u vous sera utile.</small> </p>
                      </div>
                      <div class="item active">
                        <p class="text-center"> <em class="h4 text-mute">Bienvenue sur <strong><?php echo $this->tendoo->getVersion();?></strong></em><br>
                          <br/>
                          <small class="text-muted">L'&eacute;quipe vous remercie d'avoir choisi Tendoo comme application pour la cr&eacute;ation de votre site web / application web. Si vous demarrez sur Tendoo, consultez <a href="<?php echo $this->url->site_url(array('admin','discover'));?>">le guide d'utilisation</a> sur les premiers pas, et commercez &agrave; personnaliser tendoo.</small> </p>
                      </div>
                    </div>
                    <a class="left carousel-control" href="#c-slide" data-slide="prev"> <i class="fa fa-angle-left"></i> </a> <a class="right carousel-control" href="#c-slide" data-slide="next"> <i class="fa fa-angle-right"></i> </a> </div>
                </div>
                <?php
                    }
                    ?>
              </li>
            </ul>									
			<?php
			}
			?>
		</div>
          <div class="col-lg-3">
            <section class="panel" data-intro="Ce panel affichera les statistiques de votre site: modules installés, thèmes installés, pages créées, privilèges et utilisateurs" data-step="13" data-position="left">
              <header class="panel-heading bg-info">Statistiques</header>
              <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                <li class="list-group-item">Modules install&eacute;s <span class="badge bg-info"><?php echo $ttModule;?></span></li>
                <li class="list-group-item">Th&egrave;mes install&eacute;s <span class="badge bg-info"><?php echo $ttTheme;?></span></li>
                <li class="list-group-item">Pages cr&eacute&eacute;es <span class="badge bg-info"><?php echo $ttPages;?></span></li>
                <li class="list-group-item">Privil&egrave;ges cr&eacute;es <span class="badge bg-info"><?php echo $ttPrivileges;?></span></li>
                <li class="list-group-item">Utilisateurs <span class="badge bg-info"><?php echo $countUsers;?></span></li>
              </ul>
            </section>
<!--
            <div class="panel-group m-b" id="accordion2">
              <div class="panel">
                <div class="panel-heading"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne"> Collapsible Group Item #1 </a> </div>
                <div id="collapseOne" class="panel-collapse in">
                  <div class="panel-body text-sm"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt. </div>
                </div>
              </div>
              <div class="panel">
                <div class="panel-heading"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo"> Collapsible Group Item #2 </a> </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                  <div class="panel-body text-sm"> Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS. </div>
                </div>
              </div>
              <div class="panel">
                <div class="panel-heading"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree"> Collapsible Group Item #3 </a> </div>
                <div id="collapseThree" class="panel-collapse collapse">
                  <div class="panel-body text-sm"> Sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. </div>
                </div>
              </div>
            </div>-->
          </div>
        </div>
      </section>
    
	</section>
	
  </section>
  <a class="hide nav-off-screen-block" data-target="body" data-toggle="class:nav-off-screen" href="#"></a>
</section>
