/*
	This will take the submitted zip code, and populate
	the city and state fields by searching the DB for
	the corresponding locations. Since multiple cities,
	towns, etc typically share the same Zip, we need to
	store the cities in a <select> field.
	
	-- Notes --
	
	* Zip code field must always have the id of "zip"
	* State field must always have id of "state"
	* City field must always have id of "city"
	
	The zip code field should always appear first on the
	form, since the city / state relies on the zip being
	submitted.
	
	The script gets it's city and state data from the
	following files:
	
	http://localhost/codeigniter/application/ajax/get_city.php
	http://localhost/codeigniter/application/ajax/get_state.php
	
	The above scripts retrieve the data from the "zips" DB table.
	
	All the city / state / zip code information is supplied by
	MaxMind GeoIP [ http://www.maxmind.com/en/geolocation_landing ]
*/
$(document).ready(function()
        {
            $("#zip").change(function()
            {
                var zip = $(this).val();//get select value
                $.ajax(
                {
                    url:'http://localhost/dating/public/plugins/ajax/get_city.php',
                    type:"post",
                    data:{zip:$(this).val()},
                    success:function(response)
                    {
                        $("#city").html(response);
                    }
                });
            });
        });
		
$(document).ready(function()
        {
            $("#zip").change(function()
            {
                var zip = $(this).val();//get select value
                $.ajax(
                {
                    url:"http://localhost/dating/public/plugins/ajax/get_state.php",
                    type:"post",
                    data:{zip:$(this).val()},
                    success:function(response)
                    {
                        $("#state").html(response);
                    }
                });
            });
        });