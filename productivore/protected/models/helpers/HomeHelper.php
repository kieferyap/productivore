<?
class HomeHelper extends MainHelper
{

	public function get_applings_byUserId($userid = 1, $isAlphabetical = false){
		if($isAlphabetical)
			$order = 'ORDER BY name ASC';
		else
			$order = 'ORDER BY notifCount DESC, name ASC';
			
		$query =
			'SELECT
				appling_id,
				appling_name as name,
				description,
				appling_url as url,
				appling_image as image,
				notification_count as notifCount,
				access_count as accessCount,
				is_favorite as isFavorite,
				appling_message as message
			FROM
				applings
				JOIN user_appling_maps
				USING (appling_id)
			WHERE
				user_id = :userid
			AND appling_id > 0 '.$order;
		$params = array('userid'=>$userid);
		return $this->sql_query($query, $params);
	}
	
	public function update_favoriteApplings_byUserId($userId, $applingId, $isFavorite){
			
		$query = '
			UPDATE user_appling_maps
			SET is_favorite = :isFavorite
			WHERE user_id = :userId
			AND appling_id = :applingId
		';
		
		$params = array(
			'userId'=>$userId,
			'applingId'=>$applingId,
			'isFavorite'=>$isFavorite
		);
		
		echo "
			UPDATE user_appling_maps
			SET is_favorite = $isFavorite
			WHERE user_id = $userId
			AND appling_id = $applingId
		>>> "; 
		echo $this->sql_execute($query, $params);
		die(); 
		die();
	}
	
}