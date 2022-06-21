<?php

namespace App\Http\Controllers;

use App\Models\Variable;
use Illuminate\Http\Request;

class VariableController extends Controller
{
    public function add(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|unique:variables,name|max:100',
            'description' => 'required|max:255'
        ]);

        Variable::create($attr);

        return back();
    }

    public function update(Variable $var)
    {
        $attr = request()->validate([
            'description' => 'required|max:255'
        ]);

        $var->update($attr);

        return back();
    }

    public function list () {
        return view('admin.vars', ['vars' => Variable::orderBy('name')->get()]);
    }
}
