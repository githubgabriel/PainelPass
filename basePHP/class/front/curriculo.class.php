<?php

class Curriculo {

    // var $table_curriculo = "";
    static $table_curriculo_experiencia = "modulo_curriculo_experiencia";

    public function getHTML_curriculo_experiencia_timeline() {
        $sql = "select * from ".self::$table_curriculo_experiencia." where status = 1 order by data_inicio desc";
        $re = conexao::query($sql);
        $num = conexao::num_rows($re);
        if($num) {
            for($i=0;$i<$num;$i++) {

                $aw = conexao::fetch_array($re);

                /* Tratamento DATA FIM */
                if($aw["data_fim"] == NULL) {
                    $aw["data_fim"] = "até <b>Agora</b>"; $IN = "in";
                }else {
                    $dataEx = explode("-",$aw["data_fim"]);
                    $aw["data_fim"] = " á ".php::get_Mes_String2($dataEx[1])."/".$dataEx[0];
                    $IN = "";
                }

                /* Tratamento DATA INICIO */
                $dataEx = explode("-",$aw["data_inicio"]);
                $aw["data_inicio"] = php::get_Mes_String2($dataEx[1])."/".$dataEx[0];


                $saida .= '<div class="timeline-item">
								<div class="timeline-item-date">'.$aw["data_inicio"].'<br>'.$aw["data_fim"].'</div><!-- date -->
									<!-- timeline item trigger -->
									<div class="timeline-item-trigger">
										<span class="icon-minus-sign" data-toggle="collapse" data-target="#job'.$i.'"><i></i></span>
									</div>
									<!-- /end of timeline item trigger -->
									<div class="timeline-arrow"><i></i></div>
									<!-- timeline main content -->
									<div class="timeline-item-content">
										<h3 class="timeline-item-title" data-toggle="collapse" data-target="#job'.$i.'"> '.utf8_encode($aw["empresa"]).' </h3>
										<div class="collapse '.$IN.'" id="job'.$i.'">
											<p><small class="muted">de '.$aw["data_inicio"].' '.$aw["data_fim"].'</small></p>
											<h4 class="media-heading primary-color">Função: '.utf8_encode($aw["cargo"]).' </h4>
											<p>'.utf8_encode($aw["descricao"]).'</p>
											<p><a href="'.$aw['link'].'" target="_blank" title="" class="noprint">&rarr; Ver Website</a></p>
										</div>
								    </div>
								 	<!-- /end of timeline main content -->
							</div>';

            }
            return $saida;
        } else {
            echo "Nenhum Registro!";
        }
    }

}