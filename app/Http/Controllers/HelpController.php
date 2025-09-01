<?php

namespace App\Http\Controllers;

use App\Models\Help;
use App\Models\Task;
use Illuminate\Http\Request;

class HelpController extends Controller
{

	public function helps_student()
	{
		$student_id = auth()->id(); 
		$helps = Help::with("tasks", "teacher")->where("student_id", $student_id)->get();
		return view("projects.helps", compact("helps"));
	}


	

	public function helps_teacher()
	{
		$teacher_id = auth()->id(); 
		$helps = Help::with("tasks", "student")->where("teacher_id", $teacher_id)->get();
		return view("teacher.help_student", compact("helps"));
	}

	public function viewrepley(Task $task, Help $help)
	{


		$helps = Help::with("tasks", "student")->get();
		return view("teacher.repley", compact("helps", "task", "help"));
		  
	}

	public function repley(Request $request, Help $help)
	{
	    $help->update($request->only('response'));
	    return redirect("/helps-teacher");
	}


}
