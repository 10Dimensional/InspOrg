<?php
if (!class_exists("FinalTilesGallery")) {
	class FinalTilesGallery {
		public function __construct($galleryId, $db) {
			$this->id = $galleryId;
			$this->gallery = null;
			$this->db = $db;
			$this->images = array();
			
		}
		
		private function getLink($image)
		{
			if($image->zoom == "T")
				return "href='" . $this->images[$image->imageId] . "'";
			
			if(strlen($image->link) > 0)
				return "href='" . $image->link . "'";
			
			return '';
		}
		
		private function getdef($value, $default)
		{
			if($value == NULL || empty($value))
				return $default;
				
			return $value;
		}
        
        private function toRGB($Hex){
            
            if (substr($Hex,0,1) == "#")
                $Hex = substr($Hex,1);
            
            $R = substr($Hex,0,2);
            $G = substr($Hex,2,2);
            $B = substr($Hex,4,2);

            $R = hexdec($R);
            $G = hexdec($G);
            $B = hexdec($B);

            $RGB['R'] = $R;
            $RGB['G'] = $G;
            $RGB['B'] = $B;
            
            $RGB[0] = $R;
            $RGB[1] = $G;
            $RGB[2] = $B;

            return $RGB;

        }

		static public function slugify($text)
		{ 
		  $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
		  $text = trim($text, '-');
		  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		  $text = strtolower($text);
		  $text = preg_replace('~[^-\w]+~', '', $text);

		  if (empty($text))
		  {
		    return 'n-a';
		  }

		  return $text;
		}

		static public function getFilters($filters)
		{
			if(empty($filters))
				return "";

			$css = array();
			foreach (explode("|", $filters) as $f) {
				$css[] = "ftg-set-" . FinalTilesGallery::slugify($f);
			}

			return implode(" ", $css);
		} 

		public function render() {
			$imageResults = $this->getImages();
			$gallery = $this->getGallery();

            $ids = array();
            foreach($imageResults as $image)
            {
	            $ids[] = $image->imageId;
            }
            
            $args = array(
				'post_type' => 'attachment',
				'posts_per_page' => -1,
				'include' => $ids
			);
		
			$atts = get_posts($args);
            foreach($atts as $att)
            {	            
	            $this->images[$att->ID] = $att->guid;
            }

            if($gallery->shuffle == 'T')
            	shuffle($imageResults);
    
            $bgCaption = $this->toRGB($gallery->hoverColor);
            
            $html = "";            

            if(strlen($gallery->style) || $gallery->borderSize || $gallery->backgroundColor || 
            	$gallery->borderRadius || $gallery->shadowSize)
			{
				$html .= "<style>\n";				
				
				if($gallery->borderSize)
					$html .= "#ftg-$this->id .tile .tile-inner { border: " . $gallery->borderSize . "px solid " . $gallery->borderColor . "; }\n";

				if($gallery->backgroundColor)
					$html .= "#ftg-$this->id .tile .tile-inner { background-color: " . $gallery->backgroundColor . "; }\n";

				if($gallery->borderRadius)
					$html .= "#ftg-$this->id .tile .tile-inner { border-radius: " . $gallery->borderRadius . "px; }\n";

				if($gallery->shadowSize)
					$html .= "#ftg-$this->id .tile .tile-inner { box-shadow: " . $gallery->shadowColor ." 0px 0px " . $gallery->shadowSize . "px; }\n";
                
                $html .= "#ftg-$this->id .tile .caption { background-color: #$gallery->hoverColor; }\n";
                $html .= "#ftg-$this->id .tile .caption { background-color: rgba($bgCaption[0], $bgCaption[1], $bgCaption[2], ". ($gallery->hoverOpacity/100) . "); }\n";
                
				if(strlen($gallery->style))
					$html .= $gallery->style;

				$html .= "</style>\n";
			}                        	           

            $html .= "<div class='final-tiles-gallery' id='ftg-$this->id' style='width:$gallery->width'>\n";
            if(strlen($gallery->filters))
            {
            	$filters = explode("|", $gallery->filters);
            	$html .= "<div class='ftg-filters'>\n";
            	$html .= "\t<a href='#'>All</a>\n";
            	foreach($filters as $filter)
            	{
            		$html .= "\t<a href='#set-". FinalTilesGallery::slugify($filter) ."'>$filter</a>\n";
            	}
            	$html .= "</div>\n";
            }
            $html .= "<div class='ftg-items'>\n";
			foreach($imageResults as $image)
			{
				$rel = $gallery->lightbox == "prettyphoto" ? "prettyPhoto[ftg-$this->id]" : "ftg-$this->id";
            	$html .= "<div class='tile ". FinalTilesGallery::getFilters($image->filters) ."'>\n";
                $html .= "<a ". ($gallery->lightbox == "lightbox2" ? "data-lightbox='gallery'" : "") ." rel='$rel' " . ($image->blank == "T" ? "target='_blank' ":" "  ) . " class='tile-inner " . ($image->zoom == "T" ? "zoom" : "") . "' " . $this->getLink($image) . ">\n";
				$html .= "<img class='item' src='$image->imagePath' />\n";
                if(! empty($image->description))
                {
                 	$html .= "<div class='caption'><p>$image->description</p></div>\n";
                }
                $html .= "</a>\n";
                $html .= "</div>\n";
			}
            $html .= "</div>\n";
            $html .= "</div>\n";
            
            $html .= "<script type='text/javascript'>\n";
            $html .= "\tjQuery('#ftg-$this->id').finalTilesGallery({\n";
            $html .= "\t\tminTileWidth: $gallery->minTileWidth,\n";
            if(strlen($gallery->script))
            {
            	$html .= "\t\tonComplete: function () { " . stripslashes($gallery->script) . "},\n";
            }
            $html .= "\t\tmargin: $gallery->margin,\n";
            $html .= "\t\tgridCellSize: $gallery->gridCellSize,\n";
            $html .= "\t\thoverEffectDuration: $gallery->hoverEffectDuration,\n";
            $html .= "\t\thoverEffect: '$gallery->hoverEffect',\n";
            $html .= "\t\thoverEasing: '$gallery->hoverEasing',\n";
			$html .= "\t\tenableTwitter: " . ($gallery->enableTwitter == "T" ? "true" : "false") . ",\n";
			$html .= "\t\tenableFacebook: " . ($gallery->enableFacebook == "T" ? "true" : "false") . ",\n";
			$html .= "\t\tenablePinterest: " . ($gallery->enablePinterest == "T" ? "true" : "false") . ",\n";
			$html .= "\t\tenableGplus: " . ($gallery->enableGplus == "T" ? "true" : "false") . ",\n";
			$html .= "\t\tallowEnlargement: " . ($gallery->enlargeImages == "T" ? "true" : "false") . ",\n";
			$html .= "\t\tscrollEffect: '"  . ($gallery->scrollEffect) . "'\n";
            $html .= "\t});\n";			
            
			$html .= "\tjQuery(function () {\n";
			switch ($gallery->lightbox) {
				default:
					break;
				case 'magnific':
					$html .= "\t\tjQuery('#ftg-$this->id .tile a.zoom').magnificPopup({type:'image', zoom: { enabled: true, duration: 300, easing: 'ease-in-out' }});\n";					
					break;
				case 'prettyphoto':
					$html .= "\t\tjQuery('#ftg-$this->id .tile a.zoom').prettyPhoto({social_tools:''});\n";
					break;
				case 'colorbox':
					$html .= "\t\tjQuery('#ftg-$this->id .tile a.zoom').colorbox({rel: 'gallery'});\n";
					break;
				case 'fancybox':
					$html .= "\t\tjQuery('#ftg-$this->id .tile a.zoom').fancybox({});\n";
					break;
				case 'swipebox':
					$html .= "\t\tjQuery('#ftg-$this->id .tile a.zoom').swipebox({});\n";
					break;
			}
			$html .= "\t\tvar preload = jQuery('#ftg-$this->id .tile a.zoom');\n";
			$html .= "\t\tvar _idx = 0;\n";
			$html .= "\t\tvar _img = new Image();\n";
			$html .= "\t\t_img.onload=function () { if(++_idx < preload.length) this.src = preload.eq(_idx).attr('href'); };\n";
			$html .= "\t\t_img.src = preload.eq(_idx).attr('href');\n";
			$html .= "\n";
			$html .= "\n";
			$html .= "\t});\n";
			 
			$html .= "</script>";
			
			if(! empty($_GET["debug"]))
				return $html;

			return str_replace(array("\n", "\t"), "", $html);
		}
		
		public function getImages() {						
			$images = $this->db->getImagesByGalleryId($this->id);			
			return $images;
		}
		
		public function getGallery() {
			if($this->gallery == null) 
			{
				$this->gallery = $this->db->getGalleryById($this->id);

				$this->gallery->hoverOpacity = $this->getdef($this->gallery->hoverOpacity, 80);
				$this->gallery->hoverEffectDuration = $this->getdef($this->gallery->hoverEffectDuration, 250);
				$this->gallery->hoverEffect = $this->getdef($this->gallery->hoverEffect, 'fade');
				$this->gallery->hoverEasing = $this->getdef($this->gallery->hoverEasing, 'easeInQuad');
				$this->gallery->hoverColor = $this->getdef($this->gallery->hoverColor, '#000000');
			}
			return $this->gallery;
		}
	}
}
?>