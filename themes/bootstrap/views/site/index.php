<div class="cushion-15"></div>
<div class="pvore-notifications-search-container">
	<form action=""><input type="text" class="search-query pvore-notifications-search-input" id="pvore-notifications-search" placeholder="Appling Search"></form>
</div>

<div class="pvore-notifications-app-hr-container">
	<hr class="pvore-notifications-app-hr"/>
</div>
<?$applingCount = count($allApplings); $i=0;?>
<?foreach($allApplings as $applingid=>$appling):?>
	<?
		$notifDescription = 'There are 0 notifications for this appling.';
		/*
		$greyedOut = '';
		if($appling['notif_count'] == 0){
			$greyedOut = 'notifications-greyed';
		}
		else{
			$notifDescription = str_replace('[FIELD]', $appling['notif_count'], $appling['message']);
		}
		*/
		if($appling['notif_count'] != 0){
			$notifDescription = str_replace('[FIELD]', $appling['notif_count'], $appling['message']);
		}
	?>

	<div class="pvore-notifications-app <? //echo $greyedOut?>" 
		id="appling-<?echo $appling['appling_id']?>-list"
		onclick="window.location='<?echo BASE_URL.'/'.$appling['url']?>'"
		isfavorite="<?echo $appling['isfavorite']?>"
		accesscount="<?echo $appling['accesscount']?>"
		baseId="appling-<?echo $appling['appling_id']?>">
		<?/*
		if($appling['notif_count'] != 0):?>
			<div class="appling-icon-notification"><?echo $appling['notif_count']?></div>
		<?endif;
		*/?>
		<div class="pvore-notifications-app-image">
			<?if($appling['isfavorite'] == 1):?>
				<span class="favorite-appling-icon fa fa-star fa-1 <? //echo $greyedOut?>"></span>
			<?endif;?>
			<span class="appling-icon fa fa-<?echo $appling['image']?> fa-2x"></span>
		</div>
		<div class="pvore-notifications-app-title appling-name-notification">
			<?echo $appling['name']?><br/>
			<p class="pvore-notifications-app-description <? //echo $greyedOut?>">
			<?echo $notifDescription;?>
			</p>
		</div>
	</div>
	<?/*
	<?if($i<$applingCount-1):?>
		<hr class="notification-hr"/>
	<?endif;?>
	<?$i++;?>
	*/?>
<?endforeach;?>