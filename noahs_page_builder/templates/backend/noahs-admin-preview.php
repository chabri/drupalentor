<div class="noahs_page_builder-wrapper">
	<div id="noahs_page_builder"  data-did="<?php echo $nid ?? null; ?>" data-langcode="<?php echo $langcode; ?>">
    	<div class="builder-wrapper">
			<?php 
                echo noahs_page_builder_html_generated($sections);
			?>
		</div>
		<div class="add-section">
			<div class="add-section_wrapper btn-group">
				<div class="btn-group">
					<button class="btn btn-blue noahs_add_section btn-admin"><i class="fa-solid fa-circle-plus"></i> Add section</button>
					<button class="btn noahs_paste_in_page btn-admin"><i class="fa-solid fa-paste"></i> Paste Section</button>
					<button class="btn noahs_open_widget_gallery btn-admin"><i class="fa-solid fa-folder-plus"></i> Widgets Gallery</button>
				</div>
			</div>
		</div>
	</div>
</div>
