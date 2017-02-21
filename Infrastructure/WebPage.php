<?php
/**
 * User: jairo
 * Date: 5/11/16
 * Time: 03:41 PM
 */

namespace Tucompu\CmsBundle\Infrastructure;


use Tucompu\CmsBundle\Entity\Article;
use Tucompu\CmsBundle\Entity\Banner;
use Tucompu\CmsBundle\Entity\Menu;

class WebPage
{
    private $manager;
    private $container;
    /**
     * Report constructor.
     */
    public function __construct($repository = null, $container)
    {
        $this->manager = $repository;
        $this->container = $container;
    }

    public function getAllArticles()
    {
        $article = $this->manager->getRepository(Article::class)->obtainAll();
        return $article;
    }

    public function getArticleBySlugLang($slug, $lang)
    {
        $article = $this->manager->getRepository(Article::class)->ObtainArticleBySlugLang($slug, $lang);
        return $article;
    }

    public function getArticleBySlug($slug)
    {
        $article = $this->manager->getRepository(Article::class)->ObtainArticleBySlug($slug);
        return $article;
    }

    public function getAllArticlesLang($lang, $quantity = null)
    {
        $articles = $this->manager->getRepository(Article::class)->obtainArticlesLang($lang, $quantity);
        return $articles;
    }

    public function getAllArticlesD($quantity = null)
    {
        $articles = $this->manager->getRepository(Article::class)->obtainArticles($quantity);
        return $articles;
    }

    public function getMenu()
    {
        $menus = $this->manager->getRepository(Menu::class)->findBy(array(
                'isActive'=> true,
            ),array(
                'position'=>'ASC'
            )
        );
        return $menus;
    }

    public function getBannerActive()
    {
        $banner = $this->manager->getRepository(Banner::class)->ObtainBannerActiveImages();
        return $banner;
    }
}