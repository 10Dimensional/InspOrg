<?php

function install_db() 
{
  global $wpdb;			
  

  $FinalTilesGalleries = $wpdb->FinalTilesGalleries;
  $FinalTilesImages = $wpdb->FinalTilesImages;
  
  
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		
  $sql = "CREATE TABLE $FinalTilesGalleries (
	 	Id INT NOT NULL AUTO_INCREMENT, 
		name VARCHAR( 30 ) NOT NULL, 
		slug VARCHAR( 30 ) NOT NULL, 
		description VARCHAR( 500 ) NULL,
        filters VARCHAR( 1500 ) NULL,
        width VARCHAR ( 10 ) DEFAULT \"100%\" NOT NULL,
		margin INT NOT NULL, 
		minTileWidth INT NOT NULL, 
        gridCellSize INT NOT NULL, 
        lightbox VARCHAR( 50 ) DEFAULT \"magnific\" NOT NULL,
        hoverEffect VARCHAR(20) DEFAULT \"fade\" NOT NULL,
        hoverColor VARCHAR(7) DEFAULT \"#000000\" NOT NULL,
        hoverOpacity INT DEFAULT 80 NOT NULL,
        hoverEffectDuration INT DEFAULT 250 NOT NULL,
        hoverEasing VARCHAR(50) DEFAULT \"swing\" NOT NULL,
        scrollEffect VARCHAR(50) DEFAULT \"slide\" NOT NULL,
        shuffle ENUM('T','F') NOT NULL,         
        enableTwitter ENUM('T','F') NOT NULL, 
        enableFacebook ENUM('T','F') NOT NULL, 
        enableGplus ENUM('T','F') NOT NULL, 
        enablePinterest ENUM('T','F') NOT NULL, 
        borderSize INT DEFAULT 0 NOT NULL,
        borderColor VARCHAR(7) DEFAULT \"#ffffff\" NOT NULL,
        shadowSize INT DEFAULT 0 NOT NULL,
        shadowColor VARCHAR(7) DEFAULT \"#000000\" NOT NULL,
        backgroundColor VARCHAR(7) DEFAULT \"#ffffff\" NOT NULL,
        enlargeImages ENUM('T','F') DEFAULT 'T' NOT NULL,
        borderRadius INT DEFAULT 0 NOT NULL,    
        style VARCHAR( 1000 ) NULL,
        script VARCHAR( 1000 ) NULL,
        UNIQUE KEY id (id)
  );";
	
  dbDelta( $sql );

  $sql = "CREATE TABLE $FinalTilesImages (
		Id INT NOT NULL AUTO_INCREMENT, 
		gid INT NOT NULL, 
		imageId INT NOT NULL, 
		imagePath LONGTEXT NOT NULL, 
		zoom ENUM('T','F') NOT NULL, 
        filters VARCHAR( 1500 ) NULL,
        link LONGTEXT NULL,
        blank ENUM('T','F') DEFAULT \"F\" NOT NULL, 
		description LONGTEXT NOT NULL, 
		sortOrder INT NOT NULL,     
		UNIQUE KEY id (Id) 
	)";

	dbDelta( $sql );
  
}
