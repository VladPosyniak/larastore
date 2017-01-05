<?php

namespace larashop\Http\Controllers\Admin;

use Illuminate\Http\Request;

use larashop\ClassDescription;
use larashop\Classes;
use larashop\Http\Requests;
use larashop\Http\Controllers\Controller;
use larashop\Language;
use larashop\Purchase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Image;
use File;
class ClassController extends Controller
{
    public function indexClass()
    {

        //

        $classes = Classes::orderBy('sort_id', 'asc')->get();
        $languages = Language::all();

        $data = ['classes' => $classes, 'NewOrderCounter' => Purchase::Neworders()->count(),'languages' => $languages];

        return view('admin.content.classes')->with($data);
    }

    public function createClass()
    {

        $languages = Language::all();
        $data = ['NewOrderCounter' => Purchase::Neworders()->count(),'languages' => $languages];

        return view('admin.content.classCreate')->with($data);
    }

    public function editClass($id)
    {

        //
        $class = Classes::findOrFail($id);
        $data = ['class' => $class, 'NewOrderCounter' => Purchase::Neworders()->count()];
        return view('admin.content.classEdit')->with($data);
    }

    public function updateClass(Request $request, $id)
    {

        $class = Classes::findOrFail($id);

//        if (isset($cat->cover)) {
//            File::delete('files/cats/img/' . $cat->cover);
//        }

        $cover = $request->file('cover');

        //dd(Input::file());
        isset($cover) ? $extension = $cover->getClientOriginalExtension() : null;

        //$extension = $cover->getClientOriginalExtension();

        $validator = Validator::make($request->all(), ['name' => 'required|min:2|max:255',
            'description' => 'required|min:2|max:255',
            'urlhash' => 'required|min:2|max:255',
            'cover' => 'mimes:jpeg,bmp,png',
            'title' => 'required',
            'keywords' => 'required'
        ]);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {
            $coverdb = $class->cover;
            if (isset($cover)) {
                $img = Image::make($cover);

                // resize image
                $img->fit(200, 200);

                // save image
                $string = str_random(40);
                $img->save('files/classes/img/' . $string . '.' . $extension);

                $coverdb = $string . '.' . $extension;
            }
            $arr = array(
                'name' => $request->name,
                'description' => $request->description,
                'cover' => $coverdb,
                'urlhash' => $request->urlhash,
                'title' => $request->title,
                'keywords' => $request->keywords
            );
            $class->update($arr);

            $request->session()->flash('alert-success', 'Категория успешно обновлена!');
            return redirect('admin/content/classes');
        }
    }

    public function storeClass(Request $request)
    {



        $cover = $request->file('cover');

        //dd(Input::file());
        isset($cover) ? $extension = $cover->getClientOriginalExtension() : null;

        //$extension = $cover->getClientOriginalExtension();

        $validator = Validator::make($request->all(), [
//            'name' => 'required|min:2|max:255',
//            'description' => 'required|min:2|max:255',
            'urlhash' => 'required|min:2|max:255',
            'cover' => 'mimes:jpeg,bmp,png',
//            'title' => 'required',
//            'keywords' => 'required'
        ]);

        if ($validator->fails()) {

            return back()->withErrors($validator)->withInput();
        } else {
            $coverdb = Null;
            if (isset($cover)) {
                $img = Image::make($cover);

                // resize image
                $img->fit(200, 200);

                // save image
                $string = str_random(40);
                $img->save('files/classes/img/' . $string . '.' . $extension);

                $coverdb = $string . '.' . $extension;
            }

            $class = new Classes();
            $class->cover = $coverdb;
            $class->urlhash = $request->urlhash;
            $class->save();

            $languages = Language::all();

            foreach ($languages as $language){
                $class_description = new ClassDescription();
                $class_description->class_id = $class->id;
                $class_description->language_id = $language->id;
                $class_description->name = $request->{'name_'.$language->code};
                $class_description->title = $request->{'title_'.$language->code};
                $class_description->description = $request->{'description_'.$language->code};
                $class_description->keywords = $request->{'keywords_'.$language->code};
                $class_description->save();
            }

            $request->session()->flash('alert-success', 'Категория успешно создана!');
            return redirect('admin/content/classes');
        }
    }

    public function sortClass(Request $request)
    {
        $i = 0;
        $tap = $request->item;
        foreach ($tap as $value) {

            // Execute statement:
            // UPDATE [Table] SET [Position] = $i WHERE [EntityId] = $value
            DB::table('classes')->where('id', $value)->update(['sort_id' => $i]);
            $i++;
        }

        //dd($tap);


    }

    public function destroyClass(Request $request, $id)
    {

        $cat = Classes::findOrFail($id);

        if (isset($cat->cover)) {
            File::delete('files/cats/img/' . $cat->cover);
        }

        $cat->delete();

        //$request->session()->flash('alert-success', 'Категория успешно удалена!');
        //return redirect('content/cat');


    }
}
