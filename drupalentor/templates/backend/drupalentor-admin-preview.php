<div class="drupalentor-builder-wrapper">
	<div id="drupalentor-builder"  data-did="<?php echo $nid; ?>" data-langcode="<?php echo $langcode; ?>">
    	<div class="builder-wrapper">
			<?php 
                echo drupalentor_html_generated($sections);
			?>
		</div>
		<div class="add-section">
			<div class="add-section_wrapper">
				<button class="btn btn-blue">Add section</button>
			</div>
		</div>
	</div>
</div>
