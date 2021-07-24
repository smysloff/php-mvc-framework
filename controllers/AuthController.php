<?php

declare(strict_types=1);

namespace app\controllers;

use smysloff\phpmvc\Application;
use smysloff\phpmvc\Controller;
use smysloff\phpmvc\middlewares\AuthMiddleware;
use smysloff\phpmvc\Request;
use smysloff\phpmvc\Response;
use app\models\LoginForm;
use app\models\User;

/**
 * Class AuthController
 *
 * @author Alexander Smyslov <smyslov@selby.su>
 * @package app\controllers
 */
class AuthController extends Controller
{
    /**
     * AuthController constructor
     */
    public function __construct()
    {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return string|bool
     */
    public function login(Request $request, Response $response): string|bool
    {
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());
            if ($loginForm->validate() && $loginForm->login()) {
                return $response->redirect('/');
            }
        }
        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm,
        ]);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function register(Request $request): string
    {
        $user = new User();

        if ($request->isPost()) {
            $user->loadData($request->getBody());

            if ($user->validate() && $user->save()) {
                Application::$app->session->setFlash('success', 'Thanks for registering');
                Application::$app->response->redirect('/');
            }
        }
        $this->setLayout('auth');

        return $this->render('register', [
            'model' => $user,
        ]);
    }

    /**
     * @param Request $request
     * @param Response $response
     */
    public function logout(Request $request, Response $response): void
    {
        Application::$app->logout();
        $response->redirect('/');
    }

    /**
     * @return string
     */
    public function profile(): string
    {
        Application::$app->view->title = 'Профиль';
        return $this->render('profile');
    }
}
