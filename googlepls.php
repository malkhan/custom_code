<?php
/* 
* © WTFPL
* by necenzurat
* Updated: 19 May 2013
*/
 function gplus_count(){
         $count = get_transient('gplus_count');
    if ($count !== false) return $count;
         $count = 0;
 
        $data = file_get_contents('https://plus.google.com/110126513116350907671/posts');
 echo "sdf"; print_r($data);die("dfg");
   if (is_wp_error($data)) {
         return 'whoa error!!!';
   }else{
 
        if (preg_match('/>([0-9,]+) people</i', $data, $matches)) {
                $results =  str_replace(',', '', $matches[1]);
        }
 
        if ( isset ( $results ) && !empty ( $results ) )
                {
                        $count = $results;
                }
        }
set_transient('gplus_count', $count, 60*60*48); // 72 hour cache
return $count;
} ?>
<?php echo gplus_count(); ?>