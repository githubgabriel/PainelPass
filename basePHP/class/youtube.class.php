<?php
/*
    @author Gabriel A. Barbosa
    @email tx.gabrielbarbosa@gmail.com
    @desc Funcoes para Youtube
    @version 1.0.0
    @update 11/FEV/2015
*/

class Youtube {


    /*

                    FUNCTIONS YOUTUBE

    */
    public function get_YouTubeIdFromURL($url) {
        $url_string = parse_url($url, PHP_URL_QUERY);
        parse_str($url_string, $args);
        return isset($args['v']) ? $args['v'] : "Erro Get Url Youtube";
    }

    public function get_ImagemYouTube($url, $tipo = 0){
        $id = $this->get_YouTubeIdFromURL($url);
        if (!empty($id) && in_array($tipo, array(0,1,2,3,'default'))){
            $saida = 'http://i1.ytimg.com/vi/'.$id.'/'.$tipo.'.jpg';
        } else { $saida = "Falta Parametros para capturar tela video youtube"; }
        return $saida;
    }

    public function get_EmbedYouTube($url,$largura,$altura) {

        $id = $this->get_YouTubeIdFromURL($url);
        $width = $largura;
        $height = $altura;
        $emembed = '<object width="' . $width . '" height="' . $height . '"><param name="movie" value="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/' . $id . '&amp;hl=en_US&amp;fs=1?rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="' . $width . '" height="' . $height . '"></embed></object>';
        return $emembed;

    }
}

?>