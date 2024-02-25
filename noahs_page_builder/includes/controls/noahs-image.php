<?php 

namespace Drupal\noahs_page_builder;

use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;
use \Drupal\noahs_page_builder\Controller\NoahsController;

class Control_Noahs_Image{
	
	public function get_type() {
		return 'noahs_image';
	}

	public function content_template($data, $name, $value) {
		$image_styles = NoahsController::getImageStyle();
		$no_image = '/'.NOAHS_PAGE_BUILDER_PATH.'/assets/img/no-image-thumbnail.jpg';
		$image = (empty($value['thumbnail']) && !empty($data['item']['default_value'])) ? $data['item']['default_value'] : $value['thumbnail'];
		$image = !empty($image) ? $image : $no_image;
		// if(!empty($value['thumbnail'])){
		// 	$image = $value['thumbnail'];
		// }

		?>
		<?php ob_start() ?>
		
	
		<div class="mb-3 background-image-field">
			<div class="media-preview-actions d-flex justify-content-center align-items-center mb-3">

				<div class="mb-3"><img class="background-thumbnail-image" src="<?php echo $image; ?>" alt="Thumbnail"></div>
				<input type="hidden" name="<?php echo $name; ?>[fid]" id="noahs_page_builder_background_image" value="<?php echo !empty($value['fid']) ? $value['fid'] : ''; ?>" class="form-control background-fid"  field-settings>
				<input type="hidden" name="<?php echo $name; ?>[thumbnail]" id="noahs_page_builder_background_thumbnail" value="<?php echo !empty($value['thumbnail']) ? $value['thumbnail'] : ''; ?>" class="form-control  background-thumbnail"  field-settings>
				<div class="btn-group position-absolute d-flex justify-content-between w-100">
					<button class="btn btn-primary media-uploadbg_image area_tooltip" title="<?php t('Add/change Image'); ?>" data-element-id="noahs_page_builder_background_image"><i class="fa-solid fa-circle-plus"></i></button>
					<button class="btn btn-danger media-removebg_image area_tooltip"  title="<?php t('Remove Image'); ?>"><i class="fa-solid fa-trash"></i></button>
				</div>
			</div>
			<div class="field_group field_item mb-3">
				<label for="noahs_page_builder_background_image_style">Use Token Field</label>
				<input type="text" name="<?php echo $name; ?>[token]">
				<a class="btn btn-s btn-info noahs_page_builder-modal-tokens mb-4" href="#">Select Token</a>
			</div>
			<div class="field_group field_item mb-3">
				<label for="noahs_page_builder_background_image_style">Image Style</label>
				<select name="<?php echo $name; ?>[image_style]" class="form-control" field-settings>
					<?php foreach($image_styles as $k => $style){ ?>
						<option value="<?php echo $k;?>" <?php echo !empty($value['image_style']) && $value['image_style'] === $k ? 'selected' : ''; ?>><?php echo $style;?></option>
					<?php } ?>
				</select>
			</div>
	
				
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