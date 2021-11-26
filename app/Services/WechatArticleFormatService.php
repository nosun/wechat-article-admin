<?php

namespace App\Services;

use voku\helper\HtmlDomParser;

class WechatArticleFormatService
{
    public static function format(String $content_original): string
    {
        $content_original = stripslashes($content_original);
        $dom = HtmlDomParser::str_get_html($content_original);

        // remove style
        self::removeStyle($dom, 'div');

        // get all paragraphs and extra the content
        $ps = $dom->find('p');
        $content = '';

        if ($ps->count()) {
            foreach ($ps as $p) {
                $spans = $p->find('span');
                if ($spans->count()) {
                    $content .= '<p>';
                    foreach ($spans as $span) {
                        $span_content = trim($span->innerHtml());
                        if (!empty($span_content)) {
                            $content .= $span_content;
                        }
                    }
                    $content .= '</p>';
                } else {
                    $p_content = trim($p->innerHtml());
                    if (!empty($p_content)) {
                        $content .= "<p>" . $p_content . "</p>";
                    }
                }
            }
        }

        $content = self::removeHtmlTag($content);
        $content = self::removeBlank($content);
        $content = self::removeSpecialChar($content);
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
        $content = str_replace('<br>', '', $content);
        $content = str_replace('<br />', '', $content);
        $content = str_replace('<strong>', '', $content);
        $content = str_replace('</strong>', '', $content);
        $content = str_replace('<span>', '', $content);
        $content = str_replace('</span>', '', $content);
        return $content;
    }

    public static function removeBlank($content)
    {
        $content = str_replace(['u00A0', 'u0020', 'u3000', 'xa0','\\n'], ['', '', '', '',''], $content);
        return $content;
    }

    public static function removeSpecialChar($content)
    {
        $content = str_replace(['◆', '■', '♥','▋'], ['', '', '',''], $content);
        return $content;
    }

    public static function removeBlankParagraph($content)
    {
        $content = str_replace('<p></p>', '', $content);
        return $content;
    }
}
