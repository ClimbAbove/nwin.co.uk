<?php

namespace Modules\Asset\Classes;

class JSShrink
{
    public static function minify($input)
    {
        return preg_replace_callback('(
		(?:
			(^|[-+\([{}=,:;!%^&*|?~]|/(?![/*])|return|throw) # context before regexp
			(?:\s|//[^\n]*+\n|/\*(?:[^*]|\*(?!/))*+\*/)* # optional space
			(/(?![/*])(?:
				\\\\[^\n]
				|[^[\n/\\\\]++
				|\[(?:\\\\[^\n]|[^]])++
			)+/) # regexp
			|(^
				|\'(?:\\\\.|[^\n\'\\\\])*\'
				|"(?:\\\\.|[^\n"\\\\])*"
				|([0-9A-Za-z_$]+)
				|([-+]+)
				|.
			)
		)(?:\s|//[^\n]*+\n|/\*(?:[^*]|\*(?!/))*+\*/)* # optional space
	)sx', 'self::jsShrinkCallback', "$input\n");
    }

    private static function jsShrinkCallback($match)
    {
        static $last = '';
        $match += array_fill(1, 5, null); // avoid E_NOTICE
        list(, $context, $regexp, $result, $word, $operator) = $match;
        if($word != '') {
            $result = ($last == 'word' ? "\n" : ($last == 'return' ? " " : "")) . $result;
            $last   = ($word == 'return' || $word == 'throw' || $word == 'break' ? 'return' : 'word');
        }
        elseif($operator) {
            $result = ($last == $operator[0] ? "\n" : "") . $result;
            $last   = $operator[0];
        }
        else {
            if($regexp) {
                $result = $context . ($context == '/' ? "\n" : "") . $regexp;
            }
            $last = '';
        }

        return $result;
    }
}
