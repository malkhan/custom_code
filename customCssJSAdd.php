<?php
function extraCssJs($libs){
	$plugins = array(
				'datatables_css' => array(
						array('name'=>'/plugins/datatables/css/jquery.dataTables.min.css','type'=>'css')
					),
				'datatables_js' => array(
						array('name'=>'/plugins/datatables/js/jquery.dataTables.min.js','type'=>'js')
					),
				'datatables_with_icon' => array(
						array('name'=>'https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.css','type'=>'css'),
						array('name'=>'https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js','type'=>'js')
					),
				'form_fields' => array(
						array('name'=>'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js','type'=>'js')
				),
				'css_select2' => array(
						array('name'=>'/plugins/select2/select2.min.css','type'=>'css'),
						array('name'=>'/plugins/select2/select2.css','type'=>'css')
				),
				'js_select2' => array(
						array('name'=>'plugins/select2/select2.js','type'=>'js'),
						array('name'=>'plugins/select2/select2.min.js','type'=>'js')
				),
				'form_fields_with_date_time' => array(
						array('name'=>'/plugins/datepicker/datepicker3.css','type'=>'css'),
						array('name'=>'https://cdn.jsdelivr.net/bootstrap.timepicker/0.2.6/css/bootstrap-timepicker.min.css','type'=>'css'),
						array('name'=>'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js','type'=>'js')
				)
			);
	if(is_array($libs) && count($libs)>0){
		$i = 0;
		foreach ($libs as $k=>$val){
			if(isset($plugins[$val]) && count($plugins[$val])>0){
				foreach ($plugins[$val] as $filename){
					$files[$i]['name'] = $filename['name'];
					$files[$i]['type'] = $filename['type'];
					$i++;
				}
			} 
		}
	}else{
		$files = $plugins[$libs];
	}
	//print_r($files);die;
	return $files;
}
$extra_css_js_top = extraCssJs(array('form_fields','datatables_with_icon'));

if(isset($extra_css_js_top) && is_array($extra_css_js_top) && count($extra_css_js_top)>0){
    foreach ($extra_css_js_top as $file){ 
       if (filter_var($file['name'], FILTER_VALIDATE_URL)) {
           $fileUrl = $file['name'];
       }else {
           $fileUrl = base_url(THEME_PATH.$file['name']);
       }
       if($file['type']=='js'){ ?>
            <script type="text/javascript" src="<?php echo $fileUrl;?>"></script>
       <?php } else{ ?>
            <link rel="stylesheet" href="<?php echo $fileUrl;?>">
       <?php } ?>
    <?php }
} ?> 
