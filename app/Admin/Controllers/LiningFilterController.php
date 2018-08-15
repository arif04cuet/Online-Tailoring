<?php

namespace App\Admin\Controllers;

use App\LiningFilter;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

use Illuminate\Support\MessageBag;

class LiningFilterController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(LiningFilter::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->title('Title');
            $grid->type('Type');
            $grid->created_at();
            $grid->updated_at();

            //filter
            $grid->filter(function ($filter) {

                $filter->like('title', 'Title');
                $types = LiningFilter::filters();
                $filter->in('type', 'Type')->multipleSelect($types);

            });


        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(LiningFilter::class, function (Form $form) {

            //$form->display('id', 'ID');
            $form->text('title', 'Title / Name');

            $types = LiningFilter::filters();
            $form->select('type', 'Type')->options($types);


            $form->saved(function ($form) {

                $success = new MessageBag([
                    'title' => $form->model()->title . ' saved successfully',
                ]);

                return back()->with(compact('success'));
            });


        });
    }
}
