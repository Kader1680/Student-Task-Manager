<?php

namespace App\Http\Controllers;

use App\Models\Help;
use Illuminate\Http\Request;

class HelpController extends Controller
{

	public function all_helps()
	{
		$student_id = auth()->id(); 
		$helps = Help::with("tasks", "teacher")->where("student_id", $student_id)->get();
		return view("projects.helps", compact("helps"));
	}
}
