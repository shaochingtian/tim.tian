<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function info($id){
        //用控制器调用模型
        return Member::getMember(); //模型名：：方法名
        #return 'MemberController info id is: '.$id;
        # route('Memberinfo'); //使用路由别名
        return view('member.memberinfo',[
            'name'=>'tsq',
            'age'=>19
        ]);  //优先找blade，如果没有再找memberinfo.php


    }
}
