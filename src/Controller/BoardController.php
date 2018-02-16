<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Board;
use App\Form\BoardType;

class BoardController extends Controller
{
    /**
     * Display a listing of the Board resource.
     * @Route("/", name="board_list")
     */
    public function index()
    {
        $boards = $this->getDoctrine()
            ->getRepository(Board::class)
            ->findAll();

        return $this->render('boards/index.html.twig',
            array('boards' => $boards)
        );
    }

    /**
     * Display creating new Board form
     * @Route("/board/new", name="board_new")
     */
    public function create(Request $request)
    {
        $board = new Board();
        $form = $this->createForm(BoardType::class, $board);
        $form = $form->handleRequest($request);
        if ($this->submitForm($form)) {
            return $this->redirectToRoute('board_list');
        }

        return $this->render('boards/new.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * @Route("/boards/{id}/update", name="board_update")
     */
    public function update(Request $request, Board $board)
    {
        if (!$board) {
            throw $this->createNotFoundException(
                'No Board found for id '.$id
            );
        }
        $form = $this->createForm(BoardType::class, $board);
        $form = $form->handleRequest($request);
        if ($this->submitForm($form)) {
            return $this->redirectToRoute('board_list');
        }

        return $this->render('boards/edit.html.twig',
            array(
                'form' => $form->createView(),
                'board' => $board
            )
        );
    }


    /**
     * @Route("/boards/{id}/delete", name="board_delete")
     */
    public function delete(Board $board)
    {
        if (!$board) {
            throw $this->createNotFoundException(
                'No Board found for id '.$id
            );
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($board);
        $em->flush();
        return $this->redirectToRoute('board_list');
    }

    private function submitForm($form)
    {
        if ($form->isSubmitted() && $form->isValid()) {
            $board = $form->getData();
            $this->process($board);
            return true;
        }
        return false;
    }

    private function process(Board $board)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($board);
        $em->flush();
    }
}
