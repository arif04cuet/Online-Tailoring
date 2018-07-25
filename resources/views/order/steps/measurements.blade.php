<div class="row">
    <div class="col">
        <h3>Measurements</h3>
    </div>
    <div class="col-2 ">
        <select class="float-right custom-select" name="measurement_unit" id="measurement_unit">
            <option value="INCH">INCH</option>
            <option value="CM">CM</option>
        </select>
    </div>
</div>

<hr> @foreach ($names as $name)
<div class="row">
    <div class="col w-100">
        @include("order.steps.measurements.$name")
    </div>
</div>
<hr> @endforeach


<div class="row">
    <div class="col w-100">
        @include("order.steps.measurements.clothing_style")
    </div>
</div>
<hr>
<div class="row">
    <div class="col w-100">
        @include("order.steps.measurements.body_analysis")
    </div>
</div>