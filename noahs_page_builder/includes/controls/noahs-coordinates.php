<?php 
namespace Drupal\noahs_page_builder;
use Drupal\noahs_page_builder\Controls_Base;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\noahs_page_builder\ModalForm;

class Control_Noahs_Coordinates extends Controls_Base {
	private function register_autoloader() {
		require_once NOAHS_PAGE_BUILDER_PATH . '/includes/autoloader.php';
		Autoloader::run();
	  }
	
	  public function __construct() {
		$this->register_autoloader();
	  }
	
	public function get_type() {
		return 'noahs_coordinates';
	}

	public function content_template($data, $name, $value) {

			$fields = $data['item']['fields'];

		?>


		<?php ob_start() ?>



		<div class="fs-6 fst-italic">Use your property as px, em, rem, %, ...</div>
			<ul class="field-element-list-horizontal">
				<?php foreach($fields as $key => $field){ 
					$final_value = $value[$key] ?? null;
					?>
					<li>
						<input type="text" name="<?php echo $name; ?>[<?php echo $key; ?>]" value="<?php echo $final_value; ?>" class="form-control" field-settings>
						<label for="noahs_page_builder_coordinate_left"><?php echo $field['title'] ?? $key; ?></label>
					</li>
				<?php } ?>
				
			</ul>
	

	 <?php return ob_get_clean();

	}

	protected function get_default_settings() {
		return [
			'input_type' => 'noahs_coordinates',
			'title' => '',
		];
	}
}

