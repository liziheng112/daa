<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class IndexController extends Controller
{
    public function index()
    {
        $redis = new \Redis();
        $redis->connect('127.0.0.1','6379');
        $redis->incr('num');
        $num = $redis->get('num');
        echo "目前访问次数:".$num."<br/>";
        $where = [];
        $data=DB::table('user')->where($where)->paginate(6);
        // dd($data);
        return view('index/index',['data'=>$data]);
    }
    public function add_do(Request $request)
    {
         $data=$request->except(['_token']);
         // dd($data);
         $res=DB::table('user')->insert($data);
         // dd($res);
         if ($res) {
            return redirect('/');
         }
    }

  
}
