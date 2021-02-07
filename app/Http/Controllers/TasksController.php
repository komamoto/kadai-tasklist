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
        $tasks=Task::all();
        
        //viewに下記を送り込む。
        return view('Tasks.index',[
            'tasks'=>$tasks,]);
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
            'task'=>$task,]);
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
        $task=new Task;
        
        $task->content=$request->content;
        $task->status=$request->status;
        $task->save();
        
        return redirect('/');
        
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
        $task=Task::findOrFail($id);
        
        return view('Tasks.show',[
            'task'=>$task,]);
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

        // メッセージ編集ビューでそれを表示
        return view('Tasks.edit', [
            'task' => $task,
        ]);
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
        // idの値でメッセージを検索して取得
        $tasks = Task::findOrFail($id);
        // メッセージを更新
        $tasks->content = $request->content;
        $tasks->status=$request->status;
        $tasks->save();

        // トップページへリダイレクトさせる
        return redirect('/');
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
        $tasks = Task::findOrFail($id);
        // メッセージを削除
        $tasks->delete();

        // トップページへリダイレクトさせる
        return redirect('/');
    }
}
