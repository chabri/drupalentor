<?php 

namespace Drupal\noahs_page_builder;

use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

class Control_Noahs_Icon{
	
	public function get_type() {
		return 'noahs_icon';
	}

	public function content_template($data, $name, $value) {


		$id = $data['wid'];

		$icon = (isset($value['class']) ? $value['class'] : 'fa-solid fa-cube');

		?>
		<?php ob_start() ?>



			<div class="media-preview-actions d-flex justify-content-center align-items-center">
				<input type="hidden" name="<?php echo $name; ?>[class]" id="noahs_page_builder_icon_class" value="<?php echo $icon; ?>" class="form-control"  field-settings>
				<input type="hidden" name="<?php echo $name; ?>[fid]" id="noahs_page_builder_icon_fid" value="<?php echo !empty($value['icon']['fid']) ? $value['icon']['fid'] : null; ?>" class="form-control"  field-settings>
				<input type="hidden" name="<?php echo $name; ?>[url]" id="noahs_page_builder_icon_url" value="<?php echo !empty($value['icon']['url']) ? $value['icon']['url'] : null; ?>" class="form-control"  field-settings>

				<span class="icon-empty <?php echo $icon; ?>"></span>
				<div class="btn-group position-absolute d-flex justify-content-between w-100">
					<button id="noahs_page_builder_icon_data" class="btn btn-primary media-select-icon" title="<?php t('Add/change Icon'); ?>" data-element-id="noahs_page_builder_icon_data"><i class="fa-solid fa-circle-plus"></i></button>
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