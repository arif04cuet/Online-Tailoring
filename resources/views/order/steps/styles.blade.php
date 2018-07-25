
 <div class="scroller scroller-left"><<</div>
 <div class="scroller scroller-right">>></div>

<div class="row">

    <?php 
        $lis = '';
        $pans = '';
    ?>
        @if ($collection)
            @foreach($collection as $item)
                
                <?php 
                $m=1;
                $lis .='<li class="nav-item" id="tab'.$item->id.'"><a class="nav-link" data-toggle="tab" href="#">'.$item->name.'</a></li>'; 
                ?>

                @if ($item->images()->get())
                    @foreach ($item->images()->get() as $image)
                        <?php $checked = ($m == 1)?' checked="checked"':''?>
                        <?php 
                        $pans .='<div id="pan'.$item->id.'" class="col-3 hide">
                                    <label class="labl d-table w-100 zoom">
                                        <input class="style" type="radio" name="style['.$item->id.']" value="'.$image->id.'" '.$checked.'/>
                                        <div data-tab="'.$item->id.'" class="product-box text-black d-table-cell align-middle text-center">
                                            <img src="'. asset('uploads').'/'.$image->file .'" alt="" style="width:100%">
                                            '. $image->caption .'
                                        </div>
                                    </label>
                            </div>';
                        $m++;
                        ?>
                    @endforeach
                @endif
            @endforeach
        @endif


        <div class="col">
            <div class="row">
                <div class="col">
                    <div class="wrapper">   
                        <ul id="tabSet" class="nav nav-pills styles_subheadings_tabs list" style="">
                            <?php echo $lis;?>      
                        </ul>
                    </div>
                </div>
            <br><br>
            </div>
                <div class="pans row" id="styles_subheadings_content">
                        <?php echo $pans;?>      
                </div>

                    
        </div>
       
    </div>

    

 <script>
 $("#tabSet li:eq(0) a").addClass('active');
 $("#tabSet li:eq(0)").click();

var hidWidth;
var scrollBarWidths = 40;
var scrollItemsPerStep = 3;


var widthOfList = function(){
  var itemsWidth = 0;
  $('.list li').each(function(){
    var itemWidth = $(this).outerWidth();
    itemsWidth+=itemWidth;
  });
  return itemsWidth;
};

var widthOfHidden = function(){
  return (($('.wrapper').outerWidth())-widthOfList()-getLeftPosi())-scrollBarWidths;
};

var getLeftPosi = function(){
  return $('.list').position().left;
};

var reAdjust = function(){
  if (($('.wrapper').outerWidth()) < widthOfList()) {
    $('.scroller-right').show();
  }
  else {
    //$('.scroller-right').hide();
  }
  
  if (getLeftPosi()<0) {
    $('.scroller-left').show();
  }
  else {
    $('.item').animate({left:"-="+getLeftPosi()+"px"},'slow');
  	//$('.scroller-left').hide();
  }
}

reAdjust();

$(window).on('resize',function(e){  
  	reAdjust();
});

$('.scroller-right').click(function() {
  
//   $('.scroller-left').fadeIn('slow');
//   $('.scroller-right').fadeOut('slow');
//   stepItemsWidth = scrollItems('left');
//   console.log(stepItemsWidth);
    width = -$('.wrapper').outerWidth()+200;
    $('.list').animate({left:"+="+width+"px"},'slow',function(){

    });

   


});

$('.scroller-left').click(function() {
  
	// $('.scroller-right').fadeIn('slow');
	// $('.scroller-left').fadeOut('slow');
    width = -$('.wrapper').outerWidth()+200;
  	$('.list').animate({left:"-="+width+"px"},'slow',function(){
  	
  	});
});    


 </script>

 <style>
 
 .wrapper {
    position:relative;
    margin:0 auto;
    overflow:hidden;
	padding:5px;
  	height:50px;
}

.list {
    position:absolute;
    left:0px;
    top:0px;
  	min-width:3000px;
  	margin-left:12px;
    margin-top:0px;
}

.list li{
	display:table-cell;
    position:relative;
    text-align:center;
    cursor:grab;
    cursor:-webkit-grab;
    color:#efefef;
    vertical-align:middle;
}

.scroller {
  text-align:center;
  cursor:pointer;
  
  padding:7px;
  padding-top:11px;
  white-space:no-wrap;
  vertical-align:middle;
  background-color:#fff;
}

.scroller-right{
  float:right;
}

.scroller-left {
  float:left;
}</style>