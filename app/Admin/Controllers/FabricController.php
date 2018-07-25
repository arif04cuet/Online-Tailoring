<?php

namespace App\Admin\Controllers;

use App\Fabric;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\FabricFilter;
use App\Product;

class FabricController extends Controller
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

            $content->header('Manage Fabric');
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

            $content->header('Fabric');
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

            $content->header('Fabric');

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
        return Admin::grid(Fabric::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->images('Fabric Images')->display(function ($images) {

                return count($images);

            });

            $grid->composition_id('Composition')->display(function ($item) {
                if($item)
                    return FabricFilter::find($item)->title;
            });

            $grid->color_id('Color')->display(function ($item) {
                if($item)
                    return FabricFilter::find($item)->title;
            });

            $grid->pattern_id('Pattern')->display(function ($item) {
                if($item)
                    return FabricFilter::find($item)->title;
            });

            $grid->category_id('Catagory')->display(function ($item) {
                if($item)
                    return FabricFilter::find($item)->title;
            });

            $grid->products('Mapped Products')->display(function ($products) {

                $products = array_map(function ($product) {
                    return "<span class='label label-success'>{$product['name']}</span>";
                }, $products);

                return join('&nbsp;', $products);
            });


            //Filter
            $grid->filter(function ($filter) {

                //$filter->equal('products', 'Products')->multipleSelect(Product::all()->pluck('name', 'id'));
                $filter->equal('composition_id', 'Composition')->select(FabricFilter::where('type', 'composition')->pluck('title', 'id'));
                $filter->equal('color_id', 'Color')->select(FabricFilter::where('type', 'color')->pluck('title', 'id'));
                $filter->equal('pattern_id', 'Patterns')->select(FabricFilter::where('type', 'patterns')->pluck('title', 'id'));
                $filter->equal('category_id', 'Catagory')->select(FabricFilter::where('type', 'catagory')->pluck('title', 'id'));

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
        return Admin::form(Fabric::class, function (Form $form) {

            $form->multipleSelect('products')->options(Product::where('is_complex',0)->pluck('name', 'id'))->placeholder('Products Mapping')->rules('required');

            $form->select('composition_id', 'Composition')->options(FabricFilter::where('type', 'composition')->pluck('title', 'id')->all());
            $form->select('color_id', 'Color')->options(FabricFilter::where('type', 'color')->pluck('title', 'id')->all());
            $form->select('pattern_id', 'Pattern')->options(FabricFilter::where('type', 'patterns')->pluck('title', 'id')->all());
            $form->select('category_id', 'Category')->options(FabricFilter::where('type', 'catagory')->pluck('title', 'id')->all());

            $form->hasMany('images', 'Upload Fabrics', function (Form\NestedForm $form) {
                $form->image('file', 'Image')->uniqueName()->move('uploads/fabric/');
                $form->text('caption');
            });

        });
    }
}