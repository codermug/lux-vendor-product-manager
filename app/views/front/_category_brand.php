<div class="modal fade " id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true" style="position: fixed !important;">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content rounded-0" id="appCategory">
            <div class="modal-body" >
                <div class="row">
                    <div class="col-md-4">
                        <div class="col-box">
                                    <div class="search-wrapper">
                                        <div class="title">Gender</div>
                                        <div class="btn-group-toggle" data-toggle="buttons"  >
                                            <label class="btn btn-block btn-secondary">
                                                <input  type="radio" id="" name="gender"> Female
                                            </label>
                                            <label class="btn btn-block btn-secondary">
                                                <input  type="radio" id="" name="gender"> Male
                                            </label>
                                        </div>
                                    </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-box">
                            <div class="search-wrapper">
                                <input type="text" class="form-control rounded-0" v-model="search_category"  placeholder="Search Category.."/>
                                    <div class="btn-group-toggle" data-toggle="buttons"  >
                                        <label class="btn btn-block btn-secondary" v-for="post in filteredCategoryList">
                                           <input  type="radio" id="" name="categories[]" v-bind:value="post"> {{post}}
                                        </label>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="col-box">
                            <div class="search-wrapper">
                                <input type="text" class="form-control rounded-0" v-model="search_brands"  placeholder="Search Brands.."/>
                                <div class="btn-group-toggle" data-toggle="buttons"  >
                                        <label class="btn btn-block btn-secondary"   v-for="brand in filteredBrandList">
                                            <input  type="radio" id="" name="brands[]" v-bind:value="brand">
                                            {{brand}}
                                        </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #appCategory div.title {
        margin: 0 0 20px;
        font-size: 1em;
        border-bottom: #cc6666 1px solid;
        padding-bottom: 10px;
    }
    #appCategory .search-wrapper input[type=text] {
        margin: 0 0 20px;
        font-size: 1em;
        border:none;
        border-bottom: #cc6666 1px solid;
        padding-bottom: 10px;
        background-color: transparent;
        padding-left: 0;
    }
    #appCategory .search-wrapper .btn {
        border-radius: 0;
        text-align: left;
        margin: 0;
    }
</style>