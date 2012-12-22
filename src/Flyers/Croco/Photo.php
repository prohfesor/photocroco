<?php
namespace Flyers\Croco;

class Photo
{
    public static function queueGrab($gameId, $question)
    {
        $handler = PATH.'/bin/grab.php';
        system("nohup php {$handler} {$gameId} {$question}  >> /dev/null &");
    }

    public function grab($url, $name)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        $raw = curl_exec($ch);
        curl_close ($ch);
        if (file_exists($name)) unlink($name);
        $fp = fopen($name,'x');
        fwrite($fp, $raw);
        fclose($fp);
    }
}