<?php

namespace App\Admin\Extensions;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Displayers\AbstractDisplayer;
use App\Image;
use App\Style;

class MonogramModal extends AbstractDisplayer
{
    public function display($text = 'Details')
    {
        if(!$this->value)
            return '';


        $modalId = 'modal_'.rand(50,100);
        $value = '';
        
        $values = unserialize($this->value);
        
        $value .='<tr><th>Style</th><th>Color</th><th>Text</th></tr>';
        $value .='<tr><td>'.$values['style'].'</td><td>'.$values['color'].'</td><td>'.$values['text'].'</td></tr>';
        $font = 'normal';
        
        if($values['style'] == 'script')
            $font = 'italic';

        $div = '
        <div style="height:200px;width:100%;background-color:gray;display: flex;
        justify-content: center;
        align-items: center;">
            <div style="color:'.$values['color'].';font-style:'.$font.'">'.$values['text'].'</div>
        </div>';


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
        <hr>
        {$div}
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