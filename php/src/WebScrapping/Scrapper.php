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

        //Buscando os divs com tipo, ID e autores para criar o objeto Paper
        $divElements = $element->getElementsByTagName('div');

        $authors = array();
        $paperType = '';
        foreach($divElements as $divElement)
        {

          if($divElement->getAttribute('class') == 'authors')
          {
            $authorElements = $divElement->getElementsByTagName('span');
          //Loop pelos autores e registrando-os no array de Persons $authors
            foreach ($authorElements as $authorElement) 
            {
              $authorInstitution = $authorElement->getAttribute('title');
              $authorName = $authorElement->textContent;
              $person = new Person($authorName, $authorInstitution);
              $authors[] = $person;
            }

          }
                      
          if ($divElement->getAttribute('class') == 'tags mr-sm')
          {
            $paperType = $divElement->textContent;
          }

          if ($divElement->getAttribute('class') == 'volume-info')
                {
                  $paperId = $divElement->textContent;
                  
                }
        }

        //Criando objeto Paper e registrando-o no array de papers que será retornado pelo Scrapper
        $paper = new Paper($paperId, $title, $paperType, $authors);
        $paper->id = $paperId;
        $paper->title = $title;
        $paper->type = $paperType;
        $paper->authors = $authors;
        $papersArray[] = $paper;
        
    }

    return $papersArray;
  }
}
