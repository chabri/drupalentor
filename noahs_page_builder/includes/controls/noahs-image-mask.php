<?php 

namespace Drupal\noahs_page_builder;

use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;
use \Drupal\noahs_page_builder_pro\Controller\NoahsMaskImageProController;

class Control_Noahs_Image_Mask{
	
	public function get_type() {
		return 'noahs_image_mask';
	}

	public function content_template($data, $name, $value) {

		$id = $data['wid'];


		$items = NoahsMaskImageProController::list($name);

		$options = array(
			'' => 'Auto',
			'cover' => 'Cover',
			'contain' => 'Contain',
			'initial' => 'Custom',
		);
		?>
		<?php ob_start() ?>

		

		<div class="media-preview-actions media-preview-actions--mask overflow-auto mb-3" style="height:200px">
			<div class="row gap-3">
				<?php foreach($items as $k => $item){ 
					$checked = ($item === $value['mask']) ? 'checked' : '';
				?>
					<div class="col-2 d-flex align-items-center">
						<label for="mask-<?php echo $k; ?>">
							<input type="radio" id="mask-<?php echo $k; ?>" name="<?php echo $name; ?>[mask]" value="<?php echo $item; ?>" <?php echo $checked; ?> field-setting>
							<img src="<?php echo $item; ?>" alt="SVG Image" class="w-100">
						</label>
					</div>
				<?php }?>
			</div>
		</div>
		<div class="mb-3">
			<label class="form-label">Mask Size (usep px, %, rem, wv...)</label>
			<select name="<?php echo $name; ?>[mask_size]"  class="form-control" field-setting>
				<?php foreach ($options as $key => $label) { ?>
					<option value="<?php echo $key; ?>" <?php echo ($value === $selectedValue) ? 'selected' : ''; ?>>
            			<?php echo $label; ?>
        			</option>				
				<?php } ?>
			</select>
		</div>

		<?php return ob_get_clean();
	}

	protected function get_default_settings() {
		return [
			'input_type' => 'noahs_image_mask',
			'placeholder' => '',
			'title' => '',
		];
	}
}