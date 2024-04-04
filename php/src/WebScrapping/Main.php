<?php

namespace Chuva\Php\WebScrapping;

/**
 * Runner for the Webscrapping exercice.
 */
class Main {


  /**
   * Main runner, instantiates a Scrapper and runs.
   */
  public static function run(): void {
    $dom = new \DOMDocument('1.0', 'utf-8');
    $dom->loadHTMLFile(__DIR__ . '/../../assets/origin.html');

    $data = (new Scrapper())->scrap($dom);

    // Write your logic to save the output file bellow.
    print_r($data);
  }

  //Função que define o paper com maior numero de autores
  function definePaperWithMoreAuthors($paperArray): int
  {
    $maxAuthors = 1;
    foreach ($paperArray as $paper) {
      if (count($paper->authors) > $maxAuthors) {
        $maxAuthors = count($paper->authors);
      }
    }
    return $maxAuthors;
  }

  //Função para escrever o header da planilha
  function createHeader($maxAuthors): array
  {
    $headerRow = [
      'ID',
      'Title',
      'Type',
    ];
    //Faz com que o paper com maior número de autores defina o header
    for ($i = 1; $i <= $maxAuthors; $i++) {
      $newAuthor = "Author $i";
      $newAuthorInstitution = "Author $i Institution";
      $headerRow[] = $newAuthor;
      $headerRow[] = $newAuthorInstitution;
    }
    return $headerRow;
  }

}
