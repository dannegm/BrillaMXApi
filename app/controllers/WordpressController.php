<?php

// Esto no crasheará?
require_once('/home/clicker/public/wp-load.php');

class WordpressController extends BaseController{

/*
* ----------------------------------
*  Wordrpess
* ----------------------------------
*/

	public function notas ($page) {
		$npage = Input::get('n') != null ? Input::get('n') : 10;

		if ($page > 1) {
			$paginate = ($page - 1) * $npage;
		} else {
			$paginate = 0;
		}

		$args = array (
			'posts_per_page' => $npage,
			'post_status' => 'publish',
			'offset' => $paginate
		);
		$the_query = new WP_Query( $args );

		if ($the_query->have_posts()) {
			$data = array();
			while ($the_query->have_posts()) {
				$the_query->the_post();
				$content = get_the_content();

				$content = strip_tags($content);
				$content = str_replace("\n", "", $content);
				$content = str_replace("\r", "", $content);
				$content = str_replace("\n", '', $content);

				$content = rtrim($content, "\x00..\x1F");
				$content = str_replace('&nbsp;', '', $content);

				$image_url = get_the_post_thumbnail( get_the_ID() );
				preg_match('/src=\"(.*?)\"/', $image_url, $url);

				$src = $url[1];
				$src = str_replace('.jpg', '-500x350.jpg', $src);
				$src = str_replace('.png', '-500x350.png', $src);

				$data[] = array(
					'imagen' => $src,
					'title' => get_the_title(),
					'date' => get_the_date(),
					'content' => substr($content, 0, 138),
					'id' => get_the_ID(),
					'link' => get_permalink(get_the_ID())
				);
			}
		}
		return Response::json($data);
	}

	public function nota ($id) {
		$args = array(
			'post_type' => 'post',
			'p' => $id
		);

		$the_query = new WP_Query( $args );

		if ( $the_query->have_posts() ){
			$data = array();
			while ( $the_query->have_posts() ){
				$the_query->the_post();

				$image_url = get_the_post_thumbnail( get_the_ID() );
				preg_match('/src=\"(.*?)\"/', $image_url, $url);
				$src = $url[1];
				/*$src = str_replace('.jpg', '-500x350.jpg', $src);
				$src = str_replace('.png', '-500x350.png', $src);*/

				$content = get_the_content();
				$content = str_replace("\r\n", "<br>", $content);
				$content = rtrim($content, "\x00..\x1F");
				$content = str_replace('&nbsp;', '', $content);

				$data[] = array(
					'imagen' => $src,
					'title' => get_the_title(),
					'date' => get_the_date(),
					'content' => $content,
					'id' => get_the_ID(),
					'link' => get_permalink(get_the_ID())
				);
			}
		}
		return Response::json($data[0]);
	}

	public function nota_formated ($id) {

	}

}
