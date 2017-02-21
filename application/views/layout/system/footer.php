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
                                    <button type='button' class='btn btn-default btn-sm' data-dismiss='modal'>Close</button> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer footer-ext" style=" background-color: #ff3333; height: 50px">
            <div class="container">
                <p class="text-muted">Place sticky footer content here.</p>
            </div>
        </footer>
    </body>
</html>