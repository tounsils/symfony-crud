<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Board;

class BoardController extends Controller
{
    /**
     * Display a listing of the Board resource.
     * @Route("/boards", name="board_list")
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
     * @Route("/board/new", name="board_new")
     */
    public function create()
    {
      # code...
    }

    public function store($value='')
    {
      # code...
    }

    /**
     * @Route("/boards/{id}/edit", name="board_edit")
     */
    public function edit($id)
    {
      # code...
    }

    public function update($value='')
    {
      # code...
    }

    /**
     * @Route("/boards/{id}/delete", name="board_delete")
     */
    public function destroy($id)
    {
      # code...
    }

    public function process($value='')
    {
      # code...
    }
}
