<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use Illuminate\Http\JsonResponse; 
use Illuminate\Http\Request;

class ProjectController extends Controller
{
 
    public function create(): JsonResponse
    {
        $employees = Employee::all();
        return response()->json($employees);
    }
}

