<?php namespace Arcanedev\SeoHelper\Tests;
use Arcanedev\SeoHelper\SeoMeta;

/**
 * Class     SeoMetaTest
 *
 * @package  Arcanedev\SeoHelper\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class SeoMetaTest extends TestCase
{
    /* ------------------------------------------------------------------------------------------------
     |  Properties
     | ------------------------------------------------------------------------------------------------
     */
    /** @var SeoMeta */
    private $seoMeta;

    /* ------------------------------------------------------------------------------------------------
     |  Main Functions
     | ------------------------------------------------------------------------------------------------
     */
    public function setUp()
    {
        parent::setUp();

        $configs       = $this->app['config']->get('seo-helper');
        $this->seoMeta = new SeoMeta($configs);

        $this->seoMeta->setUrl($this->baseUrl);
    }

    public function tearDown()
    {
        parent::tearDown();

        unset($this->seoMeta);
    }

    /* ------------------------------------------------------------------------------------------------
     |  Test Functions
     | ------------------------------------------------------------------------------------------------
     */
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(SeoMeta::class, $this->seoMeta);
        $this->assertNotEmpty($this->seoMeta->render());
    }

    /** @test */
    public function it_can_be_instantiated_by_container()
    {
        $this->seoMeta = $this->app['arcanedev.seo-helper.meta'];

        $this->assertInstanceOf(SeoMeta::class, $this->seoMeta);
        $this->assertNotEmpty($this->seoMeta->render());
    }

    /** @test */
    public function it_can_set_and_get_and_render_title()
    {
        $title = 'Awesome Title';

        $this->seoMeta->setTitle($title);

        $this->assertEquals($title, $this->seoMeta->getTitle());
        $this->assertEquals(
            '<title>' . $title . '</title>',
            $this->seoMeta->renderTitle()
        );

        $siteName = 'Company name';
        $this->seoMeta->setTitle($title, $siteName);

        $this->assertEquals($title, $this->seoMeta->getTitle());
        $this->assertEquals(
            '<title>' . $title . ' - ' . $siteName . '</title>',
            $this->seoMeta->renderTitle()
        );

        $separator = '|';
        $this->seoMeta->setTitle($title, $siteName, $separator);

        $this->assertEquals($title, $this->seoMeta->getTitle());
        $this->assertEquals(
            "<title>$title $separator $siteName</title>",
            $this->seoMeta->renderTitle()
        );
    }

    /** @test */
    public function it_can_set_and_get_and_render_description()
    {
        $description = 'Awesome Description';

        $this->seoMeta->setDescription($description);

        $this->assertEquals($description, $this->seoMeta->getDescription());
        $this->assertEquals(
            '<meta name="description" content="' . $description . '">',
            $this->seoMeta->renderDescription()
        );
    }

    /** @test */
    public function it_can_set_and_get_and_render_keywords()
    {
        $keywords = ['keyword-1', 'keyword-2', 'keyword-3', 'keyword-4', 'keyword-5'];

        $this->seoMeta->setKeywords($keywords);

        $this->assertEquals($keywords, $this->seoMeta->getKeywords());
        $this->assertEquals(
            '<meta name="keywords" content="' . implode(', ', $keywords) . '">',
            $this->seoMeta->renderKeywords()
        );

        $this->seoMeta->setKeywords(implode(',', $keywords));

        $this->assertEquals($keywords, $this->seoMeta->getKeywords());
        $this->assertEquals(
            '<meta name="keywords" content="' . implode(', ', $keywords) . '">',
            $this->seoMeta->renderKeywords()
        );

        $this->seoMeta->setKeywords(null);
        $this->assertEmpty($this->seoMeta->renderKeywords());
    }

    /** @test */
    public function it_can_add_one_keyword()
    {
        $keywords = ['keyword-1', 'keyword-2', 'keyword-3', 'keyword-4', 'keyword-5'];
        $this->seoMeta->setKeywords($keywords);

        $this->assertEquals($keywords, $this->seoMeta->getKeywords());

        $keywords[] = $keyword = 'keyword-6';
        $this->seoMeta->addKeyword($keyword);

        $this->assertEquals($keywords, $this->seoMeta->getKeywords());
    }
}
