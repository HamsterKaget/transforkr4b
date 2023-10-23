<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardKelasController extends Controller
{
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        return view('web.backend.sections.admin.master-kelas.index');

    }

    public function getData(Request $request)
    {
        $query = Kelas::query();

        if ($request->search) {
            $query->where('name', 'LIKE', "%" . $request->search . "%");
        }

        $data = $query->orderBy('updated_at', 'desc') // Order by updated_at in descending order
                    ->orderBy('created_at', 'desc') // Then order by created_at in descending order
                    ->paginate(7);

        return response()->json($data, 200);
    }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'slug' => 'required',
    //         'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:5120',
    //     ]);

    //     // Handle file upload
    //     if ($request->hasFile('logo')) {
    //         $file = $request->file('logo');
    //         $filename = time() . '_' . $file->getClientOriginalName();

    //         // Store the file in the 'public' disk under the 'logo' directory
    //         $path = Storage::disk('public')->putFileAs('logo', $file, $filename);
    //     } else {
    //         $filename = null; // No file uploaded
    //     }

    //     $data = new Kelas([
    //         'name' => $request->input('name'),
    //         'slug' => $request->input('slug'),
    //         'logo' => $filename,
    //     ]);

    //     $data->save();

    //     return response()->json($data, 200);
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required|exists:categories,id',
    //         'name' => 'required',
    //         'slug' => 'required',
    //         'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:5120',
    //     ]);

    //     $data = Kelas::find($request->input('id'));


    //     // Handle file upload
    //     if ($request->hasFile('logo')) {
    //         $file = $request->file('logo');
    //         $filename = time() . '_' . $file->getClientOriginalName();

    //         // Store the file in the 'public' disk under the 'logo' directory
    //         $path = Storage::disk('public')->putFileAs('logo', $file, $filename);
    //         $data->name = $request->input('name');
    //         $data->slug = $request->input('slug');
    //         $data->logo = $filename;
    //     } else {
    //         $filename = null; // No file uploaded
    //         $data->name = $request->input('name');
    //         $data->slug = $request->input('slug');
    //     }
    //     $data->save();

    //     return response()->json($data, 200);
    // }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $data = new Kelas([
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

        $data = Kelas::find($request->input('id'));


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
            $data = Kelas::findOrFail($request->id);
            $data->delete();
            return response()->json(['message' => 'Kelas deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e], 500);
        }
    }
}
