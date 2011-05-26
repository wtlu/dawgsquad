function RequestforPermission($next_url) { 
	global $facebook;
	$loginUrl=$facebook->getLoginUrl(array(
		'canvas'=>1,
		'fbconnect'=>0,
		'display'=>'page',
		'next'=>$next_url,
		'cancel_url'=>'http://www.facebook.com/',
		'req_perms'=>'email,publish_stream',
	));
	return '<fb:redirect url="'.$loginUrl.'" />';
}