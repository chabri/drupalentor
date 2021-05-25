<?php
    use Drupal\image\Entity\ImageStyle;
    $image_styles = \Drupal::entityQuery('image_style')->execute();
    $module_url = '/'.drupal_get_path('module', 'drupalentor');
    $assets_url = $module_url.'/assets/';
?>

<div id="vvveb-builder">
				<div id="top-panel">
					<img src="<?php echo $assets_url; ?>img/logo.png" alt="Vvveb" class="float-start" id="logo" width="100">
					
					<div class="btn-group float-start" role="group">
					  <button class="btn btn-light" title="Toggle file manager" id="toggle-file-manager-btn" data-vvveb-action="toggleFileManager" data-bs-toggle="button" aria-pressed="false">
						  <img src="<?php echo $assets_url; ?>libs/builder/icons/file-manager-layout.svg" width="20px" height="20px">
					  </button>

					  <button class="btn btn-light" title="Toggle left column" id="toggle-left-column-btn" data-vvveb-action="toggleLeftColumn" data-bs-toggle="button" aria-pressed="false">
						  <img src="<?php echo $assets_url; ?>libs/builder/icons/left-column-layout.svg" width="20px" height="20px">
					  </button>
					  
					  <button class="btn btn-light" title="Toggle right column" id="toggle-right-column-btn" data-vvveb-action="toggleRightColumn" data-bs-toggle="button" aria-pressed="false">
						  <img src="<?php echo $assets_url; ?>libs/builder/icons/right-column-layout.svg" width="20px" height="20px">
					  </button>
					</div>
					
					<div class="btn-group me-3" role="group">
					  <button class="btn btn-light" title="Undo (Ctrl/Cmd + Z)" id="undo-btn" data-vvveb-action="undo" data-vvveb-shortcut="ctrl+z">
						  <i class="la la-undo"></i>
					  </button>

					  <button class="btn btn-light la-flip-horizontal"  title="Redo (Ctrl/Cmd + Shift + Z)" id="redo-btn" data-vvveb-action="redo" data-vvveb-shortcut="ctrl+shift+z">
						  <i class="la la-undo"></i>
					  </button>
					</div>
										
					
					<div class="btn-group me-3" role="group">
					  <button class="btn btn-light" title="Designer Mode (Free component dragging)" id="designer-mode-btn" data-bs-toggle="button" aria-pressed="false" data-vvveb-action="setDesignerMode">
						  <i class="la la-hand-rock"></i>
					  </button>

					  <a class="btn btn-light" title="View"  type="button" target="_blank" href="<?php echo $nodeUrl; ?>">
						  <i class="la la-eye"></i>
					  </a>

					  <button class="btn btn-light" title="Fullscreen (F11)" id="fullscreen-btn" data-bs-toggle="button" aria-pressed="false" data-vvveb-action="fullscreen">
						  <i class="la la-expand-arrows-alt"></i>
					  </button>

					</div>
					
								
					<div class="btn-group me-3 float-end" role="group">
					  <button class="btn btn-primary btn-icon" title="Export (Ctrl + E)" id="save-btn" data-toggle="modal" data-target="#message-modal">
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

					</div>
										
				</div>	
				
				<div id="left-panel">

					  
					 <div class="drag-elements">
						
						<div class="header">
							<ul class="nav nav-tabs  nav-fill" id="elements-tabs" role="tablist">
							  <li class="nav-item sections-tab">
								<a class="nav-link active" id="sections-tab" data-bs-toggle="tab" href="#sections" role="tab" aria-controls="sections" aria-selected="true" title="Sections">
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
							  
							  
							  <div class="tab-pane fade show active sections" id="sections" role="tabpanel" aria-labelledby="sections-tab">
								  

										<ul class="nav nav-tabs nav-fill sections-tabs" id="properties-tabs" role="tablist">
										  <li class="nav-item content-tab">
											<a class="nav-link active" data-bs-toggle="tab" href="#sections-new-tab" role="tab" aria-controls="components" aria-selected="false">
												<i class="la la-plus"></i> <div><span>Add section</span></div></a>
										  </li>
										  <li class="nav-item style-tab">
											<a class="nav-link" data-bs-toggle="tab" href="#sections-list" role="tab" aria-controls="sections" aria-selected="true">
												<i class="la la-th-list"></i> <div><span>Page Sections</span></div></a>
										  </li>
										</ul>
								
										<div class="tab-content">
		
											 <div class="tab-pane fade" id="sections-list" data-section="style" role="tabpanel" aria-labelledby="style-tab">
												<div class="drag-elements-sidepane sidepane">
												  <div>
													<div class="sections-container">
																													  
															<div class="section-item" draggable="true">
																<div class="controls">
																	<div class="handle"></div>
																	<div class="info">
																		<div class="name">&nbsp;
																			<div class="type">&nbsp;</div>
																		</div>
																	</div>
																</div>
															</div> 
															<div class="section-item" draggable="true">
																<div class="controls">
																	<div class="handle"></div>
																	<div class="info">
																		<div class="name">&nbsp;
																			<div class="type">&nbsp;</div>
																		</div>
																	</div>
																</div>
															</div> 
															<div class="section-item" draggable="true">
																<div class="controls">
																	<div class="handle"></div>
																	<div class="info">
																		<div class="name">&nbsp;
																			<div class="type">&nbsp;</div>
																		</div>
																	</div>
																</div>
															</div> 
															<!-- div class="section-item" draggable="true">
																<div class="controls">
																	<div class="handle"></div>
																	<div class="info">
																		<div class="name">welcome area
																			<div class="type">section</div>
																		</div>
																	</div>
																	<div class="buttons"> <a class="delete-btn" href="" title="Remove section"><i class="la la-trash text-danger"></i></a>
																		
																		<a class="properties-btn" href="" title="Properties"><i class="la la-cog"></i></a> </div>
																</div>
																<input class="header_check" type="checkbox" id="section-components-9338">
																<label for="section-components-9338">
																	<div class="header-arrow"></div>
																</label>
																<div class="tree">
																	<ol></ol>
																</div>
															</div --> 
																											
															
													  </div>
													</div>
												</div>
											</div>
											
											<div class="tab-pane fade show active" id="sections-new-tab" data-section="content" role="tabpanel" aria-labelledby="content-tab">


													   <div class="search">
															  <input class="form-control form-control-sm block-search" placeholder="Search sections" type="text" data-vvveb-action="sectionSearch" data-vvveb-on="keyup">
															  <button class="clear-backspace"  data-vvveb-action="clearSectionSearch">
																  <i class="la la-times"></i>
															  </button>
														</div>

											  
														<div class="drag-elements-sidepane sidepane">
															  <div class="block-preview"><img src=""></div>
															  <div>
																<ul class="sections-list clearfix" data-type="leftpanel">
																</ul>

															  </div>
														</div>

											</div>
											
										</div>
							
							  </div>
							
								<div class="tab-pane fade show" id="components-tabs" role="tabpanel" aria-labelledby="components-tab">
								  
								  
										<ul class="nav nav-tabs nav-fill sections-tabs" role="tablist">
										  <li class="nav-item components-tab">
											<a class="nav-link active" data-bs-toggle="tab" href="#components" role="tab" aria-controls="components" aria-selected="true">
												<i class="la la-box"></i> <div><span>Components</span></div></a>
										  </li>
										  <li class="nav-item blocks-tab">
											<a class="nav-link" data-bs-toggle="tab" href="#blocks" role="tab" aria-controls="components" aria-selected="false">
												<i class="la la-copy"></i> <div><span>Blocks</span></div></a>
										  </li>
										</ul>
								
										<div class="tab-content">
		
											 <div class="tab-pane fade show active components" id="components" data-section="components" role="tabpanel" aria-labelledby="components-tab">
												 
												   <div class="search">
														  <input class="form-control form-control-sm component-search" placeholder="Search components" type="text" data-vvveb-action="componentSearch" data-vvveb-on="keyup">
														  <button class="clear-backspace"  data-vvveb-action="clearComponentSearch">
															  <i class="la la-times"></i>
															</button>
													</div>

													<div class="drag-elements-sidepane sidepane">	
														 <div>
														  
														<ul class="components-list clearfix" data-type="leftpanel">
														</ul>

													</div>											 
												</div>
											</div>

											
											
											<div class="tab-pane fade show active blocks" id="blocks" data-section="content" role="tabpanel" aria-labelledby="content-tab">

													   <div class="search">
															  <input class="form-control form-control-sm block-search" placeholder="Search blocks" type="text" data-vvveb-action="blockSearch" data-vvveb-on="keyup">
															  <button class="clear-backspace"  data-vvveb-action="clearBlockSearch">
																  <i class="la la-times"></i>
															  </button>
														</div>

											  
														<div class="drag-elements-sidepane sidepane">
															  <div class="block-preview"><img src=""></div>
															  <div>
																<ul class="blocks-list clearfix" data-type="leftpanel">
																</ul>

															  </div>
														</div>
											</div>
											
										</div>
							</div>

								<div class="tab-pane fade" id="properties" role="tabpanel" aria-labelledby="properties-tab">
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
														 <div class="tab-pane fade show active" id="content-left-panel-tab" data-section="content" role="tabpanel" aria-labelledby="content-tab">
															<div class="alert alert-dismissible fade show alert-light m-3" role="alert" style="">		  
																<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>		  
																<strong>No selected element!</strong><br> Click on an element to edit.		
															</div>
														</div>
														
														 <div class="tab-pane fade show" id="style-left-panel-tab" data-section="style" role="tabpanel" aria-labelledby="style-tab">
														</div>
														
														 <div class="tab-pane fade show" id="advanced-left-panel-tab" data-section="advanced"  role="tabpanel" aria-labelledby="advanced-tab">
															<div class="alert alert-dismissible fade show alert-info m-3" role="alert" style="">		  
																<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>		  
																<strong>No advanced properties!</strong><br> This component does not have advanced properties.		
															</div>
														</div>
													</div>
											</div>
										</div>
									</div>
							  </div>
							
								<div class="tab-pane fade" id="configuration" role="tabpanel" aria-labelledby="configuration-tab">
									
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
							
							<div class="loading-message active">
									<div class="animation-container">
									  <div class="dot dot-1"></div>
									  <div class="dot dot-2"></div>
									  <div class="dot dot-3"></div>
									</div>

									<svg xmlns="http://www.w3.org/2000/svg" version="1.1">
									  <defs>
										<filter id="goo">
										  <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
										  <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 21 -7"/>
										</filter>
									  </defs>
									</svg>
									<!-- https://codepen.io/Izumenko/pen/MpWyXK -->
							</div>
							
							<div id="highlight-box">
								<div id="highlight-name"></div>
								
								<div id="section-actions">
									<a id="add-section-btn" href="" title="Add element"><i class="la la-plus"></i></a>
								</div>
							</div>

							<div id="select-box">

								<div id="wysiwyg-editor">
										<a id="bold-btn" href="" title="Bold"><i class="la la-bold"></i></a>
										<a id="italic-btn" href="" title="Italic"><i class="la la-italic"></i></a>
										<a id="underline-btn" href="" title="Underline"><i class="la la-underline"></i></a>
										<a id="strike-btn" href="" title="Strikeout"><del>S</del></a>
										<a id="link-btn" href="" title="Create link"><i class="la la-link"></i></a>
										
										<div class="dropdown">
										  <a class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="la la-align-left"></i>
										  </a>

											  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
												<a class="dropdown-item" href="#"><i class="la la-lg la-align-left"></i> Align Left</a>
												<a class="dropdown-item" href="#"><i class="la la-lg la-align-center"></i> Align Center</a>
												<a class="dropdown-item" href="#"><i class="la la-lg la-align-right"></i> Align Right</a>
												<a class="dropdown-item" href="#"><i class="la la-lg la-align-justify"></i> Align Justify</a>
											  </div>
										</div>
										
										<input name="color" type="color" pattern="#[a-f0-9]{6}" class="form-control form-control-color">
										
										<select class="form-select">
											<option value="">Default</option>
											<option value="Arial, Helvetica, sans-serif">Arial</option>
											<option value="'Lucida Sans Unicode', 'Lucida Grande', sans-serif">Lucida Grande</option>
											<option value="'Palatino Linotype', 'Book Antiqua', Palatino, serif">Palatino Linotype</option>
											<option value="'Times New Roman', Times, serif">Times New Roman</option>
											<option value="Georgia, serif">Georgia, serif</option>
											<option value="Tahoma, Geneva, sans-serif">Tahoma</option>
											<option value="'Comic Sans MS', cursive, sans-serif">Comic Sans</option>
											<option value="Verdana, Geneva, sans-serif">Verdana</option>
											<option value="Impact, Charcoal, sans-serif">Impact</option>
											<option value="'Arial Black', Gadget, sans-serif">Arial Black</option>
											<option value="'Trebuchet MS', Helvetica, sans-serif">Trebuchet</option>
											<option value="'Courier New', Courier, monospace">Courier New</option>
											<option value="'Brush Script MT', sans-serif">Brush Script</option>
										</select>
								</div>

								<div id="select-actions">
									<a id="drag-btn" href="" title="Drag element"><i class="la la-arrows-alt"></i></a>
									<a id="parent-btn" href="" title="Select parent" class="la-rotate-180"><i class="la la-level-up-alt"></i></a>
									
									<a id="up-btn" href="" title="Move element up"><i class="la la-arrow-up"></i></a>
									<a id="down-btn" href="" title="Move element down"><i class="la la-arrow-down"></i></a>
									<a id="clone-btn" href="" title="Clone element"><i class="la la-copy"></i></a>
									<a id="delete-btn" href="" title="Remove element"><i class="la la-trash"></i></a>
								</div>
							</div>
							
							<!-- add section box -->
							<div id="add-section-box" class="drag-elements">

									<div class="header">							
										<ul class="nav nav-tabs" id="box-elements-tabs" role="tablist">
										  <li class="nav-item component-tab">
											<a class="nav-link active" id="box-components-tab" data-bs-toggle="tab" href="#box-components" role="tab" aria-controls="components" aria-selected="true"><i class="la la-lg la-cube"></i> <div><small>Components</small></div></a>
										  </li>
										  <li class="nav-item sections-tab">
											<a class="nav-link" id="box-sections-tab" data-bs-toggle="tab" href="#box-blocks" role="tab" aria-controls="blocks" aria-selected="false"><i class="la la-lg la-image"></i> <div><small>Blocks</small></div></a>
										  </li>
										  <li class="nav-item component-properties-tab" style="display:none">
											<a class="nav-link" id="box-properties-tab" data-bs-toggle="tab" href="#box-properties" role="tab" aria-controls="properties" aria-selected="false"><i class="la la-lg la-cog"></i> <div><small>Properties</small></div></a>
										  </li>
										</ul>
										
										<div class="section-box-actions">

											<div id="close-section-btn" class="btn btn-light btn-sm bg-white btn-sm float-end"><i class="la la-times"></i></div>
										
											<div class="small mt-1 me-3 float-end">
											
												<div class="d-inline me-2">
												  <input type="radio" id="add-section-insert-mode-after" value="after" checked="checked" name="add-section-insert-mode" class="form-check-input">
												  <label class="form-check-label" for="add-section-insert-mode-after">After</label>
												</div>
												
												<div class="d-inline">
												  <input type="radio" id="add-section-insert-mode-inside" value="inside" name="add-section-insert-mode" class="form-check-input">
												  <label class="form-check-label" for="add-section-insert-mode-inside">Inside</label>
												</div>
										
											</div>
											
										</div>
										
										<div class="tab-content">
										  <div class="tab-pane fade show active" id="box-components" role="tabpanel" aria-labelledby="components-tab">
											  
											   <div class="search">
													  <input class="form-control form-control-sm component-search" placeholder="Search components" type="text" data-vvveb-action="addBoxComponentSearch" data-vvveb-on="keyup">
													  <button class="clear-backspace" data-vvveb-action="clearComponentSearch">
														  <i class="la la-times"></i>
													  </button>
												  </div>

												<div>
												  <div>
													  
													<ul class="components-list clearfix" data-type="addbox">
													</ul>

												  </div>
												</div>
										  
										  </div>
										  <div class="tab-pane fade" id="box-blocks" role="tabpanel" aria-labelledby="blocks-tab">
											  
											   <div class="search">
													  <input class="form-control form-control-sm block-search" placeholder="Search blocks" type="text" data-vvveb-action="addBoxBlockSearch" data-vvveb-on="keyup">
													  <button class="clear-backspace"  data-vvveb-action="clearBlockSearch">
														  <i class="la la-times"></i>
													  </button>
												  </div>

												<div>
												  <div>
													  
													<ul class="blocks-list clearfix"  data-type="addbox">
													</ul>

												  </div>
												</div>
										  
										  </div>
										
											<!-- div class="tab-pane fade" id="box-properties" role="tabpanel" aria-labelledby="blocks-tab">
												<div class="component-properties-sidepane">
													<div>
														<div class="component-properties">
															<div class="mt-4 text-center">Click on an element to edit.</div>
														</div>
													</div>
												</div>
											</div -->
										</div>
									</div>		

							</div>
							<!-- //add section box -->
						</div>
						<iframe src="" id="iframe1">
						</iframe>
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
								 <div class="tab-pane fade show active" id="content-tab" data-section="content" role="tabpanel" aria-labelledby="content-tab">
									<div class="alert alert-dismissible fade show alert-light m-3" role="alert" style="">		  
										<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>		  
										<strong>No selected element!</strong><br> Click on an element to edit.		
									</div>
								</div>
								
								 <div class="tab-pane fade show" id="style-tab" data-section="style" role="tabpanel" aria-labelledby="style-tab">
								</div>
								
								 <div class="tab-pane fade show" id="advanced-tab" data-section="advanced"  role="tabpanel" aria-labelledby="advanced-tab">
										<div class="alert alert-dismissible fade show alert-info m-3" role="alert" style="">		  
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>		  
											<strong>No advanced properties!</strong><br> This component does not have advanced properties.		
										</div>
								</div>
								
								
							</div>
							
							
							
					</div>
				</div>
				
				<div id="bottom-panel">

				<div class="btn-group" role="group">

		 			 <button id="code-editor-btn" data-view="mobile" class="btn btn-sm btn-light btn-sm"  title="Code editor" data-vvveb-action="toggleEditor">
						  <i class="la la-code"></i> Code editor
					  </button>
					 
						<div id="toggleEditorJsExecute" class="form-check mt-1" style="display:none">
							<input type="checkbox" class="form-check-input" id="runjs" name="runjs" data-vvveb-action="toggleEditorJsExecute">
							<label class="form-check-label" for="runjs"><small>Run javascript code on edit</small></label>
						</div>
					</div>
					
					<div id="vvveb-code-editor">
						<textarea class="form-control"></textarea>
					<div>

				</div>	
			</div>
		</div>


<!-- templates -->

<script id="vvveb-input-textinput" type="text/html">
	
	<div>
		<input name="{%=key%}" type="text" class="form-control"/>
	</div>
	
</script>

<script id="vvveb-input-textareainput" type="text/html">
	
	<div>
		<textarea name="{%=key%}" rows="3" class="form-control"/>
	</div>
	
</script>

<script id="vvveb-input-checkboxinput" type="text/html">
	
	<div class="form-check">
		  <input name="{%=key%}" class="form-check-input" type="checkbox" id="{%=key%}_check">
		  <label class="form-check-label" for="{%=key%}_check">{% if (typeof text !== 'undefined') { %} {%=text%} {% } %}</label>
	</div>
	
</script>

<script id="vvveb-input-radioinput" type="text/html">
	
	<div>
	
		{% for ( var i = 0; i < options.length; i++ ) { %}

		<label class="form-check-input  {% if (typeof inline !== 'undefined' && inline == true) { %}custom-control-inline{% } %}"  title="{%=options[i].title%}">
		  <input name="{%=key%}" class="form-check-input" type="radio" value="{%=options[i].value%}" id="{%=key%}{%=i%}" {%if (options[i].checked) { %}checked="{%=options[i].checked%}"{% } %}>
		  <label class="form-check-label" for="{%=key%}{%=i%}">{%=options[i].text%}</label>
		</label>

		{% } %}

	</div>
	
</script>

<script id="vvveb-input-radiobuttoninput" type="text/html">
	
	<div class="btn-group {%if (extraclass) { %}{%=extraclass%}{% } %} clearfix" role="group">
		{% var namespace = 'rb-' + Math.floor(Math.random() * 100); %}
		
		{% for ( var i = 0; i < options.length; i++ ) { %}

		<input name="{%=key%}" class="btn-check" type="radio" value="{%=options[i].value%}" id="{%=namespace%}{%=key%}{%=i%}" {%if (options[i].checked) { %}checked="{%=options[i].checked%}"{% } %} autocomplete="off">
		<label class="btn btn-outline-primary {%if (options[i].extraclass) { %}{%=options[i].extraclass%}{% } %}" for="{%=namespace%}{%=key%}{%=i%}" title="{%=options[i].title%}">
		  {%if (options[i].icon) { %}<i class="{%=options[i].icon%}"></i>{% } %}
		  {%=options[i].text%}
		</label>

		{% } %}
				
	</div>
	
</script>


<script id="vvveb-input-toggle" type="text/html">
	
    <div class="toggle">
        <input 
		type="checkbox" 
		name="{%=key%}" 
		value="{%=on%}" 
		{%if (off) { %} data-value-off="{%=off%}" {% } %}
		{%if (on) { %} data-value-on="{%=on%}" {% } %} 
		class="toggle-checkbox" 
		id="{%=key%}">
        <label class="toggle-label" for="{%=key%}">
            <span class="toggle-inner"></span>
            <span class="toggle-switch"></span>
        </label>
    </div>
	
</script>

<script id="vvveb-input-header" type="text/html">

		<h6 class="header">{%=header%}</h6>
	
</script>

	
<script id="vvveb-input-select" type="text/html">

	<div>

		<select class="form-select">
			{% for ( var i = 0; i < options.length; i++ ) { %}
			<option value="{%=options[i].value%}">{%=options[i].text%}</option>
			{% } %}
		</select>
	
	</div>
	
</script>

<script id="vvveb-input-dateinput" type="text/html">
	
	<div>
		<input name="{%=key%}" type="date" class="form-control" 
			{% if (typeof min_date === 'undefined') { %} min="{%=min_date%}" {% } %} {% if (typeof max_date === 'undefined') { %} max="{%=max_date%}" {% } %}
		/>
	</div>
	
</script>

<script id="vvveb-input-listinput" type="text/html">

	<div class="row">

		{% for ( var i = 0; i < options.length; i++ ) { %}
		<div class="col-6">
			<div class="input-group">
				<input name="{%=key%}_{%=i%}" type="text" class="form-control" value="{%=options[i].text%}"/>
				<div class="input-group-append">
					<button class="input-group-text btn btn-sm btn-danger">
						<i class="la la-trash la-lg"></i>
					</button>
				</div>
			  </div>
			  <br/>
		</div>
		{% } %}


		{% if (typeof hide_remove === 'undefined') { %}
		<div class="col-12">
		
			<button class="btn btn-sm btn-outline-primary">
				<i class="la la-trash la-lg"></i> Add new
			</button>
			
		</div>
		{% } %}
			
	</div>
	
</script>

<script id="vvveb-input-grid" type="text/html">

	<div class="row">
		<div class="col-6 mb-2">
		
			<label>Flexbox</label>
			<select class="form-select" name="col">
				
				<option value="">None</option>
				{% for ( var i = 1; i <= 12; i++ ) { %}
				<option value="{%=i%}" {% if ((typeof col !== 'undefined') && col == i) { %} selected {% } %}>{%=i%}</option>
				{% } %}
				
			</select>
		</div>

		<div class="col-6 mb-2">
			<label>Extra small</label>
			<select class="form-select" name="col-xs">
				
				<option value="">None</option>
				{% for ( var i = 1; i <= 12; i++ ) { %}
				<option value="{%=i%}" {% if ((typeof col_xs !== 'undefined') && col_xs == i) { %} selected {% } %}>{%=i%}</option>
				{% } %}
				
			</select>
		</div>
		
		<!-- div class="col-6">
			<label>Small</label>
			<select class="form-select" name="col-sm">
				
				<option value="">None</option>
				{% for ( var i = 1; i <= 12; i++ ) { %}
				<option value="{%=i%}" {% if ((typeof col_sm !== 'undefined') && col_sm == i) { %} selected {% } %}>{%=i%}</option>
				{% } %}
				
			</select>
			<br/>
		</div -->
		
		<div class="col-6 mb-2">
			<label>Medium</label>
			<select class="form-select" name="col-md">
				
				<option value="">None</option>
				{% for ( var i = 1; i <= 12; i++ ) { %}
				<option value="{%=i%}" {% if ((typeof col_md !== 'undefined') && col_md == i) { %} selected {% } %}>{%=i%}</option>
				{% } %}
				
			</select>
		</div>
		
		<div class="col-6 mb-2">
			<label>Large</label>
			<select class="form-select" name="col-lg">
				
				<option value="">None</option>
				{% for ( var i = 1; i <= 12; i++ ) { %}
				<option value="{%=i%}" {% if ((typeof col_lg !== 'undefined') && col_lg == i) { %} selected {% } %}>{%=i%}</option>
				{% } %}
				
			</select>
		</div>
		
		
		<div class="col-6 mb-2">
			<label>Extra large </label>
			<select class="form-select" name="col-xl">
				
				<option value="">None</option>
				{% for ( var i = 1; i <= 12; i++ ) { %}
				<option value="{%=i%}" {% if ((typeof col_lg !== 'undefined') && col_lg == i) { %} selected {% } %}>{%=i%}</option>
				{% } %}
				
			</select>
		</div>
		
		<div class="col-6 mb-2">
			<label>Extra extra large</label>
			<select class="form-select" name="col-xxl">
				
				<option value="">None</option>
				{% for ( var i = 1; i <= 12; i++ ) { %}
				<option value="{%=i%}" {% if ((typeof col_lg !== 'undefined') && col_lg == i) { %} selected {% } %}>{%=i%}</option>
				{% } %}
				
			</select>
		</div>
		
		{% if (typeof hide_remove === 'undefined') { %}
		<div class="col-12">
		
			<button class="btn btn-sm btn-outline-light text-danger">
				<i class="la la-trash la-lg"></i> Remove
			</button>
			
		</div>
		{% } %}
		
	</div>
	
</script>

<script id="vvveb-input-textvalue" type="text/html">
	
	<div class="row">
		<div class="col-6 mb-1">
			<label>Value</label>
			<input name="value" type="text" value="{%=value%}" class="form-control"/>
		</div>

		<div class="col-6 mb-1">
			<label>Text</label>
			<input name="text" type="text" value="{%=text%}" class="form-control"/>
		</div>

		{% if (typeof hide_remove === 'undefined') { %}
		<div class="col-12">
		
			<button class="btn btn-sm btn-outline-light text-danger">
				<i class="la la-trash la-lg"></i> Remove
			</button>
			
		</div>
		{% } %}

	</div>
	
</script>

<script id="vvveb-input-rangeinput" type="text/html">
	
	<div class="input-range">
		
		<input name="{%=key%}" type="range" min="{%=min%}" max="{%=max%}" step="{%=step%}" class="form-range" data-input-value/>
		<input name="{%=key%}" type="number" min="{%=min%}" max="{%=max%}" step="{%=step%}" class="form-control" data-input-value/>
        
	</div>
	
</script>

<script id="vvveb-input-imageinput" type="text/html">
    {% 
        var suffix = Math.floor(Math.random() * 10000); 
        var IMCE_WINDOW = null;
        var imageDefault = '<?php echo $assets_url; ?>img/default.png';
    %}
        <div class="drupalentor-imgupload-input">
            <input name="{%=key%}" type="text" class="form-control" id="drupalentor-upload-{%=suffix%}"/>
            <img class="drupalentor-image-thumnb-{%=suffix%}" src="{%=imageDefault%}" style="width: 104px;margin-bottom: 5px;margin-top: 5px;">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button class="imce-url-add btn btn-primary btn-sm" id="imce-url-add-{%=suffix%}"<span><?php echo t('Add Image'); ?></span></button>
                <button class="imce-url-delete btn btn-danger btn-sm" id="imce-url-delete-{%=suffix%}"><span><?php echo t('Remove'); ?></span></button>
            </div>
            <div class="image-style" style="margin-top:5px;">
                <label>Image Style</label>
                <select class="form-select" name="col-xxl" id="drupalentor-imagestyle-{%=suffix%}"">

                    <option value="">None</option>
                        <?php foreach($image_styles as $key => $styles){
                            echo '<option value="'.$key.'">'.$styles.'</option>';
                        }
                    ?>

                </select>
            </div>
        </div>
    {% 

        $(document).ready(function(){

            var url = Drupal.url('imce');
            var inputID = 'drupalentor-upload-' + suffix;
            var imageUrl = $('#'+inputID).val();
            if(imageUrl != imageDefault){
                $('.drupalentor-image-thumnb-'+suffix).attr('src', imageUrl);
            }
            
            $('#imce-url-delete-'+suffix).click(function(){
                $('#'+inputID).val('');
                $('#'+inputID).focusout();
                $('#'+inputID).parent('.drupalentor-imgupload-input').find('img').attr('src', imageDefault);

            });
            var drupalentorImceInput = (window.drupalentorImceInput = window.drupalentorImceInput || {
                urlSendto: function (File, win) {
                    var url = File.getUrl();
                    var el = $('#' + win.imce.getQuery('inputId'))[0];
                    win.close();
                    if (el) {
                        var base_path = drupalSettings.drupalentor.base_path;
                        var url_new = '/' + url.replace(base_path, '');
                        $(el).val(url_new);
                        $(el).parent('.drupalentor-imgupload-input').find('img').attr('src', url_new);
                        $(el).focusout();
                        $('#drupalentor-imagestyle-'+suffix).val('');
                    }
                }
            });
            $('#imce-url-add-'+suffix).on('click', function(e){
                e.preventDefault();
                url += (url.indexOf('?') === -1 ? '?' : '&') + 'sendto=drupalentorImceInput.urlSendto&inputId=' + inputID + '&type=link';
                if (IMCE_WINDOW == null || IMCE_WINDOW.closed) {
                    IMCE_WINDOW = window.open(url, '', 'width=' + Math.min(1000, parseInt(screen.availWidth * 0.8, 10)) + ',height=' + Math.min(800, parseInt(screen.availHeight * 0.8, 10)) + ',resizable=1');
                }
            });
             
            if(typeof imageUrl !== "undefined"){
                if(imageUrl.toString().indexOf("/sites/default/files/styles") > -1){
                    $('#drupalentor-imagestyle-'+suffix).val(imageUrl.split("/")[5]);
                }
            }

            $('#drupalentor-imagestyle-'+suffix).on('change', function(e){
            
                var image_style = $(this).val();
                var img = $('#'+inputID).val();
                var data = {
                    img: img,
                    image_style: image_style,
                };

                $.ajax({
                    url: drupalSettings.getImageStyleURL,
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function (data) {
                        $('#'+inputID).val(data.image_path);
                        $('#'+inputID).focusout();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert(textStatus + ":" + jqXHR.responseText);
                    }
                });
            });
        });
    %}
</script>


<script id="vvveb-input-colorinput" type="text/html">
	
	<div>
		<input name="{%=key%}" type="color" {% if (typeof value !== 'undefined' && value != false) { %} value="{%=value%}" {% } %}  pattern="#[a-f0-9]{6}" class="form-control form-control-color"/>
	</div>
	
</script>

<script id="vvveb-input-bootstrap-color-picker-input" type="text/html">
	
	<div>
		<div id="cp2" class="input-group" title="Using input value">
		  <input name="{%=key%}" type="text" {% if (typeof value !== 'undefined' && value != false) { %} value="{%=value%}" {% } %}	 class="form-control"/>
		  <span class="input-group-append">
			<span class="input-group-text colorpicker-input-addon"><i></i></span>
		  </span>
		</div>
	</div>

</script>

<script id="vvveb-input-numberinput" type="text/html">
	<div>
		<input name="{%=key%}" type="number" value="{%=value%}" 
			  {% if (typeof min !== 'undefined' && min != false) { %}min="{%=min%}"{% } %} 
			  {% if (typeof max !== 'undefined' && max != false) { %}max="{%=max%}"{% } %} 
			  {% if (typeof step !== 'undefined' && step != false) { %}step="{%=step%}"{% } %} 
		class="form-control"/>
	</div>
</script>

<script id="vvveb-input-button" type="text/html">
	<div>
		<button class="btn btn-sm btn-primary">
			<i class="la  {% if (typeof icon !== 'undefined') { %} {%=icon%} {% } else { %} la-plus {% } %} la-lg"></i> {%=text%}
		</button>
	</div>		
</script>

<script id="vvveb-input-cssunitinput" type="text/html">
	<div class="input-group" id="cssunit-{%=key%}">
		<input name="number" type="number"  {% if (typeof value !== 'undefined' && value != false) { %} value="{%=value%}" {% } %} 
			  {% if (typeof min !== 'undefined' && min != false) { %}min="{%=min%}"{% } %} 
			  {% if (typeof max !== 'undefined' && max != false) { %}max="{%=max%}"{% } %} 
			  {% if (typeof step !== 'undefined' && step != false) { %}step="{%=step%}"{% } %} 
		class="form-control"/>
		 <div class="input-group-append">
		<select class="form-select small-arrow" name="unit">
			<option value="em">em</option>
			<option value="px">px</option>
			<option value="%">%</option>
			<option value="rem">rem</option>
			<option value="auto">auto</option>
		</select>
		</div>
	</div>
	
</script>


<script id="vvveb-filemanager-folder" type="text/html">
	<li data-folder="{%=folder%}" class="folder">
		<label for="{%=folder%}"><span>{%=folderTitle%}</span></label> <input type="checkbox" id="{%=folder%}" />
		<ol></ol>
	</li>
</script>

<script id="vvveb-filemanager-page" type="text/html">
	<li data-url="{%=url%}" data-file="{%=file%}" data-page="{%=name%}" class="file">
		<label for="{%=name%}"><span>{%=title%}</span></label> <input type="checkbox" id="{%=name%}" />
		<ol></ol>
	</li>
</script>

<script id="vvveb-filemanager-component" type="text/html">
	<li data-url="{%=url%}" data-component="{%=name%}" class="component">
		<a href="{%=url%}"><span>{%=title%}</span></a>
	</li>
</script>

<script id="vvveb-input-sectioninput" type="text/html">

		<label class="header" data-header="{%=key%}" for="header_{%=key%}"><span>&ensp;{%=header%}</span> <div class="header-arrow"></div></label> 
		<input class="header_check" type="checkbox" {% if (typeof expanded !== 'undefined' && expanded == false) { %} {% } else { %}checked="true"{% } %} id="header_{%=key%}"> 
		<div class="section" data-section="{%=key%}"></div>		
	
</script>


<script id="vvveb-property" type="text/html">

	<div class="mb-3 {% if (typeof col !== 'undefined' && col != false) { %} col-sm-{%=col%} d-inline-block px-2 {% } else { %}row{% } %}" data-key="{%=key%}" {% if (typeof group !== 'undefined' && group != null) { %}data-group="{%=group%}" {% } %}>
		
		{% if (typeof name !== 'undefined' && name != false) { %}<label class="{% if (typeof inline === 'undefined' ) { %}col-sm-4{% } %} control-label" for="input-model">{%=name%}</label>{% } %}
		
		<div class="{% if (typeof inline === 'undefined') { %}col-sm-{% if (typeof name !== 'undefined' && name != false) { %}8{% } else { %}12{% } } %} input"></div>
		
	</div>		 
	
</script>

<script id="vvveb-input-autocompletelist" type="text/html">
	
	<div>
		<input name="{%=key%}" type="text" class="form-control"/>
		
		<div class="form-control autocomplete-list" style="min=height: 150px; overflow: auto;">
                  </div>
                  </div>
	
</script>

<script id="vvveb-input-tagsinput" type="text/html">
	
	<div>
		<div class="form-control tags-input" style="height:auto;">
				

				<input name="{%=key%}" type="text" class="form-control" style="border:none;min-width:60px;"/>
                  </div>
                  </div>
	
</script>

<script id="vvveb-section" type="text/html">
	{% var suffix = Math.floor(Math.random() * 10000); %}

	<div class="section-item" draggable="true">
		<div class="controls">
			<div class="handle"></div>
			<div class="info">
				<div class="name">{%=name%} 
					<div class="type">{%=type%}</div>
				</div>
			</div>
			<div class="buttons">
				<a class="delete-btn" href="" title="Remove section"><i class="la la-trash text-danger"></i></a>
				<!-- 
				<a class="up-btn" href="" title="Move element up"><i class="la la-arrow-up"></i></a>
				<a class="down-btn" href="" title="Move element down"><i class="la la-arrow-down"></i></a>
				-->
				<a class="properties-btn" href="" title="Properties"><i class="la la-cog"></i></a>
		</div>
		</div>


		<input class="header_check" type="checkbox" id="section-components-{%=suffix%}">

		<label for="section-components-{%=suffix%}"> 
			<div class="header-arrow"></div>
		</label>
		
		<div class="tree">
			<ol >
				<li data-component="Products" class="file">							
					<label for="idNaN" style="background-image:url(http://demo.givan.ro/js/vvvebjs/icons/products.svg)"><span>Products</span></label>							
					<input type="checkbox" id="idNaN">
				</li>
				<li data-component="Posts" class="file">							
					<label for="idNaN" style="background-image:url(http://demo.givan.ro/js/vvvebjs/icons/posts.svg)"><span>Posts</span></label>							
					<input type="checkbox" id="idNaN">
				</li>
			</ol>
		</div>
	</div>
	
</script>


<!--// end templates -->


<!-- message modal-->
<!-- export html modal-->
<div class="modal fade" id="textarea-modal" tabindex="-1" role="dialog" aria-labelledby="textarea-modal" aria-hidden="true">
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
<div class="modal fade" id="message-modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <p class="modal-title text-primary"><i class="la la-lg la-comment"></i> VvvebJs</p>
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


<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        Vvveb.Gui.init();
        Vvveb.FileManager.init();
        Vvveb.SectionList.init();
        Vvveb.ComponentsGroup['Widgets'] = ["widgets/googlemaps", "widgets/video", "widgets/drupalblock", "widgets/drupalview"];   
    });
</script>