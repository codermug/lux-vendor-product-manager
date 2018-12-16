<div class="modal fade cvemod" id="materialModal" tabindex="-1" role="dialog" data-backdrop="static" style="position: fixed !important; ">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content rounded-0" id="appMaterial">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Select Gender</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
            </div>
            <div class="modal-body pt-0 pb-0" >
                <div class="row">
                    <div class="col-md-4 col-box">
                            <div class="title">
                                <input type="text" class="form-control rounded-0" v-model="search_material"  placeholder="Search Material.."/>
                            </div>
                            <div class="search-wrapper scrollbar">
                                    <div class="btn-group-toggle"   >
                                        <label class="btn btn-block btn-ct" v-for="material in filteredMaterialsList" @click="setMaterial(material.id,material.text)" v-bind:class="[selected_m.id == material.id ? 'active':'']">
                                            <input  type="radio" id="" name="mt" v-bind:value="material.id"> {{material.text}}
                                        </label>
                                    </div>
                            </div>
                    </div>
                    <div class="col-md-4 col-box">
                            <div class="title">
                                <input type="text" class="form-control rounded-0" v-model="search_color"  placeholder="Search Color.."/>
                            </div>
                            <div class="search-wrapper scrollbar">
                                    <div class="form-check cl-d" v-for="color in filteredColorsList" >
                                        <label class="form-check-label color" @click="setColor(color.id,color.text)" >
                                            <input  type="radio" id="" name="color" class="form-check-input" v-bind:value="color.id">
                                            <span v-bind:style="{background:[color.description]}"></span>  {{color.text}}
                                        </label>
                                    </div>
                            </div>
                            <div class="search-wrapper-overlay" v-if="selected_m==''"></div>
                    </div>
                    <div class="col-md-4 col-box">
                            <div class="title">
                                <input type="text" class="form-control rounded-0" v-model="search_condition"  placeholder="Search Condition.."/>
                            </div>
                            <div class="search-wrapper scrollbar">
                                    <div class="btn-group-toggle"   >
                                        <label class="btn btn-block btn-ct" v-for="cn in filteredConditionList" @click="setCnd(cn.id,cn.text)" v-bind:class="[selected_co.id == cn.id ? 'active':'']">
                                            <input  type="radio" id="" name="cnd" v-bind:value="cn.id"> {{cn.text}}
                                        </label>
                                    </div>
                            </div>
                            <div class="search-wrapper-overlay" v-if="selected_cl==''"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

