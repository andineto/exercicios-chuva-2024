<?php

namespace Chuva\Php\WebScrapping;

use Chuva\Php\WebScrapping\Entity\Paper;
use Chuva\Php\WebScrapping\Entity\Person;

/**
 * Does the scrapping of a webpage.
 */
class Scrapper {

  /**
   * Loads paper information from the HTML and returns the array with the data.
   */
  public function scrap(\DOMDocument $dom): array {
    $papersArray = array();
    // Loop através de cada tag "a"
    $elements = $dom->getElementsByTagName('a');

    foreach ($elements as $element) 
    {
        // Verificar se o elemento possui a classe "paper-card p-lg bd-gradient-left"
        if ($element->getAttribute('class') == 'paper-card p-lg bd-gradient-left')
        {
          $title = $element->getElementsByTagName('h4')->item(0)->textContent;
        } 
    }
    return [];
  }
}
