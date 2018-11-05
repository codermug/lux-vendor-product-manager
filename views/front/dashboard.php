<h1>Step 1: </h1>
<hr>
<form>
    <div class="row">
        <div class="col-md-12">
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1"> Women
                </label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2"> Men
                </label>
            </div>
            <div class="form-check form-check-inline disabled">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled> Kids
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2>Select Item Category </h2>
           <select id="categories" ></select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h1>Step 2: </h1>
            <hr>
            <h2>Select Material</h2>
        </div>
    </div>
</form>

<script type="text/javascript">
    var options =  JSON.parse('<?php echo Inc\DataService::wooCommerceCategories(1)?>');
    var data = [
        {
            id: 0,
            text: 'enhancement'
        },
        {
            id: 1,
            text: 'bug'
        },
        {
            id: 2,
            text: 'duplicate',
            children: [{
                id: 3,
                text: 'salam'
            },{ id: 5,
                text: 'Dawod'}
                ]


        },
        {
            id: 3,
            text: 'invalid'
        },
        {
            id: 4,
            text: 'wontfix'
        }
    ];

    $(document).ready(function () {
        $('#categories').select2({
            data : options
        });
    })



    console.log(options);


</script>