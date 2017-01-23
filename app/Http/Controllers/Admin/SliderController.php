<?php

namespace larashop\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use larashop\Http\Controllers\Controller;
use larashop\Sliders;
use Validator;

class SliderController extends Controller
{
    public function sliders()
    {
        $sliders = Sliders::all();
        foreach ($sliders as $key => $slider) {
            $sliders[$key]->data = unserialize($slider->data);
        }
//        return dd($sliders);
        return view('admin.content.sliders.sliders', ['sliders' => $sliders]);
    }

    public function create()
    {
        return view('admin.content.sliders.slidersCreate');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255',
            'description' => 'required|min:2|max:255',
            'type' => 'required',
            'identificator' => 'required',
            'height' => 'required|integer',
            'width' => 'required|integer',
        ]);
        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {


            $data = [];
            if ($request->file('images')[0]) {
                foreach ($request->file('images') as $image) {
                    $link = '';
                    foreach ($request->links as $item) {
                        $link = $item;
                    }
                    $saveimage = Image::make($image)->fit($request->width, $request->height);
                    $string = str_random(40);
                    $extension = $image->getClientOriginalExtension();
                    $saveimage->save('files/sliders/' . $string . '.' . $extension);
                    $data[] =
                        [
                            'image' => $string . '.' . $extension,
                            'link' => $link
                        ];
                }
            }

            $data = serialize($data);

            $slider = new Sliders();
            $slider->name = $request->name;
            $slider->description = $request->description;
            $slider->identificator = $request->identificator;
            $slider->type = $request->type;
            $slider->data = $data;
            $slider->height = $request->height;
            $slider->width = $request->width;
            $slider->save();

            return redirect(url('admin/content/sliders'));


        }
    }

    public function edit($id)
    {
        $slider = Sliders::find($id);
        $slider->data = unserialize($slider->data);
//        return dd($slider->data);
        return view('admin.content.sliders.slidersEdit', ['slider' => $slider]);
    }

    public function update(Request $request, $id)
    {

        $slider = Sliders::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255',
            'description' => 'required|min:2|max:255',
            'type' => 'required',
            'identificator' => 'required',
            'height' => 'required|integer',
            'width' => 'required|integer',
        ]);
        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {

            $data = [];


            if (isset($request->file('images')[0])) {
                foreach ($request->file('images') as $image) {
                    $link = '';
                    if (isset($request->links[0])) {
                        foreach ($request->links as $item) {
                            $link = $item;
                        }
                    }
                    $saveimage = Image::make($image)->fit($request->width, $request->height);
                    $string = str_random(40);
                    $extension = $image->getClientOriginalExtension();
                    $saveimage->save('files/sliders/' . $string . '.' . $extension);
                    $data[] =
                        [
                            'image' => $string . '.' . $extension,
                            'link' => $link
                        ];
                }
            }

            if (isset($request->images_old[0])) {
                foreach ($request->images_old as $image) {
                    $link = '';
                    if (isset($request->links_old[0])) {
                        foreach ($request->links_old as $item) {
                            $link = $item;
                        }
                    }
                    $data[] =
                        [
                            'image' => $image,
                            'link' => $link
                        ];
                }
            }


            $data = serialize($data);


            $slider->name = $request->name;
            $slider->description = $request->description;
            $slider->identificator = $request->identificator;
            $slider->type = $request->type;
            $slider->data = $data;
            $slider->height = $request->height;
            $slider->width = $request->width;
            $slider->save();

            return redirect(url('admin/content/sliders'));
        }
    }
}
