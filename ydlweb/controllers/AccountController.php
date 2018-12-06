<?php

namespace app\controllers;

use app\controllers\HomeBaseController;
use app\models\Users;
use Salt;
use Tool;
use Yii;
use yii\filters\AccessControl;

class AccountController extends HomeBaseController {

	public function behaviors() {
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['index'],
				'rules' => [
					// 允许认证用户
					[
						'allow' => true,
						'roles' => ['@'],
					],
					// 默认禁止其他用户
				],
			],
		];
	}
	public function actionIndex() {
		$session = Yii::$app->session;
		if (!$session->isActive) {
			$session->open();
		}

		$usersModel = new Users;
		$usersModel = $usersModel->findById($session['uid']);
		$customServer = $usersModel->customServer;
		if ($usersModel) {
			$request = Yii::$app->request;
			$act = $request->get('act');
			if ($act) {
				// 重置密码
				return $this->render('forget_password2');
			} else {
				// 个人中心
				return $this->render('personal_account', ['user' => $usersModel,'customServer'=>$customServer]);
			}
		} else {
			// 异常流,session过期
			return Tool::outputError("登录失效,请重新登录");
		}
	}

	public function actionResetPassword() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;

		if (!$session->isActive) {
			$session->open();
		}

		$usersModel = new Users;
		$usersModel = $usersModel->findById($session['uid']);

		if ($request->isPost) {
			$oldPassword = $request->post('oldPassword');
			$password = $request->post('newPassword');
			$passwordVerify = $request->post('verifyPassword');
			$reallyPassword = $usersModel->password;

			$tmphash = Salt::vertifySalt($oldPassword, $usersModel->salt);
			$isPass = $tmphash == $usersModel->password ? true : false;
			if ($isPass) {
				if ($password === $passwordVerify) {
					$hash = Salt::generateSalt($password);
					$lastPassword = $hash['password'];
					$salt = $hash['salt'];
					$isSuccess = $usersModel->resetPassword($lastPassword, $salt, $usersModel->email, $message);
					if ($isSuccess) {
						return Tool::outputError($message);
					} else {
						return Tool::outputError($message);
					}
				} else {
					// 两次密码不对
					return Tool::outputError("两次输入密码不同");
				}
			} else {
				// 密码不正确
				return Tool::outputError("密码不正确");
			}
		}
	}

	public function actionResetTelephone() {
		$request = Yii::$app->request;
		$session = Yii::$app->session;

		if (!$session->isActive) {
			$session->open();
		}

		$usersModel = new Users;
		$usersModel = $usersModel->findById($session['uid']);
		if ($request->isPost) {
			$oldTelephone = $request->post('telephone');

			$usersModel->phone = $oldTelephone;
			$usersModel->update();
			return Tool::outputSuccess("修改成功");
		}
	}
}
