<?php

namespace App\Admin\Extensions;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Displayers\AbstractDisplayer;
use App\Image;
use App\Style;

class Modal extends AbstractDisplayer
{
    public function display($text = 'Details')
    {
        $modalId = 'modal_'.rand(50,100);
        $value = '';
        $styles = unserialize($this->value);

        foreach($styles as $key=>$image_id){

            $image = Image::find($image_id);
            $style = $image->style;
            $value .= '<tr><td>'.$style->name.'</td><td>'.$image->caption.'<br/><img width="100" src="/uploads/'.$image->file.'"/></td></tr>';
        }
        return <<<EOT

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#{$modalId}">
Show
</button>

<div class="modal fade" id="{$modalId}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{$text}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
        {$value}
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


EOT;

    }
}