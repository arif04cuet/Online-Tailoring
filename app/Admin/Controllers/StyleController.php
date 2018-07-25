<?php

namespace App\Admin\Controllers;

use App\Style;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Product;

class StyleController extends Controller
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

            $content->header('Manage Styles');
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
        return Admin::grid(Style::class, function (Grid $grid) {
            $grid->id('ID')->sortable();
            $grid->name("Name")->sortable();;
            $grid->images('Style Images')->display(function ($images) {

                return count($images);

            });

            $grid->products('Mapped Products')->display(function ($products) {

                $products = array_map(function ($product) {
                    return "<span class='label label-success'>{$product['name']}</span>";
                }, $products);

                return join('&nbsp;', $products);
            });

              //Filter
            $grid->filter(function ($filter) {

                $filter->like('name', 'Name');


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
        return Admin::form(Style::class, function (Form $form) {

            $form->multipleSelect('products')->options(Product::where('is_complex',0)->pluck('name', 'id'))->placeholder('Products Mapping')->rules('required');
            $form->text('name', 'Style Name')->rules('required');
            $form->hasMany('images', 'Upload Styles', function (Form\NestedForm $form) {
                $form->image('file', 'Image')->uniqueName()->move('uploads/style/');
                $form->text('caption');
            });
        });
    }
}