<div class="row lining_filters">
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

<script>

         //filter fabrics
         $('body').on('change','.lining_filters select',function(){
            $('#ajax_loader').show();
            var values = $('.lining_filters select').serialize();
           
            targ = '#nav-lining';
            product_id = $('input[name=product]:checked').val();;
            loadurl = 'order/' + product_id + '/linings?'+values;
            $.get(loadurl, function (data) {
                $(targ).html(data.html);
                $('#ajax_loader').hide();
            });
        

        });


</script>