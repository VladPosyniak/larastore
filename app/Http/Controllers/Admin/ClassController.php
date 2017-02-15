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
        $descriptions = [];
        foreach (Language::all() as $language){
            foreach ($class->all_descriptions as $description){
                if ($language->id === $description->language_id){
                    $descriptions[$language->code] = $description;
                }
            }
        }

        $data = [
            'class' => $class,
            'NewOrderCounter' => Purchase::Neworders()->count(),
            'languages' => Language::all(),
            'descriptions' => $descriptions
        ];
        return view('admin.content.classEdit')->with($data);
    }

    public function updateClass(Request $request, $id)
    {

        $class = Classes::findOrFail($id);

        if (isset($class->cover)) {
            File::delete('files/classes/img/' . $class->cover);
        }

        $cover = $request->file('cover');

        //dd(Input::file());
        isset($cover) ? $extension = $cover->getClientOriginalExtension() : null;

        $rules = [
            'urlhash' => 'required|min:2|max:255',
            'cover' => 'mimes:jpeg,bmp,png',
        ];
        foreach (Language::all() as $language){
            $rules['description_'.$language->code] = 'required|min:3';
            $rules['title_'.$language->code] = 'required';
            $rules['keywords_'.$language->code] = 'required';
            $rules['name_'.$language->code] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

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
                'cover' => $coverdb,
                'urlhash' => $request->urlhash,
            );


            $class->update($arr);

            foreach (Language::all() as $language){
                $class_description = ClassDescription::where([
                    ['language_id','=',$language->id],
                    ['class_id','=',$class->id]
                ])->first();
                $class_description->name = $request->{'name_'.$language->code};
                $class_description->title = $request->{'title_'.$language->code};
                $class_description->description = $request->{'description_'.$language->code};
                $class_description->keywords = $request->{'keywords_'.$language->code};
                $class_description->update();
            }

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

        $rules = [
            'urlhash' => 'required|min:2|max:255',
            'cover' => 'mimes:jpeg,bmp,png',
        ];
        foreach (Language::all() as $language){
            $rules['description_'.$language->code] = 'required|min:3';
            $rules['title_'.$language->code] = 'required';
            $rules['keywords_'.$language->code] = 'required';
            $rules['name_'.$language->code] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

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

        $class = Classes::findOrFail($id);
        if (isset($class->cover)) {
            File::delete('files/cats/img/' . $class->cover);
        }
        $class->delete();
        ClassDescription::where('class_id','=',$id)->delete();
    }
}
