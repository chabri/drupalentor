<?php
	use Drupal\drupalentor\RenderForm;

    use Drupal\image\Entity\ImageStyle;
    $image_styles = \Drupal::entityQuery('image_style')->execute();
    $module_url = '/'.drupal_get_path('module', 'drupalentor');
    $assets_url = $module_url.'/assets/';

	$path = "";
	
	function walk($section, $widgetId, $skey) {

		$settings = $section['settings'];
		$widgetType = $section['element_name'];
		$columns = $section['columns'];
		$fields = drupalentor_get_el_fields($widgetId)['fields'];

		?>
		
				<legend><?php echo $settings['row_name'] ? $settings['row_name'] : 'Row'; ?> - Section</legend>
				<div class="settings">
					<?php echo RenderForm::render_form($fields, $section, 'section['.$skey.']', $skey); ?>
					<input type="hidden" name="section[<?php echo $skey; ?>][row_name]" value="<?php echo $section['row_name']; ?>">
					<input type="hidden" name="section[<?php echo $skey; ?>][element_name]" value="<?php echo $section['element_name']; ?>">
					<input type="hidden" name="section[<?php echo $skey; ?>][editing]" value="false">
				</div>
				<div class="content">
					<?php if (!empty($columns)){ foreach($columns as $ckey => $column){ 
						$settings = $column['settings'];
						$elements = $column['elements'];
						?>
						<input type="hidden" name="section[<?php echo $skey; ?>][columns][<?php echo $ckey; ?>][col_lg]" value="<?php echo $column['col_lg']; ?>">
						<input type="hidden" name="section[<?php echo $skey; ?>][columns][<?php echo $ckey; ?>][editing]" value="<?php echo $column['editing']; ?>">
						<input type="hidden" name="section[<?php echo $skey; ?>][columns][<?php echo $ckey; ?>][element_name]" value="<?php echo $column['element_name']; ?>">
						<fieldset data-key="<?php echo $ckey; ?>">
							<legend>Column <?php echo $column['col_lg']; ?></legend>
								<div class="settings">
							
									<?php echo RenderForm::render_form($fields, $column, 'section['.$skey.'][columns]['.$ckey.']', $ckey); ?>
								</div>
								<?php if (!empty($elements)){ foreach($elements as $ekey => $element){ 
									$settings = $element['settings'];
									?>
									<fieldset data-key="<?php echo $ckey.$ekey; ?>">
									<input type="hidden" name="section[<?php echo $skey; ?>][columns][<?php echo $ckey; ?>][elements][<?php echo $ekey; ?>][element_name]" value="<?php echo $element['element_name']; ?>">
									<input type="hidden" name="section[<?php echo $skey; ?>][columns][<?php echo $ckey; ?>][elements][<?php echo $ekey; ?>][editing]" value="false">
										<legend>Widget <?php echo $element['settings']['title']; ?></legend>
										<div class="settings">

											<?php echo RenderForm::render_form($fields, $element, 'section['.$skey.'][columns]['.$ckey.'][elements]['.$ekey.']', $ekey); ?>
											<?php if(!empty($element['row'])){

												walk($element['row'], $element['row']['element_name'], $ekey);
												}
											?>
										</div>	
									</fieldset>
								<?php }} ?>
						</fieldset>
					<?php }} ?>
				</div>
		<?php
	}
?>

	<div id="drupalentor-builder">
		<form id="myform">
			<?php 
				foreach($sections as $key => $section){ 
					$widgetId = $section['element_name'];
					?>
					<fieldset data-key="<?php echo $key; ?>">
						<?php walk($section, $widgetId, $key); ?>			
					</fieldset>
					<?php
				}
			?>

			<button type="submit">Guardar</button>
		</form>
	</div>
	<div class="widgets-modal">
		<ul>
		<?php foreach($widgets as $widget){ ?>
			<li><?php echo (string) $widget['title']; ?></li>
		<?php } ?>
		</ul>
	</div>
	<?php echo drupalentor_frontend($data->html); ?>