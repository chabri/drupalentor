<?php
    use Drupal\image\Entity\ImageStyle;
    $image_styles = \Drupal::entityQuery('image_style')->execute();
    $module_url = '/'.drupal_get_path('module', 'drupalentor');
    $assets_url = $module_url.'/assets/';
	$widgets = $el_fields;
?>

<div id="vvveb-builder">
				<div id="top-panel">
					<img src="<?php echo $assets_url; ?>img/logo.png" alt="Vvveb" class="float-start" id="logo" width="100">
										
					
	
								
					<div class="btn-group me-3 float-end" role="group">
	
					  <button class="btn btn-primary btn-icon" title="Export (Ctrl + E)" id="save-btn">
						  <i class="la la-save"></i> <span data-v-gettext>Save page</span>
					  </button>
					</div>	
	

					<div class="btn-group float-end me-3 responsive-btns" role="group">
		 			 <button id="mobile-view" data-view="mobile" class="btn btn-light"  title="Mobile view" data-vvveb-action="viewport">
						  <i class="la la-mobile"></i>
					  </button>

					  <button id="tablet-view"  data-view="tablet" class="btn btn-light"  title="Tablet view" data-vvveb-action="viewport">
						  <i class="la la-tablet"></i>
					  </button>
					  
					  <button id="desktop-view"  data-view="" class="btn btn-light"  title="Desktop view" data-vvveb-action="viewport">
						  <i class="la la-laptop"></i>
					  </button>
					  <div class="btn-group me-3 float-end" role="group">
	
	<a class="btn btn-light" title="View"  type="button" target="_blank" href="<?php echo $nodeUrl; ?>">
		  <i class="la la-eye"></i>
	  </a>
	</div>	
					</div>
										
				</div>	
				
				<div id="left-panel">

					  
					 <div class="drag-elements">
						
						<div class="header">
							<ul class="nav nav-tabs  nav-fill" id="elements-tabs" role="tablist">
							  <li class="nav-item sections-tab">
								<a class="nav-link active" id="sections-tab" data-bs-toggle="tab" href="#sections-list" role="tab" aria-controls="sections" aria-selected="true" title="Sections">
									<i class="la la-stream"></i>
									<!-- img src="../../../js/vvvebjs/icons/list_group.svg" height="23" --> 
									<!-- div><small>Sections</small></div -->
								</a>
							  </li>
							  <li class="nav-item component-tab">
								<a class="nav-link" id="components-tab" data-bs-toggle="tab" href="#components-tabs" role="tab" aria-controls="components" aria-selected="false" title="Components">
									<i class="la la-box"></i>
									<!-- img src="../../../js/vvvebjs/icons/product.svg" height="23" --> 
									<!-- div><small>Components</small></div -->
								</a>
							  </li>
							  <!-- li class="nav-item sections-tab">
								<a class="nav-link" id="sections-tab" data-bs-toggle="tab" href="#sections" role="tab" aria-controls="sections" aria-selected="false" title="Sections"><img src="../../../js/vvvebjs/icons/list_group.svg" width="24" height="23"> <div><small>Sections</small></div></a>
							  </li -->
							  <li class="nav-item component-properties-tab" style="display:none">
								<a class="nav-link" id="properties-tab" data-bs-toggle="tab" href="#properties" role="tab" aria-controls="properties" aria-selected="false" title="Properties">
									<i class="la la-cog"></i>
									<!-- img src="../../../js/vvvebjs/icons/filters.svg" height="23"--> 
									<!-- div><small>Properties</small></div -->
								</a>
							  </li>
							  <li class="nav-item component-configuration-tab">
								<a class="nav-link" id="configuration-tab" data-bs-toggle="tab" href="#configuration" role="tab" aria-controls="configuration" aria-selected="false" title="Configuration">
									<i class="la la-tools"></i>
									<!-- img src="../../../js/vvvebjs/icons/filters.svg" height="23"--> 
									<!-- div><small>Properties</small></div -->
								</a>
							  </li>
							</ul>
					
							<div class="tab-content">
							  
							  
							  <div class="tab-pane   active sections" id="sections-list" role="tabpanel" aria-labelledby="sections-tab">
			
								
										<div class="tab-content">
											
			
										<div class="search">
															  <input class="form-control form-control-sm block-search" placeholder="Search sections" type="text" data-vvveb-action="sectionSearch" data-vvveb-on="keyup">
															 <!--<button class="clear-backspace"  data-vvveb-action="clearSectionSearch">
																  <i class="la la-times"></i>
															  </button> -->
														</div>

											  
														<div class="drag-elements-sidepane sidepane">
															  <div class="block-preview"><img src=""></div>
															  <div>
																<ul class="sections-list clearfix" data-type="leftpanel">
																		<?php foreach($sections as $i => $section): ?>
																			<li>
																				<a class="section-name use-ajax" data-dialog-type=“modal href="/modal-form/<?php echo  $id .'/' .$section['element'] . '/' . $section['id'] ?? ''; ?>" data-widgetType="<?php echo $section['element']; ?>"><?php echo $i + 1; ?> <?php echo $section['row_name'] ?? ''; ?></a>
																				<a class="add-section-btn" title="add section"><i class="la la-plus"></i></a>
																			</li>
																		<?php endforeach; ?>
																</ul>
															  </div>
														</div>
											
										</div>
							
							  </div>
							
								<div class="tab-pane  " id="components-tabs" role="tabpanel" aria-labelledby="components-tab">
								  
								  
				
								
										<div class="tab-content">
		
												 
												   <div class="search">
														  <input class="form-control form-control-sm component-search" placeholder="Search components" type="text" data-vvveb-action="componentSearch" data-vvveb-on="keyup">
														  <button class="clear-backspace"  data-vvveb-action="clearComponentSearch">
															  <i class="la la-times"></i>
															</button>
													</div>


													<ul class="sections-list clearfix" data-type="leftpanel">
															<?php foreach($widgets as $widget): ?>
																<li>
																	<a class="name" href="#"><?php echo (string) $widget['title']; ?></a>
																	<a class="add-section-btn" title="add section"><i class="la la-plus"></i></a>
																</li>
															<?php endforeach; ?>
													</ul>




											
										</div>
							</div>

								<div class="tab-pane " id="properties" role="tabpanel" aria-labelledby="properties-tab">
									<div class="component-properties-sidepane">
										<div>
											<div class="component-properties">
												<ul class="nav nav-tabs nav-fill" id="properties-tabs" role="tablist">
													  <li class="nav-item content-tab">
														<a class="nav-link active" data-bs-toggle="tab" href="#content-left-panel-tab" role="tab" aria-controls="components" aria-selected="true">
															<i class="la la-lg la-sliders-h"></i> <div><span>Content</span></div></a>
													  </li>
													  <li class="nav-item style-tab">
														<a class="nav-link" data-bs-toggle="tab" href="#style-left-panel-tab" role="tab" aria-controls="style" aria-selected="false">
															<i class="la la-lg la-paint-brush"></i> <div><span>Style</span></div></a>
													  </li>
													  <li class="nav-item advanced-tab">
														<a class="nav-link" data-bs-toggle="tab" href="#advanced-left-panel-tab" role="tab" aria-controls="advanced" aria-selected="false">
															<i class="la la-lg la-tools"></i> <div><span>Advanced</span></div></a>
													  </li>
													</ul>
											
													<div class="tab-content">
														 <div class="tab-pane   active" id="content-left-panel-tab" data-section="content" role="tabpanel" aria-labelledby="content-tab">
															<div class="alert alert-dismissible   alert-light m-3" role="alert" style="">		  
																<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>		  
																<strong>No selected element!</strong><br> Click on an element to edit.		
															</div>
														</div>
														
														 <div class="tab-pane  " id="style-left-panel-tab" data-section="style" role="tabpanel" aria-labelledby="style-tab">
														</div>
														
														 <div class="tab-pane  " id="advanced-left-panel-tab" data-section="advanced"  role="tabpanel" aria-labelledby="advanced-tab">
															<div class="alert alert-dismissible   alert-info m-3" role="alert" style="">		  
																<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>		  
																<strong>No advanced properties!</strong><br> This component does not have advanced properties.		
															</div>
														</div>
													</div>
											</div>
										</div>
									</div>
							  </div>
							
								<div class="tab-pane " id="configuration" role="tabpanel" aria-labelledby="configuration-tab">
									
									<!-- color palette -->
									<label class="header" data-header="default" for="header_pallette"><span>Color palette</span>
										<div class="header-arrow"></div>
									</label>
									<input class="header_check" type="checkbox" checked="true" id="header_pallette">
									<div class="section" data-section="default">

										
									</div>
										
										
									<!-- typography -->	
									<label class="header" data-header="element_header" for="header_element_typography"><span>Typography</span>
										<div class="header-arrow"></div>
									</label>
									
									<input class="header_check" type="checkbox" checked="true" id="header_element_typography">
									<div class="section" data-section="element_header">
										
										
									</div>
									
								
								</div><!-- end configuration tab -->
							
							</div>
						</div>							
					
					  </div>
				</div>	


				<div id="canvas">
					<div id="iframe-wrapper">
						<div id="iframe-layer">
							<?php echo drupalentor_frontend($data->html); ?>
						</div>		
					</div>
				</div>

				<div id="right-panel">
					<div class="component-properties">
						
						<ul class="nav nav-tabs nav-fill" id="properties-tabs" role="tablist">
							  <li class="nav-item content-tab">
								<a class="nav-link active" data-bs-toggle="tab" href="#content-tab" role="tab" aria-controls="components" aria-selected="true">
									<i class="la la-lg la-sliders-h"></i> <div><span>Content</span></div></a>
							  </li>
							  <li class="nav-item style-tab">
								<a class="nav-link" data-bs-toggle="tab" href="#style-tab" role="tab" aria-controls="blocks" aria-selected="false">
									<i class="la la-lg la-paint-brush"></i> <div><span>Style</span></div></a>
							  </li>
							  <li class="nav-item advanced-tab">
								<a class="nav-link" data-bs-toggle="tab" href="#advanced-tab" role="tab" aria-controls="blocks" aria-selected="false">
									<i class="la la-lg la-tools"></i> <div><span>Advanced</span></div></a>
							  </li>
							</ul>
					
							<div class="tab-content">
								 <div class="tab-pane   active" id="content-tab" data-section="content" role="tabpanel" aria-labelledby="content-tab">
									<div class="alert alert-dismissible   alert-light m-3" role="alert" style="">		  
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>		  
										<strong>No selected element!</strong><br> Click on an element to edit.		
									</div>
								</div>
								
								 <div class="tab-pane  " id="style-tab" data-section="style" role="tabpanel" aria-labelledby="style-tab">
								</div>
								
								 <div class="tab-pane  " id="advanced-tab" data-section="advanced"  role="tabpanel" aria-labelledby="advanced-tab">
										<div class="alert alert-dismissible   alert-info m-3" role="alert" style="">		  
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>		  
											<strong>No advanced properties!</strong><br> This component does not have advanced properties.		
										</div>
								</div>
								
								
							</div>
							
							
							
					</div>
				</div>
			
			</div>
		</div>




<!-- message modal-->
<!-- export html modal-->

<div class="modal " id="textarea-modal" tabindex="-1" role="dialog" aria-labelledby="textarea-modal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title text-primary"><i class="la la-lg la-save"></i> Export html</p>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <!-- span aria-hidden="true"><small><i class="la la-times"></i></small></span -->
        </button>
      </div>
      <div class="modal-body">
        
        <textarea rows="25" cols="150" class="form-control"></textarea>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal"><i class="la la-times"></i> Close</button>
      </div>
    </div>
  </div>
</div>

<!-- message modal-->
<div class="modal " id="message-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title text-primary"><i class="la la-lg la-comment"></i> Drupalentor</p>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <!-- span aria-hidden="true"><small><i class="la la-times"></i></small></span -->
        </button>
      </div>
      <div class="modal-body">
        <p>Page was successfully saved!.</p>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-primary">Ok</button> -->
        <button type="button" class="btn btn-secondary btn-lg" data-bs-dismiss="modal"><i class="la la-times"></i> Close</button>
      </div>
    </div>
  </div>
</div>

</div>