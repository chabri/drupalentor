<div class="noahs_page_builder-wrapper">
	<div id="noahs_page_builder"  data-did="<?php echo $nid ?? null; ?>" data-langcode="<?php echo $langcode; ?>">
    	<div class="builder-wrapper">
			<?php 
                echo noahs_page_builder_html_generated($sections);
			?>
		</div>
		<div class="add-section">
			<div class="add-section_wrapper">
				<button class="btn btn-blue">Add section</button>
			</div>
		</div>
	</div>
</div>
