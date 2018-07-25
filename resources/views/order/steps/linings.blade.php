
<div class="row">
        <?php $m=1;?>
        @if ($collection)
            @foreach($collection as $item)
                @if ($item->images()->get())
                    @foreach ($item->images()->get() as $image)
                        <?php $checked = ($m == 1)?' checked="checked"':''?>
                        <div class="col-3 ">
                                <label class="labl d-table w-100 zoom">
                                    
                                    <input class="lining" type="radio" name="lining" value="{{$image->id}}"  {{$checked}} />
                                    <div class="product-box text-black d-table-cell align-middle text-center">
                                        <img src="{{ asset('uploads').'/'.$image->file }}" alt="" style="width:100%">
                                        {{$image->caption}}
                                    </div>
                                </label>
                        </div>
                        <?php $m++?>
                    @endforeach
                @else
                <p>Sorry, no Lining found for this product!</p>
                @endif
            
            @endforeach
        
        @else
        <p>Sorry, no Fabrics found for this product!</p>
        @endif

    </div>
    
    <div class="row">
    <div class="col">
        <button class="nav-link btn btn-primary next">Next >></button>
    </div>
</div>