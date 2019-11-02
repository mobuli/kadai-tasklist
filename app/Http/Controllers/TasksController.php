<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Task;

class TasksController extends Controller
{

    public function __construct(Request $request){
        $this->middleware('checkUser');
    }

    public function index()
    {

        $data = [];
        if (Auth::check()) {

            $user = Auth::user();

            //$tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
            $tasks = $user->tasks()->where('user_id',$user->id)->orderBy('created_at','desc')->paginate(4);

            return view('tasks.index', [
                'user' => $user,
                'tasks' => $tasks,
            ]);

        }

        return view('welcome', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $taks = new Task;

        return view('tasks.create', [
            'task' => $taks,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'content' => 'required|max:191',
            'status' => 'required|max:10',
        ]);

        $request->user()->tasks()->create([
            'content' => $request->content,
            'status'  => $request->status,
        ]);

        return redirect()->route('tasks.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        session(['back_url' => url()->previous() ]);

        return view('tasks.show', [
            'task' => Task::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $taks = Task::find($id);

        return view('tasks.edit', [
            'task' => $taks,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'content' => 'required|max:191',
            'status' => 'required|max:10',
        ]);

         $taks = Task::find($id);
         $taks->content = $request->content;
         $taks->status = $request->status;
         $taks->save();

         if (session()->has('back_url')){
             $back_url = session('back_url');
             session()->forget('back_url');
             return redirect($back_url);
         }else{
             return redirect()->route('tasks.index');
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $task = Task::find($id);

        if (Auth::id() === $task->user_id) {
            $task->delete();
        }

        return redirect()->route('tasks.index');
    }

}
