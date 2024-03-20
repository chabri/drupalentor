<?php 

namespace Drupal\noahs_page_builder;

use Drupal\noahs_page_builder\Controls_Base;
use Drupal\file\Entity\File;
use Drupal\image\Entity\ImageStyle;

class Control_Noahs_Gallery extends Controls_Base{
	
	public function get_type() {
		return 'noahs_gallery';
	}

	public function content_template($data, $name, $value) {

		$items = $value ? $value : [];
		$data_field = [];

		?>
		<?php ob_start() ?>

	
		<div class="noahs_page_builder_gallery_field">
			<div id="<?php echo $data['item_id']; ?>">
				<div class="gallery-images-wrapper p-3 mb-3 bg-light rounded-3 row position-relative" id="gallery-images-wrapper">
				<?php foreach(array_values($items) as $i => $item){

					$image = '';
					if(isset($item['fid'])){
						$file = File::load($item['fid']);
						$file_uri = $file->getFileUri();
						
						$image = ImageStyle::load('thumbnail')->buildUrl($file_uri);
					}

					?>
					<div class="col-3 image-box mb-2 position-relative" data-delta="<?php echo $i; ?>">
						<div class="noahs_gallery_field_actions">
							<div class="noahs_page_builder-edit-grid-item btn btn-sm btn-info position-absolute top-50 start-50 translate-middle rounded-circle" data-show-click="#edit-gallery-image-<?php echo $i; ?>"><i class="fa-solid fa-pen-to-square"></i></div>
							<div class="noahs_page_builder-move-grid-item btn btn-sm btn-info position-absolute top-0 start-0 rounded-circle"><i class="fa-solid fa-arrows-up-down-left-right"></i></div>
							<div class="noahs_page_builder-remove-grid-item btn btn-sm btn-danger position-absolute bottom-0 end-0 rounded-circle"><i class="fa-solid fa-trash"></i></div>
						</div>
						<img src="<?php echo $image; ?>" style="width:100%; height:auto;">
						<div id="edit-gallery-image-<?php echo $i; ?>" class="noahs_page_builder-hover-modal bg-light p-3 position-absolute top-100 start-50 translate-middle-x shadow-lg hidden">
							<div class="btn btn-sm btn-danger position-absolute top-0 start-50 translate-middle rounded-circle" data-show-click="#edit-gallery-image-<?php echo $i; ?>"><i class="fa-regular fa-circle-xmark"></i></div>
							<input class="form-control mb-3" type="hidden" name="element[gallery_items][<?php echo $i; ?>][fid]" value="<?php echo $item['fid'] ?? null; ?>">
							<input class="form-control" type="text" name="element[gallery_items][<?php echo $i; ?>][url]" value="<?php echo $item['url'] ?? null; ?>">
						</div>
					</div>
				<?php } ?>
				</div>
			</div>

		</div>
	 <?php return ob_get_clean();

	}
	protected function get_default_settings() {
		return [
			'input_type' => 'noahs_gallery',
			'placeholder' => '',
			'title' => '',
		];
	}
}