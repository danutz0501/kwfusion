<legend>Pagination Helper</legend>
<p>
Paginating data is to break up a large data set into small, manageable chunks. For example, if you have a hundred records to display, rather than displaying all 
those records onto one page, you would instead break it up into five different pages, each containing 20 records. Each page would then contain links to the next 
(or previous page). Below is an example of how the pagination links are commonly displayed:
</p>

<div class="white-row">

<blockquote>Data record 1</blockquote>
<blockquote>Data record 2</blockquote>
<blockquote>Data record 3</blockquote>
<blockquote>Etc....</blockquote>

<ul class='pagination'>
	<li><a class='current'>1</a></li>
	<li><a class='current'>2</a></li>
	<li><a class='current'>3</a></li>
	<li><a class='dot'>...</a></li>
	<li><a class='current'>8</a></li>
	<li><a class='current'>9</a></li>
	<li><a class='current'>10</a></li>
	<li><a class='current'>Last</a></li>
</ul>
</div>

<p>
Creating a script to paginate data isn't terribly complex, but is very tedious. Fortunately, the Pagination helper makes it very quick and simple to paginate 
your data for you.
</p>


<legend>Accessing Pagination Helper</legend>
<p>
The Pagination Toolbox is accessed through your controllers, using the following command: <code>Toolbox::helper("Pagination");</code>
</p>

<legend>Usage Examples</legend>
<p>
The first step when using the helper is to assign it to a variable: <code>$p = Toolbox::helper("Pagination");</code>
</p>
<p>
Next, you will need to setup a few configuration options.

<ol>
	<li><strong>$page</strong><br>The current page number. Use the route parameters (<code>$this->route->param</code>) to determine where in the url the page number is located.</li>
	<li><strong>$per_page</strong><br>Number of records to display per page.</li>
	<li><strong>$startpoint</strong><br>The query offset. Do not change this variable.</li>
	<li><strong>$table</strong><br>The database table being queried.</li>
	<li><strong>$where</strong><br>The WHERE clause.</li>
	<li><strong>$where_values</strong><br>Value of the WHERE placeholders.</li>
</ol>
<br>
After the configuration options are set, they are passed to the Pagination helper's pagination() function, as shown below:<br>
<code>$p = Toolbox::helper("Pagination");</code><br>
<code>$p->paginate( $table, $where = null, $where_values = null, $per_page, $page );</code>
</p>

<p>
<h6>Below is an example script which retrieves city/states from the database.</h6>
<em>Controller file</em>
<div class="console">
	##########################################<br>
	##### Prepare configuration settings #####<br>
	##########################################<br><br>
	// Set up paginator<br>
	$p = Toolbox::helper("Pagination");<br><br>
	// Tell the paginator which URL segment contains the page number<br>
	// $this->route->param2 means the second parameter of the URL<br>
	// Remember that the URL is organized into three segments -- controller / action / parameters<br>
	// So if your URL is http://example.com/geo/index/cities/123, then the URL is structured as follows:<br>
	// the first two segments are always the controller and action, so /geo/ is the controller segment,<br>
	// /index/ is the action segment, and everything after the /index/ segment are considered URL parameters,<br>
	// therefore /cities/ would be parameter 1 (ie, $this->route->param1), and /123 is parameter 2 (ie, $this->route->param2)<br>
	### Note: Since the first two segments of the URL is always reserved for the controller, then the action, in that order, for pagination<br>
	### purposes, the $page variable must always be set to one of the URL parameters ($this->route->param1, $this->route->param2, etc)<br>
	### See the docs on the Router for more information<br>
	$page = ( empty( $this->route->param2 ) ? 1 : $this->route->param2 );<br><br>
	// How many records to display on each page<br>
    $per_page = 10;<br><br>
    // Do not change the $startpoint variable; it's purpose is to<br>
    // keep track of where in the database the paginator needs to fetch records from<br>
    $startpoint = ($page * $per_page) - $per_page;<br><br>
    // the database table you are querying<br>
    $table = "db_table_name";<br><br>
    #########################################<br>
	##### End of configuration settings #####<br>
	#########################################<br><br>

    // An example query to be paginated<br>
    $query = $this->db->prepare("SELECT citycode, statecode FROM {$table} LIMIT {$startpoint}, {$per_page}");<br>
    // Execute the query<br>
    $query->execute();<br><br>
    // Store the query results in an array named $data['location'][]<br>
    // which will be passed to the view file for display<br>
    foreach( $query as $row ) {<br>
	    // Note the empty brackets []<br>
	    $data['location'][] = $row;<br>
    }<br><br>
    // Create the pagination links. Store it to the $data array so that we can pass it to the view as well<br>
    $data['pagination'] = $p->paginate( $table, $where = null, $where_values = null, $per_page, $page );<br><br>
    // Fetch the view file, and pass $data array<br>
	$this->view('geo/index', $data);<br>

</div>
</p>

<p>
<em>View file</em>
<div class="console">
/**<br>
 &nbsp;* $data['location'] is the array created by the query loop in the controller file<br>
 &nbsp;* $data['pagination'] is the pagination links, also created in the controller file<br>
 &nbsp;*/<br><br>
 &lt;?php foreach( $data['location'] as $city ): ?><br><br>

 &lt;?= $city['citycode'] . ', ' . $city['statecode'].'&lt;br>'; ?><br><br>

 &lt;?php endforeach; ?><br><br>

 &lt;?= $data['pagination']; ?>
</div>
</p>

<legend>Using WHERE clause in queries</legend>
<p>
In the above example, we retrieved all of the cities and states contained in our database, using the query: 
<code>$query = $this->db->prepare("SELECT citycode, statecode FROM {$table} LIMIT {$startpoint}, {$per_page}");</code>. <br>
However, what if we wanted to only get a specific city? Or if we wanted to get a specific city/state combo? In order to do so, we 
would need to add a WHERE clause to the above query. Now we could simply rewrite the above query like this:<br>
 
<code class="text-warning">$query = $this->db->prepare("SELECT citycode, statecode FROM {$table} 
<strong>WHERE citycode = 'New York' AND statecode = 'NY'</strong> LIMIT {$startpoint}, {$per_page}");
</code><br>
however there are a couple issues doing it in that manner.<br>
The first problem is that we are inserting data directly into the query, rather than using PDO's prepared statements. 
Not using, or improperly using, prepared statements can be very dangerous and introduces security holes.<br>
Secondly, additional formatting is necessary in order to work with the Pagination helper, since by default, it will only
execute prepared PDO statements.
</p>

<p>
Fortunately, the Pagination helper makes it as simple as possible to add the WHERE clause. In fact, it is nearly identical 
to the first example, except this time, we are creating just two extra variables - <code>$where</code> and <code>$where_values</code>
</p>

<div class="console">
	##########################################<br>
	##### Prepare configuration settings #####<br>
	##########################################<br><br>
	// Set up paginator<br>
	$p = Toolbox::helper("Pagination");<br><br>
	// Tell the paginator which URL segment contains the page number<br>
	$page = ( empty( $this->route->param2 ) ? 1 : $this->route->param2 );<br><br>
	// How many records to display on each page<br>
    $per_page = 10;<br><br>
    // Do not change the $startpoint variable; it's purpose is to<br>
    // keep track of where in the database the paginator needs to fetch records from<br>
    $startpoint = ($page * $per_page) - $per_page;<br><br>
    // the database table you are querying<br>
    $table = "db_table_name";<br><br>
    #########################################<br>
	##### End of configuration settings #####<br>
	#########################################<br><br>

	// The query WHERE parameter<br>
	$where = "WHERE citycode = ? AND statecode = ?";<br><br>
	// The WHERE placeholder (?) values<br>
	$where_values = array("Hanover", "PA");<br><br>

    // Add the $where variable to the query<br>
    $query = $this->db->prepare("SELECT citycode, statecode FROM {$table} {$where} LIMIT {$startpoint}, {$per_page}");<br>
    // And pass the placeholder values to the execute statement<br>
    $query->execute( $where_values );<br><br>
    // Store the query results in an array named $data['location'][]<br>
    // which will be passed to the view file for display<br>
    foreach( $query as $row ) {<br>
	    // Note the empty brackets []<br>
	    $data['location'][] = $row;<br>
    }<br><br>
    // Finally, change the default $where = null, $where_values = null to simply $where and $where_values<br>
    $data['pagination'] = $p->paginate( $table, $where, $where_values, $per_page, $page );<br><br>
    // Fetch the view file, and pass $data array<br>
	$this->view('geo/index', $data);<br>

</div>