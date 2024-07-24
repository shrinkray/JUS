<?php

// get coauthors info
$coauthors = get_coauthors();
$c_string = "";
$i=1;
foreach( $coauthors as $coauthor ):
$c_string = $c_string.$coauthor->last_name;
$c_string = $c_string.", ".substr($coauthor->first_name, 0, 1).".";
if(count($coauthors)>$i){
$c_string = $c_string.", ";
}
$i++;
endforeach;

// get issue date
$c_terms = get_the_terms( $post->ID, 'issue' );
foreach ($c_terms as $c_term){
    $issue = explode('-', $c_term->slug);
}
$url = str_replace("http://www.usabilityprofessionals.org/uxmagazine/", "http://www.uxpamagazine.org/", get_permalink() );
?>
<div class="citation">
<?php
echo $c_string;
echo  " (".substr(get_the_date('Y'), -4).('). ');
echo " ".get_the_title().". User Experience Magazine, ".$issue[0]."(".$issue[1].")."; ?>
<br/>
Retrieved from <a href="<?php echo $url; ?>"><?php echo $url; ?></a>
</div>