<?php
/*
*   @author Gabriel A. Barbosa
*   @desc class gerenciamento de Log
*   @version 1.0.0
*/
class log {

    public function insertLog($iden,$icon,$color,$valor) {
        conexao::query("insert into logs (identificador,icon,color,valor,datahora) values ('".$iden."','".$icon."','".$color."','".$valor."', NOW())");
    }

    public function getLog($iden) {
        $where = $this->getLog_prepareWhere($iden);
        $re = conexao::query("select * from logs $where order by datahora desc");
        $num = conexao::num_rows($re);
        if($num) {
            $saida = null;
            for($i=0;$i<$num;$i++) {
                $aw = conexao::fetch_array($re);
                $saida .= $this->templateLog($aw["icon"],$aw["color"],$aw["valor"],$aw["datahora"]);
            }
            return $saida;
        } else { return $this->noTemplateLog(); }
    }

    private function getLog_prepareWhere($iden) {
        if($iden) {
            $iden = explode(",",$iden);
            $where = "where";
            foreach($iden as $valor) { $where .= " identificador = '".$valor."' or"; }
            $where = substr($where, 0, -2);
            return $where;
        }
    }

    private function qtd_dias_passado($datafinal) {
        if($datafinal != "") {
            $datetime_atual = php::get_Data("nomysql");
            $dias = php::getDiasEntreDatas($datafinal, $datetime_atual);
            if($dias == 1) {
                $dias .= " dia atrás";
            } else if($dias > 1 and $dias < 30) {
                $dias .= " dias atrás";
            } else if($dias >= 30) {
                $dias = $datafinal;
            }
            else
            {
                $dias = "<b>Hoje</b>";
            }
        }else{ $dias = "Sem Data"; }
        return $dias;
    }

    private function templateLog($icon,$color,$valor,$datetime) {

        if($color) { $color = "style='background-color:".$color." !important';"; }

        $datetime = php::datahora_format($datetime);

        $dias = $this->qtd_dias_passado($datetime[0]);

        $template = '<li>
        <div class="col1">
            <div class="content">
                <div class="content-col1">
                    <div class="label label-success" '.$color.'><i class="'.$icon.'"></i></div>
                </div>
                <div class="content-col2">
                    <div class="desc"> '.$valor.' </div>
                </div>
            </div>
        </div> <!-- /.col1 -->
        <div class="col2">
            <div class="date">'.$dias.'</div>
        </div> <!-- /.col2 -->
    </li>';

        return $template;
    }

    private function noTemplateLog() {
        $template = '<li>
    <div class="col1">
        <div class="content">
            <div class="content-col1">
                <div class="label label-success"><i class="icon-info"></i></div>
            </div>
            <div class="content-col2">
                <div class="desc"> Nenhuma mensagem.</div>
            </div>
        </div>
    </div>
    <div class="col2">
        <div class="date">
           Agora
        </div>
    </div>
</li>';
        return $template;
    }

}