<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
                    </div>
                </div>
            </div>
            <!-- end: Content -->
            <!--div id="usage">
                <ul>
                    <li>
                        Power By Ming
                    </li>
                </ul>
            </div-->
        </div><!--/container-->

        <div class="modal fade" aria-labelledby="myModalTitle" aria-hidden="true" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalTitle">Base Title</h4>
                    </div>
                    <div class="modal-body" id="myModalbody">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary" id="myModalBtn" onclick="myModalBtn()">确定</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <div class="ming-alert" id="ming_alert"></div>
        <div class="clearfix"></div>

        <script src="<?php echo base_url('asset/js/bootstrap.min.js');?>"></script>	
        <!-- page scripts -->
        <script src="<?php echo base_url('asset/third_party/jquery-ui/js/jquery-ui-1.10.4.min.js');?>"></script>
        <script src="<?php echo base_url('asset/third_party/touchpunch/jquery.ui.touch-punch.min.js');?>"></script>
        
        
        <!-- theme scripts -->
        <script src="<?php echo base_url('asset/js/SmoothScroll.js');?>"></script>
        <script src="<?php echo base_url('asset/js/jquery.mmenu.min.js');?>"></script>
        <script src="<?php echo base_url('asset/js/core.min.js');?>"></script>

        <!-- end: JavaScript-->
    </body>
</html>