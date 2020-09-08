<?php
// Class to tweet on Twitter.
class CodeTwit {
    function tweet($status, $url)
    {
      var_dump('Tweeted:'.$status.' from:'.$url);
    }
  }
  
  // Class to share on Google plus.
  class Googlize {
    function share($url)
    {
      var_dump('Shared on Google plus:'.$url);
    }
  }
  
  // Class to share in Reddit.
  class Reddiator {
    function reddit($url, $title)
    {
      var_dump('Reddit! url:'.$url.' title:'.$title);
    }
  }
 
  $c = new CodeTwit();
  echo $c->tweet("just a status", "url given");


// As you can see above, in order to share a message on three different social media channels, we ended up repeating same steps three times. 
// It would be even more painful if we had more social media channels to share the message. 
// What would be an ideal scenario is, sharing the message on all social media channels in one go. 
// To do that, we can introduce a Facade class as seen below.

// We can simplify the code by using a Façade class with the following characteristics:
// It holds references to the classes that it uses (in our case, to the CodeTwit, Googlize, and the Reddiator classes).
// 1. It has a method that calls all of the methods that we need.
// 2. A façade class enables us to call only one method instead of calling to many methods. 
//By doing so, it simplifies the work with the system, and allows us to have a simpler and more convenient interface.
// 
// In our example, the shareFacade class gets the social networks objects injected to its constructor, holds these objects by reference, 
// and has the ability to call to all of the share methods from a single share method.
    
// The Facade class
class shareFacade {
    // Holds a reference to all of the classes.
    protected $twitter;    
    protected $google;   
    protected $reddit;    
      
    // The objects are injected to the constructor.   
    function __construct($twitterObj,$gooleObj,$redditObj)
    {
      $this->twitter = $twitterObj;
      $this->google  = $gooleObj;
      $this->reddit  = $redditObj;
    }  
          
    // One function makes all the job of calling all the share methods
    //  that belong to all the social networks.
    function share($url,$title,$status)
    {
      $this->twitter->tweet($status, $url);
      $this->google->share($url);
      $this->reddit->reddit($url, $title);
    }
  }
  
  // Create the objects from the classes.
  $twitterObj = new CodeTwit();
  $gooleObj   = new Googlize();
  $redditObj  = new Reddiator();
  
  // Pass the objects to the class facade object.
  $shareObj = new shareFacade($twitterObj,$gooleObj,$redditObj);
  
  // Call only 1 method to share your post with all the social networks.
  
  $shareObj->share('https://meme-forever.com/post-meme','My greatest Meme','Read my greatest meme ever.');
  