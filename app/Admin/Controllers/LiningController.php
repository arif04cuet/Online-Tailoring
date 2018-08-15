<?php

namespace App\Admin\Controllers;

use App\Lining;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\LiningFilter;
use App\Product;

class LiningController extends Controller
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

            $content->header('Manage Linings Fabrics');
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
        return Admin::grid(Lining::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->images('Lining Fabric Images')->display(function ($images) {

                return count($images);

            });

            $grid->category_id('Category')->display(function ($item) {
                if($item)
                    return LiningFilter::find($item)->title;
            });


            $grid->products('Mapped Products')->display(function ($products) {

                $products = array_map(function ($product) {
                    return "<span class='label label-success'>{$product['name']}</span>";
                }, $products);

                return join('&nbsp;', $products);
            });


            //Filter
            $grid->filter(function ($filter) {

                $filter->equal('category_id', 'Catagory')->select(LiningFilter::where('type', 'category')->pluck('title', 'id'));

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
        return Admin::form(Lining::class, function (Form $form) {

            $form->multipleSelect('products')->options(Product::where('has_lining', 1)->pluck('name', 'id'))->placeholder('Products Mapping')->rules('required');
            $form->select('category_id', 'Category')->options(LiningFilter::where('type', 'category')->pluck('title', 'id')->all())->rules('required');

            $form->hasMany('images', 'Upload Lining Fabrics', function (Form\NestedForm $form) {
                $form->image('file', 'Image')->uniqueName()->move('lining/');
                $form->text('caption');
            });

        });
    }
}