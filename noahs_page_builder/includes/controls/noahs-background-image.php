<?php 

namespace Drupal\noahs_page_builder;

use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;
use \Drupal\noahs_page_builder\Controller\NoahsController;
class Control_Noahs_Background_Image{
	
	public function get_type() {
		return 'noahs_background_image';
	}

	public function content_template($data, $name, $value) {


		$id = $data['wid'];
		$image_styles = NoahsController::getImageStyle();

		$image = !empty($value['background_image']['thumbnail']) ? $value['background_image']['thumbnail'] : '/'.NOAHS_PAGE_BUILDER_PATH.'/assets/img/no-image-thumbnail.jpg';

		$field_names = [
			'Background Position' => 'background_position',
			'Background repeat' => 'background_repeat',
			'Background Attachment' => 'background_attachment',
			'Background size' => 'background_size'
		];

		// Array con las opciones para cada select

		$options = [
			'background_position' => [
				'' => 'Center Center',
				'center top' => 'Center Top',
				'center right' => 'Center Right',
				'center bottom' => 'Center Bottom',
				'left top' => 'Left Top',
				'left center' => 'Left Center',
				'left bottom' => 'Left Bottom',
				'right top' => 'Right Top',
				'right center' => 'Right Center',
				'right bottom' => 'Right Bottom'
			],
			'background_repeat' => [
				'' => 'No Repeat',
				'repeat' => 'Repeat',
				'repeat-x' => 'Repeat X',
				'repeat-y' => 'Repeat Y'
			],
			'background_attachment' => [
				'' => 'Default',
				'scroll' => 'Scroll',
				'fixed' => 'Fixed'
			],
			'background_size' => [
				'' => 'Default',
				'cover' => 'Cover',
				'contain' => 'Contain',
			]
		];

		$nameBase = $name.'[background_image]';
		$element_id = preg_replace('/[\[\]]+/', '_', $name);

		?>
		<?php ob_start() ?>
		

				<div class="field_group mt-3">
					<div class="field_group field_element mb-3">
			
						<div class="mb-3 background-image-field">
							<div class="media-preview-actions d-flex justify-content-center align-items-center mb-3">
							
								<img class="background-thumbnail-image" src="<?php echo $image; ?>" alt="Thumbnail">
								<input type="hidden" name="<?php echo $name; ?>[background_image][fid]" id="<?php echo $element_id; ?>" value="<?php echo !empty($value['background_image']['fid']) ? $value['background_image']['fid'] : null; ?>" class="form-control background-fid"  field-settings>
								<input type="hidden" name="<?php echo $name; ?>[background_image][thumbnail]" id="noahs_page_builder_background_thumbnail" value="<?php echo !empty($value['background_image']['thumbnail']) ? $value['background_image']['thumbnail'] : null; ?>" class="form-control  background-thumbnail"  field-settings>
								<input type="hidden" name="<?php echo $name; ?>[background_image][original]" id="noahs_page_builder_background_original" value="<?php echo !empty($value['background_image']['original']) ? $value['background_image']['original'] : null; ?>" class="form-control  background-original"  field-settings>
								<div class="btn-group position-absolute d-flex justify-content-between w-100">
									<button class="btn btn-primary media-uploadbg_image area_tooltip" title="<?php t('Add/change Image'); ?>" data-element-id="<?php echo $element_id; ?>"><i class="fa-solid fa-circle-plus"></i></button>
									<button class="btn btn-danger media-removebg_image area_tooltip"  title="<?php t('Remove Image'); ?>"><i class="fa-solid fa-trash"></i></button>
								</div>
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

						<?php
							foreach ($field_names as $label => $field_name) {
								?>
								<div class="field_group field_item mb-3">
									<label for="noahs_page_builder_<?php echo $field_name; ?>"><?php echo $label; ?></label>
									<select name="<?php echo $nameBase; ?>[<?php echo $field_name; ?>]" data-style-css="<?php echo str_replace('_', '-', $field_name); ?>" class="form-control" field-settings>
										<?php foreach ($options[$field_name] as $k => $title) { ?>
											<option value="<?php echo $k; ?>" <?php echo !empty($value['background_image'][$field_name]) && $value['background_image'][$field_name] === $k ? ' selected' : ''; ?>>
												<?php echo $title; ?>
											</option>
										<?php } ?>
									</select>
								</div>
								<?php
							}
							?>

					</div>
				</div>
	

		<?php return ob_get_clean();
	}

	protected function get_default_settings() {
		return [
			'input_type' => 'noahs_background_image',
			'placeholder' => '',
			'title' => '',
		];
	}
}