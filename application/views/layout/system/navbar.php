<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>



<?php
    $this->load->library("lib_navbar");
    
    $navbar = new lib_navbar();
    $navbar->add_navitem("Students", base_url("index.php/person/vlist"));
    $navbar->add_navitem("Charl");
    $navbar->add_navitem_dropdown("test2", ["index/url" => "Url"]);
    
    $navbar->add_navitem("test3", "#", ["align" => "right"]);
    $navbar->add_navitem_form("signup", "
        <form class='form' role='form' method='post' action='login' accept-charset='UTF-8' id='login-nav'>
            <div class='form-group'>
                <label class='sr-only' for='exampleInputEmail2'>Email address</label>
                <input type='email' class='form-control' id='exampleInputEmail2' placeholder='Email address' required>
            </div>
            <div class='form-group'>
                <label class='sr-only' for='exampleInputPassword2'>Password</label>
                <input type='password' class='form-control' id='exampleInputPassword2' placeholder='Password' required>
            </div>
            <div class='checkbox'>
                <label>
                    <input type='checkbox'> Remember me
                </label>
            </div>
            <div class='form-group'>
                <button type='submit' class='btn btn-success btn-block'>Sign in</button>
            </div>
        </form>
    ", ["align" => "right"]);
    $navbar->display();
    
?>