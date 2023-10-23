<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class DashboardJurusanController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        return view('web.backend.sections.admin.master-jurusan.index');

    }

    public function getData(Request $request)
    {
        $query = Jurusan::query();

        if ($request->search) {
            $query->where('name', 'LIKE', "%" . $request->search . "%");
        }

        $data = $query->orderBy('updated_at', 'desc') // Order by updated_at in descending order
                    ->orderBy('created_at', 'desc') // Then order by created_at in descending order
                    ->paginate(7);

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = new Jurusan([
            'name' => $request->input('name'),
        ]);

        $data->save();

        return response()->json($data, 200);
    }


    public function update(Request $request)
    {
        // dd($request);
        $request->validate([
            'id' => 'required|exists:kelas,id',
            'name' => 'required',
        ]);

        $data = Jurusan::find($request->input('id'));


        $data->name = $request->input('name');
        $data->save();

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        try {
            $data = Jurusan::findOrFail($request->id);
            $data->delete();
            return response()->json(['message' => 'Jurusan deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }
}
