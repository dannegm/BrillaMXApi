<?php

class IndexController extends BaseController{

/*
* ----------------------------------
*  MICROSITIO
* ----------------------------------
*/

	public function micrositio(){
		return View::make('micrositio');
	}

/*
* ----------------------------------
*  SINGLE USER
* ----------------------------------
*/
	public function user($fbid){
		$user = User::whereFbid($fbid)->with('fieldaction')->with('achievement')->get();
		if($user->isEmpty()){
			$error = array(
				'error' => 1
			);
			return Response::json($error);
		}else{
			return Response::json($user[0]);
		}
	}
	
	public function register(){
		$user = User::whereFbid(Input::get('fbid'))->get();

		if($user->isEmpty()){
			$user = new User;
			$user->fbid = Input::get('fbid');
			$user->twid = Input::get('twid');
			$user->name = Input::get('name');
			$user->email = Input::get('email');
			$user->fieldaction_id = Input::get('fieldaction_id');
			$user->gender = Input::get('gender');
			$user->age = Input::get('age');
			$user->bio = '...';
			$user->save();

			$user = User::whereFbid(Input::get('fbid'))->with('fieldaction')->get();
			return Response::json($user);
		}else{
			return Response::json($user);
		}
	}

	public function addTwitter($fbid){
		$twiterID = Input::get('twid');
		DB::table('users')
            ->where('fbid', $fbid)
            ->update(array('twid' => $twiterID));

		$user = User::whereFbid($fbid)->with('fieldaction')->get();
		return Response::json($user);
	}

	public function addPoints($fbid){
		$user = User::where('fbid', '=', $fbid)->get();
		DB::table('users')
            ->whereFbid($fbid)
            ->increment('points', Input::get('points'));

		$user = User::whereFbid($fbid)->with('fieldaction')->get();
		return Response::json($user);
	}

	public function landingSelfie($idSelfie){
		$selfie = Selfie::where('id', '=', $idSelfie)->with('engagement')->with('user')->get();

		if($selfie->isEmpty()){
			$error = array(
				'error' => 1
			);
			return Response::json($error);
		}else{
			return Response::json($selfie[0]);
		}
	}

	public function getSelfie($idSelfie){
		$selfie = Selfie::where('id', '=', $idSelfie)->with('engagement')->with('user')->get();

		if($selfie->isEmpty()){
			return Redirect::route('index');
		}else{
			$data = array(
				'title' => 'Brilla México',
				'selfie' => $selfie
			);
			return View::make('foto', $data);
		}
	}

	public function getSelfies($fbid){
		$selfies = Selfie::where('user_id', '=', $fbid)
			->OrderBy('id', 'desc')
			->take(30)
			->with('engagement')
			->with('user')
			->get();

		if($selfies->isEmpty()){
			$error = array(
				'error' => 1
			);
			return Response::json($error);
		}else{
			return Response::json($selfies);
		}
	}

	public function uploadSelfie($fbid){
		$up = Input::hasFile('picture');
		$status = array();
		if($up){

			//coordenada x
			$x = 0;

			//coordenada y
			$y = 0;

			//width
			//$width = Input::get('width');

			//height
			//$height = Input::get('height');

			//guardamos la imágen en una variabñe
			$image = Input::file('picture');
			$deg = Input::get('deg');
			$deg = isset($deg) ? $deg : 0;

			//obtenemos el md5
			$md5 = md5_file($image);

			//traemos la extensión
			$ext = $image->getClientOriginalExtension();

			//generamos el nombre de la imagen
			$filename = $md5.'.'.$ext;

			//se mueve la imágen a la carpeta pictures
			$image->move('pictures', $filename);

			//obtenemos la url de la imágen
			$fileUrl = URL::asset('pictures/'.$filename);
			$fileUrlThumb = URL::asset('pictures/m/'.$filename);

			//obtenemos root de imágen
			$file = public_path('pictures/'.$filename);

			//traemos tamaño
			list($w, $h) = getimagesize($file);

			//asignamos las carpetas a variables
			$path = public_path('pictures/'.$filename);
			$pathThumb = public_path('pictures/thumb/'.$filename);

			//creamos la imágen
			if($w > $h){
				$width = $h;
				$height = $h;
			}else if($h > $w){
				$width = $w;
				$height = $w;
			}else{
				$width = $w;
				$height = $h;
			}

			$img = Image::make($file)->crop($width, $height, 0, 0);
			$img = Image::make($img)->rotate(-$deg);

			//id de compromiso
			$engagement = Input::get('engagement_id');

			//redimensiones a todos tamaños de carpetas y
			Image::make($img)->resize(512, 512)->insert('img/'.$engagement.'.png')->save($path);
			Image::make($img)->resize(128, 128)->save($pathThumb);

			$selfie = Selfie::wherePicture($filename)->first();

			if(is_null($selfie)){
				//insertamos la imagen en la bd
				$selfie = new Selfie;
				$selfie->user_id = $fbid;
				$selfie->engagement_id = $engagement;
				$selfie->picture = $filename;
				$selfie->description = Input::get('description');
				$selfie->save();

				//obtenemos el id
				$id = $selfie->id;

				$selfie = Selfie::find($id);
				return Response::json($selfie);
			}else{
				return Response::json($selfie);
			}
		}else{
			//si la imagen no sube guardamos el error
			$status = array(
				'status' => 'error',
				'time'=> array(
					'time' => time()
				),
				'error' => 'error',
				'pic' => 'error'
			);
			return Response::json($status);
		}
	}

	public function addLogro($fbid){
		$userFbid = User::where('fbid', '=', $fbid)->first();

		$attach = DB::table('achievement_user')->where('user_id', $userFbid->id)->where('achievement_id', Input::get('logro'))->first();

		if(is_null($attach)){
			$user = User::find($userFbid->id);
			
			$user->achievement()->detach(Input::get('logro'));
			$user->achievement()->attach(Input::get('logro'));

			$status = array(
				'status' => 'success'
			);

			$logro = Achievement::find(Input::get('logro'));
			$puntos = $logro->points_for_achievement;

			DB::table('users')
				->where('fbid', '=', $fbid)
				->increment('points', $puntos);

			return Response::json($status);
		}else{
			$status = array(
				'error' => 'error',
				'msg' => 'El logro ya existe'
			);
			return Response::json($status);
		}
	}

	public function editUser($fbid){
		$new_name = Input::get('name');
		$new_bio = Input::get('bio');
		DB::table('users')
            ->where('fbid', $fbid)
            ->update(array('name' => $new_name, 'bio' => $new_bio));
		
		$user = User::whereFbid($fbid)->with('fieldaction')->get();
		return Response::json($user);
	}

	public function deleteUser($fbid){
		$user = User::where('fbid', '=', $fbid)->get();
		$id = $user[0]->id;
		try {
			DB::table('selfies')->where('user_id', '=', $fbid)->delete();
			DB::table('users')->where('fbid', '=', $fbid)->delete();
			DB::table('achievement_user')->where('user_id', '=', $id)->delete();

			$status = array(
				'status' => 'success'
			);
		}catch(\Exception $e){
			$status = array(
				'status' => 'error',
				'error' => 'No ha sido posible borrar al usuario'
			);
		}
		return Response::json($status);
	}

	public function addShare($fbid){
		$share = Input::get('share');
		DB::table('users')
			->where('fbid', $fbid)
			->increment('shares');

		$user = User::whereFbid($fbid)->with('fieldaction')->get();
		return Response::json($user);
	}

/*
* ----------------------------------
*  USERS
* ----------------------------------
*/

	public function users(){
		$users = User::with('fieldaction')->get();

		return Response::json($users);
	}

	public function leaderBoard($fieldaction){
		$users = User::where('fieldaction_id', '=', $fieldaction)->with('fieldaction')->take(30)->OrderBy('points', 'desc')->get();

		return Response::json($users);
	}

	public function getAllSelfies(){
		$selfies = Selfie::OrderBy('id', 'desc')->with('user')->take(30)->get();

		return Response::json($selfies);
	}

	public function getLeaders(){
		$users = User::OrderBy('points', 'desc')->take(10)->get();

		return Response::json($users);
	}
}

?>