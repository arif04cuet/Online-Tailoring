<?php

namespace App\Admin\Controllers;

use App\AttributeSet;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Attribute;
use App\Product;

class AttributeSetController extends Controller
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

            $content->header('Manage Attribute Set');
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

            $content->header('Attribute Set');
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

            $content->header('Attribute Set');
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
        return Admin::grid(AttributeSet::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name('Name');
            $grid->attributes()->display(function ($items) {

                $items = array_map(function ($item) {
                    return "<span class='label label-success'>{$item['title']}</span>";
                }, $items);

                return join('&nbsp;', $items);
            });

            $grid->product()->name('Associated Product');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        return Admin::form(AttributeSet::class, function (Form $form) {


            $form->select('product_id', 'Associated Product')->options(Product::where('is_complex', 0)->pluck('name', 'id'));
            $form->text('name', 'Name');
            $form->text('machine_name', 'Machine Name');
            $form->multipleSelect('attributes')->options(Attribute::all()->pluck('title', 'id')->all());

        });
    }
}
