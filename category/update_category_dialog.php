
<div id="update-category-dialog" class="modal fade " role="dialog">
     <div class="modal-dialog modal-sm vertical-alignment-helper">
         <div class="vertical-align-center">
            <div class="modal-content">
                <!-- updated bgcolor since 04-20-17 -->
                <div class="modal-header toast-info" 
                     style="padding-top:10px;padding-bottom:10px;
                            background-color:#c1c0c0"> <!--#2f96b4-->
                    <button type="button" class="close" style="margin-top:0px;" data-dismiss="modal">&times;</button>
                    <!-- updated color, added font family and font weight since 04-20-17 -->
                    <h5 class="modal-title" 
                        style="color:#474646;font-family:calibri;
                               font-size:18px;font-weight:bold;">Update Category</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group" style="margin-left: 10px;">
                        <span class="update-category-label">Category</span>
                        <div class="col-sm-12" style="padding-left: 0px;margin-top: 5px;">
                            <input type="text" name="categorytxt" value="" class="form-control update-category-txt"
                            autocomplete="off" />
                        </div>
                    </div>
                    <div style="text-align: right;margin-right: 15px;">
                        <button id="update-category-save" type="button" class="btn btn-default"
                                style="color:#ffffff;border:none;border-radius:2px;
                                       padding-top:5px;padding-bottom:5px;margin-top:15px;">
                            Save
                        </button>
                    </div>
                </div>
            </div>                     
        </div>
     </div>
 </div>
 