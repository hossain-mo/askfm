<?php

namespace App\Http\Controllers;


use App\Questions;
use App\User;
use Illuminate\Http\Request;
use Symfony\Component\Console\Question\Question;

class QuestionController extends Controller
{
    /**
     * @param Request $request
     * @param User $user
     */
    private $quest;
    public function create(Request $request,int $userid)
    {   $this->quest=new Questions();
        $this->quest->createOne($request['content'],$userid);
    }
    public function replay(Request $request,int $id)
    {
        $this->quest=new Questions();
        $this->quest->addReplay($request['content'],$id);
    }
}