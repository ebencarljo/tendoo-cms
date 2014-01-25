<?php
if(!function_exists('css_url'))
{
	function css_url($e)
	{
		$instance	=	Controller::instance();
		return $instance->url->main_url().'Tendoo_assets/css/'.$e.'.css';
	}
}
if(!function_exists('is_php'))
{
	function is_php($vers)
	{
		if($vers	>=	phpversion())
		{
			return true;
		}
		return false;
	}
}
if ( ! function_exists('remove_invisible_characters'))
{
	function remove_invisible_characters($str, $url_encoded = TRUE)
	{
		$non_displayables = array();
		
		// every control character except newline (dec 10)
		// carriage return (dec 13), and horizontal tab (dec 09)
		
		if ($url_encoded)
		{
			$non_displayables[] = '/%0[0-8bcef]/';	// url encoded 00-08, 11, 12, 14, 15
			$non_displayables[] = '/%1[0-9a-f]/';	// url encoded 16-31
		}
		
		$non_displayables[] = '/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]+/S';	// 00-08, 11, 12, 14-31, 127

		do
		{
			$str = preg_replace($non_displayables, '', $str, -1, $count);
		}
		while ($count);

		return $str;
	}
}
if(!function_exists('show_message'))
{
	function show_error($content)
	{
		?><p style="border:solid 1px #CCC;padding:1%;width:96%;margin:1%;text-align:center;background:#FFE6E6;color:#777;"><span>Error : </span><?php echo $content;?></p><?php
	}
}
if(!function_exists('log_message'))
{
	function log_message($e,$content)
	{
		return // take care after;
		?><h1><?php echo $e;?></h1><p><?php echo $content;?></p><?php
	}
}
if(!function_exists('js_url'))
{
	function js_url($e="")
	{
		$instance	=	Controller::instance();
		return $instance->url->main_url().'Tendoo_assets/script/'.$e.'.js';
	}
}
if(!function_exists('img_url'))
{
	function img_url($e)
	{
		$instance	=	Controller::instance();
		return $instance->url->base_url().'assets/files/'.$e;
	}
}
if(!function_exists('Tendoo_error'))
{
	function Tendoo_error($text)
	{
		return '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><i style="font-size:18px;margin-right:5px;" class="icon-warning-sign"></i> '.$text.'</div>';
	}
}
if(!function_exists('Tendoo_success'))
{
	function Tendoo_success($text)
	{
		return '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><i style="font-size:18px;margin-right:5px;" class="icon-thumbs-up-alt"></i> '.$text.'</div>';
	}
}
if(!function_exists('Tendoo_warning'))
{
	function Tendoo_warning($text)
	{
		return '<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><i style="font-size:18px;margin-right:5px;" class="icon-warning-sign"></i> '.$text.'</div>';
	}
}
if(!function_exists('Tendoo_info'))
{
	function Tendoo_info($text)
	{
		return '<div class="alert alert-info"><button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button><i style="font-size:18px;margin-right:5px;" class="icon-info"></i> '.$text.'</div>';;
	}
}
if(!function_exists('notice'))
{
	function notice($e,$extends_msg= '',$sort = FALSE)
	{
		$array['config_1']					=	Tendoo_info('Un fichier de configuration est d&eacute;j&agrave; existant. Si vous enregistrer de nouvelles donn&eacute;es, l\'ancien sera &eacute;cras&eacute;');
		$array['accessDenied']				=	Tendoo_warning('Vous n\'avez pas ou plus acc&egrave;s &agrave; cette page.');
		$array['config_2']					=	Tendoo_warning('Une erreur fatale s\'est produite durant l\'installation, veuillez re-installer Tendoo.');
		$array['noThemeInstalled']			=	Tendoo_warning(' Une erreur s\'est produite durant l\'acc&egrave;s au th&egrave;me. Il est possible qu\'aucun th&egrave;me ne soit install&eacute; ou d&eacute;finit comme th&egrave;me par d&eacute;faut.');
		$array['mustCreatePrivilege']		=	Tendoo_warning(' Il est n&eacute;cessaire de cr&eacute;er des privil&egrave;ges avant de g&eacute;rer des administrateurs');
		$array['controler_created']			=	Tendoo_success(' Le contr&ocirc;leur &agrave; &eacute;t&eacute; correctement cr&eacute;e.');		
		$array['c_name_already_found']		=	Tendoo_warning('Une autre page poss&egrave;de d&eacute;j&agrave; ce nom comme contr&ocirc;leur, veuillez choisir un autre nom.');
		$array['name_already_found']		=	Tendoo_warning('Une autre page poss&egrave;de d&eacute;j&agrave; ce nom, veuillez choisir un autre nom.');
		$array['controler_deleted']			=	Tendoo_success(' Le contr&ocirc;leur &agrave; &eacute;t&eacute; correctement supprim&eacute;.');
		$array['incorrectSuperAdminPassword']	=	Tendoo_warning('Le mot de passe administrateur est incorrect');
		$array['cantHeritFromItSelf']		=	Tendoo_error('Ce contr&ocirc;leur ne peut pas &ecirc;tre un sous menu de lui m&ecirc;me. La modification de l\'emplacement &agrave; &eacute;chou&eacute;.');
		$array['cantSendMsgToYou']			=	Tendoo_error('Une erreur s\'est produite, vous ne pouvez pas vous envoyer un message.');
		$array['unkConSpeAsParent']			=	Tendoo_error('Le contr&ocirc;leur (Menu), d&eacute;finie comme parent est introuvable. La modification du contr&ocirc;leur &agrave; &eacute;chou&eacute;.');
		$array['addingActionFailure']		=	Tendoo_error('La cr&eacute;ation d\'action pour ce module &agrave; &eacute;chou&eacute;.');
		$array['subMenuLevelReach']			=	Tendoo_error('Impossible de cr&eacute;er ou de modifier ce contr&ocirc;leur, la limitation en terme de sous menu &agrave; &eacute;t&eacute; atteinte. Veuillez choisir un autre menu ou en cr&eacute;er un nouveau.');
		$array['cantUserReservedCNames']	=	Tendoo_error('Ce code du contr&ocirc;leur est un code reserv&eacute;, vous ne pouvez pas l\'utiliser.');
		
		$array['cant_delete_mainpage']		=	Tendoo_warning(' La page principale ne peut pas &ecirc;tre supprim&eacute;.');
		$array['controler_edited']			=	Tendoo_success(' Le contr&ocirc;leur &agrave; &eacute;t&eacute; correctement modifi&eacute;.');
		$array['db_unable_to_connect']		=	Tendoo_warning('Il est impossible de se connect&eacute; avec les informations fournies.');
		$array['db_unable_to_select']		=	Tendoo_warning('La connexion &agrave; &eacute;t&eacute; &eacute;tablie, cependant il est impossible d\'acc&eacute;der &agrave; la base de donn&eacute;e.');
		$array['error_occured']				=	Tendoo_warning(' Une erreur s\'est produite durant l\'op&eacute;ration.');
		$array['adminDeleted']				=	Tendoo_success(' L\'utilisateur &agrave; &eacute;t&eacute; correctement supprim&eacute;.');
		$array['controller_not_found']		=	Tendoo_warning(' Ce contr&ocirc;leur est introuvable.');
		$array['no_main_controller_created']=	Tendoo_warning(' Aucun contr&ocirc;leur d&eacute;finit comme principale n\'a &eacute;t&eacute; retrouv&eacute;, le nouveau contr&ocirc;leur &agrave; &eacute;t&eacute; d&eacute;finit comme contr&ocirc;leur par d&eacute;faut.');
		$array['no_main_page_set']			=	Tendoo_info(' Aucun contr&ocirc;leur n\'est d&eacute;finie par d&eacute;faut.');
		$array['no_priv_created']			=	Tendoo_info(' Aucun privil&egrave;ge n\'a &eacute;t&eacute; cr&eacute;e, Les action ne peuvent &ecirc;tre administr&eacute;es qu\'apr&egrave;s la cr&eacute;ation d\'un privil&egrave;ge au moins.');
		$array['InvalidModule']				=	Tendoo_warning('Ce module est invalide ou incompatible.');
		$array['CantDeleteDir']				=	Tendoo_warning('Une erreur s\'est produite durant la suppr&eacute;ssion d\'un dossier.');
		$array['module_corrupted']			= 	Tendoo_warning('Ce module ne peut pas &ecirc;tre install&eacute;. Il est corrompu ou incompatible.');	
		$array['errorInstallModuleFirst']	= 	Tendoo_warning('Vous devez installer les tables avant d\'installer le module');	
		$array['moduleInstalled']			=	Tendoo_success(' L\'installation du module est termin&eacute;.');
		$array['module_alreadyExist']		= 	Tendoo_warning('Ce module &agrave; d&eacute;j&agrave; &eacute;t&eacute; install&eacute;.');	
		$array['unknowModule']				=	Tendoo_warning('Ce module est introuvable.');
		$array['module_uninstalled']		=	Tendoo_success('Le module &agrave; &eacute;t&eacute; d&eacute;sinstall&eacute;.');
		$array['InvalidPage']				=	Tendoo_warning('Cette page n\'a pas pu &ecirc;tre charg&eacute; car le contr&ocirc;leur correspondant &agrave; cette adresse est introuvable ou indisponible.');
		$array['noControllerDefined']		=	Tendoo_warning('Impossible d\'acc&eacute;der &agrave; cet &eacute;lement, Il ne dispose pas d\'interface embarqu&eacute;.');
		$array['cantSetChildAsMain']		=	Tendoo_warning('Un sous menu ne peut pas &ecirc;tre d&eacute;finie comme page principale. La modification de la priorit&eacute; &agrave; &eacute;chou&eacute;e.');
		$array['noFileUpdated']				=	Tendoo_warning('Aucun fichier n\'a &eacute;t&eacute; re&ccedil;u.');
		$array['done']						=	Tendoo_success('L\'op&eacute;ration s\'est d&eacute;roul&eacute;e avec succ&egrave;s.');
		$array['accessForbiden']			=	Tendoo_warning('Vous ne faites pas partie du privil&egrave;s qui peut acc&eacute;der &agrave; cette page.');
		$array['userCreated']				=	Tendoo_success('L\'utilisateur a &eacute;t&eacute; cr&eacute;e.');
		$array['userNotFoundOrWrongPass']	=	Tendoo_warning('Utilisateur introuvable ou mot de passe incorrect.');
		$array['notForYourPriv']			=	Tendoo_warning('Acc&eacute;der &agrave; cet &eacute;l&eacute;ment ne fait pas partie de vos actions.');
		$array['unknowAdmin']				=	Tendoo_warning('Administrateur introuvable.');
		$array['moduleBug']					=	Tendoo_warning('Une erreur s\'est produite. Le module attach&eacute; &agrave; ce contr&ocirc;leur est introuvable.');
		$array['notAllowed']				=	Tendoo_warning('Il ne vous est pas permis d\'effctuer cette op&eacute;ration. Soit compte tenu de votre privil&egrave;ge actuel, soit compte tenu de l\'indisponibilit&eacute; du service.');
		$array['theme_alreadyExist']		=	Tendoo_info('Ce th&egrave;me avait d&eacute;j&agrave; &eacute;t&eacute; install&eacute;.');
		$array['NoCompatibleTheme']			=	Tendoo_warning('Ce th&egrave;me n\'est pas compatible avec la version actuelle d\'Tendoo.');
		$array['NoCompatibleModule']		=	Tendoo_warning('Ce module n\'est pas compatible avec la version actuelle d\'Tendoo.');
		$array['SystemDirNameUsed']			=	Tendoo_warning('Ce th&egrave;me ne peut pas s\'installer car il &agrave; tenter d\'utiliser des ressources syst&egrave;me.');
		$array['theme_installed']			=	Tendoo_success('Le th&egrave;me a &eacute;t&eacute; install&eacute; correctement.');
		$array['no_theme_selected']			=	Tendoo_warning('Aucun th&egrave;me n\'a &eacute;t&eacute; choisi comme th&egrave;me par d&eacute;faut.');
		$array['defaultThemeSet']			=	Tendoo_success('Le th&egrave;me &agrave; &eacute;t&eacute; correctement choisi come th&egrave;me par d&eacute;faut.');
		$array['unknowTheme']				=	Tendoo_warning('Th&egrave;me inconnu ou introuvable.');
		$array['missingArg']				=	Tendoo_warning('Une erreur s\'est produite. Certains &eacute;l&eacute;ment, qui permettent le traitement de votre demande, sont manquant ou incorrect.');
		$array['page404']					=	Tendoo_warning('Cette page est introuvable ou indisponible. Veuillez re-&eacute;ssayer.');
		$array['restoringDone']				=	Tendoo_success('La restauration s\'est correctement d&eacute;roul&eacute;.');
		$array['cmsRestored']				=	Tendoo_success('La restauration s\'est correctement d&eacute;roul&eacute;.');
		$array['creatingHiddenControllerFailure']		=	Tendoo_warning('La cr&eacute;ation du contr&ocirc;leur invisible &agrave; &eacute;chou&eacute;');
		$array['installFailed']				=	Tendoo_warning('Une erreur s\'est produite durant l\'installtion certaines composantes n\'ont pas &eacute;t&eacute; correctement install&eacute;es');
		$array['db_connect_error']			=	Tendoo_warning('Connexion impossible,int&eacute;rrompu ou le nombre limit de connexion accord&eacute; &agrave; l\'utilisateur de la base de donn&eacute; est atteinte. Veuillez re-&eacute;ssayer.');
		$array['themeCrashed']				=	Tendoo_warning('Une erreur s\'est produite avec le th&egrave;me. Ce th&egrave;me ne fonctionne pas correctement.');
		$array['noMainPage']				=	Tendoo_warning('Impossible d\'acc&eacute;der &agrave; la page principale du site. Aucun contr&ocirc;leur n\'a &eacute;t&eacute; d&eacute;finit comme principal');
		$array['AdminAuthFailed']			=	Tendoo_warning('Mot de passe administrateur incorrect.');
		
		$array['SuperAdminCreationError']	=	Tendoo_warning('Un erreur s\'est produite durant la cr&eacute;ation du Super-administrateur. V&eacute;fiez les informations envoy&eacute;es ou assurez vous qu\'il n\'existe pas un autre Super-administrateur pour ce site.');
		$array['adminCreated']				=	Tendoo_success('L\'utilisateur &agrave; &eacute;t&eacute; correctement cr&eacute;e');
		$array['no_page_set']				=	Tendoo_warning('Aucun contr&ocirc;leur disponible.');
		$array['privilegeNotFound']			=	Tendoo_warning('Privil&egrave;ge introuvable.');
		$array['invalidApp']				=	Tendoo_warning('Application Tendoo non valide. L\'installation &agrave; &eacute;chou&eacute;e');
		$array['adminCreationFailed']		=	Tendoo_warning('Impossible de cr&eacute;er un administrateur, verifiez la correspondance de pseudo et vos actions.');
		$array['tableCreationFailed']		=	Tendoo_warning('Impossible d\'installer Tendoo, les informations fournies sont peut &ecirc;tre invalide. Assurez-vous de la validité de la connexion et de leur conformit&eacute; aux informations fournies.');
		$array['upload_invalid_filetype']	=	Tendoo_warning('Extension du fichier non autoris&eacute;e');
		$array['themeControlerFailed']		=	Tendoo_warning('L\'interace embarqu&eacute; de ce th&egrave;me n\'est pas correctement d&eacute;finie.');
		$array['themeControlerNoFound']		=	Tendoo_warning('Ce th&egrave;me ne dispose pas d\'interface embarqu&eacute;..');
		$array['registrationNotAllowed']	=	Tendoo_warning('Il impossible de s\'inscrire. L\'inscription &agrave; &eacute;t&eacute; d&eacute;sactiv&eacute;e sur ce site.');
		$array['userExists']					=	Tendoo_warning('Un utilisateur poss&eacute;dant ce pseudo existe d&eacute;j&agrave;.');
		$array['emailUsed']						=	Tendoo_warning(' Cet email est d&eacute;j&agrave; utilis&eacute;, veuillez choisir un autre.');
		$array['unallowedPrivilege']			=	Tendoo_warning(' Ce privil&egrave;ge n\'est pas autoris&eacute;.');
		$array['UnactiveUser']					=	Tendoo_warning(' Cet utilisateur est inactif, veuillez consulter l\'adresse email fournie pour cet utilsateur. Si aucun mail d\'activation n\'a &eacute;t&eacute; envoy&eacute;, vous pouvez essayer &agrave; nouveau. En utilisant la proc&eacute;dure de r&eacute;cup&eacute;ration de mot de passe');
		$array['alreadyActive']					=	Tendoo_warning(' Impossible d\'envoyer le mail d\'activation car le compte attach&eacute; &agrave; cette adresse mail est d&eacute;j&agrave; actif.');	
		$array['actionProhibited']				=	Tendoo_warning(' Il vous est interdit d\'effectuer cette op&eacute;ration.');
		$array['unknowEmail']					=	Tendoo_warning(' Aucun compte n\'est attach&eacute; &agrave; cette adresse mail.');
		$array['validationSended']				=	Tendoo_success(' Un mail d\'activation &agrave; &eacute;t&eacute; envoy&eacute; &agrave; cette addresse.');
		$array['regisAndAssociatedFunLocked']	=	Tendoo_warning(' L\'inscription et les services associ&eacute;s sont d&eacute;sactiv&eacute;s sur ce site.');
		$array['NewLinkSended']					=	Tendoo_success(' Un nouveau lien &agrave; &eacute;t&eacute; envoy&eacute; &agrave; votre boite mail.');
		$array['timeStampExhausted']			=	Tendoo_warning(' Ce lien n\'est plus valide. La dur&eacute;e de vie de ce lien &agrave; expir&eacute;e.');
		$array['activationFailed']				=	Tendoo_warning(' Ce lien n\'est plus valide. La dur&eacute;e de vie de ce lien &agrave; expir&eacute;e.');
		$array['accountActivationDone']			=	Tendoo_success(' Le compte est d&eacute;sormais actif.');
		$array['accountActivationFailed']		=	Tendoo_warning(' L\'activation du compte &agrave; &eacute;chou&eacute;e.');
		$array['samePassword']					=	Tendoo_warning(' Le nouveau mot de passe ne peut pas &ecirc;re identique &agrave; l\'ancien.');
		$array['passwordChanged']				=	Tendoo_success(' Le mot de passe &agrave; &eacute;t&eacute; correctement modifi&eacute;.');
		$array['upload_no_file_selected']		=	Tendoo_warning(' Aucun fichier n\'a &eacute;t&eacute; envoy&eacute;.');
		$array['cannotDeleteUsedPrivilege']		=	Tendoo_warning(' Vous ne pouvez pas supprimer un privil&egrave;ge en cours d\'utilisation.');
		$array['userTownUpdated']				=	Tendoo_success(' Ville correctement mis &agrave; jour.');
		$array['userStateUpdated']				=	Tendoo_success(' Pays correctement mis &agrave; jour.');
		$array['userSurnameUpdated']			=	Tendoo_success(' Pr&eacute;nom correctement mis &agrave; jour.');
		$array['userNameUpdated']				=	Tendoo_success(' Nom correctement mis &agrave; jour.');
		
		
		if($e === TRUE)
		{
			?><style>
			.notice_sorter
			{
				border:solid 1px #999;
				color:#333;
			}
			.notice_sorter thead td
			{
				padding:2px 10px;
				text-align:center;
				background:#EEE;
				background:-moz-linear-gradient(top,#EEE,#CCC);
				border:solid 1px #999;
			}
			.notice_sorter tbody td
			{
				padding:2px 10px;
				text-align:justify;
				background:#FFF;
				border:solid 1px #999;
			}
			</style><table class="notice_sorter"><thead>
            <style>
			.notice_sorter
			{
				border:solid 1px #999;
				color:#333;
			}
			.notice_sorter thead td
			{
				padding:2px 10px;
				text-align:center;
				background:#EEE;
				background:-moz-linear-gradient(top,#EEE,#CCC);
				border:solid 1px #999;
			}
			.notice_sorter tbody td
			{
				padding:2px 10px;
				text-align:justify;
				background:#FFF;
				border:solid 1px #999;
			}
			</style>
            <tr><td>Index</td><td>Code</td><td>Description</td></tr></thead><tbody><?php    
			$index		=	1;
			foreach($array as $k => $v)
			{
				?><tr><td><?php echo $index;?></td><td><?php echo $k;?></td><td><?php echo strip_tags($v);?></td></tr><?php
				$index++;
			}
			?></tbody></table><?php
		}
		else
		{
			if(is_string($e))
			{
				global $NOTICE_SUPER_ARRAY;
				if(in_array($e,$array) || array_key_exists($e,$array))
				{
					return $array[$e];
				}
				else if(isset($NOTICE_SUPER_ARRAY))
				{
					if(array_key_exists($e,$NOTICE_SUPER_ARRAY))
					{
						return $NOTICE_SUPER_ARRAY[$e];
					}
					else
					{
						return Tendoo_warning(' "'.$e.'" constitue une alerte introuvable');
					}
				}
				else if($e != '' && strlen($e) <= 50)
				{
					return Tendoo_warning(' "'.$e.'" constitue une alerte introuvable');
				}
				else
				{
					return $e;
				}
			}
			return false;
		}
	}
}
if(!function_exists('notice_from_url'))
{
	function notice_from_url()
	{
		if(isset($_GET['notice']))
		{
			return notice($_GET['notice']);
		}
	}
}
if(!function_exists('notice_from_url_by_modal'))
{
	function notice_from_url_by_modal()
	{
		if(isset($_GET['notice']))
		{
			?><div class="notices" id="this_notice" style="position:fixed;width:300px;bottom:10px;left:10px;"><div class="tile double bg-color-purple padding10"><?php echo strip_tags(notice($_GET['notice']));?></div></div><script type="text/javascript">
				$('#this_notice').bind('click',function()
				{
					$(this).fadeOut(500,function()
					{
						$(this).remove();
					});
				});
				$(document).ready(function()
				{
					$('#this_notice').animate({"margin-left":"10px"},80,'linear',function()
					{
						$(this).animate({"margin-left":"-10px"},80,"linear",function()
						{
							$(this).animate({"margin-left":"10px"},80,'linear',function()
							{
								$(this).animate({"margin-left":"-10px"},80,"linear",function()
								{
									$(this).animate({"margin-left":"10px"},80,'linear');
								});								
							});
						})
					});
					setTimeout(function(){
						$('#this_notice').trigger('click');
					},10000);
				});
			</script><?php
		}
	}
}
if(!function_exists('sup'))
{
	function sup($e) // Site Url Plus
	{
		$ci		=	get_instance();
		$ci		=	$ci->uri;
		$uri	=	explode('/',$ci->uri_string);
		$length	=	count($uri);
		$end_uri=	'';
		for($_i = 0;$_i <= 2 ;$_i++)
		{
			$end_uri	.= '/';
			$end_uri	.=$uri[$_i];
		}
		return site_url($end_uri.'/'.$e);
	}
}
if(!function_exists('between'))
{
	function between($min,$max,$var) // Site Url Plus
	{
		if($min >= $max || $min == $max)
		{
			return FALSE;
		}
		if((int)$var >= $min && (int)$var <= $max)
		{
			return TRUE;
		}
		return FALSE;
	}
}
if(!function_exists('is_compatible'))
{
	function is_compatible() // Site Url Plus
	{
		if(fopen('index.php','r')===FALSE || file_get_contents('index.php') === FALSE)
		{
			?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><title>Erreur - Serveur incompatible</title><body><p>Le serveur sous lequel tourne ce site ne supporte pas certaines fonctionnalité. Tendoo ne peut pas correctement s'ex&eacute;cuter</p></body></html><?php
		}
	}
}
if(!function_exists('__extends'))
{
	function __extends(&$obj)
	{
		$Controller				=	Controller::instance();
		$obj->url				=&	$Controller->url;
		$obj->input				=&	$Controller->input;
		$obj->notice			=&	$Controller->notice;
		$obj->tendoo				=&	$Controller->tendoo;
		$obj->db				=&	$Controller->db;
		$obj->session			=&	$Controller->session;
		$obj->users_global		=&	$Controller->users_global;
		$obj->load				=&	$Controller->load;
		if(isset($Controller->tendoo_admin))
		{
			$obj->tendoo_admin	=&	$Controller->tendoo_admin;
		}
		if(isset($Controller->file))
		{
			$obj->file	=&	$Controller->file;
		}
		if(isset($Controller->form_validation))
		{
			$obj->form_validation	=&	$Controller->form_validation;
		}
	}
}
?>