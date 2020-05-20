<?php


namespace Drupal\cdp_task;


use Drupal\cdp_task\Plugin\rest\resource\JiraBaResource;
use Drupal\rest\Plugin\ResourceBase;
use Symfony\Component\Serializer\Encoder\JsonDecode;

class CdpJiraDecode
{
  private $content;
  private $data;


  /**
   * @return mixed
   */
  public function __construct()
  {
    $this->jsonContent();
  }

  private function jsonContent(){
    $this->content = file_get_contents('/var/www/html/web/sites/default/files/search.json');
    $this->content = json_decode($this->content);
    $this->jiraBa();
    foreach ($this->content->issues as $item){
      $this->data[] = $item->key;
    }
  }

  public function getContent()
  {
    return $this->data;
  }

  private function jiraBa() {

    $resource = JiraBaResource::create();
//    'https://jira.baltic-amadeus.lt/rest/api/2/search?jql=project=PRIM&maxResults=7'

  }
}
