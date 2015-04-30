<?php
/**
 * @package      ThzTypo
 * @copyright    Copyright(C) since 2015  Themezly.com. All Rights Reserved.
 * @author       Themezly.com
 * @version      1.0.0
 * @license      MIT License, https://github.com/Themezly/ThzTypo/blob/master/LICENSE
 * @website      http://www.themezly.com
 */
 
/**
 * Creates a ThzTypo font preview set
 */
class ThzTypo {

	public function __construct() {
		
		$this->thz_font_print();
		
	}	
	
	/**
	 * Creates a dropdown list with standard fonts
	 */	
	public function thz_standard_fonts(){
		
		
			$html ='';
		
			$standard_fonts = array(
			
				'Arial, Helvetica, sans-serif',
				"'Arial Black', Gadget, sans-serif" ,
				"'Bookman Old Style', serif",
				"'Comic Sans MS', cursive",
				"'Courier New', Courier, monospace" ,
				"'Century Gothic', sans-serif",
				"Garamond, serif",
				"Georgia, serif",
				"Geneva, Tahoma, Verdana, sans-serif",
				"Helvetica, Arial, sans-serif" ,
				"'Helvetica Neue', Helvetica, Arial, sans-serif",
				"Impact, Charcoal, sans-serif",
				"'Lucida Console', Monaco, monospace",
				"'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
				"'MS Sans Serif', Geneva, sans-serif" ,
				"'MS Serif', 'New York', sans-serif",
				"'Palatino Linotype','Book Antiqua', Palatino, serif",
				"Tahoma, Geneva, sans-serif",
				"'Times New Roman', Times, serif",
				"'Trebuchet MS', Helvetica, sans-serif",
				"Verdana, Geneva, sans-serif",
				"Cambria,serif",
			);	
			
			
			foreach($standard_fonts as $sf){
				
				$font_variants 	= '300,300italic,400,italic,700,700italic,900,900italic';
				$font_type 		= 'standard';
				
				$html .='<option value="'.$sf.'" data-type="'.$font_type.'" data-variants="'.$font_variants.'">';
				$html .=$sf;
				$html .='</option>';
				
			}
			
			return $html;
				
	}
		
	/**
	 * Creates a dropdown list with google fonts
	 */		
	public function thz_google_fonts(){


		$html ='';
		$fonts = json_decode(file_get_contents(dirname(__FILE__).'/google.fonts.json'),true);
		
		$google_fonts = array();
		foreach ($fonts['items'] as $font) {
			$google_fonts[$font['family']] = array(
				'label'    => $font['family'],
				'variants' => $font['variants'],
				'subsets'  => $font['subsets'],
			);
		}
		
		foreach($google_fonts as $gf){
			
			$font_name 		= $gf['label'];
			$font_variants 	= implode(',',$gf['variants']);
			$font_subsets 	= implode(',',$gf['subsets']);
			$font_type 		= 'google';
			
			$html .='<option value="'.$font_name.'" data-type="'.$font_type.'" data-variants="'.$font_variants.'"  data-subsets="'.$font_subsets.'">';
			$html .=$font_name;
			$html .='</option>';
			
			
		}

		
		return $html;
	}
	
	/**
	 * Creates a dropdown list of standard font variants
	 */		
	public function thz_font_variants(){

		
		$html ='<div class="thz-typography-group">';
			$html .='<span>Style & Weight</span>';
			$html .='<select id="thz-font-variant">';
				$html .='<option value="300">Thin</option>';
				$html .='<option value="300italic">Thin/Italic</option>';
				$html .='<option value="400" selected="selected">Normal</option>';
				$html .='<option value="700">Bold</option>';
				$html .='<option value="700italic">Bold/Italic</option>';
				$html .='<option value="900">Bolder</option>';
				$html .='<option value="900italic">Bolder/Italic</option>';
			$html .='</select>';
		$html .='</div>';

		
		return $html;

		
	}

	/**
	 * Creates a select holder for google font subsets
	 */		
	public function thz_font_subsets(){
		

		$html ='<div class="thz-typography-group">';
		$html .='<span>Subsets</span>';
		$html .='<select id="thz-font-subset"></select>';
		$html .='</div>';

		
		return $html;
		
	}
	
	
	/**
	 * Creates a preview box
	 */		
	public function thz_font_preview(){
		

		$html ='<div class="thz-typography-preview">';
		$html .='1 2 3 4 5 6 7 8 9 0 A B C D E F G H I J K L M N O P Q R S T U V W X Y Z a b c d e f g h i j k l m n o p q r s t u v w x y z';
		$html .='</div>';

		
		return $html;
		
	}	


	/**
	 * Prints the complete ThzTypo preview block
	 */		
	public function thz_font_print(){
		
		$html ='<div id="thz-font-selector">';
			$html .='<div class="thz-typography-group">';
			$html .='<span>Family</span>';
				$html .='<select id="thz-font-family">';
					$html .='<optgroup label="Standard Fonts">';
					$html .=$this->thz_standard_fonts();
					$html .='</optgroup>';
					$html .='<optgroup label="Google Fonts">';
					$html .=$this->thz_google_fonts();
					$html .='</optgroup>';
				$html .='</select>';
			$html .='</div>';
			$html .=$this->thz_font_variants();
			$html .=$this->thz_font_subsets();
			$html .=$this->thz_font_preview();
		$html .='</div>';

		
		echo $html;		
	}	
}