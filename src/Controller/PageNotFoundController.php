<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PageNotFoundController extends AbstractController {

    /**
     * @return RedirectResponse
     */
    public function pageNotFoundAction(): RedirectResponse{
        return $this->redirect('/');
    }
}
