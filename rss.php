<style>
.header {
  background: #555;
  color: #f1f1f1;
  position: fixed;
  top: 0;
  width: 100%;
  left:-0px;
  right:-0px;
  z-index:2;
}
marquee
{
marquee-speed:normal;
    
}
   
    @media(min-width:200px) and (max-width:1024px){
    .si{
      font-size:40px;
    }
    marquee
    {
    marquee-speed:fast;
    }

  }
  </style>
<div class="header" id="myHeader">
<center>
  <h1>DEPARTMENT OF CSE</h1>
  <h2>JOB NOTIFICATIONS</h2>
</center></div>
<marquee direction=up height='113%'>
<?php
$html = "";
//$url = "https://www.monsterindia.com/jobsearch/rss_jobs.html?cat=22";
function produce_XML_object_tree($raw_XML) {
    libxml_use_internal_errors(true);
    try {
        $xmlTree = new SimpleXMLElement($raw_XML);
    } catch (Exception $e) {
        // Something went wrong.
        $error_message = 'SimpleXMLElement threw an exception.';
        foreach(libxml_get_errors() as $error_line) {
            $error_message .= "\t" . $error_line->message;
        }
        trigger_error($error_message);
        return false;
    }
    return $xmlTree;
}

$xml_feed_url = 'https://www.monsterindia.com/jobsearch/rss_jobs.html?cat=22';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $xml_feed_url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$xml1 = curl_exec($ch);
curl_close($ch);

$xml = produce_XML_object_tree($xml1);
$count=0;
for($i = 0; $i < 40; $i++){
	$title = $xml->channel->item[$i]->title;
	$link = $xml->channel->item[$i]->link;
	$description = $xml->channel->item[$i]->description;
	$strexp=explode("Experience: ",$description);
	$str=substr($strexp[1],4,1); 
	$pubDate = $xml->channel->item[$i]->pubDate;
	$html.="<body style='background-color:lightgreen;height:100%;'>";
	if($str==0){
    $html .= "<center ><a href='$link'class='si' ><h3><i>$title</i></h3></a>";
	$html .= "<b class='si'>$description</b>";
	$html .= "<br />$pubDate</center><hr/>";
	$count++;
	}
	
}
$html.= "<br><center><b class='si'>NUMBER OF JOB NOTIFICATIONS : ".$count;
$html.= "</b></center><br><center><b class='si'><span style='color:red'>ALL RIGHTS RESERVED &reg; PSCMR</span></b></center>";
echo $html;


?>
</marquee>