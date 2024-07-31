<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function index()
    {

        // Luego, retorna la vista con los datos necesarios
        return view('documents.index');
    }
}
