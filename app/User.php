<?php

namespace App;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use App\Questions;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','fullname', 'email', 'password','birthdate','gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Questions()
    {
        return $this->hasMany('App\Questions');
    }
    public function friends()
    {
        return $this->belongsToMany('App\User','friends', 'user_id', 'user_id_to');
    }
    public function getUserId(string  $username){
        $userid= User::where('username',$username)->first()->id;
        return $userid;
    }
    public function showProfile(string $username){

        return $this->where('username',$username)->first()->questions;
    }
    public function setting (Request $request,$id){

        $this->where('id',$id)->update(['username'=>$request['username'],'fullname'=>$request['fullname'],
            'email'=>$request['email'],'password'=>Hash::make($request['password'])
            ]);

    }
    public function showPeople($id){
        $people = DB::table('users')
            ->select('users.*')
            ->leftJoin('friends', 'users.id', '=', 'friends.user_id_to')
            ->whereNull('friends.id')
            ->where('users.id','<>',$id)
            ->get();
        return $people;
    }
    public  function addFriend($userId,$friendId){
        return DB::insert('insert into `friends` (`user_id`, `user_id_to`) values (?, ?)', [$userId, $friendId]);
    }
    public function showFriends($id){
        $people = DB::select('SELECT * FROM users INNER JOIN friends  on users.id= friends.user_id_to 
              WHERE friends.id in (SELECT id FROM friends WHERE friends.user_id=?)',[$id]);
        return $people;
    }
}
