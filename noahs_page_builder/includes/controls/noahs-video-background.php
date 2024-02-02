<?php 

namespace Drupal\noahs_page_builder;

use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;


class Control_Noahs_Video_Background {
	
	public function get_type() {
		return 'noahs_background';
	}

	public function content_template($data, $name, $value) {

		// $option = $data['value']['option'];
		$id = $data['wid'];


		?>
		<?php ob_start() ?>
		
	
	
		


			<div class="field_element">
				<label for="background_option_video">Background Video URL</label>
				<input type="text" name="<?php echo $name; ?>[url]" id="background_option_video" value="<?php echo !empty($value['url']) ? $value['url'] : null; ?>"  class="form-control"  field-settings>

			</div>

			<div class="field_element field__color">
				<label for="noahs_page_builder_background_overlay">Video Overlay</label>
				<input type="text" 
					   name="<?php echo $name; ?>[video_background_overlay]" 
					   id="noahs_page_builder_video_background_overlay" 
					   class="form-control-color-alpha" 
					   value="<?php echo !empty($value['video_background_overlay']) ? $value['video_background_overlay'] : null; ?>" 
					   field-settings
					   >
			</div>


		<?php return ob_get_clean();
	}

	protected function get_default_settings() {
		return [
			'input_type' => 'noahs_background',
			'placeholder' => '',
			'title' => '',
		];
	}
}