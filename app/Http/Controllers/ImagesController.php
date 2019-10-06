<?php

namespace App\Http\Controllers;

use App\Film;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arResult['images'] = Image::all();
        $arResult['films'] = Film::all();
        return view('admin.image.index', $arResult);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'images' => 'required',
        ]);

        foreach ($request->file('images') as $file) {
                $image = new Image;
                $image->link = $file->store('images', 'public');
                $image->name = $request->name;
                $image->save();
                DB::table('film_image')->insert(['film_id' => $request->film_id, 'image_id' => $image->id]);
        }
        return redirect()->route('images.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Image $image
     * @return string
     */
    public function show(Image $image)
    {
        return '<img class="img-fluid" src="' . asset('/storage/' . $image->link) . '" alt="">';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'film_id' => 'required|integer',
        ]);
        DB::table('film_image')->where('image_id', $id)->update(['film_id'=>$request->film_id]);
        return redirect()->route('images.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Image $image
     * @return void
     * @throws \Exception
     */
    public function destroy(Image $image)
    {
        $arLink = explode('/', $image->link);
        $name = $arLink[count($arLink) - 1];
        //dd($name);
        Storage::delete('/public/images/' . $name);
        $image->delete();
        DB::table('film_image')->where('image_id', $image->id)->delete();
        return redirect()->route('images.index');
    }
}
