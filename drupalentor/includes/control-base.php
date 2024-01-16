<?php 
	namespace Drupal\drupalentor;

   class Controls_Base{

	private function getContent($data, $name, $value){
		$control_id = $data['item']['type'];
		$class_name = $this->getControlClassName($control_id);
		$control = new $class_name();
		$content = $control->content_template($data, $name, $value);
	
		return $content;
	}
	public function generateHtml($data, $values, $name, $value, $wrapper){

		$state = !empty($data['item']['state']) ? htmlspecialchars(json_encode($data['item']['state']), ENT_QUOTES, 'UTF-8') : null;
	
		$content = $this->getContent($data, $name, $value);

		?>
		<?php ob_start() ?>
			<div class="drupalentor_field field__<?php echo $data['item']['type']; ?> drupalentor_field__static" 
				data-field-state="<?php echo $state; ?>" 
				data-field-name="<?php echo $data['item_id']; ?>">
				<?php if($wrapper === 'group'){ ?>
					<h5 class="d-flex justify-content-between">
						<?php echo $data['item']['title']; ?></i>
					</h5>
					<div class="" id="<?php echo $data['item_id']; ?>">
					<?php }else{ ?>
					<h5 class="d-flex justify-content-between" data-bs-toggle="collapse" href="#<?php echo $data['item_id']; ?>" role="button" aria-expanded="false" aria-controls="<?php echo $data['item_id']; ?>">
						<?php echo $data['item']['title']; ?><i class="fa-solid fa-angle-down"></i>
					</h5>
					<div class="collapse" id="<?php echo $data['item_id']; ?>">
					<?php } ?>
				
					<?php echo $content; ?>
				</div>
			</div>
			
		<?php return ob_get_clean();
	}

    public function hoverHTML(array $data, $content, $values, $wrapper) {
		
        $control_id = $data['item']['type'];
        $class_name = $this->getControlClassName($control_id);
        $control = new $class_name();

        $state = !empty($data['item']['state']) ? htmlspecialchars(json_encode($data['item']['state']), ENT_QUOTES, 'UTF-8') : null;

        $html_hover = '';
        $html_hover .= '<div class="field__hover drupalentor_field" 
                        data-field-state="'.$state.'" 
                        data-field-name="'.$data['item_id'].'">';
						if($wrapper === 'group'){
        $html_hover .= '<h5 class="d-flex justify-content-between">'. $data['item']['title'].'</h5>';
		$html_hover .= '<div id="'.$data['item_id'].'">';
						}else{
        $html_hover .= '<h5 class="d-flex justify-content-between" data-bs-toggle="collapse" href="#'.$data['item_id'].'" role="button" aria-expanded="false" aria-controls="'.$data['item_id'].'">'. $data['item']['title'].'<i class="fa-solid fa-angle-down"></i></h5>';
		$html_hover .= '<div class="collapse" id="'.$data['item_id'].'">';
						}
      
        $html_hover .= '<div class="hover_tabs">';
        $hover_status = ['default' => t('Default'), 'hover' => t('Hover')];
        foreach($hover_status as $key_status => $status){
            $html_hover .= '<a href="#hover_tab_'.$data['item_id'].$key_status.'" class="hover_tabs-tab">'.$status.'</a>';
        }
        $html_hover .= '</div>';

        foreach($hover_status as $key_status => $status){

            $html_hover .= '<div class="field__hover-content" id="hover_tab_'.$data['item_id'].$key_status.'" data-hover-status="'.$key_status.'">';
            if(!empty($data['item']['responsive'])){
                $name = 'element[css][desktop]['.$key_status.']['.$data['item_id'].']';
                $value = isset($values['css']['desktop'][$key_status][$data['item_id']]) ? $values['css']['desktop'][$key_status][$data['item_id']] : '';
                $content = $control->content_template($data, $name, $value);
                $html_hover .= $this->responsiveHTML($data, $content, $key_status, $values, false, $wrapper);
            } else {

                $name = 'element[css][desktop]['.$key_status.']['.$data['item_id'].']';
                $value = isset($values['css']['desktop'][$key_status][$data['item_id']]) ? $values['css']['desktop'][$key_status][$data['item_id']] : '';
                $content = $control->content_template($data, $name, $value);
                $html_hover .= $content;
            }
            $html_hover .= '</div>';
        }
        $html_hover .= '</div>';
        $html_hover .= '</div>';
        return $html_hover;
    }


    public function responsiveHTML(array $data, $content, $hover_status, $values, $hover, $wrapper) {

        $control_id = $data['item']['type'];
        $class_name = $this->getControlClassName($control_id);
        $control = new $class_name();

        $state = !empty($data['item']['state']) ? htmlspecialchars(json_encode($data['item']['state']), ENT_QUOTES, 'UTF-8') : null;
		$responsive = '';
		$responsive .= '<div class="drupalentor_field drupalentor_field__responsive field__group field__'.$data['item']['type'].'" 
						data-field-state="'.$state.'"
						data-field-name="'.$data['item_id'].'">';
		if($hover){
			if($wrapper === 'group'){
				$responsive .= '<h5 class="d-flex justify-content-between">'. $data['item']['title'].'</h5>';
			}else{
				$responsive .= '<h5 class="d-flex justify-content-between" data-bs-toggle="collapse" href="#'.$data['item_id'].'" role="button" aria-expanded="false" aria-controls="'.$data['item_id'].'">'. $data['item']['title'].'<i class="fa-solid fa-angle-down"></i></h5>';
			}
		}	

		if($hover){
			if($wrapper === 'group'){
				$responsive .= '<div id="'.$data['item_id'].'">';
			}else{
				$responsive .= '<div class="collapse" id="'.$data['item_id'].'">';
			}
		}
		$responsive .= '<div class="responsive__tabs">';
		foreach (self::getMediaQuery() as $k => $query) {
			
			$icon = '<i class="fa-solid fa-mobile-screen-button"></i>';
			if($k === 'tablet'){
				$icon = '<i class="fa-solid fa-tablet-screen-button"></i>';
			}
			if($k === 'desktop'){
				$icon = '<i class="fa-solid fa-desktop"></i>';
			}
			$responsive .= '<a href="#responsive_tab_'.$k.'" class="responsive_tabs-tab" title="'.$k.'">'.$icon.'</a>';
		}
		// <div class="collapse" id="'.$data['item_id'].'">
		// 	' . $content . '
		// </div>
		$responsive .= '</div>';
		foreach (self::getMediaQuery() as $k => $query) {
			$name = 'element[css]['.$k.'][default]['.$data['item_id'].']';

			$value =  (!empty($values['css'][$k]['default'][$data['item_id']]) ? $values['css'][$k]['default'][$data['item_id']] : '');
		
			if($hover_status){
				$name = 'element[css]['.$k.']['.$hover_status.']['.$data['item_id'].']';
				$value = (!empty($values['css'][$k][$hover_status][$data['item_id']]) ? $values['css'][$k][$hover_status][$data['item_id']] : '');
			}
			// dump($name);
			$content = $control->content_template($data, $name, $value);
		
			$responsive .=  
				'<div class="field-wrapper" data-mediaquery="'.$k.'" id="responsive_tab_'.$k.'" data-responsive-status="'.$k.'">
					<p>'. $data['item']['title'].' ' . $k .'</p>
						' . $content . '
				</div>';
		}
	
		$responsive .= '</div>';
		if($hover){
			$responsive .= '</div>';
		}
		return $responsive;
	
    }


	public function extractHtml($data, $values, $wrapper) {


		$state = !empty($data['item']['state']) ? htmlspecialchars(json_encode($data['item']['state']), ENT_QUOTES, 'UTF-8') : null;
		$control_id = $data['item']['type'];
	
		$class_name = $this->getControlClassName($control_id);
	
		$control = new $class_name();
	

		$name = 'element['.$data['item_id'].']';
		$value = !empty($values[$data['item_id']]) ? $values[$data['item_id']] : null;

		$html = $this->generateHtml($data, $values, $name, $value, $wrapper);

		if (!empty($data['item']['style_type'])) {
			if ($data['item']['style_type'] === 'style') {

				$name = 'element[css][desktop][default]['.$data['item_id'].']';
				$value = !empty($values['css']['desktop']['default'][$data['item_id']]) ? $values['css']['desktop']['default'][$data['item_id']] : null;
			
				$html = $this->generateHtml($data, $values, $name, $value, $wrapper);

			} elseif ($data['item']['style_type'] === 'class') {
				$name = 'element[class]['.$data['item_id'].']';
				$value = !empty($values['class'][$data['item_id']]) ? $values['class'][$data['item_id']] : null;
				$html = $this->generateHtml($data, $values, $name, $value, $wrapper);
			}
		}

		if ($data['item']['type'] === 'info' || $data['item']['type'] === 'html' || $data['item']['type'] === 'drupalentor_gallery') {

			$html = $this->getContent($data, $name, $value);
		}

		if ($data['item']['type'] === 'textarea') {
			$name = 'element['.$data['item_id'].']';
			$html = $this->generateHtml($data, $values, $name, $value, $wrapper);
		}
		$content = $this->getContent($data, $name, $value);
		if (!empty($data['item']['responsive'])) {
			if (!empty($data['item']['style_hover'])) {
				return $this->hoverHTML($data, $content, $values, $wrapper);
			} else {
				return $this->responsiveHTML($data, $content, null,  $values, true, $wrapper);
			}
		} elseif (!empty($data['item']['style_hover'])) {
			return $this->hoverHTML($data, $content, $values, $wrapper);
		}

		return $html;
	}
	
	public function getControlClassName($control_id) {
        $control_class_id = str_replace(' ', '_', ucwords(str_replace('_', ' ', $control_id)));
        return __NAMESPACE__ . '\Control_' . $control_class_id;
    }
	
	public function defaultFields(){
		$form = [];
				// Section Styles
		$form['section_extras'] = [
			'type' => 'tab',
			'title' => t('Extras'),
			'weight' => 9,
		];
		$form['border'] = [
			'type'        => 'drupalentor_border',
			'title'       => t('Border'),
			'tab'     => 'section_extras',
			'style_type' => 'style',
			'style_selector' => 'widget', 
			'style_css' => 'border', 
			'style_hover' => true,
			'responsive' => true,
		];

		$form['group_extra'] = [
			'type' => 'group',
			'title' => t('Extra'),
		];
		$form['margin'] = [
			'type'     => 'drupalentor_margin',
			'title'    => t('Margin'),
			'tab'     => 'section_extras',
			'style_type' => 'style',
			'style_selector' => 'widget', 
			'style_css' => 'margin', 
			'responsive' => true,
			'style_hover' => true,
			'group' => 'group_extra'
		];
		$form['padding'] = [
			'type'     => 'drupalentor_padding',
			'title'    => t('Padding'),
			'tab'     => 'section_extras',
			'style_type' => 'style',
			'style_selector' => 'widget', 
			'style_css' => 'padding', 
			'responsive' => true,
			'style_hover' => true,
			'group' => 'group_extra'
		];
		$form['element_class'] =[
			'type'    => 'text',
			'title'   => ('Custom CSS classes'),
			'style_type' => 'class',
			'style_selector' => 'widget', 
			'tab' => 'section_extras',
			'placeholder' => 'Multiple classes should be separated with SPACE.',
			'group' => 'group_extra'
		];
		$form['element_inner_class'] = [
			'type'    => 'text',
			'title'   => ('Custom for element inner CSS classes'),
			'style_type' => 'class',
			'style_selector' => '.column-inner', 
			'placeholder'    => ('Multiple classes should be separated with SPACE.'),
			'tab' => 'section_extras',
			'group' => 'group_extra'
		];
		$form['hidden_element'] = [
            'type'    => 'drupalentor_group_checkbox',
            'title'   => t('Hide Element'),
            'tab' => 'section_extras',
            'style_type' => 'class',
            'style_selector' => 'widget', 
            'options' => [
               'hidden-xs' => t('Hide on mobile'),
               'hidden-md' => t('Hide on Tablet'),
               'hidden-lg' => t('Hide on desktop'),
            ]
      
         ];
		return $form;
	}
	public function groupFields($fields){

		// Iterar sobre el array original y agrupar por pestañas
		// group by tabs

		$tabs = array();

			
		foreach ($fields as $key => $value) {
			if (isset($value['type']) && $value['type'] === 'tab') {
				$currentTab = $key;
				$tabs[$currentTab] = $value;
				$tabs[$currentTab]['items'] = [];
				// Agregar el título de la pestaña
				$tabs[$currentTab]['title'] = isset($value['title']) ? $value['title'] : $currentTab;
			} else {
				if (isset($value['tab'])) {
					$tabName = $value['tab'];
					$group = isset($value['group']) ? $value['group'] : null;
		
					// Verificar si hay grupos o no
					if ($group !== null) {
						if (!isset($tabs[$tabName]['items'][$group])) {
							// Utilizar el título y tipo del grupo del array original
							$groupTitle = isset($fields[$group]['title']) ? $fields[$group]['title'] : $group;
							$groupType = isset($fields[$group]['type']) ? $fields[$group]['type'] : null;
							$tabs[$tabName]['items'][$group]['title'] = $groupTitle;
							$tabs[$tabName]['items'][$group]['type'] = $groupType;
						}
						$tabs[$tabName]['items'][$group]['items'][$key] = $value;
					} else {
						$tabs[$tabName]['items'][$key] = $value;
					}
				}
			}
		}


		return $tabs;
	}
	public static function getMediaQuery() {
		$media_query = [
			"desktop" => "1600px",
			"tablet" => "920px",
			"mobile" => "767px",
		];
		return $media_query;
	}

   }