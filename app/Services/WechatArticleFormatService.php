<?php

namespace App\Services;

use voku\helper\HtmlDomParser;
use HTMLPurifier;

class WechatArticleFormatService
{
    public static function format(String $content_original): string
    {
//        $content_original = htmlspecialchars_decode($content_original);
//        $content_original = stripslashes($content_original);
//        $content_original = self::preClean($content_original);
        $config = \HTMLPurifier_Config::createDefault();
        $config->set('Core.Encoding', 'UTF-8'); // replace with your encoding
        $config->set('HTML.Doctype', 'XHTML 1.0 Transitional'); // replace with your doctype
        $config->set('HTML.Allowed', 'p,strong'); // replace with your doctype
        $purifier = new HTMLPurifier($config);
        $pure_html = $purifier->purify($content_original);
//        // remove style
//        $content_original = self::removeHtmlStyle($content_original);
//        // dd($content_original);
//
//        $dom = HtmlDomParser::str_get_html($content_original);
//
//        // get all paragraphs
//        $ps = $dom->find('p,section');
//
//        $content = '';
//
//        if ($ps->count()) {
//            foreach ($ps as $p) {
//                $p_content = trim($p->innerHtml());
//                if (!empty($p_content)) {
//                    $content .= "<p>" . $p_content . "</p>";
//                }
//            }
//        }
//
        $content = self::finalClean($pure_html);

        return $content;
    }

    /**
     * 预清洗
     * @param $content
     * @return mixed|string
     */
    public static function preClean($content)
    {
        $content = str_replace('""', '"', $content);
        $content = self::removeBlankStrong($content);
        return $content;
    }

    /**
     * @param $content
     * @return string
     */
    public static function finalClean($content)
    {
        $content = self::removeHtmlTag($content);
        $content = self::removeBlank($content);
        $content = self::removeSpecialChar($content);
        $content = self::removeBlankStrong($content);
        $content = self::removeBlankParagraph($content);
        return $content;
    }

    /**
     * @param $node
     * @param $root
     */
    public static function removeStyle($node, $root = null)
    {
        if ($root) {
            $nodes = $node->find($root);
            foreach ($nodes as $node) {
                self::removeStyle($node);
            }
        } else {
            $node->removeAttribute('style');
            if ($node->children()->count()) {
                $children = $node->children();
                foreach ($children as $child) {
                    self::removeStyle($child);
                }
            }
        }
    }

    public static function removeHtmlTag($content)
    {
        $content = preg_replace("/<img(.*?)>/", '', $content);
        $content = preg_replace("/<iframe(.*?)\/iframe>/", '', $content);
        $content = preg_replace("/<a(.*?)\/a>/", '', $content);
        $content = str_replace(['<br>', '<br />'], ['', ''], $content);
        $content = str_replace(['<span>', '</span>'], ['', ''], $content);
        $content = str_replace(['<section>', '</section>'], ['', ''], $content);
        $content = str_replace(['<em>', '</em>'], ['', ''], $content);
        return $content;
    }

    public static function removeHtmlStyle($content)
    {
        $content = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $content);
        $content = preg_replace('/(<[^>]+) rgb=".*?"/i', '$1', $content);
        $content = preg_replace('/(<[^>]+) normal=".*?"/i', '$1', $content);
        $content = preg_replace('/(<[^>]+) simhei=".*?"/i', '$1', $content);
        $content = preg_replace('/(<[^>]+) break-word=".*?"/i', '$1', $content);
        $content = preg_replace('/(<[^>]+) border-box=".*?"/i', '$1', $content);
        $content = preg_replace('/(<[^>]+) center=".*?"/i', '$1', $content);
        $content = preg_replace('/(<[^>]+) class=".*?"/i', '$1', $content);
        $content = preg_replace('/(<[^>]+) id=".*?"/i', '$1', $content);
        return $content;
    }

    public static function removeBlank($content)
    {
        $content = str_replace(['u00A0', 'u0020', 'u3000', 'xa0', '\\n'], ['', '', '', '', ''], $content);
        return $content;
    }

    public static function removeSpecialChar($content)
    {
        $content = str_replace(['◆', '■', '♥', '▋'], ['', '', '', ''], $content);
        return $content;
    }

    public static function removeBlankParagraph($content)
    {
        $content = str_replace('<p></p>', '', $content);
        return $content;
    }

    public static function removeBlankStrong($content)
    {
        $content = str_replace('<strong><strong>', '<strong>', $content);
        $content = str_replace('</strong></strong>', '</strong>', $content);
        $content = str_replace('<strong></strong>', '', $content);
        return $content;
    }
}
