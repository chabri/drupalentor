<?php 
namespace Drupal\noahs_page_builder;
use Drupal\noahs_page_builder\Controls_Base;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Drupal\noahs_page_builder\ModalForm;

class Control_Noahs_Multiple_Elements extends Controls_Base {
	private function register_autoloader() {
		require_once NOAHS_PAGE_BUILDER_PATH . '/includes/autoloader.php';
		Autoloader::run();
	  }
	
	  public function __construct() {
		$this->register_autoloader();
	  }
	
	public function get_type() {
		return 'noahs_multiple_elements';
	}

	public function content_template($data, $name, $values) {

		$fields = $data['item']['fields'];
		$subfields = $fields[$data['item_id']];
		$values = ($values) ? $values : array();
		$parent = $data['item_id'];
	

		$html = '
			<div class="accordion-item">
			<h2 class="accordion-header" id="header_replace">
				<div class="accordion-actions">
					<button class="btn btn-light noahs_page_builder-remove-item area_tooltip" title="Remove"><i class="fa-regular fa-trash-can"></i></button>
					<button class="btn btn-light noahs_page_builder-duplicate-item area_tooltip" title="Clone"><i class="fa-regular fa-copy"></i></i></button>
				</div>
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#colapse_replace" aria-expanded="true" aria-controls="colapse_replace">
					Accordion Item #1
				</button>
			</h2>
			<div id="colapse_replace" class="accordion-collapse collapse" aria-labelledby="header_replace" data-bs-parent="#'.$data['item_id'] .'">
				<div class="accordion-body">';

					$default_form = ModalForm::renderSubFields($fields, null, 'replace_it', $parent);
					$html .= $default_form;
					$html .= '
				</div>
			</div>
		</div>';
		$addItemHtml = htmlspecialchars($html, ENT_QUOTES, 'UTF-8');
	
	
		?>


		<?php ob_start() ?>


		<div class="noahs_page_builder_multiple_elements">
			<div class="accordion" id="<?php echo $data['item_id']; ?>">
				<?php foreach(array_values($values) as $i => $value){ 

					$newvalue['element'] = $value;


					$form = ModalForm::renderSubFields($fields, $newvalue, $i, $parent);

					?>
					<div class="accordion-item">
						<h2 class="accordion-header" id="header_<?php echo $i; ?>">
						<div class="accordion-actions btn-group">
							<button class="btn btn-light noahs_page_builder-remove-item area_tooltip" title="Remove"><i class="fa-regular fa-trash-can"></i></button>
							<button class="btn btn-light noahs_page_builder-duplicate-item area_tooltip" title="Clone"><i class="fa-regular fa-copy"></i></button>
							<button class="btn btn-light noahs_page_builder-move-item area_tooltip" title="Clone"><i class="fa-solid fa-up-down-left-right"></i></button>
						</div>
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#slideshow_<?php echo $i; ?>" aria-expanded="false" aria-controls="slideshow_<?php echo $i; ?>">
							Slideshow Item #<?php echo $i; ?>
						</button>
						</h2>
						<div id="slideshow_<?php echo $i; ?>" class="accordion-collapse collapse" aria-labelledby="header_<?php echo $i; ?>" data-bs-parent="#<?php echo $data['item_id']; ?>">
							<div class="accordion-body">
							<?php 
							echo $form;
							?>
						</div>
						</div>
					</div>
				<?php } ?>
			</div>
			<button class="btn btn-secondary btn-labeled noahs_page_builder-add-item mt-3" data-html="<?php echo $addItemHtml; ?>"><span class="btn-label"><i class="fa-solid fa-circle-plus"></i></span>Add new Item</button>

		</div>



	 <?php return ob_get_clean();

	}

	protected function get_default_settings() {
		return [
			'input_type' => 'noahs_multiple_elements',
			'title' => '',
		];
	}
}

