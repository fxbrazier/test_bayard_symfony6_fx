<?php

namespace App\Entity\traits;

use App\Entity\Article;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

trait FromXML {
    /**
    * Transforms xml file.
    */
    public function transform(string $xmlFile): string
    {
        $xml = simplexml_load_file($xmlFile , 'SimpleXMLElement');

        $value = $xml->URL;

        $url = $this->childToNonEmpty($value);

        return $url->getUrl();
    }

    /**
    * Tries to return child node text value of the given element as a NonEmpty value object.
    */
    final public function childToNonEmpty(string $value, string $type = Article::class): ?Article
    {
        if (null === $value) {
            return null;
        }
        
        return $this->toNonEmpty($value, $type);
    }

    /**
    * Converts string value to NonEmpty value object.
    */
    final public function toNonEmpty(string $value, string $type = Article::class): Article
    {
        $article = new Article();
        $article->setUrl($value);

        $isValid = is_a($article, $type, true);
        
        if (!$isValid) {
            return null;
        }

        return $article;
    }
}