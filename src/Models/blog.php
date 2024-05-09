<?php

class Blog{
  private $header;
  private $content;
  public function __construct( $header, $content ){
    $this->header = $header;
    $this->content = $content;
  }

  
  public function getContent(){
    return $this->content;
  }
  public function setContent( $content ){
    $this->content = $content;
  }
  public function getHeader(){
    return $this->header;
  }
  public function setHeader( $header ){
    $this->header = $header;
  }
}