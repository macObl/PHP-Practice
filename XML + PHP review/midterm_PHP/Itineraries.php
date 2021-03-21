<?php
    session_start();
    define("ITINERARY_PATH", "Data/itineraries.xml");
    $itineraries = simplexml_load_file(ITINERARY_PATH);
    
    extract($_POST);
    $confirmation = false;
 
    function onPassengerChanged(){
        $selected_name = $drpPassenger;
    }

    //instantiate vairables
    $xml_array = [];
    $confirmation = null;
    $selected_value = null;
    $txtOutboundDeparture = $txtOutboundArriving = $txtInboundDeparture = $txtInboundArriving = null;

    //create array of passenger value => name
    //for getting the name later based on dropdown value
    $index=0;
    $itinerary_array= [];
    foreach ($itineraries->itinerary as $itinerary){
        $name = $itinerary->passenger->__toString();
        $itinerary_array[$index]=$name;
        $index++;	
    }

    //get value from drpPassenger
    if (isset($drpPassenger)){
        $selected_value = $_POST['drpPassenger'];
        if ($selected_value != -1){
            foreach ($itineraries->itinerary as $itinerary){
                $name = $itinerary->passenger->__toString();

                //Set variables if name is the same as value of array w/ index from dropdown
                if ($name == $itinerary_array[$selected_value]){
                    $txtOutboundDeparture = $itinerary->outbound->departure->city;
                    $txtOutboundArriving = $itinerary->outbound->arriving->city;
                    $txtInboundDeparture = $itinerary->inbound->departure->city;
                    $txtInboundArriving = $itinerary->inbound->arriving->city;
                }
            }
        }
        //don't fill boxes if index is -1
        else{
            $txtOutboundDeparture = "";
            $txtOutboundArriving = "";
            $txtInboundDeparture = "";
            $txtInboundArriving = "";
        }
    }

    //set confirmation message and save xml if btnsave is pressed
     if (isset($btnSave))
    {	
        $confirmation = "Revised itinerary has been saved to: " . ITINERARY_PATH;
        foreach($itineraries->itinerary as $itinerary){
            array_push($xml_array, $itinerary);
        }

        $xml_array[$selected_value]->outbound->departure->city = $_POST['txtOutboundDeparture'];
        $xml_array[$selected_value]->outbound->arriving->city = $_POST['txtOutboundArriving'];
        $xml_array[$selected_value]->inbound->departure->city = $_POST['txtInboundDeparture'];
        $xml_array[$selected_value]->inbound->arriving->city = $_POST['txtInboundArriving'];
        $itineraries->asXML("Data/itineraries.xml");
    }


    include "./Common/Header.php";
?>
<div class="container"> 
     <div class="row vertical-margin">
        <div class="col-md-10 text-center"><h1>Itineraries</h1></div>
    </div>
    <form action="Itineraries.php" method="post" id="itineraries-form">
        <div class="row vertical-margin">
            <div class="col-md-2"><label for="drpPassenger">Passenger:</label></div>
            <div class="col-md-6">
                <select name="drpPassenger" class="form-control" onchange="onPassengerChanged();">
                    
                    <option value="-1">Select ... </option>

                    <?php 
                    //Add your code here to display restaurant names
                    $i=0;
                    foreach ($itineraries->itinerary as $itinerary){
                        $name = $itinerary->passenger;
                        ?>
                        <option value="<?php echo $i;?>" <?php echo ($selected_value ==  $i) ? ' selected="selected"' : '';?>><?php echo $name;?></option>
                        <?php
                        $i++;	
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="row vertical-margin">
           <div class="col-md-6 col-md-offset-2"><h3>Outbound</h3></div>
        </div>
        <div class="row vertical-margin">
            <div class="col-md-2"><label>Departure City:</label></div>
            <div class="col-md-6">
                <input type="text" class="form-control" rows="2" style="width : 100%" name="txtOutboundDeparture" value="<?php print $txtOutboundDeparture ?>"/>
            </div>
        </div>
        <div class="row vertical-margin">
            <div class="col-md-2"><label>Arriving City:</label></div>
            <div class="col-md-6">
                <input type="text" class="form-control" rows="2" style="width : 100%" name="txtOutboundArriving" value="<?php print $txtOutboundArriving ?>"/>
            </div>
        </div>
        <div class="row vertical-margin">
           <div class="col-md-6 col-md-offset-2"><h3>Inbound</h3></div>
        </div>
        <div class="row vertical-margin">
            <div class="col-md-2"><label>Departure City:</label></div>
            <div class="col-md-6">
                <input type="text" class="form-control" rows="2" style="width : 100%" name="txtInboundDeparture" value="<?php print $txtInboundDeparture ?>"/>
            </div>
        </div>
        <div class="row vertical-margin">
            <div class="col-md-2"><label>Arriving City:</label></div>
            <div class="col-md-6">
                <input type="text" class="form-control" rows="2" style="width : 100%" name="txtInboundArriving" value="<?php print $txtInboundArriving ?>"/>
            </div>
        </div>

        <div class="row vertical-margin">
            <div class="col-md-10 col-md-offset-2">
                <input type='submit'  class="btn btn-primary btn-min-width" name='btnSave' value='Save Changes'/>
            </div>
        </div>
        <div class="row" style="display: <?php print ($confirmation ?  'block' :'none' )?>" >
            <div class="col-md-8"><Label ID="lblConfirmation" class="form-control alert-success">
                <?php print $confirmation ?></Label>
            </div>
        </div>
    </form>
</div>
<br/>
<?php include "./Common/Footer.php"; ?>