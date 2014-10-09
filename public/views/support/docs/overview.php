<legend>Overview</legend>
<p>
After installation and configuration is complete, you are ready to code!
</p>

<p>
It is important to note that much of the code that you write will implement the <code>Application::run()</code> command. This command is used internally throughout the code base, to ensure that all dependencies are met when calling various classes and methods. It will also be used often by the developer, to ensure system stability, as well as providing as consistent programming interface as possible.
</p>

<p>
Let's examine a quick example of the command.<br>
To set a $_SESSION variable, we would do so as follows:
<pre>
// Set session username to "Bob"
Application::run( 'session' )->set( 'username', 'Bob' );

// Say hi to Bob
echo 'Hello, ' . Application::run( 'session' )->fetch( 'username' );
</pre>
</p>
<p>
The above would output: <code>Hello, Bob</code>
</p>

<p>
Let's look at another example. This time, we will save Bob to the APC cache.
</p>
<p>
<pre>
// The Application::run( 'session' )->verify() method simply checks to see
// if a session key exists, and returns true or false

if ( Application::run( 'session' )->verify( 'username' ) )
{
	$key = Application::run( 'session' )->verify( 'username' );
    
    // The Application::run( 'session' )->fetch() method returns the value of the specified key
	$value = Application::run( 'session' )->fetch( 'username' );
	
    // Data stored into APC must have both a key and value
    Application::run( 'apc' )->add( $key, $value );
    
} else {
	
    // Error message
	echo 'The session key "username" does not exists';

}
</pre>
</p>
<p>
Since we have already set a $_SESSION key called "username" ( i.e., $_SESSION['username'] ) with the value "Bob", it will be successfully saved to the cache -- otherwise, if the session key 'username' did not exist, it would have printed the simple error message.
</p>

<p>
Hopefully this has not sounded overwhelming -- the functions that <code>Application::run()</code> performs is covered in great detail throughtout the docs. The important thing is simply to introduce you to the command, and give an idea of how it is used.
</p>