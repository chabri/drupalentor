<?php 

namespace Drupal\drupalentor;

use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

class Control_Drupalentor_Image{
	
	public function get_type() {
		return 'drupalentor_image';
	}

	public function content_template($data, $name, $value) {
		$image_styles = \Drupal::entityQuery('image_style')->execute();
		$image = '/'.DRUPALENTOR_PATH.'/assets/img/no-image-thumbnail.jpg';

		if(!empty($value['thumbnail'])){
			$image = $value['thumbnail'];
		}
		?>
		<?php ob_start() ?>
		
	
		<div class="mb-3 background-image-field">
			<label for="drupalentor_image">Background Image</label>

			<div class="mb-3"><img class="background-thumbnail-image" src="<?php echo $image; ?>" alt="Thumbnail"></div>
			<input type="hidden" name="<?php echo $name; ?>[fid]" id="drupalentor_background_image" value="<?php echo !empty($value['fid']) ? $value['fid'] : null; ?>" class="form-control background-fid"  field-settings>
			<input type="hidden" name="<?php echo $name; ?>[thumbnail]" id="drupalentor_background_thumbnail" value="<?php echo !empty($value['thumbnail']) ? $value['thumbnail'] : null; ?>" class="form-control  background-thumbnail"  field-settings>
			<div class="mb-3">
				<button class="btn btn-primary media-uploadbg_image area_tooltip" title="<?php t('Add/change Image'); ?>" data-element-id="drupalentor_background_image"><i class="fa-solid fa-circle-plus"></i></button>
				<button class="btn btn-danger media-removebg_image area_tooltip"  title="<?php t('Remove Image'); ?>"><i class="fa-solid fa-trash"></i></button>
			</div>
			<div class="field_group field_item mb-3">
				<label for="drupalentor_background_image_style">Image Style</label>
				<select name="<?php echo $name; ?>[image_style]" class="form-control" field-settings>
					<?php foreach($image_styles as $k => $style){ ?>
						<option value="<?php echo $k;?>" <?php echo !empty($value['solid']['image_style']) && $value['solid']['image_style'] === $k ?? 'selected'; ?>><?php echo $style;?></option>
					<?php } ?>
				</select>
			</div>
			
		</div>
		
	
		<?php return ob_get_clean();
	}

	protected function get_default_settings() {
		return [
			'input_type' => 'drupalentor_background',
			'placeholder' => '',
			'title' => '',
		];
	}
}