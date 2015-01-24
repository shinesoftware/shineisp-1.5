<?php 
namespace Base\View\Helper;
use Zend\View\Helper\AbstractHelper;

class YouTube extends AbstractHelper
{
    public function __invoke($text)
    {
        $text = preg_replace('~
                # Match non-linked youtube URL in the wild. (Rev:20130823)
                https?://         # Required scheme. Either http or https.
                (?:[0-9A-Z-]+\.)? # Optional subdomain.
                (?:               # Group host alternatives.
                youtu\.be/      # Either youtu.be,
                | youtube         # or youtube.com or
                (?:-nocookie)?  # youtube-nocookie.com
                \.com           # followed by
                \S*             # Allow anything up to VIDEO_ID,
                [^\w\s-]       # but char before ID is non-ID char.
        )                 # End host alternatives.
                ([\w-]{11})      # $1: VIDEO_ID is exactly 11 chars.
                (?=[^\w-]|$)     # Assert next char is non-ID or EOS.
                (?!               # Assert URL is not pre-linked.
                [?=&+%\w.-]*    # Allow URL (query) remainder.
                (?:             # Group pre-linked alternatives.
                [\'"][^<>]*>  # Either inside a start tag,
                | </a>          # or inside <a> element text contents.
        )               # End recognized pre-linked alts.
        )                 # End negative lookahead assertion.
                [?=&+%\w.-]*        # Consume any URL (query) remainder.
                ~ix',
                '<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="http://www.youtube.com/embed/$1"></iframe></div>',
                $text);
        
        return $text;
    }
    
}