<?php
    DEFINE ('DB_USER','root');
    DEFINE ('DB_PASSWORD','');
    DEFINE ('DB_HOST','localhost');
    DEFINE ('DB_NAME','go');
    
    //Connection
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error( ));
    
    mysqli_set_charset($dbc, 'utf8');
// Code user Registration
if (isset($_POST['submit'])) {
    $companyReg = $_POST['companyReg'];
    $companyName = $_POST['companyName'];
    $companyEmail = $_POST['companyEmail'];
    $streetNo = $_POST['streetNo'];
    $postalCode = $_POST['postalCode'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $region = $_POST['region'];
    $currency = $_POST['currency'];
    $language = $_POST['language'];
    $address = $streetNo.' '.$postalCode.' '.$city.' '.$region.' '.$country;
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $fullName = $firstName.' '.$lastName; 
    $supplierEmail = $_POST['supplierEmail'];
    $status = "2";
    $sub_status = "registered";
    $productGrp = $_POST['productGrp'];
    $description = $_POST['description'];
    $querySub = "";
    $query1 = "";
    $query = mysqli_query($dbc, "insert into company(company_code,company_name,address,currency,language) values('$companyReg','$companyName','$address','$currency','$language')");
    if($productGrp == "others"){
    $querySub = mysqli_query($dbc, "insert into subcontractor(name,company_code,email,registration_status,description) values('$fullName','$companyReg','$supplierEmail','$sub_status','$description')"); }
    else{
    $query1 = mysqli_query($dbc, "insert into vendor(name,company_code,registration_status,email,product,description) values('$fullName','$companyReg','$status','$supplierEmail','$productGrp','$description')"); 
    }
    $fileCount = count($_FILES['file']['name']);
    for($i=0;$i<$fileCount;$i++){
        $fileName = $_FILES['file']['name'][$i];
        $query2 = mysqli_query($dbc,"insert into companyfile(company_code,title,file) values('$companyReg','$fileName','$fileName')");
    }
    if ($query && $query2 && ($querySub || $query1)){
        echo "<script>alert('You are successfully register');</script>";
    } else {
        echo "<script>alert('Not register something went worng');</script>";
    }
    }
    
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <meta charset="UTF-8" content="width=device-width, initial-scale=1.0">
        <title>GO Uniform | Self Registration</title>
        <link rel="icon"  type="image/png" sizes="16×16" href="uploads/1635148440_Logo2.png">
    </head>
    <style>
        section{
            padding-left: 120px;
            padding-right: 250px;
        }

        form{
            padding-left: 120px;
            padding-right: 250px;
        }

        label{
            width: 25%;
            display: inline-block;
            vertical-align: top;
        }

        .form-group{
            padding-left: 50px;
            padding-right: 100px;
            padding-bottom: 10px;
        }

        input, textarea{
            width: 65%;
        }

        .btn-primary{
            color: white;
            background-color: #0084B9;
        }

        .btn-primary:hover{
            background-color: #285e8e;
        }

        .btn-default{
            color: white;
            background-color: #aaa;
        }

        .btn-default:hover{
            background-color: #999999;
        }

        #footer {
            margin: 0 0 0 0; 
            padding: 0 0 1px 0; /* assuming footer of height 100px */
        }

    </style>
        <section class="header domReload">
            <h1>Self registration</h1>
            <div class="content">
                <div class="intro copy">
                    <p>If this is <strong>your first time visiting our website</strong>, please familiarize yourself with the way GO Uniform Sdn Bhd does business with its suppliers.<br>The first pre-requiste before your company contacts our purchasing staff is to register and fill in the following <strong>Supplier Registration Form</strong>. </p><p>After entering all data, please submit the form by pressing the submit button.</p><p>Your entered data is then available for the respective GO Uniform Sdn Bhd purchasing staff who checks your product / service portfolio. If they are interested in your profile, they will get in touch with you directly by using the contact address you have entered.</p>
                </div>
            </div>
        </section>
        <div class="content">
            <form id="supplier-registration-form" name="registrationForm" data-track-form-name="supplier-registration-form" class="form-horizontal clearfix" method="post" enctype="multipart/form-data">
                <input type="hidden" name="language" value="" />

                <br>
                <h2>Supplier address:</h2>

                <div class="form-group">
                    <label id="fld-company-name-label" for="fld-company-Regno" class="col-sm-3 control-label">Company Registration No&nbsp;*</label>
                    <!--  <div class="col-sm-9"> -->
                    <input id="fld-company-Regno" name="companyReg" class="input-text form-control" type="text" value="" required/>
                    <div class="validation-error"></div>
                    <!--  </div> -->
                </div>

                <div class="form-group">
                    <label id="fld-company-name-label" for="fld-company-name" class="col-sm-3 control-label">Company name&nbsp;*</label>
                    <!--  <div class="col-sm-9"> -->
                    <input id="fld-company-name" name="companyName" class="input-text form-control" type="text" value="" required/>
                    <div class="validation-error"></div>
                    <!--  </div> -->
                </div>

                <div class="form-group">
                    <label id="fld-company-name-label" for="fld-company-email" class="col-sm-3 control-label">Company Email Address&nbsp;*</label>
                    <!--  <div class="col-sm-9"> -->
                    <input id="fld-company-email" name="companyEmail" class="input-text form-control" type="email" value="" required/>
                    <div class="validation-error"></div>
                    <!--  </div> -->
                </div>

                <div class="form-group">
                    <label id="fld-street-label" for="fld-street-no" class="col-sm-3 control-label">Street no&nbsp;*</label>
                    <!--  <div class="col-sm-9"> -->
                    <input id="fld-street-no" name="streetNo" class="input-text form-control" type="text" value="" required/>
                    <div class="validation-error"></div>
                    <!--  </div> -->
                </div>

                <div class="form-group">
                    <label id="fld-postal-code-label" for="fld-postal-code" class="col-sm-3 control-label">Postal Code&nbsp;*</label>
                    <!--  <div class="col-sm-9"> -->
                    <input id="fld-postal-code" name="postalCode" class="input-text form-control" type="text" value="" required/>
                    <div class="validation-error"></div>
                    <!--  </div> -->
                </div>

                <div class="form-group">
                    <label id="fld-city-label" for="fld-city" class="col-sm-3 control-label">City&nbsp;*</label>
                    <!--  <div class="col-sm-9"> -->
                    <input id="fld-city" name="city" class="input-text form-control" type="text" value="" required/>
                    <div class="validation-error"></div>
                    <!--  </div> -->
                </div>

                <div class="form-group">
                    <label id="fld-country-label" for="fld-country" class="col-sm-3 control-label">Country / Territory&nbsp;*</label>
                    <!--  <div class="col-sm-9"> -->
                    <select id="fld-countryCode" name="country" class="input-text form-control" required>
                        <option value="">--Please choose an option--</option>
                        <option name="malaysia" value="malaysia">Malaysia</option>
                        <option name="singapore" value="singapore">Singapore</option>
                        <option name="china" value="china">China</option>
                        <option name="thailand" value="thailand">Thailand</option>
                    </select>
                    <!--<input id="fld-country" name="country" type="hidden" value=""/> -->
                    <div class="validation-error"></div>
                    <!--  </div> -->
                </div>

                <div class="form-group">
                    <label id="fld-region-label" for="fld-region" class="col-sm-3 control-label">Region&nbsp;*</label>
                    <!--  <div class="col-sm-9"> -->
                    <input id="fld-region" name="region" class="input-text form-control" type="text" value="" required/>
                    <div class="validation-error"></div>
                    <!--  </div> -->
                </div>

                <div class="form-group">
                    <label id="fld-currency-label" for="fld-currency" class="col-sm-3 control-label">Currency&nbsp;*</label>
                    <!--  <div class="col-sm-9"> -->
                    <input id="fld-currency" name="currency" class="input-text form-control" type="text" value="" required/>
                    <div class="validation-error"></div>
                    <!--  </div> -->
                </div>

                <div class="form-group">
                    <label id="fld-language-label" for="fld-language" class="col-sm-3 control-label">Language&nbsp;*</label>
                    <!--  <div class="col-sm-9"> -->
                    <select id="fld-language" name="language" class="input-text form-control" required>
                        <option value="">--Please choose an option--</option>
                        <option name="english" value="english">English</option>
                        <option name="malay" value="malay">Malay</option>
                        <option name="chinese" value="chinese">Chinese</option>
                        <option name="cantonese" value="cantonese">Cantonese</option>
                    </select>
                   <!-- <input id="fld-language" name="language" type="hidden" value=""/> -->
                    <div class="validation-error"></div>
                    <!--  </div> -->
                </div>

                <h2>Supplier contact:</h2>

                <div class="form-group">
                    <label id="fld-firstName-label" for="fld-firstName" class="col-sm-3 control-label">First Name&nbsp;*</label>
                    <!--  <div class="col-sm-9"> -->
                    <input id="fld-firstName" name="firstName" class="input-text form-control" type="text" value="" required/>
                    <div class="validation-error"></div>
                    <!--  </div> -->
                </div>

                <div class="form-group">
                    <label id="fld-lastName-label" for="fld-lastName" class="col-sm-3 control-label">Last Name&nbsp;*</label>
                    <!--  <div class="col-sm-9"> -->
                    <input id="fld-lastName" name="lastName" class="input-text form-control" type="text" value="" required/>
                    <div class="validation-error"></div>
                    <!--  </div> -->
                </div>

                <div class="form-group">
                    <label id="fld-email-label" for="fld-email" class="col-sm-3 control-label">Email Address&nbsp;*</label>
                    <!--  <div class="col-sm-9"> -->
                    <input id="fld-email" name="supplierEmail" class="input-text form-control" type="email" value="" required/>
                    <div class="validation-error"></div>
                    <!--  </div> -->
                </div>

                

                <h2>Goods &amp; Services:</h2>
                <div class="form-group">
                    <label style="width: 80%">Select <em>main</em> area you are interested in.</label>
                </div>

                <div class="form-group">
                    <label id="fld-pcn-group-label" for="fld-pcn-group" class="col-sm-3 control-label">Product Group&nbsp;*</label>
                    <!--  <div class="col-sm-9"> -->
                    <select id="fld-product-grp" name="productGrp" class="input-text form-control" required>
                        <option value="">--Please choose an option--</option>
                        <option name="materials" value="materials">Materials</option>
                        <option name="school uniform" value="school uniform">School Uniform</option>
                        <option name="career uniform" value="career uniform">Career Uniform</option>
                        <option name="others" value="others">Others</option>
                    </select>
                   <!--  <input id="fld-language" name="productGrp" type="hidden" value=""/>-->
                    <div class="validation-error"></div>
                    <!--  </div> -->
                </div>

                <div class="form-group">
                    <label id="fld-goods-description-label" for="fld-goods-description" class="col-sm-3 control-label">What goods and/ or services in concrete you want to sell to us:&nbsp;*</label>
                    <!--  <div class="col-sm-9"> -->
                    <textarea id="fld-goods-description" name="description" class="input-text form-control" rows="7" required></textarea>
                    <div class="validation-error"></div>
                    <!--  </div> -->
                </div> 


                <h2>Supporting Material:</h2>
                <div class="form-group">
                    <label style="width: 80%">Upload the supporting material eg.(Company Financial Report, Annual Report, Product Catalog, )</label>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Upload&nbsp;*</label>
                    <!--  <div class="col-sm-9"> -->
                    <input name="file[]" class="input-text form-control" type="file" id="file" multiple>
                    <div class="validation-error"></div>
                    <!--  </div> -->
                </div>

                <br>
                <br>

                <div class="form-group" style="float: right">
                    <!--  <div class="buttons col-sm-9 col-sm-push-3"> -->
                    <button id="submit" type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                    <button type="reset" class="btn btn-default" type="submit" value="submit">Clear</button>

                    <small class="mandatory-disclaimer">*&nbsp;Mandatory fields</small>
                    <!--  </div> -->
                </div>
            </form>
        </div>

    