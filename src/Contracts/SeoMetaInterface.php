<?php namespace Arcanedev\SeoHelper\Contracts;

/**
 * Interface  SeoMetaInterface
 *
 * @package   Arcanedev\SeoHelper\Contracts
 * @author    ARCANEDEV <arcanedev.maroc@gmail.com>
 */
interface SeoMetaInterface extends Renderable
{
    /* ------------------------------------------------------------------------------------------------
     |  Getters & Setters
     | ------------------------------------------------------------------------------------------------
     */
    /**
     * Get the title.
     *
     * @return string
     */
    public function getTitle();

    /**
     * Set the title.
     *
     * @param  string  $title
     * @param  string  $siteName
     * @param  string  $separator
     *
     * @return self
     */
    public function setTitle($title, $siteName = null, $separator = null);

    /**
     * Get the description content.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set the description content.
     *
     * @param  string  $content
     *
     * @return self
     */
    public function setDescription($content);

    /**
     * Get the keywords content.
     *
     * @return array
     */
    public function getKeywords();

    /**
     * Set the keywords content.
     *
     * @param  array|string  $content
     *
     * @return self
     */
    public function setKeywords($content);

    /**
     * Add a keyword.
     *
     * @param  string  $keyword
     *
     * @return self
     */
    public function addKeyword($keyword);

    /**
     * Set the current URL.
     *
     * @param  string  $url
     *
     * @return self
     */
    public function setUrl($url);
}
