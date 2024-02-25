<?php 

namespace Drupal\noahs_page_builder;

use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

class Control_Noahs_Icon{
	
	public function get_type() {
		return 'noahs_icon';
	}

	public function content_template($data, $name, $value, $delta) {


		$id = $data['wid'];

		$icon = (isset($value['class']) ? $value['class'] : '');

		?>
		<?php ob_start() ?>

			<div class="media-preview-actions d-flex justify-content-center align-items-center">
				<input type="hidden" name="<?php echo $name; ?>[class]" id="noahs_page_builder_icon_class_<?php echo $delta; ?>" value="<?php echo $icon; ?>" class="form-control"  field-settings>
				<input type="hidden" name="<?php echo $name; ?>[fid]" id="noahs_page_builder_icon_fid_<?php echo $delta; ?>" value="<?php echo !empty($value['icon']['fid']) ? $value['icon']['fid'] : null; ?>" class="form-control"  field-settings>
				<input type="hidden" name="<?php echo $name; ?>[url]" id="noahs_page_builder_icon_url_<?php echo $delta; ?>" value="<?php echo !empty($value['icon']['url']) ? $value['icon']['url'] : null; ?>" class="form-control"  field-settings>

				<span class="icon-empty <?php echo $icon; ?>"></span>
				<div class="btn-group position-absolute d-flex justify-content-between w-100">
					<button id="noahs_page_builder_icon_data_<?php echo $delta; ?>" class="btn btn-primary media-select-icon" data-delta="<?php echo $delta; ?>" title="<?php t('Add/change Icon'); ?>" data-element-id="noahs_page_builder_icon_data_<?php echo $delta; ?>"><i class="fa-solid fa-circle-plus"></i></button>
					<button id="noahs_page_builder_icon_data_remove<?php echo $delta; ?>" class="btn btn-danger media-remove-icon" data-delta="<?php echo $delta; ?>" title="<?php t('Remove Icon'); ?>" data-element-id="noahs_page_builder_icon_data_<?php echo $delta; ?>"><i class="fa-solid fa-trash"></i></button>
				</div>
			</div>


		<?php return ob_get_clean();
	}

	protected function get_default_settings() {
		return [
			'input_type' => 'noahs_icon',
			'placeholder' => '',
			'title' => '',
		];
	}
}