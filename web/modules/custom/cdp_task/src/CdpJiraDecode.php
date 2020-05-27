<?php


namespace Drupal\cdp_task;


class CdpJiraDecode
{
  private $content;
  private $data;


  /**
   * @return array
   */
  public function __construct()
  {
    $this->jsonContent();
  }

  /**
   * @return array
   *  Decodes and returns jira.json file issues by keys
   **/
  private function jsonContent()
  {
    $this->content = file_get_contents('/var/www/html/web/sites/default/files/search.json');
    $this->content = json_decode($this->content);
    foreach ($this->content->issues as $item) {
      $this->data[] = $item->key;
    }
  }

  /**
   * @return array
   *  Json issues by keys
   */
  public function getContent()
  {
    return $this->data;
  }

}
