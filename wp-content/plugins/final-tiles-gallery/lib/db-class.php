<?php
class FinalTilesDB {
	
	private static $pInstance;
	
	private function __construct() {}
	
	public static function getInstance() {
		if(!self::$pInstance) {
			self::$pInstance = new FinalTilesDB();
		}
		
		return self::$pInstance;
	}
	
	public function query() {
		return "Test";	
	}
	
	public function addGallery($data) {
		global $wpdb;		  
		$galleryAdded = $wpdb->insert( $wpdb->FinalTilesGalleries, $data);
		exit( var_dump( $wpdb->last_query ) );
		return $galleryAdded;
	}
	
	public function getNewGalleryId() {
		global $wpdb;
		return $wpdb->insert_id;
	}
	
	public function deleteGallery($gid) {
		global $wpdb;
		$wpdb->query( "DELETE FROM $wpdb->FinalTilesImages WHERE gid = '$gid'" );
		$wpdb->query( "DELETE FROM $wpdb->FinalTilesGalleries WHERE Id = '$gid'" );
	}
	
	public function editGallery($gid, $data) {
		global $wpdb;
		$imageEdited = $wpdb->update( $wpdb->FinalTilesGalleries, $data, array( 'Id' => $gid ) );
		
		return $imageEdited;
	}
	
	public function getGalleryById($id) {
		global $wpdb;
		$query = "SELECT * FROM $wpdb->FinalTilesGalleries WHERE Id = '$id'";
		$gallery = $wpdb->get_row($query);
		return $gallery;
	}
	
	public function getGalleries() {
		global $wpdb;
		$query = "SELECT Id, name, slug, description FROM $wpdb->FinalTilesGalleries";
		$galleryResults = $wpdb->get_results( $query );
		return $galleryResults;
	}
	
	public function addImage($gid, $image) {
		global $wpdb;		
		$imageAdded = $wpdb->insert( $wpdb->FinalTilesImages, array( 'gid' => $gid, 'imagePath' => $image, 'title' => "", 'description' => "", 'sortOrder' => 0 ) );
		return $imageAdded;
	}

	public function addImages($gid, $images) {
		global $wpdb;		

		foreach ($images as $image) {
			
			$imageAdded = $wpdb->insert( $wpdb->FinalTilesImages, 
				array( 'gid' => $gid, 'imagePath' => $image->imagePath, 
     					 'description' => $image->description, 
					'imageId' => $image->imageId, 'sortOrder' => 0, 'filters' => $images->filters ) );
			$id = $wpdb->insert_id;
			$wpdb->update($wpdb->FinalTilesImages, array('sortOrder' => $id), array('id' => $id));
		}
		
		return true;
	}
	
	public function addFullImage($data) {
		global $wpdb;		
		$imageAdded = $wpdb->insert( $wpdb->FinalTilesImages, $data );
		return $imageAdded;
	}
	
	public function deleteImage($id) {
		global $wpdb;
		$query = "DELETE FROM $wpdb->FinalTilesImages WHERE Id = '$id'";
		if($wpdb->query($query) === FALSE) {
			return false;
		}
		else {
			return true;
		}
	}
	
	public function editImage($id, $data) {
		global $wpdb;
		$imageEdited = $wpdb->update( $wpdb->FinalTilesImages, $data, array( 'Id' => $id ) );
		//exit( var_dump( $wpdb->last_query ) );
		return $imageEdited;
	}

	public function sortImages($ids) {
		global $wpdb;
		$index = 1;
		foreach($ids as $id) 
		{
			$data = array('sortOrder' => $index++);
			$wpdb->update( $wpdb->FinalTilesImages, $data, array( 'Id' => $id ) );
		}
		return true;
	}
	
	public function getImagesByGalleryId($gid) {
		global $wpdb;
		$query = "SELECT * FROM $wpdb->FinalTilesImages WHERE gid = $gid ORDER BY sortOrder ASC";
		$imageResults = $wpdb->get_results( $query );
		return $imageResults;
	}
	
	public function getGalleryByGalleryId($gid) {
		global $wpdb;
		$query = "SELECT $wpdb->FinalTilesGalleries.*, $wpdb->FinalTilesImages.* FROM $wpdb->FinalTilesGalleries INNER JOIN $wpdb->FinalTilesImages ON ($wpdb->FinalTilesGalleries.Id = $wpdb->FinalTilesImages.gid) WHERE $wpdb->FinalTilesGalleries.Id = '$gid' ORDER BY sortOrder ASC";			
		$gallery = $wpdb->get_results( $query );		
		return $gallery;
	}
}
?>