<div class="modal fade  cvemod" id="categoryModal" tabindex="0" role="dialog" data-backdrop="static" style=" position:fixed !important;" >
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Gender {{selected_g}} | Category {{selected_c}} | Brand{{selected_b}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body p-0" >
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-4 col-box">
                            <div class="title">
                                <span>Gender</span>
                            </div>
                            <div class="search-wrapper">
                                <div class="btn-group btn-group-toggle gn-li" data-toggle="buttons"  >
                                    <label class="btn btn-block btn-ct"  @click="setGender('female')">
                                        <input  type="radio" id="" name="gd" value="female" > Female
                                    </label>
                                    <label class="btn btn-block btn-ct"  @click="setGender('male')">
                                        <input  type="radio" id="" name="gd" value="male"  > Male
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-box">
                                <div class="title">
                                    <input type="text" class="form-control rounded-0 app-category-search" v-model="search_category"  placeholder="Search Category.."/>
                                </div>
                                <div class="search-wrapper scrollbar">
                                        <div class="btn-group btn-group-toggle"   data-toggle="buttons">
                                            
                                            <label class="btn btn-block"    v-for="post in filteredCategoryList" @click="!post.children ? getMaterials(post.id,post.text):''" v-bind:class="[post.children? 'btn-pr' : 'btn-ct']">
                                                <!--<input  type="radio" id="" name="ct" v-bind:value="post.id"> {{post.text}}-->
                                                <input  type="radio" id="" name="ct" v-bind:value="post.id" v-if="!post.children"> 
                                                <span  v-if="!post.children">{{post.text}}</span>
                                                <span  v-if="post.children" class="btn-label">{{post.text}}</span>
                                               
                                                    <div class="btn-group btn-group-toggle" v-if="post.children"  data-toggle="buttons">
                                                        <label class="btn btn-block btn-ct"  v-for="children in post.children"  @click="getMaterials(children.id,children.text)" >
                                                            <input  type="radio" name="ct" v-bind:value="children.id"> {{children.text}}
                                                        </label>
                                                    </div>

                                            </label>
                                          

                                        </div>

                                </div>
                                <div class="search-wrapper-overlay" v-if="selected_g==''"></div>
                        </div>
                        <div class="col-md-4 col-box ">
                            <div class="title">
                                <input type="text" class="form-control rounded-0" v-model="search_brand"  placeholder="Search Brands.."/>
                            </div>
                            <div class="search-wrapper scrollbar">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-block btn-ct"   v-for="brand in filteredBrandList"  @click="setBrand(brand.text)" >
                                            <input  type="radio" id="" name="bd" v-bind:value="brand.id">
                                            {{brand.text}}
                                        </label>
                                </div>
                            </div>
                            <div class="search-wrapper-overlay" v-if="selected_c==''"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

