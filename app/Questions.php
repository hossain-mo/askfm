<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Questions extends Model
{

    //
    public function createOne($content,$user_id){
        $this->user_id=$user_id;
        $this->content=$content;
        $this->replay='';
        $this->save();
    }
    public function addReplay($content,$id){
        $this->replay=$content;
        $this->where('id',$id)->update(['replay' => $this->replay]);
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
