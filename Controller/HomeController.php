<?php
/**
 * User: jairo
 * Date: 2/11/16
 * Time: 08:22 PM
 */

namespace Tucompu\CmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HomeController
 * @package Tucompu\CmsBundle\Controller
 * @Route("/page")
 */
class HomeController extends Controller
{
    /**
     * @Route("/")
     * @Template("CmsBundle:frontend:home.html.twig")
     */
    public function indexAction(Request $request)
    {
       // $request = $this->get('request');
        $lang = $request->getLocale();
        $articles = $this->get('webpage')->getAllArticles();
        $banner = $this->get('webpage')->getBannerActive();
        //$articles =
        return array(
            'articles' => $articles,
            'banners' => $banner
        );
    }

    /**
     * @Route("/{slug}", name="pageDetail")
     * @param $slug
     * @param $lang
     * @Template("CmsBundle:frontend:page.html.twig")
     * @return array
     */
    public function pageAction($slug)
    {
        $request = $this->get('request');
        $lang = $request->getLocale();
        $article = $this->get('webpage')->getArticleBySlugLang($slug,$lang);
        if($article == null){
            $article = $this->get('webpage')->getArticleBySlug($slug,$lang);
        }
        return array( 'article' => $article );
    }
}