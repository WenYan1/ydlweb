<?php
namespace app\controllers;

use Yii;

class HomeBaseController extends \yii\web\Controller {
	public function _popSuccessMessage() {
		$session = Yii::$app->session;
		if (!$session->isActive) {
			$session->open();
		}

		return $session->getFlash('success_message');
	}

	public function _setSuccessMessage($msg) {
		$session = Yii::$app->session;
		if (!$session->isActive) {
			$session->open();
		}

		$session->setFlash('success_message', $msg);
	}

	public function _popErrorMessage() {
		$session = Yii::$app->session;
		if (!$session->isActive) {
			$session->open();
		}

		return $session->getFlash('error_message');
	}

	public function _setErrorMessage($msg) {
		$session = Yii::$app->session;
		if (!$session->isActive) {
			$session->open();
		}

		$session->setFlash('error_message', $msg);
	}
}