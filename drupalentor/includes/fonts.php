<?php 
	namespace Drupal\drupalentor;

   class Fonts{


	// public function content_template();

	public static function getFonts() {
		$drupalentor_fonts = [
            'Roboto',
            'Open Sans',
            'Lato',
            'Montserrat',
            'Roboto Condensed',
            'Oswald',
            'Source Sans Pro',
            'Raleway',
            'Ubuntu',
            'PT Sans',
            'Noto Sans',
            'Roboto Slab',
            'Poppins',
            'Merriweather',
            'Playfair Display',
            'Droid Sans',
            'Lora',
            'Roboto Mono',
            'Ubuntu Condensed',
            'Titillium Web'
        ];
		return $drupalentor_fonts;
	// return ob_get_clean();
	}
	public static function getFontsWeights() {
		$drupalentor_fonts = [
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
		return $drupalentor_fonts;
	// return ob_get_clean();
	}

   }
