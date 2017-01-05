<?php

namespace larashop\Http\Controllers\Admin;

use Illuminate\Http\Request;
use larashop\Classes;
use larashop\FilterGroup;
use larashop\Filters;
use larashop\Http\Controllers\Controller;
use Validator;

class FilterController extends Controller
{
    public function filterGroups()
    {
        $groups = FilterGroup::all();
        return view('admin.content.filters.filterGroups', ['groups' => $groups]);
    }

    public function filterGroupsCreate()
    {
        $classes = Classes::all();
        return view('admin.content.filters.filterGroupCreate', ['classes' => $classes]);
    }

    public function filterGroupsStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255',
            'class' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $group = new FilterGroup();
            $group->name = $request->name;
            $group->filter_class_id = $request->class;
            $group->save();

            $request->session()->flash('alert-success', 'Группа создана!');
            return redirect('admin/content/filter-groups');
        }

    }

    public function filterGroupsEdit($id)
    {
        $group = FilterGroup::find($id);
        $classes = Classes::all();
        return view('admin.content.filters.filterGroupEdit', ['group' => $group, 'classes' => $classes]);
    }

    public function filterGroupsUpdate($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|max:255',
            'class' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $group = FilterGroup::find($id);
            $data = [
                'name' => $request->name,
                'filter_class_id' => $request->class
            ];
            $group->update($data);

            $request->session()->flash('alert-success', 'Группа изменена!');
            return redirect('admin/content/filter-groups');
        }
    }

    public function filterGroupsDelete($id, Request $request){
        $group = FilterGroup::find($id);
        $group->delete();
        $request->session()->flash('alert-success', 'Группа удалена!');
        return redirect('admin/content/filter-groups');
    }

    public function filters(){
        $filters = Filters::all();
        $groups = FilterGroup::all();
        return view('admin.content.filters.filters',['filters' => $filters,'groups' => $groups]);
    }

    public function filterCreate(){
        $groups = FilterGroup::all();
        return view('admin.content.filters.filterCreate',['groups'=>$groups]);
    }

    public function filterStore(Request $request){
        $validator = Validator::make($request->all(), [
            'value' => 'required|min:1|max:255',
            'group' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $filter = new Filters();
            $filter->value = $request->value;
            $filter->filter_group_id = $request->group;
            $filter->save();

            $request->session()->flash('alert-success', 'Фильтер создан!');
            return redirect('admin/content/filters');
        }
    }

    public function filterEdit($id){
        $filter = Filters::find($id);
        $groups = FilterGroup::all();
        return view('admin.content.filters.filterEdit',['filter1' => $filter,'groups'=>$groups]);
    }

    public function filterUpdate($id, Request $request){
        $validator = Validator::make($request->all(), [
            'value' => 'required|min:1|max:255',
            'group' => 'required|integer'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            $filter = Filters::find($id);
            $data = [
                'value' => $request->value,
                'filter_group_id' => $request->group
            ];
            $filter->update($data);

            $request->session()->flash('alert-success', 'Фильтер изменен!');
            return redirect('admin/content/filters');
        }
    }

    public function filterDelete($id, Request $request){
        $filter = Filters::find($id);
        $filter->delete();
        $request->session()->flash('alert-success', 'Фильтер удален!');
        return redirect('admin/content/filters');
    }
}
