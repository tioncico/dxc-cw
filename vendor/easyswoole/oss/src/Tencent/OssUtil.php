<?php

namespace EasySwoole\Oss\Tencent;

class OssUtil
{
    static function filterQueryAndFragment($str)
    {
        $charUnreserved = 'a-zA-Z0-9_\-\.~';
        $charSubDelims = '!\$&\'\(\)\*\+,;=';
        if (!is_string($str)) {
            throw new \InvalidArgumentException('Query and fragment must be a string');
        }
        return preg_replace_callback(
            '/(?:[^' . $charUnreserved . $charSubDelims . '%:@\/\?]++|%(?![A-Fa-f0-9]{2}))/',
            function ($match) {
                return rawurlencode($match[0]);
            },
            $str
        );

    }


    static function regionMap($region)
    {
        $regionmap = array('cn-east'      => 'ap-shanghai',
                           'cn-south'     => 'ap-guangzhou',
                           'cn-north'     => 'ap-beijing-1',
                           'cn-south-2'   => 'ap-guangzhou-2',
                           'cn-southwest' => 'ap-chengdu',
                           'sg'           => 'ap-singapore',
                           'tj'           => 'ap-beijing-1',
                           'bj'           => 'ap-beijing',
                           'sh'           => 'ap-shanghai',
                           'gz'           => 'ap-guangzhou',
                           'cd'           => 'ap-chengdu',
                           'sgp'          => 'ap-singapore');
        if (array_key_exists($region, $regionmap)) {
            return $regionmap[$region];
        }
        return $region;
    }

    static function encodeKey($key)
    {
        return str_replace('%2F', '/', rawurlencode($key));
    }

    static function endWith($haystack, $needle)
    {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }
        return (substr($haystack, -$length) === $needle);
    }



   static function startWith( $haystack, $needle ) {
        $length = strlen( $needle );
        if ( $length == 0 ) {
            return true;
        }
        return ( substr( $haystack, $length ) === $needle );
    }

   static function headersMap( $command, $request ) {
        $headermap = array(
            'TransferEncoding'=>'Transfer-Encoding',
            'ChannelId'=>'x-cos-channel-id'
        );
        foreach ( $headermap as $key => $value ) {
            if ( isset( $command[$key] ) ) {
                $request = $request->withHeader( $value, $command[$key] );
            }
        }
        return $request;
    }
}
