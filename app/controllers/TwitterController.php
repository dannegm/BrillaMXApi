<?php
class TwitterController extends BaseController{

/*
* ----------------------------------
*  Twitter
* ----------------------------------
*/

	public function tweetsByHashtag ($hashtag) {
		$settings = array(
		    'oauth_access_token' => "116323157-weLXsH2PkAQsBKSzPReRwNiaya3WlzO7FgAlcRhr",
		    'oauth_access_token_secret' => "SgmtKAGDebEn8yw7Q29oxBttOnriP8Vhfdud04Q7UcC20",
		    'consumer_key' => "hLNEGszkXit0O388A94QqhPAN",
		    'consumer_secret' => "l1VCHgDNZ6KBXenFPhly5gfNNJar0YpipEq9nFJV44h9i5XKYM"
		);
		$url = 'https://api.twitter.com/1.1/search/tweets.json';
		$requestMethod = 'GET';

		$oldest = "158007999942766593";
		$getfield = "?q=#{$hashtag}&since_id={$oldest}&count=30&result_type=mixed";

		$twitter = new TwitterAPIExchange($settings);
		$tweet = $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();
		$tweet = json_decode($tweet);
		return Response::json($tweet);
	}
}