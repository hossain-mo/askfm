<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator ;
class UserController extends Controller
{
    private $user;
    public function signup(Request $request){
        $this->user=new \App\User();
        $validator = Validator::make($request->all(),[
            'username'=>'bail|required|string',
            'email' => 'bail|required|email',
            'fullname' =>'bail|required|alpha_num',
            'password' => 'bail|required|alpha_num',
            'birthdate' => 'bail|required|date',
        ]);
        if ($validator->fails()) {
            return redirect('/error')
                ->withErrors($validator)
                ->withInput();
        }

        $this->user->fillable($request->all());
        $result=$this->user->signup();
        if($result)
            return redirect('/dashboard');
        else
            return redirect('/welcome');
    }
    public function signin(Request $request){
        $this->user=new \App\User();
        $validator = Validator::make($request->all(),[
            'email' => 'bail|required|email',
            'password' => 'bail|required|alpha_num',

        ]);
        if ($validator->fails()) {
            return redirect('/error')
                ->withErrors($validator)
                ->withInput();
        }
        $this->user->fillable($request->all());
        $result=$this->user->signin();
        if($result)
            return redirect('/dashboard');
        else
            return redirect('/error');

    }
    public function showProfile($username=null){
        $this->user=new User();
        if(Auth::user())
        $username=Auth::user()->username;
        try
        {
            return view('profile',['user'=>$username,'questions'=>$this->user->showProfile($username)
                ,'people'=>$this->showPeoples()]);

        }catch (\Exception $e){
            return redirect('/error');
        }
    }
    public function AskQuestion(Request $request){
        $this->user=new User();
        $Ques=new QuestionController();
        try {
            $Ques->create($request, $this->user->getUserId($request['username']));
            $path='/'.$request['username'];
            return redirect($path);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    public function replay(Request $request){
        $this->user=new User();
        $Ques=new QuestionController();
        try {
            $Ques->replay($request, $request['id']);
            $path='/'.$request['username'];
            return redirect($path);
        }catch (\Exception $e){
            return redirect('error');
        }
    }
    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
    public function setting(Request $request){
        $val=$this->validator($request);
        if ($val->fails()) {
            return redirect('/error')
                ->withErrors($val)
                ->withInput();
        }
        $this->user=new User();
        $this->user->setting($request,Auth::id());
        return redirect('profile');
    }
    public  function showPeoples(){
        $this->user=new User();
        return $this->user->showPeople(Auth::id());
    }
    public function addFriend(Request $request){
        $this->user=new User();
        $this->user->addFriend(Auth::id(),$request['id']);
        return redirect('profile');
    }
    public function showFriends(){
        $this->user=new User();
       return view('friends',[ 'friends'=>$this->user->showFriends(Auth::id())]);
    }

}
