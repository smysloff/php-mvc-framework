<?php

declare(strict_types=1);

namespace app\controllers;

use smysloff\phpmvc\Application;
use smysloff\phpmvc\Controller;
use smysloff\phpmvc\Request;
use smysloff\phpmvc\Response;
use app\models\ContactForm;

/**
 * Class SiteController
 *
 * @author Alexander Smyslov <smyslov@selby.su>
 * @package app\controllers
 */
class SiteController extends Controller
{
    /**
     * @return string
     */
    public function home(): string
    {
        $params = [
            'name' => 'Мой Проект',
        ];
        return $this->render('home', $params);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return string|bool
     */
    public function contact(Request $request, Response $response): string|bool
    {
        $contact = new ContactForm();
        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->send()) {
                Application::$app->session->setFlash('success', 'Письмо успешно отправлено');
                return $response->redirect('/contact');
            }
        }
        return $this->render('contact', [
            'model' => $contact
        ]);
    }
}
