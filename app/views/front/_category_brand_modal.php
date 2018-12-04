<div class="modal fade  cvemod" id="categoryModal" tabindex="0" role="dialog" data-backdrop="static" style=" position:fixed !important;" >
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Gender {{selected_g.text}} | Category {{selected_c.text}} | Brand{{selected_b.text}}</h4>
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
                                <div class="btn-group btn-group-toggle gn-li"   >
                                    <label class="btn btn-block btn-ct"  @click="setGender(1,'female')" >
                                        <input  type="radio" id="" name="gd" value="female" autocomplete="off"> Female
                                    </label>
                                    <label class="btn btn-block btn-ct"  @click="setGender(2,'male')">
                                        <input  type="radio" id="" name="gd" value="male"  autocomplete="off"> Male
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-box">
                                <div class="title">
                                    <input type="text" class="form-control rounded-0 app-category-search" v-model="search_category"  placeholder="Search Category.."/>
                                </div>
                                <div class="search-wrapper scrollbar">
                                        <div class="btn-group btn-group-toggle"   >
                                            
                                            <label class="btn btn-ct btn-block"    v-for="post in filteredCategoryList" @click="!post.children ? getMaterials(post.id,post.text):''" v-bind:class="[post.children? 'btn-pr' : 'btn-ct',slCat == post.id ? 'active':'']" :checked="slCat == post.id" >
                                                <!--<input  type="radio" id="" name="ct" v-bind:value="post.id"> {{post.text}}-->
                                                <input  type="radio" id="" name="ct" v-bind:value="post.id" v-if="!post.children" autocomplete="off">  
                                                <span  v-if="!post.children">{{post.text}}</span>
                                                <span  v-if="post.children" class="btn-label">{{post.text}}</span>
                                               
                                                        <label class="btn btn-block btn-ct"  v-for="children in post.children"  @click="getMaterials(children.id,children.text)" >
                                                            <input  type="radio" name="ct" v-bind:value="children.id" autocomplete="off"> -- {{children.text}}     
                                                        </label>

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
                                <div class="btn-group btn-group-toggle" >
                                        <label class="btn btn-block btn-ct"   v-for="brand in filteredBrandList"  @click="setBrand(brand.id,brand.text)" v-bind:class="[selected_b.id == brand.id ? 'active':'']" >
                                            <input  type="radio"  name="bd" v-bind:value="brand.id" autocomplete="off">
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

