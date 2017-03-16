<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    echo error_helper::check_errors();
    $base_url = CI_BASE_URL;
    
?>
        </div>
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='modal fade' id='jqmMessageModal' role='dialog' aria-labelledby='jqmMessageModal' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                                    <h4 class='modal-title' id='modalMessageTitle'>
                                        Modal title
                                    </h4>
                                </div>
                                <div class='modal-body' id='modalMessageBody'></div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-close btn-sm messageModalCloseBtn' data-dismiss='modal'>Close</button> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class='container-fluid'>
            <div class='row'>
                <div class='col-md-12'>
                    <div class='modal fade' id='jqmConfirmModal' role='dialog' aria-labelledby='jqmConfirmModal' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                                    <h4 class='modal-title' id='modalMessageTitle'>
                                        Modal title
                                    </h4>
                                </div>
                                <div class='modal-body' id='modalMessageBody'></div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-close btn-sm' data-dismiss='modal'>Close</button> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="jqmModalConfirm" name="jqmModalConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="modalConfirmTitle">Confirm Delete</h4>
                    </div>

                    <div class="modal-body" id="modalConfirmBody">
                        <p>You are about to delete one track, this procedure is irreversible.</p>
                        <p>Do you want to proceed?</p>
                        <p class="debug-url"></p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel" id="modalConfirmCancelBtn" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger" id="modalConfirmOkBtn">Ok</a>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer footer-ext">
            <div class="footer-bottom">
                <div class="container padding-top-15">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="copyright">
                                <?php echo lib_date::strtodatetime("NOW", lib_date::$DATE_FORMAT_12); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="copyright text-center font-size-16">
                                <a href="<?php echo http_helper::build_url(); ?>"><?php echo CI_META_TITLE; ?></a>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="copyright">
                                <?php echo CI_CONTACT_NUMBER; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
    <script type="text/javascript" src="<?php echo $base_url; ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $base_url; ?>assets/js/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo $base_url; ?>assets/js/system.js"></script>
</html>