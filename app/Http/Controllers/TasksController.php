<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     // getでmessages/にアクセスされた場合の「一覧表示処理」
    public function index()
    {
        
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            $tasks=$user->tasks()->orderBy('created_at','desc')->paginate(25);
            return view('Tasks.index',[
                'tasks'=>$tasks]);
        }
        // メッセージ一覧ビューでそれを表示
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     // getでmessages/createにアクセスされた場合の「新規登録画面表示処理」
    public function create()
    {
        $task=new Task;
    
        return view('Tasks.create',[
            'task'=>$task,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     
     // postでmessages/にアクセスされた場合の「新規登録処理」
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'status'=>'required|max:10',
         ]);
         
         // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $request->user()->tasks()->create([
            'content' => $request->content,
            'status'=>$request->status,
        ]);
         // 前のURLへリダイレクトさせる
        //return back();
        return redirect('/');
        // $task=new Task;
        // $task->content=$request->content;
        // $task->status=$request->status;
        // $task->save();
    }
         

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
     // getでmessages/（任意のid）にアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        // idの値でユーザを検索して取得
        $task=Task::findOrFail($id);
       if(\Auth::id() ===$task->user_id){
           return view('Tasks.show',[
            'task'=>$task,
        ]);
        }
        // トップページへリダイレクトさせる
        return redirect('/');
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
     // getでmessages/（任意のid）/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
        if(\Auth::id() ===$task->user_id){
            // メッセージ編集ビューでそれを表示
            return view('Tasks.edit', [
            'task' => $task,
        ]);
        }
        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
     // putまたはpatchでmessages/（任意のid）にアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        $request->validate([
            'status'=>'required|max:10',
        ]);
        
        // idの値でメッセージを検索して取得
        $tasks = Task::findOrFail($id);
        // メッセージ編集ビューでそれを表示
        if(\Auth::id() ===$tasks->user_id){
            // メッセージを更新
            $tasks->content = $request->content;
            $tasks->status=$request->status;
            $tasks->save();
            // トップページへリダイレクトさせる
            return redirect('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
     // deleteでmessages/（任意のid）にアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        // idの値でメッセージを検索して取得
        $task= \App\Task::findOrFail($id);
        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を削除
        if(\Auth::id() ===$task->user_id){
            $task->delete();
        }
        
        // トップページへリダイレクトさせる
        return redirect('/');
        // return back();
        
        // idの値でメッセージを検索して取得
        //$tasks=Task::findOrFail($id);
        // idの値でメッセージを検索して取得
        //$tasks->delete();
        // トップページへリダイレクトさせる
        //return redirect('/');
    }
}
