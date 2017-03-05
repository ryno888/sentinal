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
                                <div class='modal-body' id='modalMessageBody'>

                                </div>
                                <div class='modal-footer'>

                                    <button type='button' class='btn btn-default' data-dismiss='modal'>
                                        Close
                                    </button> 
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
        <footer>
        </footer>
    </body>
    <script type="text/javascript" src="<?php echo $base_url; ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $base_url; ?>assets/js/system.js"></script>
    <script type="text/javascript" src="<?php echo $base_url; ?>assets/js/components.js"></script>
</html>