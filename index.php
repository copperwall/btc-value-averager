<html>
<head>
   <title>How's Bitcoin Doing?</title>
   <link rel='stylesheet' type='text/css' href='../bootstrap/css/bootstrap.css'/>
</head>
<body>
   <style>
      #content {
         position:absolute;
         top:0px;
         width:100%;
         text-align:center;
         vertical-align:center;
      }

      .content_box {
         bottom:0px;
      }
      
      .lead {
         font-size:3.5em;
      }

      .row_thing {
         height:250px;
         margin-top:0px;
         margin-bottom:0px;
         background-color:purple;
         width:100%;
      }

      /* add a shadow on hover
      .row_thing:hover {
         box-shadow: 0px, 2px, 2px, 3px, white;
      }*/

      .row_thing p {
         float:right;
         padding-top:92px;
         margin-right:10px;
         color:white;
      }

      #coinbase_row {
         background-color:#4775FF;
      }

      #gox_row {
         background-color:#FF9933;
      }

      #bitstamp_row {
         background-color:#8AE62E;
      }

      .row_title {
         color:white;
         font-size:4em;
         padding-top:92px;
         margin-top:0px;
         float:left;
         margin-left:10px;
      }
   </style>
   
   <div id='content'>
      <h1>How's Bitcoin Doing?</h1>
      <br/><br/>
      <div class='content_box'>
         <?php
            // grab json data from all sites
            $coinbase_json = file_get_contents("http://coinbase.com/api/v1/prices/sell");
            $mtgox_json = file_get_contents("http://data.mtgox.com/api/2/BTCUSD/money/ticker_fast");
            $bitstamp_json = file_get_contents("https://www.bitstamp.net/api/ticker/");

            // decode json into objects
            $coinbase_sell = number_format(json_decode($coinbase_json)->{"subtotal"}->{"amount"}, 2, '.', '');
            $mtgox_sell = number_format(json_decode($mtgox_json)->{"data"}->{"last"}->{"value"}, 2, '.', '');
            $bitstamp_sell = number_format(json_decode($bitstamp_json)->{"last"}, 2, '.', '');

            $avg_sell = number_format((($coinbase_sell + $mtgox_sell + $bitstamp_sell) / 3), 2, '.', '');

            print "<div id='avg_row' class='row_thing'><h1 class='row_title'>Average Sell Price</h1><p class='lead'>"."$".$avg_sell." USD</p></div>\n";
            print "<div id='coinbase_row' class='row_thing'><h1 class='row_title'>Coinbase</h1><p class='lead'>"."$".$coinbase_sell." USD"."</p></div>\n";
            print "<div id='gox_row' class='row_thing'><h1 class='row_title'>Mt. Gox</h1><p class='lead'>"."$".$mtgox_sell." USD"."</p></div>\n";
            print "<div id='bitstamp_row' class='row_thing'><h1 class='row_title'>Bitstamp</h1><p class='lead'>"."$".$bitstamp_sell." USD"."</p></div>\n";
         ?>
      </div>
   </div>
</body>
</html>
