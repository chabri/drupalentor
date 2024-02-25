<?php 
	namespace Drupal\noahs_page_builder;

   class Fonts{


	// public function content_template();

	public static function getFonts() {
		$font_options = [
			'' => 'Default',
			'Roboto' => 'Roboto',
			'Open Sans' => 'Open Sans',
			'Lato' => 'Lato',
			'Montserrat' => 'Montserrat',
			'Roboto Condensed' => 'Roboto Condensed',
			'Oswald' => 'Oswald',
			'Raleway' => 'Raleway',
			'Ubuntu' => 'Ubuntu',
			'PT Sans' => 'PT Sans',
			'Noto Sans' => 'Noto Sans',
			'Roboto Slab' => 'Roboto Slab',
			'Poppins' => 'Poppins',
			'Merriweather' => 'Merriweather',
			'Playfair Display' => 'Playfair Display',
			'Droid Sans' => 'Droid Sans',
			'Lora' => 'Lora',
			'Roboto Mono' => 'Roboto Mono',
			'Ubuntu Condensed' => 'Ubuntu Condensed',
			'Titillium Web' => 'Titillium Web',
		  ];
		return $font_options;
	// return ob_get_clean();
	}
	public static function getFontsWeights() {
		$noahs_page_builder_fonts = [
			""    => "Default",
			"100" => "100",
			"200" => "200",
			"300" => "300",
			"400" => "400",
			"500" => "500",
			"600" => "600",
			"700" => "700",
			"800" => "800",
			"900" => "900",
			"normal" => "Normal",
			"bold" => "Bold",
			];
		return $noahs_page_builder_fonts;
	// return ob_get_clean();
	}

   }
