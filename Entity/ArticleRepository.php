<?php

namespace Tucompu\CmsBundle\Entity;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends \Doctrine\ORM\EntityRepository
{
    public function obtainAll()
    {
        $em = $this->getEntityManager();

        $articles = $em->createQuery('
            SELECT a,ts,l FROM CmsBundle:Article a 
            JOIN a.translations ts
            JOIN ts.language l
            WHERE a.isActive = true AND ts.isActive = true
        ');

        return $articles->getResult();
    }

    public function obtainArticles($lang, $quantity)
    {
        $em = $this->getEntityManager();
        $articles = $em->createQuery('
            SELECT ats,a,l FROM CmsBundle:ArticleTranslations ats
            JOIN ats.article a
            JOIN ats.language l
            WHERE l.code = :lang
        ');
        $articles->setParameter('lang', $lang);
        if($quantity != null){
            $articles->setMaxResults($quantity);
        }

        return $articles->getResult();
    }

    public function obtainArticlesLang($lang, $quantity)
    {
        $em = $this->getEntityManager();
        $articles = $em->createQuery('
            SELECT ats,a,l FROM AppBundle:ArticleTranslations ats
            JOIN ats.article a
            JOIN ats.language l
            WHERE l.code = :lang
        ');
        $articles->setParameter('lang', $lang);
        if($quantity != null){
            $articles->setMaxResults($quantity);
        }

        return $articles->getResult();
    }

    public function ObtainArticleBySlugLang($slug, $lang)
    {
        if($slug == null || $slug == ''){
            $slug = 'es';
        }
        $em = $this->getEntityManager();
        $articles = $em->createQuery('
            SELECT ats,a,l FROM AppBundle:ArticleTranslations ats
            JOIN ats.article a
            JOIN ats.language l
            WHERE l.code = :lang AND a.slug = :slug
        ');
        $articles->setParameter('lang', $lang);
        $articles->setParameter('slug', $slug);
        $articles->setMaxResults(1);
        return $articles->getOneOrNullResult();
    }

    public function ObtainArticleBySlug($slug)
    {
        if($slug == null || $slug == ''){
            $slug = 'es';
        }
        $em = $this->getEntityManager();
        $articles = $em->createQuery('
            SELECT ats,a,l FROM AppBundle:ArticleTranslations ats
            JOIN ats.article a
            JOIN ats.language l
            WHERE a.slug = :slug
        ');
        $articles->setParameter('slug', $slug);
        $articles->setMaxResults(1);
        return $articles->getOneOrNullResult();
    }
}