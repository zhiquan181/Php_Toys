<?php
  /**
  * kuaidi_query
  */
  class kuaidi_query
  {
    private $kuaidi;
    private $get_data;
    
    public function __construct($get_data)
    {
      $this->kuaidi = $get_data;
    }

    public function object_array($array)
    {
       if(is_object($array))
       {
        $array = (array)$array;
       }
       if(is_array($array))
       {
        foreach($array as $key=>$value)
        {
         $array[$key] = $this->object_array($value);
        }
       }
       return $array;
    }

    public function kuaidi_query_number(){
      $kuaidi = $_POST['kuaidi'];
      $company = file_get_contents("http://m.kuaidi100.com/autonumber/auto?num=".$kuaidi);
      preg_match_all('/"(.*?)"/',$company,$match);
      $company = $match[1][1];
      $company = file_get_contents("http://m.kuaidi100.com/query?type=".$company."&postid=".$kuaidi."&id=1&valicode=");
      $c= json_decode($company); 
      $array = $this->object_array($c);
      return $array;
    }

    

  }


?>