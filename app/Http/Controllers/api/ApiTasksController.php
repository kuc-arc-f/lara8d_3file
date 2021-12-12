<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
//
class ApiTasksController extends Controller
{
  /**************************************
   *
   **************************************/
  public function __construct(){
    $this->TBL_LIMIT = 500;
  }
  /**************************************
   *
   **************************************/
  public function list(Request $request)
  {   
    $page = 1;
    $pageNo = $request->input("page"); 
    if(isset($pageNo)){
      $page = $pageNo;
    }    
    //var_dump($pageInfo);
    $items = Task::orderBy('id', 'desc')
    ->get();
    return response()->json($items);
  }
   /**************************************
   *
   **************************************/  
  public function create(Request $request){
    $task = new Task();
    $task->title   = request('title');
    $task->content = request('content');
    $task->save();
    $ret = ['title' => request('title'),'content' => request('content')];
    return response()->json($ret);
  }
  /**************************************
   *
   **************************************/
  public function show(Request $request)
  {
    $ret = array();
    $id = $request->input("id"); 
    if(isset($id)){
      $task = Task::find($id);
//var_dump($task);
      $ret = $task;
    }
    return response()->json($ret);
  }   
  /**************************************
   *
   **************************************/
  public function update(Request $request){
    $task = Task::find(request('id'));
    $task->title   = request('title');
    $task->content = request('content');
    $task->save();
    $ret = ['id'=> request('id')];
//    $request->session()->flash('flash_message_success', 'Sucsess, save item');
    return response()->json($ret);
  }
  /**************************************
   *
   **************************************/
  public function delete(Request $request){
    $task = Task::find(request('id'));
    $task->delete();
    $ret = ['id'=> request('id') ];
//  $request->session()->flash('flash_message_success', 'Sucsess, delete item');
    return response()->json($ret);
  }
  
}
