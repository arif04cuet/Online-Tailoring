<?php

namespace App\Admin\Controllers;

use App\Order;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use App\Product;
use App\Image;

class OrderController extends Controller
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

            $content->header('Manage Orders');
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
        return Admin::grid(Order::class, function (Grid $grid) {

            $grid->model()->orderBy('id', 'desc');

            $grid->id('ID')->sortable();
            $grid->product_id('Product')->display(function($product_id){
                return Product::find($product_id)->name;
            });
            $grid->fabric_id('Fabric')->display(function($fabric_id){
                $image = Image::find($fabric_id);
                return $image->caption .'<br/><img width="100" src="/uploads/'.$image->file.'"/>';
            });
            $grid->lining_id('Lining Fabric')->display(function($lining_id){
                $image = Image::find($lining_id);
                return $image->caption .'<br/><img width="100" src="/uploads/'.$image->file.'"/>';
            });
            
            $grid->style()->modal('Product Style');
            $grid->monogram()->monogram_modal('Monogram');

            $grid->customer()->name('Customer Name');
            $grid->customer()->email('Email');
            $grid->customer()->mobile('Phone');
            $grid->invoice()->payment_status('Paid')->display(function($status){
                if($status =='Completed')
                    return "<span class='label label-success'>{$status}</span>";
                else
                    return "<span class='label ' style='background-color:red'>{$status}</span>";
            });
            $grid->created_at('Ordered On');

            $grid->filter(function ($filter) {

                // Sets the range query for the created_at field
                $filter->between('created_at', 'Ordered On')->date();
                
                $filter->where(function ($query) {

                    $query->whereHas('customer', function ($query) {
                        $query->where('mobile', 'like', "%{$this->input}%")->orWhere('email', 'like', "%{$this->input}%");
                    });
                
                }, 'Email or Phone');



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
        return Admin::form(Order::class, function (Form $form) {

            $form->display('id', 'ID');

            $form->display('created_at', 'Created At');
            $form->display('updated_at', 'Updated At');
        });
    }
}