<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mailing Address</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

</head>

<body>
    <?php
    
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://us-street.api.smartystreets.com/street-address?key=153647725713222131&street=3331%2520Erie%2520Ave&city=Cincinnati&state=OH&zipcode=45208',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        // print_r($response);die('s');
        $val=json_decode('{"input_index":0,"candidate_index":0,"delivery_line_1":"30 N Michigan Ave","last_line":"Chicago IL 60602-3402","delivery_point_barcode":"606023402999","components":{"primary_number":"30","street_predirection":"N","street_name":"Michigan","street_suffix":"Ave","city_name":"Chicago","default_city_name":"Chicago","state_abbreviation":"IL","zipcode":"60602","plus4_code":"3402","delivery_point":"99","delivery_point_check_digit":"9"},"metadata":{"record_type":"H","zip_type":"Standard","county_fips":"17031","county_name":"Cook","carrier_route":"C002","congressional_district":"07","building_default_indicator":"Y","rdi":"Commercial","elot_sequence":"0035","elot_sort":"A","latitude":41.88248,"longitude":-87.62461,"precision":"Zip9","time_zone":"Central","utc_offset":-6,"dst":true},"analysis":{"dpv_match_code":"D","dpv_footnotes":"AAN1","dpv_cmra":"N","dpv_vacant":"N","dpv_no_stat":"Y","active":"Y","footnotes":"B#H#"}}');
        
        $standerAddress = [$val];
        // print_r($standerAddress[0]);
        // print_r($standerAddress[0]->components->city_name);
        $states = array('AL'=>'Alabama','AK'=>'Alaska','AZ'=>'Arizona','AR'=>'Arkansas','CA'=>'California','CO'=>'Colorado','CT'=>'Connecticut','DE'=>'Delaware','DC'=>'District of Columbia','FL'=>'Florida','GA'=>'Georgia','HI'=>'Hawaii','ID'=>'Idaho','IL'=>'Illinois','IN'=>'Indiana','IA'=>'Iowa','KS'=>'Kansas','KY'=>'Kentucky','LA'=>'Louisiana','ME'=>'Maine','MD'=>'Maryland','MA'=>'Massachusetts','MI'=>'Michigan','MN'=>'Minnesota','MS'=>'Mississippi','MO'=>'Missouri','MT'=>'Montana','NE'=>'Nebraska','NV'=>'Nevada','NH'=>'New Hampshire','NJ'=>'New Jersey','NM'=>'New Mexico','NY'=>'New York','NC'=>'North Carolina','ND'=>'North Dakota','OH'=>'Ohio','OK'=>'Oklahoma','OR'=>'Oregon','PA'=>'Pennsylvania','RI'=>'Rhode Island','SC'=>'South Carolina','SD'=>'South Dakota','TN'=>'Tennessee','TX'=>'Texas','UT'=>'Utah','VT'=>'Vermont','VA'=>'Virginia','WA'=>'Washington','WV'=>'West Virginia','WI'=>'Wisconsin','WY'=>'Wyoming',);
    ?>
    <div class="container">
        <div class="alert alert-warning">
            <strong>Warning!</strong> Field Can't Be Empty.
        </div>
        <h2 class="heading-2">Address Validator</h2>
        <h4 class="heading-4">Validate/Standardizes Addresses Using USPS</h4>
        <form method="POST" name="mailingAddress" id="mailingAddress">
            <div class="form-group">
                <label for="address_1">Address Line 1</label>
                <input type="text" class="form-control" id="address_1" name="address_1"
                    placeholder="Please Enter Your Address 1">
            </div>
            <div class="form-group">
                <label for="address_2">Address Line 2</label>
                <input type="text" class="form-control" id="address_2" name="address_2"
                    placeholder="Please Enter Your Address 2">
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Please Enter Your City">
            </div>
            <div class="form-group">
                <label for="state">State</label>`
                <select class="form-control" id="state" name="state">
                    <?php foreach ($states as $key => $value) { ?>
                    <option value="<?php echo $value; ?>"><?php echo $value; ?></option>
                    <?php } ?>

                </select>
            </div>
            <div class="form-group">
                <label for="zip_code">Zip Code</label>
                <input type="text" class="form-control" id="zip_code" name="zip_code"
                    placeholder="Please Enter Your Zip Code" maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
            </div>
            <div class="validate-btn">
            <button type="button" class="btn btn-primary" id="sendFormData">VALIDATE</button>
            </div>
          
        </form>

        <!-- Modal-->
        <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel">Save Address</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>

                        </button>

                    </div>
                    <div class="modal-body">
                        <p>Which address format you want to save?</p>
                        <div role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-pills nav-justified" role="tablist">
                                <li role="presentation" class="nav-item active"><a href="#uploadTab"
                                        aria-controls="uploadTab" class="nav-link" role="tab" data-toggle="tab"
                                        data-prefix="org_">Original</a>

                                </li>
                                <li role="presentation" class="nav-item"><a href="#browseTab" aria-controls="browseTab"
                                        class="nav-link" role="tab" data-toggle="tab" data-prefix="std_">Standardized
                                        (USPS)</a>

                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="uploadTab">
                                    <p>
                                        <div>
                                            Address Line 1: <p id="org_Address_1"></p>
                                        </div>
                                        <div>
                                            Address Line 2: <p id="org_Address_2"></p>
                                        </div>
                                        <div>
                                            City: <p id="org_City"></p>
                                        </div>
                                        <div>
                                            State: <p id="org_State"></p>
                                        </div>
                                        <div>
                                            Zip Code: <p id="org_ZipCode"></p>
                                        </div>
                                       
                                    </p>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="browseTab">
                                    
                                    <div>
                                        Address Line 1:
                                        <p id="std_Address_1">
                                            <?= $standerAddress[0]->components->street_name ?>
                                        </p>
                                    </div>
                                    <div>
                                        Address Line 2:
                                        <p id="std_Address_2">
                                            <?= $standerAddress[0]->components->street_suffix ?>
                                        </p>
                                    </div>
                                    <div>
                                        City:
                                        <p id="std_City">
                                            <?= $standerAddress[0]->components->city_name ?>
                                        </p>
                                    </div>
                                    <div>
                                        State:
                                        <p id="std_State">
                                            <?= $standerAddress[0]->components->state_abbreviation ?>
                                        </p>
                                    </div>
                                    <div>
                                        Zip Code:
                                        <p id="std_ZipCode">
                                            <?= $standerAddress[0]->components->zipcode ?>
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="alert alert-success">
                            <strong>Address saved successfully!</strong>
                        </div>
                        <!-- <div class="alert alert-primary hide" role="alert">
                            Addrress saved Successfully!
                        </div> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="submitFinalData" class="btn btn-primary save">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

</html>



<!-- JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"> </script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"> </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function () {
        $(".alert-success").hide();
        $(".alert-warning").hide();
        $("#sendFormData").click(function (e) {
            var address_1 = $("#address_1").val();
            var address_2 = $("#address_2").val();
            var city = $("#city").val();
            var state = $("#state").val();
            var zipCode = $("#zip_code").val();

            if(address_1 == '' || address_2 == '' || city == '' || state == '' || zipCode == ''){
                $(".alert-warning").show();
                return false;
            }

            $("#modalForm").modal('show');
            $("#org_Address_1").text(address_1);
            $("#org_Address_2").text(address_2);
            $("#org_City").text(city);
            $("#org_State").text(state);
            $("#org_ZipCode").text(zipCode);

        });

        $("#submitFinalData").click(function (e) {
            e.preventDefault();
            var prefix = $('li.nav-item.active > a').attr('data-prefix');
            // alert(prefix);
            var prefixId = '#' + prefix;
            var modalAddress_1 = $(prefixId + "Address_1").text();
            var modalAddress_2 = $(prefixId + "Address_2").text();
            var modalCity = $(prefixId + "City").text();
            var modalState = $(prefixId + "State").text();
            var modalZipCode = $(prefixId + "ZipCode").text();

            var dataString = 'modalAddress_1=' + modalAddress_1.replace(/^\s+|\s+$/gm, '') +
                '&modalAddress_2=' + modalAddress_2.replace(/^\s+|\s+$/gm, '') + '&modalCity=' +
                modalCity.replace(/^\s+|\s+$/gm, '') + '&modalState=' + modalState.replace(
                    /^\s+|\s+$/gm, '') + '&modalZipCode=' + modalZipCode.replace(/^\s+|\s+$/gm, '');
            $.ajax({
                type: 'POST',
                data: dataString,
                url: 'insert.php',
                success: function (data) {
                    // alert(data);
                    $(".alert-success").show();
                }
            });
        });


    });
</script>