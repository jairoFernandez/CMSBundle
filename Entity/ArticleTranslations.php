<?php

namespace Tucompu\CmsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ArticleTranslations
 *
 * @ORM\Table(name="WEB_ArticleTranslations")
 * @ORM\Entity(repositoryClass="CmsBundle\Entity\ArticleTranslationsRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class ArticleTranslations
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="translations")
     */
    private $article;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="Languages")
     */
    private $language;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="shortDescription", type="string", length=255)
     */
    private $shortDescription;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isActive", type="boolean", nullable=true)
     */
    private $isActive;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="tags", type="string", length=255)
     */
    private $tags;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createAt", type="datetime")
     */
    private $createAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modifiedAt", type="datetime")
     */
    private $modifiedAt;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return ArticleTranslations
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set shortDescription
     *
     * @param string $shortDescription
     *
     * @return ArticleTranslations
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return ArticleTranslations
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return ArticleTranslations
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set tags
     *
     * @param string $tags
     *
     * @return ArticleTranslations
     */
    public function setTags($tags)
    {
        $this->tags = $tags;

        return $this;
    }

    /**
     * Get tags
     *
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }
    
    public function __toString()
    {
        return $this->getTitle()." (".$this->getLanguage()->getCode().")";
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return ArticleTranslations
     */
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * Set modifiedAt
     *
     * @param \DateTime $modifiedAt
     *
     * @return ArticleTranslations
     */
    public function setModifiedAt($modifiedAt)
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    /**
     * Get modifiedAt
     *
     * @return \DateTime
     */
    public function getModifiedAt()
    {
        return $this->modifiedAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedValue()
    {
        $this->setCreateAt(new \DateTime("now"));
        $this->setModifiedAt(new \DateTime("now"));
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAt()
    {
        $this->setModifiedAt(new \DateTime("now"));
    }

    /**
     * Set article
     *
     * @param \Tucompu\CmsBundle\Entity\Article $article
     * @return ArticleTranslations
     */
    public function setArticle(\Tucompu\CmsBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Get article
     *
     * @return \Tucompu\CmsBundle\Entity\Article 
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set language
     *
     * @param \Tucompu\CmsBundle\Entity\Languages $language
     * @return ArticleTranslations
     */
    public function setLanguage(\Tucompu\CmsBundle\Entity\Languages $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Tucompu\CmsBundle\Entity\Languages 
     */
    public function getLanguage()
    {
        return $this->language;
    }
}
