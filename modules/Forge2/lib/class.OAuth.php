<?php

class OAuth{

	public static function validToken(\ApiResponse $response){
		
		$params = $response->getParams();

		if(!empty($params['token'])){
			$oauthToken = new OAuthToken();
			$tokens = OrmCore::findByIds($oauthToken, array($params['token']));
			if(count($tokens) == 0){
				$response->setCode(401);
				$response->setMessage("Unauthorized token");
			} else {
				$response->setCode(200);
				$response->setMessage("ok");
			}
		} else {
			$response->setCode(401);
			$response->setMessage("Unauthorized no token");
		}

		return $response;
	}

	public static function validOAuth(\ApiResponse $response){

		$params = $response->getParams();

		if(!empty($params['user']) && !empty($params['pass'])){
			$user = new OAuthUser();
			$example = new OrmExample();
			$example->addCriteria('name', OrmTypeCriteria::$EQ, array($params['user']));
			$users = OrmCore::findByExample($user, $example);
			if(count($users) == 0) {
				$response->setCode(401);
				$response->setMessage("Unauthorized login");
			} else {
				$user = $users[0];
				$values = $user->getValues();
				if($values['password'] == sha1(sha1($params['pass']).$values['salt'])){
					$oauthToken = new OAuthToken();
					$example = new OrmExample();
					$example->addCriteria('user_name', OrmTypeCriteria::$EQ, array($params['user']));
					OrmCore::deleteByExample($oauthToken, $example);
					
					$dt = Time();
					$token = sha1(mt_rand().$dt);
					$oauthToken->set('token', $token);
					$oauthToken->set('user_name', $params['user']);
					$oauthToken->set('dt', $dt);
					$oauthToken->save();

					$response->setCode(200);
					$response->setMessage("ok");
					$response->setContent(array('token' => $token));
				} else {
					$response->setCode(401);
					$response->setMessage("Unauthorized password");
				}
			}
		} else {
			$response->setCode(400);
			$response->setMessage("Bad Request");
		}

		return $response;
	}
}