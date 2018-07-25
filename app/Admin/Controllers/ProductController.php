<?php

namespace App\Admin\Controllers;

use App\Product;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ProductController extends Controller
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

            $content->header('Manage Products');
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
        return Admin::grid(Product::class, function (Grid $grid) {

            $grid->id('ID')->sortable();
            $grid->name('Name');
            $grid->active('Is Active')->switch();
            $grid->has_lining('Has Lining')->switch();
            $grid->is_tuxedo('Disable for Tuxedo')->switch();
            $grid->is_complex('Is Complex')->switch();
            $grid->associated_products()->display(function ($items) {
                $products = array();
                if ($items) {
                    $products = array_map(function ($item) {
                        $product = Product::find($item);
                        if($product)
                            return "<span class='label label-success'>{$product->name}</span>";
                    }, $items);
                }
                return join('&nbsp;', $products);

            });


            // $grid->created_at();
            // $grid->updated_at();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {

        return Admin::form(Product::class, function (Form $form) {


            $form->text('name', 'Name');
            $form->color('color', 'Backgroup Color');
            $form->switch('has_lining', 'Has Lining');
            $form->switch('is_tuxedo', 'Disable for Tuxedo');
            $form->switch('is_complex', 'Is Complex Product ?');
            $form->multipleSelect('associated_products')->options(Product::where('is_complex', 0)->pluck('name', 'id'));
            $form->text('weight', 'Order');
            $form->switch('active', 'Active');
        });
    }
}