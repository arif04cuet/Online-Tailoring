

<div class="row fabric_filters">
    @foreach($filters as $key=>$items)
        <div class="col-3">
            <select class="form-control" name="{{$key}}" id="{{$key}}">
                <option value="">{{ucfirst($key)}}</option>
                @foreach($items as $id=>$title)
                    <option value="{{$id}}" <?php echo (isset($requestData[$key]) and ($requestData[$key] == $id))?' selected':''?>>{{$title}}</option>
                @endforeach
            </select>
        </div>
    @endforeach
</div>
<br>
<div class="row">
<?php $m=1;?>
        @if ($collection)
            @foreach($collection as $item)
                @if ($item->images()->get())
                    @foreach ($item->images()->get() as $image)
                    
                        <div class="col-3 ">
                                <label class="labl d-table w-100 zoom">
                                    <?php $checked = ($m == 1)?' checked="checked"':''?>
                                    <input class="fabric" type="radio" name="fabric" value="{{$image->id}}"  {{$checked}} />
                                    <div class="product-box text-black d-table-cell align-middle text-center">
                                            <i class="fas fa-check hide"></i>
                                        <img src="{{ asset('uploads').'/'.$image->file }}" alt="" style="width:100%">
                                        {{$image->caption}}
                                    </div>
                                </label>
                        </div>
                        <?php $m++?>
                    @endforeach
                @else
                <p>Sorry, no Fabrics found for this product!</p>
                @endif
            
            @endforeach
        
        @else
        <p>Sorry, no Fabrics found for this product!</p>
        @endif
    
</div>
<br>
      <div class="row">
           <div class="col">
            <button class="nav-link btn btn-primary next">Next >></button>
       </div>
    </div>
    
