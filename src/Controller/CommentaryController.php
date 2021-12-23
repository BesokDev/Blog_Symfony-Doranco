<?php

namespace App\Controller;

use App\Entity\Commentary;
use App\Form\CommentaryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class CommentaryController extends AbstractController
{
    /**
     * @param Request $request
     */
    public function addComment(Request $request)
    {
        $commentary = new Commentary();

        $form = $this->createForm(CommentaryType::class, $commentary)
            ->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                
        } // end if

        return $this->render('rendered/form_commentary.html.twig', [
            'form' => $form->createView()
        ]);
    } // end function

} // end class