<?php 
namespace Drupal\drupalentor;
use Drupal\drupalentor\Controls_Base;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class Control_Drupalentor_Multiple_Fields extends Controls_Base {

	public function get_type() {
		return 'drupalentor_multiple_fields';
	}

	public function content_template($data, $name, $value) {
		$fields = $data['item']['fields'];
		$items = $value ? $value : [];
		$data_field = [];
		$html = '
			<div class="accordion-item">
			<h2 class="accordion-header" id="header_replace">
				<div class="accordion-actions">
					<button class="btn btn-light drupalentor-remove-item area_tooltip" title="Remove"><i class="fa-regular fa-trash-can"></i></button>
					<button class="btn btn-light drupalentor-duplicate-item area_tooltip" title="Clone"><i class="fa-regular fa-copy"></i></i></button>
				</div>
				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#colapse_replace" aria-expanded="true" aria-controls="colapse_replace">
					Accordion Item #1
				</button>
			</h2>
			<div id="colapse_replace" class="accordion-collapse collapse" aria-labelledby="header_replace" data-bs-parent="#'.$data['item_id'] .'">
				<div class="accordion-body">';
				
					foreach ($fields as $key => $field) {
						$data_field['item'] = $field;
						$data_field['item_id'] = $data['item_id'] . '_' . $key;
						$name = 'element[' . $data['item_id'] . '][replace_it][' . $key . ']';

						$field_value = '';
					
						$class_name = $this->getControlClassName($field['type']);
						$control = new $class_name();
						$content = $control->content_template($data_field, $name, $field_value);
						$html .= $content;
					}
					
					$html .= '
				</div>
			</div>
		</div>';
		$addItemHtml = htmlspecialchars($html, ENT_QUOTES, 'UTF-8');
		?>
		<?php ob_start() ?>

	
		<div class="drupalentor_multiple_field">
			<div class="accordion" id="<?php echo $data['item_id']; ?>">
				<?php foreach(array_values($items) as $i => $item){ 

					?>
					<div class="accordion-item">
						<h2 class="accordion-header" id="header_<?php echo $i; ?>">
						<div class="accordion-actions">
							<button class="btn btn-light drupalentor-remove-item area_tooltip" title="Remove"><i class="fa-regular fa-trash-can"></i></button>
							<button class="btn btn-light drupalentor-duplicate-item area_tooltip" title="Clone"><i class="fa-regular fa-copy"></i></i></button>
						</div>
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#slideshow_<?php echo $i; ?>" aria-expanded="false" aria-controls="slideshow_<?php echo $i; ?>">
							Slideshow Item #<?php echo $i; ?>
						</button>
						</h2>
						<div id="slideshow_<?php echo $i; ?>" class="accordion-collapse collapse" aria-labelledby="header_<?php echo $i; ?>" data-bs-parent="#<?php echo $data['item_id']; ?>">
							<div class="accordion-body">
							<?php foreach($fields as $key => $field){
								$data_field['item'] = $field;
								$data_field['item_id'] = $data['item_id'] . '_' . $key;
								$name = 'element[' . $data['item_id'] . '][0][' . $key . ']';

								$field_value = $item[$key];
							
								$class_name = $this->getControlClassName($field['type']);
								$control = new $class_name();
								$content = $control->content_template($data_field, $name, $field_value);
								echo $content; 
								}
							?>
						</div>
						</div>
					</div>
				<?php } ?>
			</div>
			<button class="btn btn-secondary btn-labeled drupalentor-add-item mt-3" data-html="<?php echo $addItemHtml; ?>"><span class="btn-label"><i class="fa-solid fa-circle-plus"></i></span>Add new Item</button>

		</div>



	 <?php return ob_get_clean();

	}

	protected function get_default_settings() {
		return [
			'input_type' => 'drupalentor_multiple_fields',
			'title' => '',
		];
	}
}

